<?php include "../../includes/header.php"; ?>
    <script src="http://rec.vtelca.gob.ve/datatables/1.10.2/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/datatables/1.10.2/media/css/jquery.dataTables.css">
    <script src="http://rec.vtelca.gob.ve/reveal/1.0/jquery.reveal.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/reveal/1.0/reveal.css">
    <script src="http://rec.vtelca.gob.ve/jquery-ui/1.10.3/ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/jquery-ui/1.10.3/themes/base/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../GestionCasos/dataTables/media/css/jquery.dataTables.css">
    <script type="text/javascript" src="../GestionCasos/JS/tablas.js"></script>

    <link rel="stylesheet" type="text/css" href="../GestionCasos/JS/jqueryUI/css/blitzer/jquery-ui-1.10.4.custom.css">
    <script src="js/GestionOrdenAsignacion.js"></script>
    <style rel="stylesheet" type="text/css">
        .reveal-modal{
            left: 45%;
            width: 850px;
        }

    </style>
    <div class="container">
        <h1>Gestion de Ordenes de Asginacion (Entrada de accesorios)</h1>
        <div class="row">
            <div class="col-md-4">
                <a href="#" style="display: none" id="btnmodal" data-reveal-id="entradaAccesorios">Registrar Orden de Asignacion</a>
                <a href="#" style="width:100%" class="btn btn-default" id="btnEntradaAccesorios"><i class="fa fa-dropbox"></i> Registrar Orden de Asignacion</a>
            </div>
            <div class="col-md-3">
                <a href="#" style="width:100%" class="btn btn-default" id="btnNuevoAccesorio"><i class="fa fa-plus"></i> Agregar Accesorio</a>
            </div>
        </div>
        <hr>
        <table  class="table table-striped" id="tablaOrdenes">
            <thead>

            </thead>
            <tbody id="tblAccesorios">

            </tbody>
        </table>
    </div>
    <div id="entradaAccesorios" class="reveal-modal full">
        <h1>Recibir accesorios de la Orden de Asignación</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <strong>Orden de Asignacion: </strong>

                </div>

                <div class="col-md-6">
                    <strong>Fecha: </strong>

                </div>
                <div class="col-md-6">

                    <label id="txtOrdenAsignacion">dassda</label>
                </div>
                <div class="col-md-6">

                    <label id="txtOrdenFecha" >dassda</label>
                </div>

            </div>
            <div class="row">

                <div class="col-md-12">
                    <strong>Observacion </strong><br>
                    <label id="txtOrdenObservacion" >dassda</label>
                </div>

            </div>

            <table  class="table table-striped" id="tablaAccesoriosOrden">

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