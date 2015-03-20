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
        <div class="panel panel-default">
            <div class="panel-heading">Consulta de casos</div>
                <div class="panel-body">
                    <div class="form-inline">
                        <label for="idCaso">Número de Caso</label>
                        <input type="text" id="idCaso" name="idCaso" class="form-control">
                        <button id="buscarCaso" class="btn btn-primary">Buscar</button>
                    </div>
                    <div id="contCaso" class="row">
                        <div class="col-md-2"></div>
                    </div>
                </div>
            <div class="panel-footer">Footer footer</div>
        </div>
    </div>
</body>
</html>