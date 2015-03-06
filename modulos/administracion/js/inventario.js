var url = 'php/inventario.php';
$(window).load(function(){
    $.getJSON(url+'?accion=getAccesorios', function(json) { // Obtener Estados
        console.log(json);
        strHTML = '';
        $.each(json, function(i, j){
            strHTML += '<tr>\n';
            strHTML += '\t<td>'+i+'</td>\n';
            strHTML += '\t<td>'+j.producto+'</td>\n';
            strHTML += '\t<td>'+j.cantidad+'</td>\n';
            strHTML += '</tr>\n';
        });
        $('#tblAccesorios').html(strHTML);
        $('#tabla').dataTable({
            ordering: false,
            language: {
                url: 'http://rec.vtelca.gob.ve/datatables/lang/Spanish.json'
            }
        });
    }).fail(function(){
        console.log('fail');
    });
});