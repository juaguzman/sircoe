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
        <link rel="stylesheet" href="../../css/pr.css" />
        <link rel="stylesheet" href="../../css/tabla.css" />
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	function buscar_ajax(cadena){
		$.ajax({
		type: 'POST',
		url: 'buscar.php',
		data: 'cadena=' + cadena,
		success: function(respuesta) {
			//Copiamos el resultado en #mostrar
			$('#mostrar').html(respuesta);
	   }
	});
	}
</script>
    </head>
    <body >
        <header>
            <h2><img id="titu" src="../../imagenes/titulo.png"></h2>
            <a href="www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
        </header>
        <?php if (login_check($mysqli) == true) : 
            include 'nav.php';
        ?>
        <div class="container">
            <h1>Busqueda de Reportes</h1>
            <div class="buscar">
                <form>
                    <input type="text" name="bucar" class="cedu" placeholder="Cedula,nombre,apellido,fecha" onkeyup="buscar_ajax(this.value);" />
                </form>
            </div>
            <div class="generatecss_dot_com_table" id="mostrar" >
            </div>
        </div>
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
            
        
    </body>
</html>