<?php include "../includes/header.php"; ?>
        <header></header>
        <script>
            <?php
    	        if (!isset($_SESSION["usuarioId"])) {
	                print "parent.location.replace('../index.php');";
	            }
            ?>
        </script>
        <div style="height: 53px;">
            <ul class="nav navbar-nav" style="float:left; margin-left:1rem">
                <li role="presentation"><a href="asignacion/registroCaso.php" target="objMain">
                    <span class="glyphicon glyphicon-headphones"></span>
                    Solicitud de accesorios
                </a></li>
                <li role="presentation"><a href="GestionCasos/Gestion_Casos.php" target="objMain">
                    <span class="glyphicon glyphicon-edit"></span>
                    Asignación de accesorios
                </a></li>
                <!--
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-gear"></i> Administración <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="disabled"><a href="administracion/notificaciones.php" target="objMain"><i class="fa fa-bell"></i> Notificaciones</a></li>
                        <li><a href="administracion/inventario.php" target="objMain"><i class="fa fa-tasks"></i> Inventario</a></li>
                        <li class="divider"></li>
                        <li class="disabled"><a href="" target="objMain">Administrar Agentes Autorizados</a></li>
                        <li class="disabled"><a href="" target="objMain">Administrar Colores</a></li>
                        <li class="disabled"><a href="" target="objMain">Administrar Modelos</a></li>
                        <li class="disabled"><a href="" target="objMain">Administrar Motivos de Reemplazo</a></li>
                        <li class="disabled"><a href="" target="objMain">Administrar Operadoras</a></li>
                        <li class="disabled"><a href="" target="objMain">Administrar Tecnologías</a></li>
                    </ul>
                </li>
                -->
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right:1rem">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <span class="glyphicon glyphicon-user"></span> <?=$_SESSION["usuarioNombre"]?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="usuario/cambiarClave.php" target="objMain"><span class="glyphicon glyphicon-lock"></span> Cambiar Contraseña</a></li>
                        <?php if($_SESSION["usuarioTipoId"] == 1) { ?>
                        <li class="divider"></li>
                        <li><a href="usuario/administrarUsuarios.php" target="objMain"><span class="glyphicon glyphicon-user"></span> Administrar Usuarios</a></li>
                        <li class="disabled"><a href="#" target="objMain"><i class="fa fa-users"></i> Administrar Grupos</a></li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li><a href="../funciones/sesion.php?accion=cerrarSesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <iframe name="objMain" id="objMain" title="objMain"></iframe>
        <footer>
            Desarrollado por <a href="http://www.vtelca.gob.ve" target="_blank">Venezolana de Telecomunicaciones C.A.</a>
        </footer>
<?php include "../includes/footer.php"; ?>
