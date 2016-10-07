<?php
//include './includes/psl-config.php';
include './includes/db_connect.php';
include_once './includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link href="css/layout.css" rel="stylesheet" type="text/css" />
        <link href="css/menu.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/login.css" rel="stylesheet" type="text/css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
       
    </head>
    <body>
        
        
         <?php if (login_check($mysqli) == true) : 
           header('Location: vistas/admin/index.php');
             ?>
            
        <?php else : ?>
            <header>
            <h2><img id="titu" src="imagenes/titulo.png"></h2>
            <a href="www.umariana.edu.co" class="stuts">Sistema de Registro y Control de Emplados<span>UNIMAR</span></a>
        </header>
        
        <div class="container">
             <div id = "form_wrapper" class = "form_wrapper">
      <form class="login active" action="includes/process_login.php" method="post" name="login_form">
	 <h3>Inicio De Sesion</h3>
	 <div>
		 <label>Correo:</label>
                 <input type="text" name="email"  placeholder="alguien@correo.com"/>
	 </div>
	 <div>
		 <label>Contraseña: 
			 <?php
                            if (isset($_GET['error'])) 
                            { 
                             echo '<p class="error">Usuario o Contraseña Incorrectos!</p>';
                            }
                            ?> 
		 </label>
             <input type="password" name="password" placeholder="Contraseña" />
	 </div>
	 <div class="bottom">
		
             <input type="submit" value="acceder" onclick="formhash(this.form, this.form.password);" />
             <a href="index.php" rel="register" class="linkform">
			 Si no recuerda su contraseña contacte al administrador del sistema
                         Email: test@example.com
                         Password: 6ZaxN2Vzm9NUJT2y
		 </a>
             <div class="clear">
                 
             </div>
	 </div>
 </form>
                 
                 
            </div>
        </div>
        <?php endif; ?>
            
    </body>
  
</html>