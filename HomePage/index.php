<?php
    require_once("../src/metodos.php");
    $usuarios_obj = new User;
    $file_obj     = new localStorage;
?>
<!DOCTYPE html>
<html> 
    <header>
        <meta charset="utf-8">
        <title>G1.com</title>
        <link href="../src/menu.css" rel="stylesheet" type="text/css">
        <link href="index.css" rel="stylesheet" type="text/css">

    </header>
    <body>
        <div class="menu-root">
            <div class="parte-superior">
                <table class="links">
                    <tr>
                        <td class="links_td" id="globo" style="color: darkblue"><a href="#">globo.com</a></td>
                        <td class="links_td" id="g1" style="color: rgba(179, 28, 17, 0.767);"><a href="#">g1</a></td>
                        <td class="links_td" id="globoesporte" style="color: darkblue"><a href="#">globoesporte</a></td>
                        <td class="links_td" id="gshow" style="color: darkblue"><a href="#">gshow</a></td>
                        <td class="links_td" id="videos" style="color: darkblue"><a href="#">Vídeos</a></td>
                    </tr>
                </table>
                <table class="userspace">
                    <?php 
                    $logado = checkLogin();
                    if ($logado){
                        $uid = $_COOKIE['uId'];

                        $loged_user = $usuarios_obj->findUserById($file_obj, $uid);
                        $loged_user = $usuarios_obj->getUser($file_obj, $loged_user);
                        
                        // Gerar dinâmicamente com PHP com os dados cadastrais se logado
                        gerarMenu($loged_user);
                    }
                        else{
                        //Caso não esteja logado, mostrar o menu de login
                    ?>
                    <tr>
                        <td class="links_td"><a description="Inscrever-se" href="../Assinar/assinar.html">Assine já</a></td>
                        <td class="links_td"><a descrioption = "Login" href="/Login/Login.php">Cadastro</a></td>
                        <td class="links_td"><a description = " Globomail"alt="Globomail" href="/Login/Login.php">Email</a></td>
                        <td class="links_td" id="entrar"><a href="../Login/Login.php">Entrar</a></td>
                    </tr>
                    <?php
                        }
                    ?>
     
                        </table>
            </div>
            <div class="parte-inferior">
                <div class="menu">
                    <div class="menu_escondido">
                        <ul type = "none">
                            <li><a href = "#"> Mais lidas </a></li>
                            <li><a href = "#"> Recentes </a> </li>
                            <li><a href = "#"> Contate-nos </a></li>
                            <li><a href = "#"> Sobre </a></li>
                    </div>
                   <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <rect id="svg_1" height="4" width="20" y="0"  x="0" stroke-width="1" fill="#fff"/>
                                <rect id="svg_2" height="4" width="20" y="7"  x="0" stroke-width="1" fill="#fff"/>
                                <rect id="svg_3" height="4" width="20" y="14" x="0" stroke-width="1" fill="#fff"/>
                            </g>
                           </svg>
                           <p>Menu</p>
                </div>
                <div class="g1-logo">
                    G1
                </div>
                <div class="pesquisar">
                    <form action="" enctype="multipart/form-data">
                        <input placeholder="Pesquisar" type="text">
                    </form>
                </div>
            </div>    
             
        </div>
        <div class="top_right">
                <div class="P1">
                    <figure>
                        <img src="principal1.jpg" alt="Pricipal 1">
                    </figure>
                </div>
                <div class="top_left">
                    <div class="P2">
                        <figure>
                            <img src="principal2.jpg" alt="Pricipal 2">
                        </figure>
                    </div>
                    <div class="P3">
                        <figure>
                            <img src="principal3.jpg" alt="Pricipal 3">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="bottom_left">
                <div>
                    <figure>
                        <img src="noticia1.jpg" alt="Noticia 1">
                    </figure>
                </div>
            </div>
            <div class="bottom_right">
                <div>
                    <figure>
                        <img src="noticia1.jpg" alt="Mais Lidas">
                    </figure>
                </div>
            </div>
        
    </body>
</html>
