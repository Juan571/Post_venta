var url = 'php/inventario.php';
var arrayAccesorios;
var arrayModelos;
var arrayInventario;
var tabla;
$(window).load(function(){

    cargarTablas("getInventario", "", "#tablaAccesorios", null, [0,1,2],"../administracion/php/inventario.php","../GestionCasos/");
    $.getJSON(url+'?accion=getAccesorios', function(json) { // Obtener Accesorios
        arrayAccesorios = json
        // console.log('getAccesorios', arrayAccesorios);
        //llenarAccesorios();
        llenarEntradaAccesorios();
    }).fail(function(){
        console.log('fail');
    });
    $.getJSON(url+'?accion=getModelos', function(json) { // Obtener Accesorios
        arrayModelos = json;
        //console.log('getModelos', arrayModelos);
        //llenarAccesorios();
        llenarEntradaModelos();
    }).fail(function(){
        console.log('fail');
    });


    $('#btnAgregarInvModelo').click(function(){
        id = $("#selAccesorios option:selected").val();
        idmodelo = $("#selModelos option:selected").val();
        accesorio = $("#selAccesorios option:selected").text();
        modelo = $("#selModelos option:selected").text();
        existe = false;
        if ((id*idmodelo) == 0) {
            return;
        }
        for (i = 0; i < $(tblEntradaAccesorios.children).length; i++) {
            if( $(tblEntradaAccesorios.children[i]).attr("data-id")==(id+idmodelo)) existe=true;
            //console.log($(tblEntradaAccesorios.children[i]).attr("data-id"))
        }
        if (existe) {
            alert("Este accesorio ya fue agregado, modifique la cantidad en la tabla..");
            return;
        }


        strHTML = '\t<tr id="trAccesorios'+id+idmodelo+'" class="trAccesorios" data-id="'+id+idmodelo+'">\n';
        strHTML += '\t\t<td>'+id+'</td>\n';
        strHTML += '\t\t<td id="tdAccesorio'+id+'">'+accesorio+'</td>\n';
        strHTML += '\t\t<td id="tdAccesorio'+id+'">'+modelo+'</td>\n';
        strHTML += '\t\t<td><input type="text" class="form-control" id="txtAccesoriosCantidad'+id+'" placeholder="Cantidad"></td>\n';
        strHTML += '\t\t<td><button class="btn btn-danger btnEliminar" data-id="'+id+'"><span class="glyphicon glyphicon-remove"></button></td>\n';
        strHTML += '\t</tr>\n';
        $('#tblEntradaAccesorios').append(strHTML);

        $('.btnEliminar').click(function(){
            id = $(this).attr('id');
            accesorio = $('#tdAccesorio'+id).text();
            $('#trAccesorios'+id).remove();
            // $('#selAccesorios').append('\t<option value="'+id+'">'+accesorio+'</option>\n');
        });
    });
    $('#btnCancelarEntradaAccesorios').click(function(){
        $('#entradaAccesorios').trigger('reveal:close');
        llenarEntradaAccesorios();
    });
    $('#btnAceptarEntradaAccesorios').click(function(){
        strId = '';
        strCantidad = '';
        $('.trAccesorios').each(function(){
            id = $(this).attr('data-id');
            strId += '&id[]='+id;
            strCantidad += '&cant[]='+$('#txtAccesoriosCantidad'+id).val();
        });
        urlSetCantidadAccesorios = url+'?accion=setCantidadAccesorios'+strId+strCantidad;
        console.log(urlSetCantidadAccesorios);
        $.getJSON(urlSetCantidadAccesorios, function(json) {
            console.log('setCantidadAccesorios', json);
            llenarEntradaAccesorios();
            llenarAccesorios();
            $('#entradaAccesorios').trigger('reveal:close');
        });
    });
    $('#btnNuevoAccesorio').click(function(){
        $("#popNuevoAccesorio").dialog({
            modal: true,
            buttons: {
                'Agregar' : function(){
                    $("#popNuevoAccesorio").dialog("close");
                    urlDel = url+'?accion=addAccesorio&nombre='+$('#txtNombreAccesorio').val();
                    console.log(urlDel, $('#txtNombreAccesorio').val());
                    $.getJSON(urlDel, function(json) {
                        console.log('addAccesorio', json);
                        llenarEntradaAccesorios();
                        strHTMLTabla = '';
                        strHTMLTabla += '<tr id="tr'+json.id+'">\n';
                        strHTMLTabla += '\t<td>'+json.id+'</td>\n';
                        strHTMLTabla += '\t<td>'+$('#txtNombreAccesorio').val()+'</td>\n';
                        strHTMLTabla += '\t<td>0</td>\n';
                        strHTMLTabla += '\t<td style="text-align:right">\n';
                        strHTMLTabla += '\t\t<button data-id="'+json.id+'" class="btn btn-danger btnRemove"><span class="glyphicon glyphicon-remove"></span></button>\n';
                        strHTMLTabla += '\t\t<button data-id="'+json.id+'" class="btn btn-info btnEdit"><span class="glyphicon glyphicon-edit"></span></button>\n';
                        strHTMLTabla += '\t</td>\n';
                        strHTMLTabla += '</tr>\n';
                        $('#tblAccesorios').append(strHTMLTabla);
                        tabla.ajax.reload();
                        botones();
                        $("#popNuevoAccesorio").dialog("close");
                    }).fail(function(j,t){
                        console.log("Error: " + t);
                    });
                },
                'Cancelar': function() {
                    $("#popNuevoAccesorio").dialog("close");
                }
            }
        });
    });
});

function llenarEntradaAccesorios() {
    strHTMLSelect = '\t<option value="0">Seleccione un Accesorio</option>\n';
    $.each(arrayAccesorios, function(i, j){
        strHTMLSelect += '\t<option value="'+i+'">'+j.producto+'</option>\n';
    });
    $('#selAccesorios').html(strHTMLSelect);
    $('#tblEntradaAccesorios').text('');
}
function llenarEntradaModelos() {
    strHTMLSelect = '\t<option value="0">Seleccione un Modelo</option>\n';
    $.each(arrayModelos, function(i, j){

        strHTMLSelect += '\t<option value="'+i+'">'+ j.descrip+"("+j.modelo+")"+'</option>\n';
    });
    $('#selModelos').html(strHTMLSelect);

}
function llenarAccesorios(){
    cargarTablas("getInventario", "", "#tablaAccesorios", null, [0,1,2],"../administracion/php/inventario.php","../GestionCasos/");
}

function botones() {
    $('.btnRemove').click(function(){

    });
}