<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'psl-config.php';
include_once 'db_connect.php';

class acciones
{
    static function listarEmpleadosDep($id)
    {
        include 'db_connect.php';
        $consulta = "SELECT empleados.*, dependencias.nombre as 'dependencia' FROM empleados, dependencias WHERE empleados.dependencias_id_depen = dependencias.id_depen and dependencias.id_depen = $id;";
        $result   = $mysqli->query($consulta);
        echo '<table>';
         echo'<tr>';
        echo '<td>Cedula</td>';
        echo '<td>Codigo</td>';
        echo '<td>Nombres</td>';
        echo '<td>Apellidos</td>';
        echo '<td>Dependencia</td>';
        echo '<td>Estado</td>';
        echo '<td colspan = "2">Opciones</td>';
        echo '</tr>';
        
        while ($campo=mysqli_fetch_object($result)) 
        {
            if(strcmp($campo->estado, "af")==0)
                    {
                        $estado="Inactivo";
                    }
                    else
                    {
                       $estado = "Activo";
                    }
            echo "<tr><td>$campo->cedula</td><td>$campo->codigo</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->dependencia</td><td>$estado</td><td><a href=modificarEmpleado.php?cedu=$campo->cedula><img src=../../imagenes/mod.png width=30px heigt=30px ></a></td><td><a href=../../includes/eliminarEmpleado.php?cedu=$campo->cedula><img src=../../imagenes/eliminar.png width=30px heigt=30px ></a></td></tr>";
        }
        echo '<table>';
    }
    
    
    static function reporteEmpleadosDependencia($id)
    {
        $mñn = "7:03:00";
       include 'db_connect.php';
        $consulta = "SELECT empleados.cedula as 'cedula',empleados.nombres as 'nombres', empleados.apellidos as 'apellidos',  entradas.fecha as 'fecha', entradas.hora as 'entrada', salidas.hora as 'salida' FROM entradas,salidas,empleados,dependencias where dependencias.id_depen = empleados.dependencias_id_depen and empleados.cedula = entradas.empleados_cedula and empleados.cedula = salidas.empleados_cedula and dependencias.id_depen = $id group by empleados.cedula, entradas.fecha order by fecha desc;";
        $result   = $mysqli->query($consulta);
        echo '<table>';
         echo'<tr>';
        echo '<td>Cedula</td>';
        echo '<td>Nombres</td>';
        echo '<td>Apellidos</td>';
        echo '<td>Fecha</td>';
        echo '<td>Entrada</td>';
        echo '<td>Salida</td>';
        echo '</tr>'; 
        
        while ($campo=mysqli_fetch_object($result)) 
        {
            echo "<tr><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->fecha</td>";
            $entrada = $campo->entrada;
            if($entrada>$mñn)
            {
                echo "<td id=tp >$campo->entrada</td>";
            }
            else
            {
              echo "<td id=to >$campo->entrada</td>";  
            }
            echo "<td>$campo->salida</td></tr>";
        }
        echo '<table>';
    }
    
    static function selectDependencia()
    {
        include 'db_connect.php';
         $consulta = "SELECT * FROM dependencias;";
        $result   = $mysqli->query($consulta);
        while ($campo=mysqli_fetch_object($result)) 
        {
            echo "<OPTION VALUE=$campo->id_depen> $campo->nombre</OPTION>";
        }
        
        
    }
}
