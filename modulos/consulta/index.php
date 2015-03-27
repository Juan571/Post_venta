<?php if (!isset($_SESSION)){session_start();} ?>
<!DOCTYPE html>
<head>
    <title>Servicio Post Venta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../resources/img/favicon.ico">

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css"/>

    <script src="../../resources/js/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
    <script src="../../resources/dist/js/bootstrap-select.min.js"></script>
    <script src="js/eventos.js"></script>
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
        <div class="panel panel-primary">
            <div class="panel-heading">Consulta de casos</div>
                <div class="panel-body" id="panelBody">
                    <div class="form-inline">
                        <label for="idCaso">Número de Caso</label>
                        <input type="text" id="idCaso" name="idCaso" class="form-control">
                        <button id="buscarCaso" class="btn btn-primary">Buscar</button>
                    </div>
                    <div id="contenidoConsulta">
                        <div id="contCaso">
                            <div class="row"><div class="col-md-12"><h2>Datos del caso</h2></div></div>
                            <div class="row">
                                <div class="col-md-3" style="text-align: right"><b>Caso N°</b></div>
                                <div class="col-md-3">--</div>
                                <div class="col-md-3" style="text-align: right"><b>Fecha de Solicitud</b></div>
                                <div class="col-md-3">--/--/---- --:--:--</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" style="text-align: right"><b>Operador</b></div>
                                <div class="col-md-3">--- ---</div>
                                <div class="col-md-3" style="text-align: right"><b>Estatus</b></div>
                                <div class="col-md-3">--</div>
                            </div>
                        </div>
                        <div id="datos_cliente">
                            <div class="row"><div class="col-md-12"><h2>Datos del cliente</h2></div></div>
                            <div class="row">
                                <div class="col-md-3" style="text-align: right"><b>Cédula</b></div>
                                <div class="col-md-3">--------</div>
                                <div class="col-md-3" style="text-align: right"><b>Nombre</b></div>
                                <div class="col-md-3">--- ---</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" style="text-align: right"><b>Dirección</b></div>
                                <div class="col-md-9">--------------</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" style="text-align: right"><b>Telefono Fijo</b></div>
                                <div class="col-md-3">-------------</div>
                                <div class="col-md-3" style="text-align: right"><b>Telefono Movil</b></div>
                                <div class="col-md-3">-------------</div>
                            </div>
                        </div>
                        <div id="datos_equipo">
                            <div class="row"><div class="col-md-12"><h2>Datos del equipo</h2></div></div>
                            <div class="row">
                                <div class="col-md-2" style="text-align: right"><b>IMEI</b></div>
                                <div class="col-md-2">1212112223</div>
                                <div class="col-md-2" style="text-align: right"><b>Modelo</b></div>
                                <div class="col-md-2">V8200</div>
                                <div class="col-md-2" style="text-align: right"><b>Color</b></div>
                                <div class="col-md-2">Azul</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2" style="text-align: right"><b>N° de Factura</b></div>
                                <div class="col-md-2">22334444</div>
                                <div class="col-md-2" style="text-align: right"><b>Fecha de Compra</b></div>
                                <div class="col-md-2">15/12/2014</div>
                                <div class="col-md-2" style="text-align: right"><b>Operadora</b></div>
                                <div class="col-md-2">Movilnet</div>
                            </div>
                        </div>
                        <div>
                            <div class="row"><div class="col-md-12"><h2>Accesorios Solicitados</h2></div></div>
                            <table align="center" class="table table-striped" style="table.tr{text-align:center;}">
                                <thead><tr><th>Producto</th><th>Tipo</th><th>Motivo</th><th>Estado</th></tr></thead>
                                <tbody id="bodyAccesorios"></tbody>
                            </table>
                        </div>
                        <div class="row"><div class="col-md-12"><h2>Trazabilidad</h2></div></div>
                        <table align="center" class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td id="Pendiente">--/--/-- --:--:--</td><td>Registro de solicitud de accesorios</td><td id="Pendiente-icon"><span class="glyphicon glyphicon-remove"></td>
                                </tr>
                                <tr>
                                    <td id="Procesado">--/--/-- --:--:--</td><td>Procesado</td><td id="Procesado-icon"><span class="glyphicon glyphicon-remove"></td>
                                </tr>
                                <tr>
                                    <td id="Despachado" >--/--/-- --:--:--</td><td>Despachado</td><td id="Despachado-icon"><span class="glyphicon glyphicon-remove"></td>
                                </tr>
                                <tr>
                                    <td id="En_Oficina_Comercial">--/--/-- --:--:--</td><td>En oficina Comercial</td><td id="En_Oficina_Comercial-icon"><span class="glyphicon glyphicon-remove"></td>
                                </tr>
                                <tr>
                                    <td id="Entregado">--/--/-- --:--:--</td><td>Entregado</td><td><span class="glyphicon glyphicon-remove"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            <div class="panel-footer">Casos de solicitudes de accesorios</div>
        </div>
    </div>
</body>
</html>