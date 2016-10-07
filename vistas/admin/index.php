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
        <?php if (login_check($mysqli) == true) : 
            include 'nav.php';
        ?>
         <?php if(isset($_REQUEST['msj'],$_REQUEST['opt']))
                 {
        $msj = $_REQUEST['msj'];
        $opt=$_REQUEST['opt'];
        if($opt==1)
        {
         echo "<div id=dialog-message title= Usuario&nbsp;Agregado > <p> El usuario $msj se creo correctamente </p></div>";   
        }
        elseif ($opt==2) 
            {
                 echo "<div id=dialog-message title= Empleado&nbsp;Modificado > <p> Empleado con cedula numero $msj se modifico correctamente </p></div>"; 
            }
        
        }?>
        <div class="container">
            <div class="prin">
                <img src="../../imagenes/alvernia.PNG" width="960px" height="250px">
            </div>
            <div class="noticias">
                <img src="../../imagenes/noticias.PNG" width="960px">
                <img src="../../imagenes/noticias1.PNG" width="960px">
                <img src="../../imagenes/noticias2.PNG" width="960px">
            </div>
                          
            <p>Regresar a la<a href="index.php">página de inicio de sesión.</a></p>
        </div>
            
        <?php endif; ?>
            
        
    </body>
</html>