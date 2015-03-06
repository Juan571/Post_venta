var url = 'php/notificaciones.php';
$(window).load(function(){
    $.getJSON(url+'?accion=getNotificaciones', function(json) { // Obtener Estados
        console.log(json);
        strHTML = '';
        strHTML += '<tr>\n';
        $.each(json, function(i, j){
            rowSpan = j.accesorio.length;
            strHTML += '\t<td rowspan="'+rowSpan+'">'+(Array(10 - i.length).join('0'))+i+'</td>\n';
            strHTML += '\t<td rowspan="'+rowSpan+'">'+j.agencia+'</td>\n';
            $.each(j.accesorio, function(k, l){
                strHTML += '\t<td>'+l+'</td>\n';
                strHTML += '\t<td>'+j.estado[k]+'</td>\n';
                strHTML += '</tr>\n<tr>\n';
            });
            strHTML += '</tr>\n';
        });
        $('#tblEstados').html(strHTML);
        $('#tasbla').dataTable({
            ordering: false,
            language: {
                url: 'http://rec.vtelca.gob.ve/datatables/lang/Spanish.json'
            }
        });
    }).fail(function(){
        console.log('fail');
    });
});