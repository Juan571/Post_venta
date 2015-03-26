var url = 'php/inventario.php';
var arrayAccesorios;
var arrayModelos;
var arrayInventario;
var tabla;

$(window).load(function(){

    cargarTablas("getOrdenes", "", "#tablaOrdenes", null, [0],"../administracion/php/inventario.php","../GestionCasos/");

    $(".botonRow").on("click",function () {

        console.log("hola");

        //$("#entradaAccesorios").modal('toggle');


        //$('#entradaAccesorios').foundation('reveal', 'open');
        //alert("VER DETALLES xD");
        //selectAgencia(aData);
    });

});/**
 * Created by juan on 24/03/15.
 */

function detallesOrdenAsignacion(aData){

    $("#txtOrdenAsignacion").text(aData[2]);
    $("#txtOrdenFecha").text(aData[1]);
    $("#txtOrdenObservacion").text(aData[3]);
    if ($("#tablaAccesoriosOrden").children().length > 0 || $("#selectDepartamento").val() == '0') {
        $("#tablaAccesoriosOrden").dataTable().fnClearTable();
        $("#tablaAccesoriosOrden").dataTable().fnDestroy();
        $("#tablaAccesoriosOrden thead > tr >  th").hide();
    }

    cargarTablas("getAccesoriosOrden",aData[0], "#tablaAccesoriosOrden", null, [0,1,2,3,4],"../administracion/php/inventario.php","../GestionCasos/");
    $('#btnmodal').trigger('click');

}