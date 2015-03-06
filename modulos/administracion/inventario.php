<?php include "../../includes/header.php"; ?>
        <script src="http://rec.vtelca.gob.ve/datatables/1.10.2/media/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/datatables/1.10.2/media/css/jquery.dataTables.css">
        <script src="http://rec.vtelca.gob.ve/reveal/1.0/jquery.reveal.js"></script>
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/reveal/1.0/reveal.css">
        <script src="js/inventario.js"></script>
        <div class="container">
            <h1>Inventario</h1>
            <div class="row">
                <a href="#" class="btn btn-success" id="btnAgregar" data-reveal-id="myModal"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
            </div>
            <hr>
            <table  class="table table-striped" id="tabla">
                <thead>
                    <th>ID</th>
                    <th>Accesorio</th>
                    <th>Cantidad</th>
                </thead>
                <tbody id="tblAccesorios">
                    
                </tbody>
            </table>
        </div>
		<div id="myModal" class="reveal-modal">
			<h1>Reveal Modal Goodness</h1>
			<p>This is a default modal in all its glory, but any of the styles here can easily be changed in the CSS.</p>
			<a class="close-reveal-modal">&#215;</a>
		</div>
<?php include "../../includes/footer.php"; ?>