<?php
    require_once("../src/metodos.php");
    $usuarios_obj = new User;
    $logado = checkLogin();
    if ($logado){
        $uid = $_COOKIE['uId'];
        $usuarios_obj->constructor($uid);
        $loged_user = $usuarios_obj->findUserById();
        $loged_user = $usuarios_obj->getUser($loged_user);
    }
    ?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel = "stylesheet" type = "text/css" href="Perfil.css">
        <title>G1 - Meus dados</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    Id de usuário
                </td>
                <td>
                    Nome
                </td>
                <td>
                    E-mail
                </td>
            </tr>
            <tr>
                <td><?php echo $loged_user[0]; ?></td>
                <td><?php echo $loged_user[1]; ?></td>
                <td><?php echo $loged_user[2]; ?></td>
            </tr>
            <a href="./Baixar.php">Download</a>
    </body>
</html>