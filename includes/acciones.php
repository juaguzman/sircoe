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
       
       include 'db_connect.php';
        $consulta = "select empleados.cedula as 'cedula',empleados.nombres as 'nombres', empleados.apellidos as 'apellidos',  entradas.fecha as 'fecha', salidas.fecha as 'salfecha', entradas.horamnn as 'entradamnn', salidas.horamnn as 'salidamnn',entradas.horatrd as 'entradtrd', salidas.horatrd as 'salidatrd'from empleados, entradas, salidas WHERE empleados.cedula = entradas.empleados_cedula AND empleados.cedula = salidas.empleados_cedula and empleados.dependencias_id_depen = $id having salidas.fecha = entradas.fecha order by entradas.fecha desc, empleados.cedula asc;";
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
    }
    
    static function reporteManiana($id)
    {
        
        include 'db_connect.php';
        $consulta = "SELECT empleados.cedula as 'cedula', empleados.nombres as 'nombres', empleados.apellidos as 'apellidos', maniana.fecha as 'fecha', maniana.entrada as 'entrada', maniana.salida as 'salida'  FROM empleados, maniana WHERE empleados.cedula = maniana.empleados_cedula and empleados.dependencias_id_depen = $id order by maniana.fecha desc, empleados.cedula desc;";
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
