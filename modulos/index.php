<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Servicio Post Venta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../resources/img/favicon.ico">

    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../resources/css/font-awesome.min.css">

    <script src="../resources/js/jquery.min.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>
    <style>
        header {
            width: calc(100% - 10px);
            height: 60px;
            background: url(../resources/img/cintillo-movilnet.png) left no-repeat,
            url(../resources/img/logo-movilnet.gif) center no-repeat,
            url(../resources/img/cintillo-d.png) right no-repeat;
            background-color: #fff;
            background-size: auto 40px;
            margin: 5px;
            border-bottom: 4px solid #f00;
        }
        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            text-align: center;
            width: 100%;
            border-top: 1px solid #f00;
            height: 21px;
            line-height: 20px;
            background-color: #fff;
            font-size: 12px;
        }
        #objMain {
            position: absolute;
            border: 0;
            width: 100%;
            height: calc(100% - 143px);
            background: #fff url(../resources/img/fondo-claro.png) center no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
<!-- HEADER -->
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
                <li role="presentation"><a href="consulta/" target="objMain">
                    <span class="glyphicon glyphicon-search"></span>
                    Consultar Caso
                </a></li>
                <li role="presentation"><a href="administracion/inventario.php" target="objMain">
                    <i class="fa fa-dropbox"></i>
                    Inventario
                </a></li>
                <li role="presentation"><a href="administracion/GestionOrdenAsignacion.php" target="objMain">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Entrada de Accesorios
                </a></li>
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
