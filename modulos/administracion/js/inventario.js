var url = 'php/inventario.php';
var arrayAccesorios;
var arrayModelos;
var arrayInventario;
var tabla;

function cargarDatePicker() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    //$("#fechaActividad").val(today);
    $(function () {
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            weekHeader: 'Sm',
            prevText: 'Previo',
            nextText: 'Próximo',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
            ],
            monthStatus: 'Ver otro mes',
            yearStatus: 'Ver  año',
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            dateFormat: 'yy-mm-dd',
            firstDay: 0,
            initStatus: 'Selecciona la fecha',
            isRTL: false
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $("#txtOrdenFecha").datepicker({
            firstDay: 1,
            maxDate:today
        });


    });
}
$(window).load(function(){
    cargarDatePicker();
    cargarTablas("getInventario", "", "#tablaAccesorios", null, [1,2,-1],"../administracion/php/inventario.php","../GestionCasos/");

    $.getJSON(url+'?accion=getModelos', function(json) { // Obtener Accesorios
        arrayModelos = json;
        //console.log('getModelos', arrayModelos);
        //llenarAccesorios();
        llenarEntradaModelos();
    }).fail(function(aa){
        console.log('fail'+aa);
    });

    $('#selModelos').change(function(){
        //console.log($(this).val());
        $.getJSON(url+'?accion=getAccesorios&data='+$(this).val(), function(json) { // Obtener Accesorios
            arrayAccesorios = json
            // console.log('getAccesorios', arrayAccesorios);
            //llenarAccesorios();
            llenarEntradaAccesorios();
        }).fail(function(){
            console.log('fail');
        });
    });
    $('#btnAgregarInvModelo').click(function(){

        id = $("#selAccesorios").val();
        idmodelo = $("#selModelos option:selected").val();
        accesorio = $("#selAccesorios option:selected").text();
        modelo = $("#selModelos option:selected").text();
        existe = false;
        count = 1;

        if ((id*idmodelo) == 0) {
            return;
        }

        for (i = 0; i < $(tblEntradaAccesorios.children).length; i++) {
            count++;
            if( $(tblEntradaAccesorios.children[i]).attr("data-id")==(id)) existe=true;

        }
        if (existe) {
            alert("Este accesorio ya fue agregado, modifique la cantidad en la tabla..");
            return;
        }


        strHTML = '\t<tr id="trAccesorios'+id+'" class="trAccesorios" data-id="'+id+'">\n';
        strHTML += '\t\t<td>'+count+'</td>\n';
        strHTML += '\t\t<td id="tdAccesorio'+id+'">'+accesorio+'</td>\n';
        strHTML += '\t\t<td id="tdAccesorio'+id+'">'+modelo+'</td>\n';
        strHTML += '\t\t<td style=\'text-align: center;\'><input type="text" maxlength="6" onkeypress="return isNumberKey(event)" class="form-control" id="txtAccesoriosCantidad'+id+'" placeholder="Cantidad"></td>\n';
        strHTML += '\t\t<td style=\'text-align: center;\'><button class="btn btn-danger btnEliminar" data-id="'+id+'"><span class="glyphicon glyphicon-remove"></button></td>\n';
        strHTML += '\t</tr>\n';

        $('#tblEntradaAccesorios').append(strHTML);

        $('.btnEliminar').click(function(){
            console.log($(this).attr('data-id'));
            id = $(this).attr('data-id');
            accesorio = $('#tdAccesorio'+id).text();
            $('#trAccesorios'+id).remove();
            // $('#selAccesorios').append('\t<option value="'+id+'">'+accesorio+'</option>\n');
        });
    });

    $('#btnCancelarEntradaAccesorios').click(function(){
        $('#tblEntradaAccesorios').html("");
        $("#entradaAccesorios input").val("");
        $('#selModelos option:eq(0)').prop('selected', true);
        $('#entradaAccesorios').trigger('reveal:close');
        llenarEntradaAccesorios();
    });

    $('#btnAceptarEntradaAccesorios').click(function(){

        strId = '';
        strCantidad = '';
        orden = '';
        orden=$("#txtOrdenAsignacion").val();
        fechaorden = $("#txtOrdenFecha").val();
        observacionOrden = $("#txtOrdenObservacion").val();

        if (orden.length*$('.trAccesorios').length*fechaorden.length===0){
            alert("Faltan Datos..");
            return;
        }
        $('.trAccesorios').each(function(){
            id = $(this).attr('data-id');
            strId += '&id[]='+id;
            strCantidad += '&cant[]='+$('#txtAccesoriosCantidad'+id).val();
            if ($('#txtAccesoriosCantidad'+id).val()==0){
                strId = '';
            }
        });
        if ( strId == ''){
            alert("Falta la cantidad de algunos accesorios");
            return;
        }
        var r = confirm("Esta seguro que deseea agregar esta orden de solicitud?");
        if (r != true) {
            return;
        }
        urlSetCantidadAccesorios = url+'?accion=setCantidadAccesorios&codeOrdAsig='+orden+"&fechaorden="+fechaorden+"&obserorden="+observacionOrden+strId+strCantidad;
        console.log(urlSetCantidadAccesorios);
        $.getJSON(urlSetCantidadAccesorios, function(json) {
            console.log('setCantidadAccesorios', json);
            llenarEntradaAccesorios();
            llenarAccesorios();
            $('#tblEntradaAccesorios').html("");
            $("#entradaAccesorios input").val("");
            $('#selModelos option:eq(0)').prop('selected', true);
            $('#entradaAccesorios').trigger('reveal:close');
            llenarEntradaAccesorios();
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
    //$('#tblEntradaAccesorios').text('');
}
function llenarEntradaModelos() {
    strHTMLSelect = '\t<option value="0">Seleccione un Modelo</option>\n';
    $.each(arrayModelos, function(i, j){

        strHTMLSelect += '\t<option value="'+i+'">'+ j.descrip+"("+j.modelo+")"+'</option>\n';
    });
    $('#selModelos').html(strHTMLSelect);

}
function llenarAccesorios(){
    $("#tablaAccesorios").dataTable().fnClearTable();
    $("#tablaAccesorios").dataTable().fnDestroy();
    cargarTablas("getInventario", "", "#tablaAccesorios", null, [1,2,-1],"../administracion/php/inventario.php","../GestionCasos/");
}

function botones() {
    $('.btnRemove').click(function(){

    });
}