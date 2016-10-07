<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
$error_email="";
$error_conra="";
$error_usu="";
$error_ced="";
$error_dep="";
$error_rol="";
 
if (isset($_POST['username'], $_POST['email'],$_POST['rol'], $_POST['p'], $_POST['cedu'], $_POST['nom'], $_POST['apll'], $_POST['dep'])) 
        {
    // Sanear y validar los datos provistos.
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $cedu  = filter_input(INPUT_POST, 'cedu',FILTER_SANITIZE_NUMBER_INT);
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $apell = filter_input(INPUT_POST, 'apll', FILTER_SANITIZE_STRING);
    $dep = filter_input(INPUT_POST, 'dep',FILTER_SANITIZE_NUMBER_INT);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
        // No es un correo electrónico válido.
        $error_msg .= '1';
        $error_email = '<p class="error">La direccion de email ingresada no es valida</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // La contraseña con hash deberá ser de 128 caracteres.
        // De lo contrario, algo muy raro habrá sucedido. 
        $error_msg .= '2';
        $error_conra = '<p class="error">Error en la configuracion de la contraseña.</p>';
    }
 
    // La validez del nombre de usuario y de la contraseña ha sido verificada en el cliente.
    // Esto será suficiente, ya que nadie se beneficiará de
    // violar estas reglas.
    //
 
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo electrónico existente.  
    if ($stmt) 
    {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ya existe otro usuario con este correo electrónico.
            $error_msg .= '3';
            $error_email ='<p class="error">EL email ya existe en el sistema.</p>';
                        
        }
                
    } else 
    {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                
    }
    
    //validar dependencia
    if($dep==0)
    {
        $error_msg .= '3';
        $error_dep = '<p class="error">Seleccione una dependencia.</p>';
    }
    if($rol=="no")
    {
        $error_msg .= '3';
      $error_rol='<p class="error">Seleccione un funcion del usuario.</p>';  
    }
 
    // Verifica el nombre de usuario existente. 
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // Ya existe otro usuario con este nombre de usuario.
                        $error_msg .= '4';
                        $error_usu ='<p class="error">el nombre de ususario ya existe</p>';
                        
                }
               
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                
        }
 
    // Pendiente: 
    // También habrá que tener en cuenta la situación en la que el usuario no tenga
    // derechos para registrarse, al verificar qué tipo de usuario intenta
    // realizar la operación.
    // 
   // validar cedula
   $prep_stmt = "SELECT id FROM members WHERE id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) 
        {
        $stmt->bind_param('s', $cedu);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1)
                    {
                        // Ya existe otro usuario con este nombre de usuario.
                        $error_msg .= '4';
                        $error_ced ='<p class="error">La cedua ya esta registrada</p>';
                        
                    }
                
        }
        else 
            {
                $error_msg .= '<p class="error">Database error line 55</p>';
                
        }     
          
        
        
 
    if (empty($error_msg)) {
        // Crear una sal aleatoria.
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Crea una contraseña con sal. 
        $password = hash('sha512', $password . $random_salt);
 
        // Inserta el nuevo usuario a la base de datos.  
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members(id,username,email,rol,password,salt) VALUES (?,?,?,?,?,?);")) 
        {
            $insert_stmt->bind_param('ssssss',$cedu, $username, $email,$rol, $password, $random_salt);
            // Ejecuta la consulta preparada.
            if ($insert_stmt->execute()) 
           {
                if($insert_usu = $mysqli->prepare("INSERT INTO usuarios(idadmin,nombre_ad,apellidos_ad,dependencias_id_depen,members_id) VALUES (?,?,?,?,?);"))
                {
                    $insert_usu->bind_param('sssss',$cedu,$nom,$apell,$dep,$cedu);
                }
                else{header('Location: ../error.php?err=Registration failure: INSERT');}
                if(!$insert_usu->execute())
                {
                  header('Location: ../error.php?err=Registration failure: INSERT');
                }
                 header('Location: index.php?msj='.$username.'&opt=1');
           }
           else
           {
               header('Location: ../error.php?err=Registration failure: INSERT');
           }
        }
        
    }
}