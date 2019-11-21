<?php
    require_once("../src/metodos.php");
    $usuarios_obj = new User;
    $file_obj     = new LocalStorage;
    $logado = checkLogin();
    if ($logado){
        $uid = $_COOKIE['uId'];
        $loged_user = $usuarios_obj->findUserById($file_obj, $uid);
        $loged_user = $usuarios_obj->getUser($file_obj, $loged_user);
    }

    // Nome do arquivo
    $arquivo = $loged_user[1];

    // Converte para texto
    $string_version = implode(',', $loged_user);
    echo $string_version;
    $tipo = ".csv";
    header("Content-Type: ".$tipo); 
    header("Content-Disposition: attachment; filename=".basename($arquivo)); 
    exit; // aborta pós-ações
?>