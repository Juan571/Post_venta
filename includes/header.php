<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Servicio Post Venta</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="http://rec.vtelca.gob.ve/img/favicon.ico">

        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/font-awesome/4.1.0/css/font-awesome.min.css">
        
        <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://rec.vtelca.gob.ve/bootstrap/3.1.1/js/bootstrap.min.js"></script>
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
