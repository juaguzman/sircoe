<?php
//include './includes/psl-config.php';
include '../includes/db_connect.php';
include_once '../includes/functions.php';
include '../includes/acciones.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="styles/main.css" />
        <link href="../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../css/tabla.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h2><img id="titu" src="../imagenes/titulo.png"></h2>
            <a href="www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
        </header>
        <?php if (login_check($mysqli) == true) : 
            include 'nav.php';
            $id = $_SESSION['user_id'];
        ?>
        <div class="container">
            <!--<h1>Pagina de empleados listado de todos los emplados por dependencia osea los que puede ver el administrador o director de esa dependencia como por ejemplo servicios generales</h1>-->
            <h1>Listado de empleados de su dependencia</h1>
<!--            <p>
                Este es un ejemplo de página protegida.  Para acceder a esta página, los usuarios
                deberán iniciar su sesión.  En algún momento, también verificaremos el rol 
                del usuario para que las páginas puedan determinar el tipo de usuario 
                autorizado para acceder a la página.
            </p>
            
            <p>Regresar a la<a href="index.php">página de inicio de sesión.</a></p>-->
            
            <div class="generatecss_dot_com_table">
                
                <?php acciones::listarEmpleadosDep($id)
                ?>
            </div>
        </div>
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
            
        
    </body>
</html>