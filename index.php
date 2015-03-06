<?php include "./includes/header.php"; ?>
        <header></header>
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
