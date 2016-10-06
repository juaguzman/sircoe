<?php
include_once '../../includes/register.inc.php';
include_once '../../includes/functions.php';
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Formulario de registro</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../../css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../../css/tabla.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true && $_SESSION['rol']=='admin') : 
            
            include 'nav.php';
        
        ?>
        <!-- Formulario de registro que se emitirá si las variables POST no se
          establecen o si la secuencia de comandos de registro ha provocado un error. -->
        <h1>Regístrate con nosotros</h1>
        <?php
        if (!empty($error_msg)) 
       {
            echo $error_msg;
        }
        ?>
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
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
            Nombre de usuario: <input type='text' name='username' id='username' /><br>
            Correo electrónico: <input type="text" name="email" id="email" /><br>
            Contraseña: <input type="password" name="password" id="password"/><br>
            Confirmar contraseña: <input type="password" name="confirmpwd" id="confirmpwd" /><br>
            <select name="rol" id="rol">
                <option value="admin" selected >Administrador</option>
                <option value="consul">Consultor</option>
            </select>
            <input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" /> 
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
  <?php else : ?>
            <p>
                <span class="error"> No está autorizado para acceder a esta página. </span> Por favor ingrese como administrador <a href="index.php">login</a>.
            </p>
   <?php endif; ?>
    </body>

</html>