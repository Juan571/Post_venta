<?php include "../../includes/header.php"; ?>
        <script>
            <?php
    	        if (!isset($_SESSION["usuarioId"])) {
	                print "parent.location.replace('../../index.php');";
	            }
            ?>
        </script>
        <div class="container">
            <form class="form-signin" action="../../funciones/sesion.php" method="post">
                <input type="hidden" name="accion" value="CambiarClave">
                <input type="hidden" name="usuarioId" value="<?=$_SESSION["usuarioId"]?>">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Cambiar Contraseña</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">Contraseña Actual:</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="txtClave" name="clave">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">Contraseña Nueva:</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="txtClave1" name="clave1">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">Repita Contraseña:</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="txtClave2" name="clave2">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-danger" style="width: 100%" id="btnEnviar" name="btnEnviar" value="Cambiar Contraseña">
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
                <?php } elseif (isset($_GET["error"]) && $_GET["error"] == 2) { ?>
                <div class="col-md-4 alert alert-danger" style="text-align:center">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    Las Contraseñas no coinciden
                </div>
                <?php } elseif (isset($_GET["error"]) && $_GET["error"] == 0) { ?>
                <div class="col-md-4 alert alert-success" style="text-align:center">
                    <span class="glyphicon glyphicon-ok"></span>
                    La contraseña se cambió con éxito
                </div>
                <?php } ?>
                <div class="col-md-4"></div>
            </div>
        </div>
<?php include "../../includes/footer.php"; ?>