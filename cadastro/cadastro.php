<?php
    echo "Loading...";
    // Verifica se todos os campos foram preenchidos corretamente
    if (!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['senha'])){ ?>
    <script>
        // Retorna para a janela anterior e mostra uma mensagem para o usuário
        location.href = "cadastro.html?err=faltacampos"
    </script>
    <?php
    }

    // Se tudo estiver certo, cadastra o usuário
    require_once("../src/metodos.php");
    $usuario = new User;
    $usuario->constructor(0);
    $ret = $usuario->createUser([$_POST['nome'], $_POST['email'], $_POST['senha']]);
    // Caso dê tudo certo...
    if ($ret > 0){
?>
    <script>
        // Redireciona para a tela de cadastro
        location.href = "/Login/Login.php?prev=cadastro"
    </script>
<?php

    } // End if
    // Se ocorrer algum erro:
    else{
        if ($ret == -2){    // Se o erro for que o usuário ja existe:
            echo "Usuário existente";
        }
        if ($ret == -1){    // Se for algum outro erro interno:
            echo "internal error";
        }
    }
    ?>
    <script>
        // Redireciona para a tela de cadastro
       location.href = "/cadastro/cadastro.html"
    </script>
