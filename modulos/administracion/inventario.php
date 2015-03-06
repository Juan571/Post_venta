<?php include "../../includes/header.php"; ?>
        <script src="http://rec.vtelca.gob.ve/datatables/1.10.2/media/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/datatables/1.10.2/media/css/jquery.dataTables.css">
        <script src="http://rec.vtelca.gob.ve/reveal/1.0/jquery.reveal.js"></script>
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/reveal/1.0/reveal.css">
        <script src="js/inventario.js"></script>
        <div class="container">
            <h1>Inventario</h1>
            <div class="row">
                <div class="col-md-1">
                    <a href="#" class="btn btn-success" id="btnEntradaAccesorios" data-reveal-id="entradaAccesorios"><i class="fa fa-dropbox"></i> Entrada de Accesorios</a>
                </div>
            </div>
            <hr>
            <table  class="table table-striped" id="tablaAccesorios">
                <thead>
                    <th>ID</th>
                    <th>Accesorio</th>
                    <th>Cantidad</th>
                </thead>
                <tbody id="tblAccesorios">
                    
                </tbody>
            </table>
        </div>
		<div id="entradaAccesorios" class="reveal-modal">
			<h1>Entrada de Accesorios</h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">Accesorios:</div>
                    <div class="col-md-10">
                        <select id="selAccesorios" style="width:100%;height:100%"></select>
                    </div>
                </div>
                <hr>
                <table  class="table table-striped" id="tablaEntradaAccesorios">
                    <thead>
                        <th>ID</th>
                        <th>Accesorio</th>
                        <th>Cantidad</th>
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
<?php include "../../includes/footer.php"; ?>