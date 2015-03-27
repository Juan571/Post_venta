<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Servicio Post Venta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="resources/img/favicon.ico">

    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="resources/css/font-awesome.min.css">

    <script src="resources/js/jquery.min.js"></script>
    <script src="resources/js/bootstrap.min.js"></script>
    <style>
        header {
            width: calc(100% - 10px);
            height: 60px;
            background: url(http://rec.vtelca.gob.ve/img/cintillo-movilnet.png) left no-repeat,
            url(http://rec.vtelca.gob.ve/img/logo-movilnet.gif) center no-repeat,
            url(http://rec.vtelca.gob.ve/img/cintillo-d.png) right no-repeat;
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
            background: #fff url(http://rec.vtelca.gob.ve/img/fondo-claro.png) center no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
<!-- HEADER -->
        <header>
            <script>
                $(document).ready(function () {
                    $("#txtCedula").focus();
                });
            </script>
        </header>
        <div class="container">
            <h1 style="text-align:center">Accesorios</h1>
            <br>
            <form class="form-signin" action="funciones/sesion.php" method="post">
                <input type="hidden" name="accion" value="iniciarSesion">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Acceso de Usuario</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">Cédula:</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="txtCedula" name="cedula">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">Contraseña:</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="txtClave" name="clave">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-danger" style="width: 100%" id="btnEnviar" name="btnEnviar" value="Ingresar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <?php if (isset($_GET["error"]) && $_GET["error"] == 1) { ?>
                <div class="col-md-4 alert alert-danger" style="text-align:center">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    Contraseña Incorrecta
                </div>
                <?php } ?>
                <div class="col-md-4"></div>
            </div>
        </div>
        <footer>
            Desarrollado por <a href="http://www.vtelca.gob.ve" target="_blank">Venezolana de Telecomunicaciones C.A.</a>
        </footer>
<?php include "./includes/footer.php"; ?>
