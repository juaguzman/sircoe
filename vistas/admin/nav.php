       <div class="container">

            <ul id="nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a class="hsubs" href="empleados.php">Empleados</a>
                   <ul class="subs">
                       <li><a href="agregarEmpleado.php">Agregar E</a></li>
                   </ul> 
                </li>
                <li><a class="hsubs" href="reporteTotalDep.php">Reportes</a>
                     <ul class="subs">
                         <li><a href="buscarCedula.php">Busqueda Reportes</a></li>
                    </ul>
                </li>
                <div id="nomses">
                    <li id="nomses" class="active" ><a href="#">¡Bienvenido, <?php if (isset($_GET['error'])){echo '<p class="error">Error Logging In!</p>';}else {echo htmlentities($_SESSION['username']);}?> !</a>
                        <ul class="subs">
                           <?php if($_SESSION['rol']=="admin"){ ?>
                          <li><a href=register.php >Agegar Administrador</a></li>
                           <?php } ?>
                            <li><a href="modPerfil.php">Modificar Perfil</a></li>
                            <li><a href="../../includes/logout.php">Cerrar sesion</a></li>
                    </ul>
                    </li>
                </div>
                <div id="lavalamp"></div>
            </ul>

        </div>
