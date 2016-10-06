<?php
//include './includes/psl-config.php';
include '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include '../../includes/acciones.php';
include '../../includes/agregarE.inc.php';
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar Empleados</title>
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h2><img id="titu" src="../../imagenes/titulo.png"></h2>
            <a href="http://www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
        </header>
        <?php if (login_check($mysqli) == true && $_SESSION['rol']=='admin') : 
        
            include './nav.php';
        
        ?>
        <br>
        
        <div class="container">
            <div class="agreET">
                 <h1 id="re">Regístro de empleados</h1>
        <?php
        if (!empty($error_msg)) 
       {
            echo $error_msg;
        }
        ?>
            </div>
            <div class="contenido">
                <br>
                <br>
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
            <h3 id="texto">Apellidos: <input type='text' name='apell' id='apellidos' /></h3><br>
            <br>
            <h3 id="texto">Nombres: <input type='text' name='nom' id='nombres' /></h3><br>
            <br>
            <?php if(!empty($error_ced)) { echo $error_ced;} ?>
            <h3 id="texto">Cedula: <input type="number" name="ced" id="cedula" /></h3>
                <br>
                <br>
                <?php if(!empty($error_codi)) { echo $error_codi;} ?>
            <h3 id="texto">Codigo: <input type="number" name="cod" id="codigo"/></h3>
                <br>
            <br>
            <?php if(!empty($error_dep)) { echo $error_dep;} ?>
            <h3 id="texto"> 
                Dependecia: 
                <SELECT NAME="dep" SIZE="1"> 
                   <OPTION VALUE="0">Escoja una Dependencia</OPTION>
                   <?php acciones::selectDependencia()?>
  
                </SELECT>
            </h3> <br> <br>
            
            <input type="submit" value="Agregar Empleado" /> 
        </form>
            </div>
            </div>
        
        <?php else : ?>
            <p>
                <span class="error"> No está autorizado para acceder a esta página. </span> Por favor ingrese como administrador <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
            
        
    </body>
</html>