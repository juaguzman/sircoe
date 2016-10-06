<?php
//include './includes/psl-config.php';
include '../../includes/db_connect.php';
include_once '../../includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="styles/main.css" />
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h2><img id="titu" src="../../imagenes/titulo.png"></h2>
            <a href="www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
            <h2><a href="http://www.umariana.edu.co "><img id="escudo" src="../../imagenes/escudo2.png"></a></h2>
        </header>
        <?php if (login_check($mysqli) == true) : 
            include 'nav.php';
        ?>
        <div class="container">
            
            <p>
            <h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </h1>            </p>
            
            <p>Regresar a la<a href="index.php">página de inicio de sesión.</a></p>
        </div>
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
            
        
    </body>
</html>