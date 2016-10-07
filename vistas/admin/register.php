<?php

include_once '../../includes/functions.php';
include '../../includes/acciones.php';
include_once '../../includes/register.inc.php';
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Formulario de registro</title>
        <script type="text/JavaScript" src="../../js/sha512.js"></script> 
        <script type="text/JavaScript" src="../../js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../../css/tabla.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h2><img id="titu" src="../../imagenes/titulo.png"></h2>
            <a href="http://www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
            <h2><a href="http://www.umariana.edu.co "><img id="escudo" src="../../imagenes/escudo2.png"></a></h2>
        </header>
        <?php if (login_check($mysqli) == true && $_SESSION['rol']=='admin') : 
            
            include 'nav.php';
        
        ?>
        <!-- Formulario de registro que se emitirá si las variables POST no se
          establecen o si la secuencia de comandos de registro ha provocado un error. -->
        <div class="container">
            <div id="condiciones">
                <ul>
                    <li> Los nombres de usuario podrían contener solo dígitos, letras mayúsculas, minúsculas y guiones bajos.</li>
                    <li> Los correos electrónicos deberán tener un formato válido. </li>
                    <li> Las contraseñas deberán tener al menos 6 caracteres.</li>
                    <li>Las contraseñas deberán estar compuestas por:
                <ul>
                    <li> Por lo menos una letra mayúscula (A-Z)</li>
                    <li> Por lo menos una letra minúscula (a-z)</li>
                    <li> Por lo menos un número (0-9)</li>
                </ul>
                    </li>
                    <li> La contraseña y la confirmación deberán coincidir exactamente.</li>
                </ul>
            </div>
            <br>
            <div class="agreER">
                <h1 id="re">Regístro De Ususarios</h1>
            </div>
        <?php
        if (!empty($error_msg)) 
       {
            echo $error_msg;
        }
        ?>
        <div class="contenido">
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
            <br>
            <br>
            <h3 id="texto">Cedula: <input type='number' maxlength="11" name='cedu' id='cedu'  value="<?php if (!empty($cedu)) { echo $cedu;} ?>" required /></h3>
            <?php if(!empty($error_ced)) { echo $error_ced;} ?>
                <br>
                <br>
                <h3 id="texto">Nombres: <input type='text' name='nom' id='nom' value="<?php if (!empty($nom)) { echo $nom;} ?>" required /></h3>
                <br>
                <br>
                <h3 id="texto">Apellidos: <input type='text' name='apll' id='apll' required  value="<?php if (!empty($apell)) { echo $apell;} ?>" /></h3>
                <br>
                <br>
                <h3 id="texto">Dependencia: <select name='dep' id='dep' > 
                        <option value="0" selected >Seleccione una dependencia</option>
                        <?php acciones::selectDependencia() ?>
                    </select></h3>
                 <?php if(!empty($error_dep)) { echo $error_dep;} ?>
                <br>
                <br>
                <h3 id="texto">Nombre de usuario: <input type='text' name='username' id='username' value="<?php if (!empty($username)) { echo $username;} ?>" required /></h3>
                 <?php if(!empty($error_usu)) { echo $error_usu;} ?>
                <br>
                <br>
            <h3 id="texto">Correo electrónico: <input type="text" name="email" id="email" value="<?php if (!empty($email)) { echo $email;} ?>" /></h3>
                 <?php if(!empty($error_email)) { echo $error_email;} ?>
                <br>
                <br>
            <h3 id="texto">Contraseña: <input type="password" name="password" id="password"/></h3>
            <?php if(!empty($error_conra)) { echo $error_conra;} ?>
                <br>
                <br>
            <h3 id="texto">Confirmar contraseña: <input type="password" name="confirmpwd" id="confirmpwd" /></h3>
                <br>
                <br>
            <h3 id="texto">Funcion: 
                <select name="rol" id="rol">
                <option value="no" selected  >Seleccione funcion del usuario</option>
                <option value="admin" >Administrador</option>
                <option value="consul">Consultor</option>
                </select></h3>
                <br>
                <br>
                <input class="btn" type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" /> 
        </form>
            <br>
            <h4 id="texto" class="fin"><p>Regresar a la <a href="index.php">Pagina de inicio</a>.</p></h4>
        </div>
        </div>
  <?php else : ?>
            <p>
                <span class="error"> No está autorizado para acceder a esta página. </span> Por favor ingrese como administrador <a href="index.php">login</a>.
            </p>
   <?php endif; ?>
    </body>

</html>