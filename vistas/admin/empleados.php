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
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../../css/tabla.css" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" href="../../css/jquery-ui.css" />
                 <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script>
            $(function() 
              {
                $( "#dialog-message" ).dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
                });
              });
      </script>
    </head>
    <body>
        <header>
            <h2><img id="titu" src="../../imagenes/titulo.png"></h2>
            <a href="www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
            <h2><a href="http://www.umariana.edu.co "><img id="escudo" src="../../imagenes/escudo2.png"></a></h2>
        </header>
        <?php if (login_check($mysqli) == true && $_SESSION['rol']=='admin') : 
            include 'nav.php';
            $id = $_SESSION['user_id'];
        ?>
        <?php if(isset($_REQUEST['msj'],$_REQUEST['opt'])){
        $msj = $_REQUEST['msj'];
        $opt=$_REQUEST['opt'];
        if($opt==1)
        {
         echo "<div id=dialog-message title= Empleado&nbsp;Eliminado > <p> Empleado con cedula numero $msj se elimino correctamente </p></div>";   
        }
        elseif ($opt==2) 
            {
                 echo "<div id=dialog-message title= Empleado&nbsp;Modificado > <p> Empleado con cedula numero $msj se modifico correctamente </p></div>"; 
            }
        
        }?>
        <div class="container">
            <!--<h1>Pagina de empleados listado de todos los emplados por dependencia osea los que puede ver el administrador o director de esa dependencia como por ejemplo servicios generales</h1>-->
            <h1>Listado de empleados de su dependencia</h1>
            <br>
            <h2>Horario de la Mañana</h2>
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
        <?php else : include './acesodenegado.php';?>
            
        <?php endif; ?>
            
        
    </body>
</html>