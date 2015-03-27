<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Servicio Post Venta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../resources/img/favicon.ico">

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css">

    <script src="../../resources/js/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
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

<script src="../../resources/dist/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="../../resources/dist/css/bootstrap-select.min.css">
        <script src="../../resources/ui/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/jquery-ui/1.10.3/themes/base/jquery.ui.all.css">
        <script src="js/administrarUsuarios.js"></script>
        <script>
            <?php
    	        if (!isset($_SESSION["usuarioId"])) {
	                print "parent.location.replace('../../index.php');";
	            }
            ?>
        </script>
        <div class="container">
            <h1>Administrar Usuarios</h1>
            <div class="row">
                <div class="col-md-1">Cédula:</div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="txtCedula" name="txtCedula">
                </div>
                <div class="col-md-1">Nombre:</div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="txtNombres" name="txtNombre">
                </div>
                <div class="col-md-1">Apellido:</div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="txtApellidos" name="txtApellidos">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1">Contraseña:</div>
                <div class="col-md-3">
                    <input type="password" class="form-control" id="txtClave" name="txtClave">
                </div>
                <div class="col-md-1">Correo:</div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="txtCorreo" name="txtCorreo">
                </div>
                <div class="col-md-1">Tipo de Usuario:</div>
                <div class="col-md-3">
                    <select id="selTipoUsuario" class="selectpicker" aria-describedby="sizing-addon2">
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1">Agente Autorizado:</div>
                <div class="col-md-3">
                    <select id="selOficinaComercial" class="selectpicker">
                    </select>
                </div>
                <div class="col-md-1">Agente Autorizado:</div>
                <div class="col-md-3">
                    <select id="selAgencia" class="selectpicker">
                        <option value="0">&nbsp;Seleccione Un Agente Autorizado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger" style="width: 100%; display:none" id="btnCancelar" name="btnCancelar">Cancelar</button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" style="width: 100%" id="btnAgregar" name="btnAgregar">Agregar Usuario</button>
                    <button class="btn btn-success" style="width: 100%; display:none" id="btnAceptar" name="btnAceptar" data-id="0">Aceptar</button>
                </div>
            </div>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Agente Autorizado</th>
                        <th>Tipo de Usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tblUsuarios"></tbody>
            </table>
        </div>
        <div id="popEliminar" title="Eliminar Usuario" style="display: none">
             <p>Está seguro que desea eliminar este usuario?</p>
        </div>
<?php include "../../includes/footer.php"; ?>
