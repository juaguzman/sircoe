<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../includes/db_connect.php';

if(isset($_REQUEST['cedu']))
{
    $cedu=$_REQUEST['cedu'];
    
    $prep_stmt='DELETE FROM empleados WHERE cedula = ?;';
    $stmt = $mysqli->prepare($prep_stmt);
     if ($stmt) 
         {
        $stmt->bind_param('s', $cedu);
       if($stmt->execute())
       {
          $msj=$cedu;
          header('Location: ../vistas/admin/empleados.php?msj='.$msj); 
       }
       
        }
    
}

