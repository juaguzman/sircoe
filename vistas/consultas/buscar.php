
<?php 

include '../../includes/db_connect.php';
//Recogemos la cadena
$busqueda=$_POST['cadena'];

//Aquí hacer la consulta para la busqueda con LIKE $busqueda
//$query = sprintf("SELECT * FROM empleados WHERE nombres LIKE %s", 
//        GetSQLValueString("%" . $busqueda . "%", "text")); //Función GetSQLValueString al fina del tema

$consulta = "SELECT * from empleados  WHERE nombres LIKE '%".$busqueda."%';";
        $result   = $mysqli->query($consulta);
         echo '<table>';
         echo'<tr>';
        echo '<td>Cedula</td>';
        echo '<td>Codigo</td>';
        echo '<td>Nombres</td>';
        echo '<td>Apellidos</td>';
        echo '<td>Dependencia</td>';
        echo '<td>Estado</td>';
        echo '</tr>';
                
        while ($campo=mysqli_fetch_object($result)) 
        {
          
            echo "<tr><td>$campo->cedula</td><td>$campo->codigo</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->dependencias_id_depen</td><td>$campo->estado</td>";
        }
        echo '<table>';

//Esto se pega en la div #mostrar
echo 'Demo '.$busqueda; //Mostrar los resultados aquí

?>