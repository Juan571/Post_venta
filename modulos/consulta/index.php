<?php if (!isset($_SESSION)){session_start();} ?>
<!DOCTYPE html>
<head>
    <title>Servicio Post Venta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://rec.vtelca.gob.ve/img/favicon.ico">

    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css"/>

    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://rec.vtelca.gob.ve/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/js/bootstrap-select.min.js"></script>
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
                <div class="panel-body">
                    <div class="form-inline">
                        <label for="idCaso">Número de Caso</label>
                        <input type="text" id="idCaso" name="idCaso" class="form-control">
                        <button id="buscarCaso" class="btn btn-primary">Buscar</button>
                    </div>
                    <div id="contCaso">
                        <div class="row"><div class="col-md-12"><h2>Datos del caso</h2></div></div>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right">Caso N°</div>
                            <div class="col-md-3">62</div>
                            <div class="col-md-3" style="text-align: right">Fecha de Solicitud</div>
                            <div class="col-md-3">12/12/2012</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right">Operador</div>
                            <div class="col-md-3">Juan Romero</div>
                            <div class="col-md-3" style="text-align: right">Estatus</div>
                            <div class="col-md-3">Pendiente</div>
                        </div>
                        <div class="row"><div class="col-md-12"><h2>Datos del cliente</h2></div></div>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right">Cédula</div>
                            <div class="col-md-3">20296572</div>
                            <div class="col-md-3" style="text-align: right">Nombre</div>
                            <div class="col-md-3">Pedro Lugo</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right">Dirección</div>
                            <div class="col-md-9">Urb. El cardón, Av#5 Casa F#102 Coro-Falcón</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="text-align: right">Telefono Fijo</div>
                            <div class="col-md-3">02682779407</div>
                            <div class="col-md-3" style="text-align: right">Telefono Movil</div>
                            <div class="col-md-3">04167588004</div>
                        </div>
                        <div class="row"><div class="col-md-12"><h2>Datos del equipo</h2></div></div>
                    </div>

                </div>
            <div class="panel-footer">Footer footer</div>
        </div>
    </div>
</body>
</html>