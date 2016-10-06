<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agregarE
 *
 * @author juan
 */

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg="";
$error_ape="";
$error_nom="";
$error_ced="";
$error_codi="";
$error_dep="";

if(isset($_POST['apell'],$_POST['nom'],$_POST['ced'],$_POST['cod'],$_POST['dep']))
{
    $cedu = filter_input(INPUT_POST, 'ced', FILTER_SANITIZE_NUMBER_INT);
    $codi = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
    $depe = filter_input(INPUT_POST, 'dep', FILTER_SANITIZE_NUMBER_INT);
    $apell = filter_input(INPUT_POST, 'apell', FILTER_SANITIZE_STRING);
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    
    if($depe==0)
    {
       $error_dep='<p class="error">Seleccione una dependencia</p>'; 
    }
    
    $stmt_dep = "select * from empleados where cedula =? ";
    $stmt = $mysqli->prepare($stmt_dep);
    if($stmt)
        {
            $stmt->bind_param('s',$cedu);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1)
            {
                $error_ced='<p class="error">la cedula ya existe en el sistema</p>';
            }
        }
    else 
        {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->close();
        }
        
        
   $stmt_dep = "select * from empleados where codigo =? ";
    $stmt = $mysqli->prepare($stmt_dep);
    if($stmt)
        {
            $stmt->bind_param('s',$codi);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1)
            {
                $error_codi = '<p class="error">el codigo ya fue asignado</p>';
            }
        }
    else 
        {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->close();
        }
    
        if(empty($error_ced)&& empty($error_dep) && empty($error_codi))
        {
            if ($insert_stmt = $mysqli->prepare("INSERT INTO empleados(cedula,nombres,apellidos,codigo,estado,dependencias_id_depen) VALUES( ?, ?, ?, ?, ?, ?);")) 
            {
              $estado="af";
              $insert_stmt->bind_param('ssssss',$cedu,$nom,$apell,$codi,$estado,$depe);
              
               if ($insert_stmt->execute())
            {
                    $apell=NULL;
                    $nom=NULL;
                    $cedu=NULL;
                    $codi=NULL;
                    $estado=NULL;        
                    echo "<div id=dialog-message title= Empleado Agregado > <p>Empleado agregado correctamente</p></div>";
            }
            else 
            {
                     header('Location: ../../error.php?err=Registration failure: INSERT');
            }
            
            }
        }
    
}