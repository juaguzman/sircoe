
<?php 

include '../../includes/db_connect.php';
//Recogemos la cadena
$busqueda=$_POST['cadena'];
$id = $_POST['id'];

//Aquí hacer la consulta para la busqueda con LIKE $busqueda
//$query = sprintf("SELECT * FROM empleados WHERE nombres LIKE %s", 
//        GetSQLValueString("%" . $busqueda . "%", "text")); //Función GetSQLValueString al fina del tema

        $consulta = "SELECT empleados.cedula as 'cedula', empleados.nombres as 'nombres', empleados.apellidos as 'apellidos', tarde.fecha as 'fecha', tarde.entrada as 'entrada', tarde.salida as 'salida'  FROM empleados, tarde WHERE empleados.cedula = tarde.empleados_cedula and empleados.dependencias_id_depen = $id and ( empleados.nombres like '%".$busqueda."%' or empleados.apellidos LIKE '%".$busqueda."%' or empleados.cedula LIKE '%".$busqueda."%' or tarde.fecha LIKE '%".$busqueda."%' ) order by tarde.fecha desc, empleados.cedula desc;";
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
                    $entratarde = strtotime($campo->entrada);
                    $saletarde = strtotime($campo->salida);
                    $prep_stmt = "SELECT tardeentra, tardesale FROM horario WHERE empleados_cedula = ? LIMIT 1";
                                  $stmt = $mysqli->prepare($prep_stmt);
                                   if ($stmt) 
                                        {
                                        $stmt->bind_param('s', $campo->cedula);
                                        $stmt->execute();
                                        $stmt->store_result(); 
                                        // Obtiene las variables del resultado.
                                        $stmt->bind_result($tardeentra,$tardesale);
                                        $stmt->fetch();
                                        }

                      if($tardeentra!=NULL)
                     {
                       $tardeentra=  strtotime($tardeentra)+350;  
                     }
                     if($tardesale!=NULL)
                     {
                      $tardesale=  strtotime($tardesale)-900;   
                     }

                    //Comparacion entrada en la tarde
           if($tardeentra!=NULL)
           {
            if($tardeentra<$entratarde)
            {
              echo "<td id=to >$campo->entrada</td>";  
            }
            else 
                {
                 echo "<td>$campo->entrada</td>";
                }
           }
           else{echo "<td > --:--:-- </td>";  };
           
           //comparacion salida en la tarde
           //Comparacion entrada en la tarde
           if($tardesale!=NULL)
           {
            if($tardesale>$saletarde)
            {
              echo "<td id=to >$campo->salida</td>";  
            }
            else 
                {
                 echo "<td>$campo->salida</td>";
                }
           }
           else{echo "<td > --:--:-- </td>";  };
           
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