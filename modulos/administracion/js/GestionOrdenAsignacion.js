var url = 'php/inventario.php';
var arrayAccesorios;
var arrayModelos;
var arrayInventario;
var tabla;

$(window).load(function(){

    cargarTablas("getOrdenes", "", "#tablaOrdenes", null, [0],"../administracion/php/inventario.php","../GestionCasos/");

    $(".botonRow").on("click",function () {

        console.log("hola");

    });

});/**
 * Created by juan on 24/03/15.
 */
function aceptarAccesoriosOrdenes(idOrden){
    strId = '';
    strCant = '';
    strDetInv = '';
    orden = '';
    incompleto = false;
    activo = false;
    urlSetCantidadAccesorios='';

    observacionOrden = $("#txtOrdenObservacion").val();
    $('.trAccesorios').each(function() {
        var sw= $(this).find(".btnsw");

        id = $(this).attr('data-id');
        cantidad = sw.attr("data-id");
        idDetalleInv =  sw.attr("data-text");

        if(sw.bootstrapSwitch('state')){
            activo = true;
            strId += '&id[]=' + id;
            strCant +='&cant[]='+cantidad;
            strDetInv +='&DetInv[]='+idDetalleInv;
        }
        else{
            incompleto=true;
        }

    });

    if (activo){

        if (incompleto){////incompleto
            alert("Este Caso quedara incompleto");
            urlAceptarAccesoriosOrden = url+'?accion=aceptarAccesorioOrden&estatus=2&idOrdAsig='+idOrden+strId+strCant+strDetInv;
           // console.log(urlSetCantidadAccesorios);
        }
        else{//procesado
            urlAceptarAccesoriosOrden = url+'?accion=aceptarAccesorioOrden&estatus=3&idOrdAsig='+idOrden+strId+strCant+strDetInv;

            alert("Este Caso pasará a proesado");
        }
         console.log(urlAceptarAccesoriosOrden);
        $.getJSON(urlAceptarAccesoriosOrden, function(json) {
            console.log('setCantidadAccesorios', json);

        });
    }

}
function detallesOrdenAsignacion(aData){

    $("#txtOrdenAsignacion").text(aData[2]);
    $("#txtOrdenFecha").text(aData[1]);
    $("#txtOrdenObservacion").text(aData[3]);
    if ($("#tablaAccesoriosOrden").children().length > 0 || $("#selectDepartamento").val() == '0') {
        $("#tablaAccesoriosOrden").dataTable().fnClearTable();
        $("#tablaAccesoriosOrden").dataTable().fnDestroy();
        $("#tablaAccesoriosOrden thead > tr >  th").hide();
    }

    cargarTablas("getAccesoriosOrden",aData[0], "#tablaAccesoriosOrden", null, [],"../administracion/php/inventario.php","../GestionCasos/");
    $('#btnmodal').trigger('click');
    $("#btnAceptarEntradaAccesorios").on("click",function(){
        $(this).off();
        aceptarAccesoriosOrdenes(aData[0]);
    });
}