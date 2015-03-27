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
                background: url(../resources/img/cintillo-movilnet.png) left no-repeat,
                            url(../resources/img/logo-movilnet.gif) center no-repeat,
                            url(../resources/img/cintillo-d.png) right no-repeat;
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
                background: #fff url(../resources/img/fondo-claro.png) center no-repeat;
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <!-- HEADER -->
