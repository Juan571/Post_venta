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
                background: url(../../resources/img/cintillo-movilnet.png) left no-repeat,
                url(../../resources/img/logo-movilnet.gif) center no-repeat,
                url(../../resources/img/cintillo-d.png) right no-repeat;
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
                background: #fff url(../../resources/img/fondo-claro.png) center no-repeat;
                background-size: cover;
            }
        </style>
    </head>
    <body>
    <!-- HEADER -->
        <script src="../../resources/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="../../resources/css/jquery.dataTables.css">
        <script src="../../resources/reveal/jquery.reveal.js"></script>
        <link rel="stylesheet" href="../../resources/reveal/reveal.css">
        <script src="../../resources/ui/jquery-ui.js"></script>
        <link rel="stylesheet" href="../../resources/themes/base/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../GestionCasos/dataTables/media/css/jquery.dataTables.css">
        <script type="text/javascript" src="../GestionCasos/JS/tablas.js"></script>

        <link rel="stylesheet" type="text/css" href="../GestionCasos/JS/jqueryUI/css/blitzer/jquery-ui-1.10.4.custom.css">
        <script src="js/inventario.js"></script>
        <style rel="stylesheet" type="text/css">
            .reveal-modal{
                left: 45%;
                width: 850px;
            }

        </style>
        <div class="container">
            <h1>Inventario</h1>
            <div class="row">
                <div class="col-md-4">
                    <a href="#" style="width:100%" class="btn btn-default" id="btnEntradaAccesorios" data-reveal-id="entradaAccesorios"><i class="fa fa-dropbox"></i> Registrar Orden de Asignacion</a>
                </div>
                <div class="col-md-3">
                    <a href="#" style="width:100%" class="btn btn-default" id="btnNuevoAccesorio"><i class="fa fa-plus"></i> Agregar Accesorio</a>
                </div>
            </div>
            <hr>
            <table  class="table table-striped" id="tablaAccesorios">
                <thead>

                </thead>
                <tbody id="tblAccesorios">
                    
                </tbody>
            </table>
        </div>
		<div id="entradaAccesorios" class="reveal-modal full">
			<h1>Envío de Accesorios</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                        <strong>Orden de Asignacion: </strong>
                        <input type="text" class="form-control" id="txtOrdenAsignacion" placeholder="Indique la orden de Asignación">
                    </div>
                    <div class="col-md-3">
                        <strong>Fecha: </strong>
                        <input type="text" class="form-control" id="txtOrdenFecha" placeholder="Indique la Fecha">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <strong>Observacion </strong><br>
                        <input type="text" class="form-control" id="txtOrdenObservacion" placeholder="Observaciones">
                    </div>

                </div>
                <div class="row" style="margin-top: 2%">


                    <div class="col-md-5">
                        <strong>Modelos</strong>
                        <select id="selModelos" style="width:100%;height:100%">
                        </select>
                    </div>
                    <div class="col-md-5">
                        <strong>Accesorios</strong>
                        <select id="selAccesorios" style="width:100%;height:100%">
                            <option value="0">Indique Accesorio</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                          <button class="btn btn-warning" id="btnAgregarInvModelo"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
                </div>
                <hr>
                <table  class="table table-striped" id="tablaEntradaAccesorios">
                    <thead>
                        <th>N°</th>
                        <th>Accesorio</th>
                        <th>Modelo</th>
                        <th style="text-align: center;width: 16%;">Cantidad</th>
                        <th style="text-align: center;">Eliminar</th>

                    </thead>
                        <tbody id="tblEntradaAccesorios">
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" id="btnAceptarEntradaAccesorios"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger" id="btnCancelarEntradaAccesorios"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    </div>
                </div>
            </div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
        <div id="popNuevoAccesorio" title="Agregar Accesorio" style="display: none">
             <p>Ingrese el nombre del accesorio</p>
             <input type="text" class="form-control" id="txtNombreAccesorio" name="txtNombreAccesorio">
        </div>
        <div id="popDelAccesorio" title="Remover Accesorio" style="display: none">
             <p>Está seguro que desea remover este accesorio?</p>
        </div>
    <script type="text/javascript">

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
<?php include "../../includes/footer.php"; ?>