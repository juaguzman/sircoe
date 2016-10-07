
<?php 

include '../../includes/db_connect.php';
//Recogemos la cadena
$busqueda=$_POST['cadena'];
$id = $_POST['id'];
//and ( empleados.nombres like '%".$busqueda."%' or empleados.apellidos LIKE '%".$busqueda."%' or empleados.cedula LIKE '%".$busqueda."%' or tarde.fecha LIKE '%".$busqueda."%' )
//Aquí hacer la consulta para la busqueda con LIKE $busqueda
//$query = sprintf("SELECT * FROM empleados WHERE nombres LIKE %s", 
//        GetSQLValueString("%" . $busqueda . "%", "text")); //Función GetSQLValueString al fina del tema

         $consulta = "SELECT empleados.cedula as 'cedula', empleados.nombres as 'nombres', empleados.apellidos as 'apellidos', maniana.fecha as 'fecha', maniana.entrada as 'entrada', maniana.salida as 'salida'  FROM empleados, maniana WHERE empleados.cedula = maniana.empleados_cedula and empleados.dependencias_id_depen = $id and ( empleados.nombres like '%".$busqueda."%' or empleados.apellidos LIKE '%".$busqueda."%' or empleados.cedula LIKE '%".$busqueda."%' or maniana.fecha LIKE '%".$busqueda."%' ) order by maniana.fecha desc, empleados.cedula desc;";
        $result   = $mysqli->query($consulta);
        echo '<table>';
         echo'<tr>';
        echo '<td>Cedula</td>';
        echo '<td>Nombres</td>';
        echo '<td>Apellidos</td>';
        echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;Fecha&nbsp;&nbsp;&nbsp;&nbsp;</td>';
        echo '<td>Entrada</td>';
        echo '<td>Salida</td>';
        echo '</tr>';
        
                while ($campo=mysqli_fetch_object($result)) 
        {
                    echo "<tr><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->fecha</td>";
                    $entramani = strtotime($campo->entrada);
                    $salemani = strtotime($campo->salida);
                    $prep_stmt = "SELECT manientra, manisale FROM horario WHERE empleados_cedula = ? LIMIT 1";
                                  $stmt = $mysqli->prepare($prep_stmt);
                                   if ($stmt) 
                                        {
                                        $stmt->bind_param('s', $campo->cedula);
                                        $stmt->execute();
                                        $stmt->store_result(); 
                                        // Obtiene las variables del resultado.
                                        $stmt->bind_result($manientra,$manisale);
                                        $stmt->fetch();
                                        }

                      if($manientra!=NULL)
                     {
                       $manientra=  strtotime($manientra)+350;  
                     }
                     if($manisale!=NULL)
                     {
                      $manisale=  strtotime($manisale)-900;   
                     }

                     // comprovacion de entrada en la mañana
                   if($manientra!=NULL)
                   {
                    if($manientra<$entramani)
                    {
                        echo "<td id=to >$campo->entrada</td>";
                    }
                    else
                    {
                      echo "<td>$campo->entrada</td>";  
                    }
                   }
                   else{echo "<td> --:--:-- </td>";  };

                   // comaparacion de salida en la mañana
                   if($manisale!=NULL)
                   {
                    if($manisale>$salemani)
                    {
                      echo "<td id=to >$campo->salida</td>";  
                    }
                    else 
                        {
                         echo "<td>$campo->salida</td>";
                        }
                   }
                   else{echo "<td> --:--:-- </td>";  };


                   $entramani = "";
                    $salemani = "";
                    $entratarde = "";
                    $saletarde = "";

                  echo "<tr>"; 
        }
        echo '</table>';

//Esto se pega en la div #mostrar
//echo 'Demo '.$busqueda; //Mostrar los resultados aquí

?>