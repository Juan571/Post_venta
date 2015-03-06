<?php include "../../includes/header.php"; ?>
        <script src="http://rec.vtelca.gob.ve/datatables/1.10.2/media/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="http://rec.vtelca.gob.ve/datatables/1.10.2/media/css/jquery.dataTables.css">
        <script src="js/inventario.js"></script>
        <div class="container">
            <h1>Inventario</h1>
            <div class="row">
                <button class="btn btn-success" id="btnAgregar"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
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
<?php include "../../includes/footer.php"; ?>