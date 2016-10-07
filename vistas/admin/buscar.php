
<?php 

include '../../includes/db_connect.php';
//Recogemos la cadena
$busqueda=$_POST['cadena'];

//Aquí hacer la consulta para la busqueda con LIKE $busqueda
//$query = sprintf("SELECT * FROM empleados WHERE nombres LIKE %s", 
//        GetSQLValueString("%" . $busqueda . "%", "text")); //Función GetSQLValueString al fina del tema

        $consulta = "select empleados.cedula as 'cedula',empleados.nombres as 'nombres', empleados.apellidos as 'apellidos',  entradas.fecha as 'fecha', salidas.fecha as 'salfecha', entradas.horamnn as 'entradamnn', salidas.horamnn as 'salidamnn',entradas.horatrd as 'entradtrd', salidas.horatrd as 'salidatrd'from empleados, entradas, salidas WHERE empleados.cedula = entradas.empleados_cedula AND empleados.cedula = salidas.empleados_cedula and empleados.dependencias_id_depen = 1 and ( empleados.nombres like '%".$busqueda."%' or empleados.apellidos LIKE '%".$busqueda."%' or empleados.cedula LIKE '%".$busqueda."%' or entradas.fecha LIKE '%".$busqueda."%' )  having salidas.fecha = entradas.fecha order by entradas.fecha desc, empleados.cedula asc;";
        $result   = $mysqli->query($consulta);
        echo '<table>';
         echo'<tr>';
        echo '<td>Cedula</td>';
        echo '<td>Nombres</td>';
        echo '<td>Apellidos</td>';
        echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;Fecha&nbsp;&nbsp;&nbsp;&nbsp;</td>';
        echo '<td>Entrada Mañana</td>';
        echo '<td>Salida Mañana</td>';
        echo '<td>Entrada Tarde</td>';
        echo '<td>Salida Tarde</td>';
        echo '</tr>'; 
        
        while ($campo=mysqli_fetch_object($result)) 
        {
            echo "<tr><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->fecha</td>";
            $entramani = strtotime($campo->entradamnn);
            $salemani = strtotime($campo->salidamnn);
            $entratarde = strtotime($campo->entradtrd);
            $saletarde = strtotime($campo->salidatrd);
            $prep_stmt = "SELECT manientra, manisale, tardeentra, tardesale FROM horario WHERE empleados_cedula = ? LIMIT 1";
                          $stmt = $mysqli->prepare($prep_stmt);
                           if ($stmt) 
                                {
                                $stmt->bind_param('s', $campo->cedula);
                                $stmt->execute();
                                $stmt->store_result(); 
                                // Obtiene las variables del resultado.
                                $stmt->bind_result($manientra,$manisale,$tardeentra,$tardesale);
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
              if($tardeentra!=NULL)
             {
               $tardeentra=  strtotime($tardeentra)+350;  
             }
             if($tardesale!=NULL)
             {
              $tardesale=  strtotime($tardesale)-900;   
             }
             
             
            
//            $entrmañ= strtotime("7:06:00");
             // comprovacion de entrada en la mañana
           if($manientra!=NULL)
           {
            if($manientra<$entramani)
            {
                echo "<td id=to >$campo->entradamnn</td>";
            }
            else
            {
              echo "<td>$campo->entradamnn</td>";  
            }
           }
           else{echo "<td> --:--:-- </td>";  };
           
           // comaparacion de salida en la mañana
           if($manisale!=NULL)
           {
            if($manisale>$salemani)
            {
              echo "<td id=to >$campo->salidamnn</td>";  
            }
            else 
                {
                 echo "<td>$campo->salidamnn</td>";
                }
           }
           else{echo "<td> --:--:-- </td>";  };
           
           //Comparacion entrada en la tarde
           if($tardeentra!=NULL)
           {
            if($tardeentra<$entratarde)
            {
              echo "<td id=to >$campo->entradtrd</td>";  
            }
            else 
                {
                 echo "<td>$campo->entradtrd</td>";
                }
           }
           else{echo "<td > --:--:-- </td>";  };
           
           //comparacion salida en la tarde
           //Comparacion entrada en la tarde
           if($tardesale!=NULL)
           {
            if($tardesale>$saletarde)
            {
              echo "<td id=to >$campo->salidatrd</td>";  
            }
            else 
                {
                 echo "<td>$campo->salidatrd</td>";
                }
           }
           else{echo "<td > --:--:-- </td>";  };
           
           $entramani = "";
            $salemani = "";
            $entratarde = "";
            $saletarde = "";
            
          echo "<tr>"; 
        }
        echo '<table>';

//Esto se pega en la div #mostrar
//echo 'Demo '.$busqueda; //Mostrar los resultados aquí

?>