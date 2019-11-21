<?php
$privateKEY = "akjflskadfjaklsjfqiowrvmkajwnwrjh";

// Classe com os métodos para acesso dos arquivos locais
class localStorage{
  // Atributo privado que guarda o local onde se encontrará o arquivo csv
  private $csvDir;
  

  // Construtor do objeto
  function constructor($url){
    $this->csvDir = $url;
  }

  // Cria um novo registro
  function createLocalStorage(){
    // Caso o arquivo não exista
    if (!file_exists($this->csvDir)){
      $arquivo = fopen($this->csvDir,'w');
      fclose($arquivo);
      return -1;
    }
  }

  function getLocalStorage(){    
    // Lê os dados do disco
    $dados = array_map('str_getcsv', file($this->csvDir)); // Lê o arquivo e converte em um array
    return $dados;
  
  } // End getLocalStorage


  function updateLocalStorage($dados){
    // Verifica se todos os parâmetros foram devidadmente passados
    if (!isset($dados)){ return -1; }
    
    // Carrega os dados já armazenados
    $dados += $this->getLocalStorage();

    // Substitui os novos dados no arquivo final
    $fd = fopen($this->csvDir, 'w');

    foreach($dados as $campos){
      fputcsv ($fd, $campos);
    }
  } // End updateLocalStorage
    
    
  function putOnLocalStorage($novo){
    if (!isset($novo)){ return -1; }
    $dados = $this->getLocalStorage();
    $dados[-1] = $novo;
    $this->updateLocalStorage($dados);

  } // End putOnLocalStorage
    
    
  function deleteFromLocalStorage($index){
    if(!isset($index)){ return -1; }
    $dados = $this->getLocalStorage();
    unset($dados[$index]);
    $this->updateLocalStorage($dados);
  }
}


// Classe para controle de Login
class User{
  // Atributos privados da classe
  private $usersCSV, $passwordsCSV, $id;

  // Recupera os dados de um usuário já cadastrado
  function getUser($index){
    // Verifica se todos os parâmetros foram passados corretamente
    if (!isset($index)){ return -1; }
    $users = $this->usersCSV->getLocalStorage();
    if (!isset($users[$index])){ return -2; }  // Verifica se o usuário existe
    
    $senha = $this->passwordsCSV->getLocalStorage();
    $usuarioEncontrado = $users[$index];
    array_push($usuarioEncontrado, $senha[$index][0]);
    return $usuarioEncontrado;
  }

  function constructor($uid){
    // Instancia o objeto usado no acesso aos usuários
    $this->usersCSV = new localStorage;
    $this->usersCSV->constructor("../tmp/usuarios.csv");

    // Inicializa o valor de uid
    $this->id = $uid;
    
    // Instancia o objeto usado no acesso às senhas
    $this->passwordsCSV = new localStorage;
    $this->passwordsCSV->constructor("../tmp/passwords.csv");
  }
  
  // Procura pelo indice de um usuário no sistema pelo Id
  function findUserById(){
    $users = $this->usersCSV->getLocalStorage();
    for ($i = 0; count($users)>$i; $i++){
      if ($users[$i][0] == $this->id){ return $i;}
    }
    return -1;
  }

  // Procura pelo índice de um usuário no sistema pelo username
  function findUserByName($Username){
    if (!isset($Username)){ return -1; }

    $users = $this->usersCSV->getLocalStorage();
    for ($i = 0; count($users)>$i; $i++){
      if ($users[$i][1] == $Username){ return $i;}
    }

    return -1;
  }

  // Cria um novo usuário
  function createUser($userData){
    // Verifica se todos os campos fora devidamente preenchidos
    if (!isset($userData)){ return -1; }
    
    // Verifica se o usuário já existe
    if ($this->findUserByName($userData[0]) >= 0){ return -2 ; }
    
    // Cria um id único para cada usuário
    $id = hash("md5", $userData[0]);

    // Informa que deve ser usada a variável global privateKEY
    global $privateKEY;
    
    // Encripta e armazena a senha
    $senha[1] = crypt(array_pop($userData), $privateKEY);
    $senha[0] = $id;
    $this->passwordsCSV->putOnLocalStorage($senha);
    
    // Termina de preencher os dados
    array_unshift($userData, $id);

    // Armazena isto no local storage
    $this->usersCSV->putOnLocalStorage($userData);
  }

  // Atualiza os dados de um usuário já existe  
  function updateUser($newInformations){
    $user = $this->getUser($this->uid);
    $users = $this->usersCSV->getLocalStorage();
    $users[$user] = $newInformations;
    $this->usersCSV->updateLocalStorage();
  }

  // Deleta um usuário já existe
  function deleteExistentUser($userId){
    if (!isset($userId)){ return -1; }
     $this->usersCSV->deleteFromLocalStorage($this->findUser($userId));
  }
}


// Verifica se o usuário está logado
function checkLogin(){
  if (isset($_COOKIE['uId'])){ return true; }
  else{ return false; }
}

// Função que gera e retorna o menu suspenso do userspace na homepage
function gerarMenu($loged_user){
  echo "
    <div id='logado'>
      <div id='nome'>$loged_user[1]</div>
      <div id='menu-suspenso'>
        <ul type='none'>
          <li><a href = '/Conta/Perfil.php'>Conta</a></li>
          <li><a href = '/Conta/Configurar.php'>Configurações</a></li>
          <li><a href = '/Logout/Logout.php'>Sair</a></li>
        </ul>
      </div>
    </div>
  ";
}