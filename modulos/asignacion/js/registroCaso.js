var url = 'php/registroCaso.php';
var arrayEstados, arrayMunicipios, arrayParroquias, arrayModelos, arrayColores;
var arrayTecnologias, arrayOperadoras, arrayAccesorios, arrayMotivos;
$(window).load(function(){
    $.getJSON(url+'?accion=getEstados', function(json) { // Obtener Estados
        arrayEstados = json;
        console.log('arrayEstados', arrayEstados);
        $.getJSON(url+'?accion=getMunicipios', function(json) { // Obtener Municipios
            arrayMunicipios = json;
            console.log('arrayMunicipios', arrayMunicipios);
            $.getJSON(url+'?accion=getParroquias', function(json) { // Obtener Parroquias
                arrayParroquias = json;
                console.log('arrayParroquias', arrayParroquias);
                strHTML = '<option value="0">Seleccione un Estado</option>\n';
                $.each(arrayEstados, function(i, j){
                    strHTML += '\t<option value="'+i+'">'+j+'</option>\n';
                })
                $('#selEstados').html(strHTML);
                $('#selEstados').change(function(){
                    idEstado = $(this).val();
                    $('#selParroquias').html('<option value="0">Parroquia</option>');
                    strHTML = '<option value="0">Seleccione un Municipio</option>';
                    $.each(arrayMunicipios, function(k, l){
                        if(idEstado === l[0]) {
                            strHTML += '<option value="'+k+'">'+l[1]+'</option>';
                        }
                    });  
                    $('#selMunicipios').html(strHTML);
                    $('#selMunicipios').change(function(){
                        idMunicipio = $(this).val();
                        strHTML = '<option value="0">Seleccione una Parroquia</option>';
                        $.each(arrayParroquias, function(m, n){
                            if(idMunicipio === n[0]) {
                                strHTML += '<option value="'+m+'">'+n[1]+'</option>';
                            }
                        });  
                        $('#selParroquias').html(strHTML);
                    });
                });
                $.getJSON(url+'?accion=getModelos', function(json) { // Obtener Parroquias
                    arrayModelos = json;
                    console.log('arrayModelos', arrayModelos);
                    strHTML = '<option value="0">Seleccione un Modelo</option>';
                    $.each(arrayModelos, function(k, l){
                        if (l[2] == 1) {
                            strHTML += '<option value="'+k+'">'+l[1]+' ('+l[0]+')</option>';
                        }
                    });  
                    $('#selModelo').html(strHTML);
                    $.getJSON(url+'?accion=getColores', function(json) { // Obtener Modelos
                        arrayColores = json;
                        console.log('arrayColores', arrayColores);
                        strHTML = '<option value="0">Seleccione un Color</option>';
                        $.each(arrayColores, function(k, l){
                            if (l[1] == 1) {
                                strHTML += '<option value="'+k+'">'+l[0]+'</option>';
                            }
                        });  
                        $('#selColor').html(strHTML);
                        $.getJSON(url+'?accion=getTecnologias', function(json) { // Obtener Tecnologías
                            arrayTecnologias = json;
                            console.log('arrayColores', arrayColores);
                            strHTML = '<option value="0">Seleccione una Tecnología</option>';
                            $.each(arrayTecnologias, function(k, l){
                                if (l[1] == 1) {
                                    strHTML += '<option value="'+k+'">'+l[0]+'</option>';
                                }
                            });  
                            $('#selTecnologia').html(strHTML);
                            $.getJSON(url+'?accion=getOperadoras', function(json) { // Obtener Tecnologías
                                arrayOperadoras = json;
                                console.log('arrayColores', arrayColores);
                                strHTML = '<option value="0">Seleccione una Operadora</option>';
                                $.each(arrayOperadoras, function(k, l){
                                    if (l[1] == 1) {
                                        strHTML += '<option value="'+k+'">'+l[0]+'</option>';
                                    }
                                });  
                                $('#selOperadora').html(strHTML);
                                $.getJSON(url+'?accion=getAccesorios', function(json) { // Obtener Accesorios
                                    arrayAccesorios = json;
                                    console.log('arrayAccesorios', arrayAccesorios);
                                    $.getJSON(url+'?accion=getMotivos', function(json) { // Obtener Motivos
                                        arrayMotivos = json;
                                        console.log('arrayMotivos', arrayMotivos);
                                        strHTML = '';
                                        $.each(arrayAccesorios, function(i, j){
                                            strHTML += lineaAccesorio(i, j);
                                        });
                                        $('#lstAccesorios').html(strHTML);
                                        $('.chkAccesorio').click(function(){
                                            id = $(this).attr('data-id');
                                            if($(this).prop('checked') == true) {
                                                $('#txtDescripcion'+id).prop('disabled', false);
                                                $('#selAccesorio'+id).prop('disabled', false);
                                                $('#txtObservaciones'+id).prop('disabled', false);
                                            } else {
                                                $('#txtDescripcion'+id).prop('disabled', true);
                                                $('#selAccesorio'+id).prop('disabled', true);
                                                $('#txtObservaciones'+id).prop('disabled', true);
                                                //$('#txtDescripcion'+id).val('');
                                                //$('#txtObservaciones'+id).val('');
                                                //$('#selAccesorio'+id).val(0);
                                            }
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    });
    $('#btnProcesarCaso').click(function(){
        // Datos de Usuario
        var cedula = $('#txtCedula').val();
        var nombres = $('#txtNombres').val();
        var apellidos = $('#txtApellidos').val();
        var direccion = $('#txtDireccion').val().replace('#', '%23');
        var parroquia_id = $('#selParroquias').val();
        var tlfFijo = $('#txtTlfFijo').val();
        var tlfMovil = $('#txtTlfMovil').val();
        var correo = $('#txtCorreo').val();
        // Validaciones de datos personales
        if (parroquia_id == 0) {
            alert('Debe Escoger un Estado, Municipio y Parroquia');
            return;
        }
        // Datos de equipo
        var modeloId = $('#selModelo').val();
        var colorId = $('#selColor').val();
        var imei = $('#txtImei').val();
        var serial = $('#txtSerial').val();
        var tecnologiaId = $('#selTecnologia').val();
        var factura = $('#txtFactura').val();
        var tmp = $('#txtFechaCompra').val().split('/')
        var fechaCompra = tmp[2]+'-'+tmp[1]+'-'+tmp[0];
        var operadoraId = $('#selOperadora').val();
        // validaciones de equipo
        if (modeloId == 0) {
            alert('Debe escoger un modelo');
            return
        } else if (colorId == 0) {
            alert('Debe escoger un color');
            return
        } else if (imei == '') {
            alert('Debe colocar el IMEI');
            return
        } else if (serial == '') {
            alert('Debe colocar un serial');
            return
        } else if (tecnologiaId == 0) {
            alert('Debe escoger una tecnología');
            return
        } else if (factura == '') {
            alert('Debe colocar el número de factura');
            return
        } else if ($('#txtFechaCompra').val() == '') {
            alert('Debe colocar la fecha de compra');
            return
        } else if (operadoraId == 0) {
            alert('Debe escoger un operador');
            return
        }
        // Datos Accesorios
        var arrayAccesoriosId = [];
        var arrayDescripcion = [];
        var arrayMotivoId = [];
        var arrayObservaciones = [];
        $.each(arrayAccesorios, function(i, j){
            if ($('#chkAccesorio'+i).prop('checked') === true){
                if ($('#selAccesorio'+i).val() == 0) {
                    alert('Debe Escoger Un motivo');
                    return;
                }
                arrayAccesoriosId.push(i);
                arrayDescripcion.push($('#txtDescripcion'+i).val());
                arrayMotivoId.push($('#selAccesorio'+i).val());
                arrayObservaciones.push($('#txtObservaciones'+i).val());
            }
        });
        var txtAccesoriosId = 'acc[]='+arrayAccesoriosId.join('&acc[]=');
        var txtDescripciones = 'desc[]='+arrayDescripcion.join('&desc[]=');
        var txtMotivosId = 'mot[]='+arrayMotivoId.join('&mot[]=');
        var txtObservaciones = 'obs[]='+arrayObservaciones.join('&obs[]=')
        
        urlProcesar = url+'?accion=setSolicitante&cedula='+cedula+'&nombres='+nombres+'&apellidos='+apellidos+'&direccion='+direccion+'&parroquia_id='+parroquia_id+'&tlfFijo='+tlfFijo+'&tlfMovil='+tlfMovil+'&correo='+correo;
        $.getJSON(urlProcesar, function(json) { // Guardar Solicitante
            console.log('Guardar Solicitante', json);
            solicitanteId = json.id;
            urlProcesar = url+'?accion=setEquipo&solicitanteId='+solicitanteId+'&modeloId='+modeloId+'&colorId='+colorId+'&imei='+imei+'&serial='+serial+'&tecnologiaId='+tecnologiaId+'&factura='+factura+'&fechaCompra='+fechaCompra+'&operadoraId='+operadoraId;
            $.getJSON(urlProcesar, function(json) { // Guardar Equipo
                console.log('Guardar Equipo', json);
                equipoId = json.id;
                console.log('&agencia_id='+agenciaId);
                urlProcesar = url+'?accion=setSolicitud&equipo_id='+equipoId+'&usuario_id='+usuarioId+'&agencia_id='+agenciaId;
                console.log(urlProcesar);
                $.getJSON(urlProcesar, function(json) { // Guardar Solicitud
                    console.log('Guardar Solicitud', json);
                    solicitudId = json.id;
                    urlProcesar = url+'?accion=setAccesorios&solicitudId='+solicitudId+'&'+txtAccesoriosId+'&'+txtDescripciones+'&'+txtMotivosId+'&'+txtObservaciones;
                    console.log(urlProcesar);
                    $.getJSON(urlProcesar, function(json) { // Guardar Accesorios
                        console.log('Guardar Accesorios', json);
                        alert('Registro agregado con exito');
                        $('input:text').val('');
                        $('input:checkbox').prop('checked', false);
                    });
                });
            });
        });
    });
    $('#txtCedula').focusout(function(){
        $.getJSON(url+'?accion=getSolicitante&cedula='+$(this).val(), function(j) { // Obtener Solicitante
            console.log('Solicitante', j);
            $('#txtNombres').val(j.nombres);
            $('#txtApellidos').val(j.apellidos);
            $('#txtDireccion').val(j.direccion);
            //$('#selParroquias').val();
            $('#txtTlfFijo').val(j.telefono_fijo);
            $('#txtTlfMovil').val(j.telefono_movil);
            $('#txtCorreo').val(j.correo);
            idParroquia = j.parroquia_id;
            idMunicipio = arrayParroquias[idParroquia][0];
            idEstado = arrayMunicipios[idMunicipio][0];
            $('#selEstados').val(idEstado);
            $('#selEstados').trigger('change');
            $('#selMunicipios').val(idMunicipio);
            $('#selMunicipios').trigger('change');
            $('#selParroquias').val(idParroquia);
        });
    });
    $('#txtSerial').focusout(function(){
        $.getJSON(url+'?accion=getEquipo&serial='+$(this).val(), function(j) { // Obtener Solicitante
            console.log('Equipo', j);
            console.log(j.color_id);
            $('#selModelo').val(j.modelo_id === undefined ? 0 : j.modelo_id);
            $('#selColor').val(j.color_id === undefined ? 0 : j.color_id);
            $('#txtImei').val(j.imei); 
            $('#selTecnologia').val(j.tecnologia_id === undefined ? 0 : j.tecnologia_id);
            $('#txtFactura').val(j.factura);
            if (j.fecha_compra === undefined) {
                $('#txtFechaCompra').val('');
            } else {
                tmp = j.fecha_compra.split(' ')[0].split('-');
                $('#txtFechaCompra').val(tmp[2]+'/'+tmp[1]+'/'+tmp[0]);
            }
            $('#selOperadora').val(j.operadora_id === undefined ? 0 : j.operadora_id);
        });
    });
});

function lineaAccesorio(id, accesorio){
    var strHTML = '<div class="row" id="accesorio'+id+'">\n';
    strHTML += '    <div class="col-md-2">\n';
    strHTML += '        <label>\n';
    strHTML += '            <input type="checkbox" id="chkAccesorio'+id+'" data-id="'+id+'" class="chkAccesorio">\n';
    strHTML += '            '+accesorio+'\n';
    strHTML += '        </label>\n';
    strHTML += '    </div>\n';
    strHTML += '    <div class="col-md-3">\n';
    strHTML += '        <input type="text" class="form-control" placeholder="Descripción" id="txtDescripcion'+id+'" disabled>\n';
    strHTML += '    </div>\n';
    strHTML += '    <div class="col-md-3">\n';
    strHTML += '        <select class="selectpicker" id="selAccesorio'+id+'" disabled>\n';
    strHTML += '            <option value="0">Motivo de Reemplazo</option>\n';
    $.each(arrayMotivos, function(i, j){
        strHTML += '            <option value="'+i+'">'+j+'</option>\n';
    });
    strHTML += '        </select>\n';
    strHTML += '    </div>\n';
    strHTML += '    <div class="col-md-4">\n';
    strHTML += '        <input type="text" class="form-control" placeholder="Observaciones" id="txtObservaciones'+id+'" disabled>\n';
    strHTML += '    </div>\n';
    strHTML += '</div>\n';
    return strHTML;
}
