var url = 'php/inventario.php';
var arrayAccesorios;
var tabla;
$(window).load(function(){
    $.getJSON(url+'?accion=getAccesorios', function(json) { // Obtener Accesorios
        arrayAccesorios = json
        console.log('getAccesorios', arrayAccesorios);
        llenarAccesorios();
        llenarEntradaAccesorios();
    }).fail(function(){
        console.log('fail');
    });
    $('#selAccesorios').change(function(){
        id = $(this).val();
        accesorio = $("#selAccesorios option:selected").text();
        if (id == 0) {return;}
        strHTML = '\t<tr id="trAccesorios'+id+'" class="trAccesorios" data-id="'+id+'">\n';
        strHTML += '\t\t<td>'+id+'</td>\n';
        strHTML += '\t\t<td id="tdAccesorio'+id+'">'+accesorio+'</td>\n';
        strHTML += '\t\t<td><input type="text" class="form-control" id="txtAccesoriosCantidad'+id+'" value="0"></td>\n';
        strHTML += '\t\t<td><button class="btn btn-danger btnEliminar" data-id="'+id+'"><span class="glyphicon glyphicon-remove"></button></td>\n';
        strHTML += '\t</tr>\n';
        $('#tblEntradaAccesorios').append(strHTML);
        $('#selAccesorios option[value="'+id+'"]').remove();
        $('.btnEliminar').click(function(){
            id = $(this).attr('data-id');
            accesorio = $('#tdAccesorio'+id).text();
            $('#trAccesorios'+id).remove();
            $('#selAccesorios').append('\t<option value="'+id+'">'+accesorio+'</option>\n');
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
});

function llenarEntradaAccesorios() {
    strHTMLSelect = '\t<option value="0">Seleccione un Accesorio</option>\n';
    $.each(arrayAccesorios, function(i, j){
        strHTMLSelect += '\t<option value="'+i+'">'+j.producto+'</option>\n';
    });
    $('#selAccesorios').html(strHTMLSelect);
    $('#tblEntradaAccesorios').text('');
}

function llenarAccesorios(){
    strHTMLTabla = '';
    $.each(arrayAccesorios, function(i, j){
        strHTMLTabla += '<tr>\n';
        strHTMLTabla += '\t<td>'+i+'</td>\n';
        strHTMLTabla += '\t<td>'+j.producto+'</td>\n';
        strHTMLTabla += '\t<td>'+j.cantidad+'</td>\n';
        strHTMLTabla += '</tr>\n';
    });
    $('#tblAccesorios').html(strHTMLTabla);
    $('#tablaAccesorios').dataTable({
        destroy: true,
        ordering: false,
        language: {
           url: 'http://rec.vtelca.gob.ve/datatables/lang/Spanish.json'
        }
    });
}