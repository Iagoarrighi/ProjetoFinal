<?php

// Classe com os métodos para acesso dos arquivos locais
class localStorage{
  // Atributo privado que guarda o local onde se encontrará o arquivo csv
  private $csvDir = "../tmp/usuarios.csv";
  function teste(){
    echo $this->csvDir;
  }

  // Métodos CRUD's básicos
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
class user{
  // Recupera os dados de um usuário já cadastrado
  function getUser($localStorage, $index){
    // Verifica se todos os parâmetros foram passados corretamente
    if (!isset($localStorage) || !isset($index)){ return -1; }
    $users = $storage->getLocalStorage();
    if (isset($users['index'])){ return $users[$index]; }  // Verifica se o usuário existe
    return -1;
  }

  // Procura pelo índice de um usuário no sistema
  function findUser($storage, $userId){
    if (!isset($userId)){ return -1; }

    $users = $storage->getLocalStorage();
    for ($i = 0; count($users)>$i; $i++){
      if ($users[$i][0] == $userId){ return $i;}
    }
    return -1;
  }

  // Cria um novo usuário
  function createUser($storage, $userData){
    if (!isset($storage) || !isset($userData)){ return -1; }
    $storage->putOnLocalStorage($userData);
  }

  // Atualiza os dados de um usuário já existe  
  function updateUser($storage, $userId, $newInformations){
    $user = $this->getUser($userId);
    $users = $storage->getLocalStorage();
    $users[$user] = $newInformations;
    $storage->updateLocalStorage();
  }

  // Deleta um usuário já existe
  function deleteExistentUser($storage, $userId){
    if (!isset($storage) || !isset($userId)){ return -1; }
     $storage->deleteFromLocalStorage($this->findUser($userId));
  }
}

$storage = new localStorage();
$usuario = new user;

