<?php if (!isset($_SESSION)){session_start();} ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <head>
        <title>Servicio Post Venta</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="http://rec.vtelca.gob.ve/img/favicon.ico">

        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/registroCaso.css">
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/css/bootstrap-select.css">
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

        <!-- Bootstrap DateTimePicker -->
        <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://rec.vtelca.gob.ve/bootstrap-datetimepicker/js/moment.min.js"></script>
        <script src="http://rec.vtelca.gob.ve/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script src="http://rec.vtelca.gob.ve/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/js/bootstrap-select.min.js"></script>
        <script src="js/registroCaso.js"></script>
        <script>
            <?php
    	        if (!isset($_SESSION["usuarioId"])) {
	                print "parent.location.replace('../../index.php');";
	            } else {
	                print "usuarioId=".$_SESSION['usuarioId'].";\n";
	                print "agenciaId=".$_SESSION['usuarioAgenciaId'].";\n";
	            }
            ?>
        </script>
    </head>
    <body>
        <div class="container">
            <form>
            <h1>Solicitud de Reemplazo de Accesorios</h1>
            <div class="row">
                <!--div class="col-md-3">N° de Caso: 0000000000</div-->
                <div class="col-md-3">Fecha de Solicitud: <?=date('d/m/Y')?></div>
                <div class="col-md-9" style="text-align: right">Oficina Receptora: <?= $_SESSION['usuarioAgencia'] ?></div>
            </div>
            <h2>Identificación del Solicitante</h2>
            <div class="row">
                <div class="col-md-1">Cédula:</div>
                <div class="col-md-3">
                    <input id="txtCedula" class="form-control" type="text" placeholder="Solo números, sin puntos ni espacios">
                </div>
                <div class="col-md-1">Nombres:</div>
                <div class="col-md-3">
                    <input id="txtNombres" class="form-control" type="text" placeholder="Nombres">
                </div>
                <div class="col-md-1">Apellidos:</div>
                <div class="col-md-3">
                    <input id="txtApellidos" class="form-control" type="text" placeholder="Apellidos">
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">Dirección:</div>
                <div class="col-md-11">
                    <input id="txtDireccion" class="form-control" type="text" placeholder="Dirección">
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">Estado:</div>
                <div class="col-md-3">
                    <select id="selEstados" class="show-tick selectpicker" data-live-search="true"><option value="0">Estado</option></select>
                </div>
                <div class="col-md-1">Municipio:</div>
                <div class="col-md-3">
                    <select id="selMunicipios" class="show-tick selectpicker" data-live-search="true"><option value="0">Municipio</option></select>
                </div>
                <div class="col-md-1">Parroquia:</div>
                <div class="col-md-3">
                    <select id="selParroquias" class="show-tick selectpicker" data-live-search="true"><option value="0">Parroquia</option></select>
                </div>
            </div>
            <h2>Información de Contacto</h2>
            <div class="row">
                <div class="col-md-1">Número Fijo:</div>
                <div class="col-md-3">
                    <input id="txtTlfFijo" class="form-control" type="text" placeholder="02695555555">
                </div>
                <div class="col-md-1">Número Móvil:</div>
                <div class="col-md-3">
                    <input id="txtTlfMovil" class="form-control" type="text" placeholder="04265555555">
                </div>
                <div class="col-md-1">Correo Electrónico:</div>
                <div class="col-md-3">
                    <input id="txtCorreo" class="form-control" type="text" placeholder="ejemplo@correo.com">
                </div>
            </div>
            <h2>Identificación del Equipo</h2>
            <div class="row">
                <div class="col-md-1">S/N:</div>
                <div class="col-md-3">
                    <input id="txtSerial" class="form-control" type="text" placeholder="S/N">
                </div>
                <div class="col-md-1">IMEI/ESN/MEID:</div>
                <div class="col-md-3">
                    <input id="txtImei" class="form-control" type="text" placeholder="IMEI/ESN/MEID">
                </div>
                <div class="col-md-1">Tecnología:</div>
                <div class="col-md-3">
                    <select id="selTecnologia" class="show-tick selectpicker" data-live-search="true">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">Modelo:</div>
                <div class="col-md-5">
                    <select id="selModelo" class="show-tick selectpicker" data-live-search="true">
                    </select>
                </div>
                <div class="col-md-1">Color:</div>
                <div class="col-md-5">
                    <select id="selColor" class="show-tick selectpicker" data-live-search="true">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">Nro. de Factura:</div>
                <div class="col-md-2">
                    <input id="txtFactura" class="form-control" type="text" placeholder="Nro. de Factura">
                </div>
                <div class="col-md-2">Fecha de Compra:</div>
                <div class="col-md-2">
                    <input id="txtFechaCompra" class="txtFecha form-control" type="text" placeholder="dd/mm/yyyy">
                </div>
                <div class="col-md-1">Operadora:</div>
                <div class="col-md-3">
                    <select id="selOperadora" class="show-tick selectpicker" data-live-search="true">
                    </select>
                </div>
            </div>
            <h2>Accesorios</h2>
            <div id="lstAccesorios"></div>
            <hr>
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <a id="btnProcesarCaso" class="btn btn-success" style="width: 100%">Procesar Caso</a>
                </div>
            </div>
            </form>
        </div>
    </body>
</html>
