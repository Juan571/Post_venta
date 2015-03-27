$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    //$("#contCaso").hide();
    $("#contenidoConsulta").hide();
    $("#buscarCaso").click(function(){
        $("#contenidoConsulta").fadeOut();
        aaa={};
        idCaso=$("#idCaso").val();
        $.getJSON('BD/consulta.php?caso='+idCaso, function(json) {
            strCaso="";
            strCliente="";
            strEquipo="";
            if (json.error){
                alert(json.error)
            }else{
                id_caso="";
                nombre_operador="";
                fecha_solicitud="";
                estado="";
                cedula_cliente="";
                nombre_cliente="";
                direccion="";
                tel_fijo="";
                tel_movil="";
                imei="";
                modelo="";
                color="";
                factura="";
                fecha_compra="";
                operadora="";
                aaa=json;
                $.each(json["caso"], function(i, j){
                    id_caso=j["id"];
                    nombre_operador=j["nombre_operador"];
                    estado=j["estado"];
                    fecha_solicitud=j["fecha_solicitud"];
                    cedula_cliente=j["cedula_cliente"];
                    nombre_cliente=j["nombres_cliente"];
                    direccion=j["direccion"];
                    tel_fijo=j["tel_fijo"];
                    tel_movil=j["tel_movil"];
                    imei=j["imei"];
                    modelo=j["modelo"];
                    color=j["color"];
                    factura=j["factura"];
                    fecha_compra=j["fecha_compra"];
                    operadora=j["operadora"];
                });
                strCaso='<div class="row"><div class="col-md-12"><h2>Datos del caso</h2></div></div>' +
                '<div class="row"><div class="col-md-3" style="text-align: right"><b>Caso N°</b></div><div class="col-md-3">'+id_caso+'</div>' +
                '<div class="col-md-3" style="text-align: right"><b>Fecha de Solicitud</b></div><div class="col-md-3">'+fecha_solicitud+'</div></div>' +
                '<div class="row"><div class="col-md-3" style="text-align: right"><b>Operador</b></div><div class="col-md-3">'+nombre_operador+'</div>' +
                '<div class="col-md-3" style="text-align: right"><b>Estatus</b></div><div class="col-md-3">'+estado+'</div></div>';
                $("#contCaso").html(strCaso);
                strCliente='<div class="row"><div class="col-md-12"><h2>Datos del cliente</h2></div></div>' +
                '<div class="row"><div class="col-md-3" style="text-align: right"><b>Cédula</b></div><div class="col-md-3">'+cedula_cliente+'</div>' +
                '<div class="col-md-3" style="text-align: right"><b>Nombre</b></div><div class="col-md-3">'+nombre_cliente+'</div></div>' +
                '<div class="row"><div class="col-md-3" style="text-align: right"><b>Dirección</b></div><div class="col-md-9">'+direccion+'</div>' +
                '</div><div class="row"><div class="col-md-3" style="text-align: right"><b>Telefono Fijo</b></div><div class="col-md-3">'+tel_fijo+'</div>' +
                '<div class="col-md-3" style="text-align: right"><b>Telefono Movil</b></div><div class="col-md-3">'+tel_movil+'</div>';
                $("#datos_cliente").html(strCliente);
                strEquipo='<div class="row"><div class="col-md-12"><h2>Datos del equipo</h2></div></div>' +
                '<div class="row"><div class="col-md-2" style="text-align: right"><b>IMEI</b></div><div class="col-md-2">'+imei+'</div>' +
                '<div class="col-md-2" style="text-align: right"><b>Modelo</b></div><div class="col-md-2">'+modelo+'</div>' +
                '<div class="col-md-2" style="text-align: right"><b>Color</b></div><div class="col-md-2">'+color+'</div></div>' +
                '<div class="row"><div class="col-md-2" style="text-align: right"><b>N° de Factura</b></div><div class="col-md-2">'+factura+'</div>' +
                '<div class="col-md-2" style="text-align: right"><b>Fecha de Compra</b></div><div class="col-md-2">'+fecha_compra+'</div>' +
                '<div class="col-md-2" style="text-align: right"><b>Operadora</b></div><div class="col-md-2">'+operadora+'</div></div>';
                $("#datos_equipo").html(strEquipo);
                bodyAccesorios="";
                $.each(json["accesorios"], function(i, j){
                    aprobado="";
                    bodyAccesorios+="<tr>";
                        bodyAccesorios+="<td>"+j["producto"]+"</td>";
                        bodyAccesorios+="<td>"+j["tipo_producto"]+"</td>";
                        bodyAccesorios+="<td>"+j["motivo"]+"</td>";
                        aprobado=(j["aprobado"]==1)?"<span class='glyphicon glyphicon-ok'></span>":"<span class='glyphicon glyphicon-remove'></span>";
                        bodyAccesorios+="<td>"+aprobado+"</td>";
                    bodyAccesorios+="</tr>";
                });
                $("#bodyAccesorios").html(bodyAccesorios);
                $("#contenidoConsulta").slideDown();
                $("#pendiente").html("--/--/-- --:--:--");
                $("#Procesado").html("--/--/-- --:--:--");
                $("#Despachado").html("--/--/-- --:--:--");
                $("#En_Oficina_Comercial").html("--/--/-- --:--:--");
                $("#Entregado-icon").html("--/--/-- --:--:--");
                $("#pendiente-icon").html("<span class='glyphicon glyphicon-remove'></span>");
                $("#Procesado-icon").html("<span class='glyphicon glyphicon-remove'></span>");
                $("#Despachado-icon").html("<span class='glyphicon glyphicon-remove'></span>");
                $("#En_Oficina_Comercial-icon").html("<span class='glyphicon glyphicon-remove'></span>");
                $("#Entregado-icon").html("<span class='glyphicon glyphicon-remove'></span>");
                $.each(json["trazabilidad"], function (i, j) {
                    $("#"+j["estado_seguimiento"]).html(j["fecha_seguimiento"]);
                    $("#"+j["estado_seguimiento"]+"-icon").html("<span class='glyphicon glyphicon-ok'></span>")
                });
            }
        }).fail(function(j, t){
            console.log("Per Error: " + t);
        });
    });
});