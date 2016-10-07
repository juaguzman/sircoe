<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_dep='';
if(isset($_POST['ced'],$_POST['nom'],$_POST['apell'],$_POST['dep']))
{
    
    $cedu = filter_input(INPUT_POST, 'ced', FILTER_SANITIZE_NUMBER_INT);
    $depe = filter_input(INPUT_POST, 'dep', FILTER_SANITIZE_NUMBER_INT);
    $apell = filter_input(INPUT_POST, 'apell', FILTER_SANITIZE_STRING);
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $codi = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
    
    if($depe==0)
    {
       $error_dep='<p class="error">Seleccione una dependencia</p>'; 
    }
    
    if(empty($error_dep))
    {
        if ($insert_stmt = $mysqli->prepare("update empleados set nombres = ?, apellidos = ?, dependencias_id_depen = ? where cedula=?;")) 
            {
            $insert_stmt->bind_param('ssss',$nom,$apell,$depe,$cedu);
             if ($insert_stmt->execute())
                {
                 $msj=$cedu;
                header('Location: empleados.php?msj='.$msj.'&opt=2'); 
                 
                }
            
            }
    }
   
    
}
