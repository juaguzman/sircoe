<?php
//include './includes/psl-config.php';
include '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include '../../includes/acciones.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="styles/main.css" />
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../../css/pr.css" rel="stylesheet" type="text/css" />
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../../css/tabla.css" rel="stylesheet" type="text/css" />
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

             <h1>Listado de Horas de entrada y salida</h1>
                <br>
                <br>
                <br>
              <h1>Reporte Horario de la tarde</h1>
             <div class="mnn">
        <div class="generatecss_dot_com_table">                
                <?php 
                $id = $_SESSION['user_id'];
                    acciones::reporteManiana($id);
                ?>
            </div>
          </div>
             <br>
             <br>
             <h1>Reporte Horario de la tarde</h1>
             <div class="mnn">
        <div class="generatecss_dot_com_table">                
                <?php 
                $id = $_SESSION['user_id'];
                    acciones::reporteTarde($id);
                ?>
            </div>
          </div>
        <?php else : include './acesodenegado.php'; ?>
            
        <?php endif; ?>
            
        
    </body>
</html>