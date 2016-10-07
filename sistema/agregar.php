<?php
include '../includes/db_connect.php';

$horain = date("H:i:s");
$fecha = date("Y-m-d");
$horacomp = strtotime($horain);
$hmn = strtotime("12:59:59");

$cod = $_REQUEST['cod'];


    $stmt_dep = "SELECT cedula from empleados where codigo = ?";
    $stmt = $mysqli->prepare($stmt_dep);
    if($stmt)
        {
            $stmt->bind_param('s',$cod);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1)
            {
                if ($stmt = $mysqli->prepare("SELECT cedula, estado from empleados where codigo = ? ")) 
                         {
                            $stmt->bind_param('s', $cod);  // Une “$email” al parámetro.
                            $stmt->execute();    // Ejecuta la consulta preparada.
                            $stmt->store_result();
                            // Obtiene las variables del resultado.
                            $stmt->bind_result($cedu,$estado);
                            $stmt->fetch();
                            echo "$cedu";
                            echo "$estado";
                            if($estado=="af")
                            {
                                echo 'Afuera';
                                if($horacomp<$hmn)
                                {
                                    
                                    if ($insert_stmt = $mysqli->prepare("INSERT INTO entradas(fecha,horamnn,empleados_cedula) VALUES(?,?,?);")) 
                                            {
                                                $insert_stmt->bind_param('sss',$fecha,$horain,$cedu);
                                            }                          
                                }
                            }
                            elseif ($estado=="ad") 
                                {

                                }
                        }

            }
            echo 'error';
        }





 