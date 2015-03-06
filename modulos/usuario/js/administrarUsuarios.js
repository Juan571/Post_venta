var url = 'php/administrarUsuarios.php';
var oficinaComercial = [];
var usuarios = [];
var idUsuario = 0;
$(window).load(function(){
    $('.selectpicker').css('width', '100%');
    $('.selectpicker').selectpicker();
    urlAgentesAutorizados = url+'?accion=getAgentesAutorizados';
    $.getJSON(urlAgentesAutorizados, function(json) { // Obtener Agentes Autorizados
        console.log('getAgentesAutorizados', json, urlAgentesAutorizados);
        strHTML = '\t<option value="0">&nbsp;Seleccione Una Oficina Comercial</option>\n';
        $.each(json, function(i, j){
            strHTML += '\t<option value="'+i+'">'+j.nombre+'</option>\n';
            oficinaComercial[i] = j.agencias;
        });
        $('#selOficinaComercial').html(strHTML);
        $('#selOficinaComercial').selectpicker();
        $('#selOficinaComercial').selectpicker('refresh');
        $('#selOficinaComercial').change(function(e, v){
            id = $(this).val();
            agencia = $("#selOficinaComercial option:selected").text();
            strHTML = '\t<option value="0">&nbsp;Seleccione Un Agente Autorizado</option>\n';
            if (id > 0) {
                strHTML += '\t<option value="'+id+'">'+agencia+'</option>\n';
                $.each(oficinaComercial[$(this).val()], function(i, j){
                    strHTML += '\t<option value="'+j.id+'">'+j.nombre+'</option>\n';
                });
            }
            $('#selAgencia').html(strHTML);
            $('#selAgencia').selectpicker();
            if (v != undefined) {
                $('#selAgencia').val(parseInt(v));
            }
            $('#selAgencia').selectpicker('refresh');
        });
        urlTipoUsuarios = url+'?accion=getTiposUsuarios';
        $.getJSON(urlTipoUsuarios, function(json) { // Obtener Tipos de Usuarios
            console.log('getTiposUsuarios', json, urlTipoUsuarios);
            strHTML = '';
            $.each(json, function(i, j){
                strHTML += '\t\t<option value="'+i+'">'+j+'</option>\n';
            });
            $('#selTipoUsuario').html(strHTML);
            $('#selTipoUsuario').selectpicker();
            $('#selTipoUsuario').selectpicker('refresh');
            llenarTabla();
        });
    });
    $('#btnAgregar').click(function(){
        cedula = $('#txtCedula').val();
        nombres = $('#txtNombres').val();
        apellidos = $('#txtApellidos').val();
        clave = $('#txtClave').val();
        correo = $('#txtCorreo').val();
        agenciaId = $('#selAgencia').val();
        tipoUsuarioId = $('#selTipoUsuario').val();
        $.each(usuarios, function(i, j){
            if (cedula == j.cedula) {
                alert ('La Cédula ya existe');
                return;
            }
        });
        if (cedula.trim() == '') {
            alert('Debe Colocar Una Cédula');
            return;
        } else if (cedula.trim() == '') {
            alert('Debe Colocar Una Cédula');
            return;
        } else if (nombres.trim() == '') {
            alert('Debe Colocar Un Nombre');
            return;
        } else if (apellidos.trim() == '') {
            alert('Debe Colocar Un Apellido');
            return;
        } else if (clave.trim() == '') {
            alert('Debe Colocar Una Contraseña');
            return;
        } else if (correo.trim() == '') {
            alert('Debe Colocar Un Correo');
            return;
        } else if (agenciaId == 0) {
            alert('Debe Seleccionar un Agente Autorizado');
            return;
        }
        urlSetUsuario = url+'?accion=setUsuario&cedula='+cedula+'&nombres='+nombres+'&apellidos='+apellidos+'&clave='+clave+'&correo='+correo+'&agenciaId='+agenciaId+'&tipoUsuarioId='+tipoUsuarioId;
        console.log(urlSetUsuario);
        $.getJSON(urlSetUsuario, function(json) { // Obtener Tipos de Usuarios
            console.log('setUsuario', json, urlSetUsuario);
            llenarTabla();
            $('.form-control').val('');
            $('#selTipoUsuario').val(1);
            $('#selOficinaComercial').val(0);
            $('#selOficinaComercial').trigger('change');
        });
    });

    $('#btnAceptar').click(function(){
        cedula = $('#txtCedula').val();
        nombres = $('#txtNombres').val();
        apellidos = $('#txtApellidos').val();
        clave = $('#txtClave').val();
        correo = $('#txtCorreo').val();
        agenciaId = $('#selAgencia').val();
        tipoUsuarioId = $('#selTipoUsuario').val();
        if (cedula.trim() == '') {
            alert('Debe Colocar Una Cédula');
            return;
        } else if (cedula.trim() == '') {
            alert('Debe Colocar Una Cédula');
            return;
        } else if (nombres.trim() == '') {
            alert('Debe Colocar Un Nombre');
            return;
        } else if (apellidos.trim() == '') {
            alert('Debe Colocar Un Apellido');
            return;
        } else if (correo.trim() == '') {
            alert('Debe Colocar Un Correo');
            return;
        } else if (agenciaId == 0) {
            alert('Debe Seleccionar un Agente Autorizado');
            return;
        }
        urlUpdateUsuario = url+'?accion=updateUsuario&id='+idUsuario+'&cedula='+cedula+'&nombres='+nombres+'&apellidos='+apellidos+'&clave='+clave+'&correo='+correo+'&agenciaId='+agenciaId+'&tipoUsuarioId='+tipoUsuarioId;
        console.log(urlUpdateUsuario);
        $.getJSON(urlUpdateUsuario, function(json) { // Obtener Tipos de Usuarios
            console.log('setUsuario', json, urlUpdateUsuario);
            $('.form-control').val('');
            $('#selTipoUsuario').val(1);
            $('#selOficinaComercial').val(0);
            $('#selOficinaComercial').trigger('change');
            llenarTabla();
        });
    });

});

function llenarTabla(){
    urlLlenarTabla = url+'?accion=getUsuarios';
    $.getJSON(urlLlenarTabla, function(json) { // Obtener Usuarios
        usuarios = json;
        console.log('getUsuarios', usuarios, urlLlenarTabla);
        strHTML = '';
        $.each(json, function(i, j){
            strHTML += '<tr id="tr'+i+'">\n';
            strHTML += '\t<td id="id'+i+'" data-id="'+i+'">'+i+'</td>\n';
            strHTML += '\t<td id="cedula'+i+'">'+j.cedula+'</td>\n';
            strHTML += '\t<td id="nombres'+i+'">'+j.nombres+'</td>\n';
            strHTML += '\t<td id="apellidos'+i+'">'+j.apellidos+'</td>\n';
            strHTML += '\t<td id="correo'+i+'">'+j.correo+'</td>\n';
            strHTML += '\t<td id="agencia'+i+'" data-id="'+j.agencia_id+'">'+j.agencia+'</td>\n';
            strHTML += '\t<td id="tipoUsuario'+i+'" data-id="'+j.tipo_usuario_id+'">'+j.tipo_usuario+'</td>\n';
            strHTML += '\t<td>\n';
            strHTML += '\t\t<button data-oc-id="'+j.oficina_comercial_id+'" data-id="'+i+'" class="btn btn-info btnEdit"><span class="glyphicon glyphicon-edit"></span></button>\n';
            strHTML += '\t\t<button data-id="'+i+'" class="btn btn-danger btnRemove"><span class="glyphicon glyphicon-remove"></span></button>\n';
            strHTML += '\t</td>\n';
            strHTML += '</tr>\n';
        });
        $('#tblUsuarios').html(strHTML);
        $('.btnEdit').click(function(){
            id = $(this).attr('data-id');
            idUsuario = id;
            $('#txtCedula').val($('#cedula'+id).text());
            $('#txtNombres').val($('#nombres'+id).text());
            $('#txtApellidos').val($('#apellidos'+id).text());
            $('#txtCorreo').val($('#correo'+id).text());
            $('#selTipoUsuario').val($('#tipoUsuario'+id).attr('data-id'));
            $('#selOficinaComercial').val($(this).attr('data-oc-id'));
            $('#selOficinaComercial').trigger('change', $('#agencia'+id).attr('data-id'));
            $('#btnAceptar').show();
            $('#btnCancelar').show();
            $('#btnAgregar').hide();
        });
        $('.btnRemove').click(function(){
            id = $(this).attr('data-id');
            $("#popEliminar").dialog({
                modal: true,
                buttons: {
                    'Eliminar' : function(){
                        urlDel = url+'?accion=delUsuario&id='+id;
                        $.getJSON(urlDel, function(json) {
                            console.log('delUsuario', json, urlDel);
                            llenarTabla();
                            $("#popEliminar").dialog("close");
                        }).fail(function(j,t){
                            console.log("Error: " + t);
                        });
                    },
                    'Cancelar': function() {
                        $("#popEliminar").dialog("close");
                    }
                }
            });    
        });
    });
    $('#btnCancelar').click(function(){
        $('.form-control').val('');
        $('#selTipoUsuario').val(1);
        $('#selOficinaComercial').val(0);
        $('#selOficinaComercial').trigger('change');
        $('#btnAceptar').hide();
        $('#btnCancelar').hide();
        $('#btnAgregar').show();
    });
}

var md5=(function(){function e(e,t){var o=e[0],u=e[1],a=e[2],f=e[3];o=n(o,u,a,f,t[0],7,-680876936);f=n(f,o,u,a,t[1],
12,-389564586);a=n(a,f,o,u,t[2],17,606105819);u=n(u,a,f,o,t[3],22,-1044525330);o=n(o,u,a,f,t[4],7,-176418897);f=n(f,o,u,a,t[5],
12,1200080426);a=n(a,f,o,u,t[6],17,-1473231341);u=n(u,a,f,o,t[7],22,-45705983);o=n(o,u,a,f,t[8],7,1770035416);f=n(f,o,u,a,t[9],
12,-1958414417);a=n(a,f,o,u,t[10],17,-42063);u=n(u,a,f,o,t[11],22,-1990404162);o=n(o,u,a,f,t[12],7,1804603682);f=n(f,o,u,a,t[13],
12,-40341101);a=n(a,f,o,u,t[14],17,-1502002290);u=n(u,a,f,o,t[15],22,1236535329);o=r(o,u,a,f,t[1],5,-165796510);f=r(f,o,u,a,t[6],
9,-1069501632);a=r(a,f,o,u,t[11],14,643717713);u=r(u,a,f,o,t[0],20,-373897302);o=r(o,u,a,f,t[5],5,-701558691);f=r(f,o,u,a,t[10],
9,38016083);a=r(a,f,o,u,t[15],14,-660478335);u=r(u,a,f,o,t[4],20,-405537848);o=r(o,u,a,f,t[9],5,568446438);f=r(f,o,u,a,t[14],
9,-1019803690);a=r(a,f,o,u,t[3],14,-187363961);u=r(u,a,f,o,t[8],20,1163531501);o=r(o,u,a,f,t[13],5,-1444681467);f=r(f,o,u,a,t[2],
9,-51403784);a=r(a,f,o,u,t[7],14,1735328473);u=r(u,a,f,o,t[12],20,-1926607734);o=i(o,u,a,f,t[5],4,-378558);f=i(f,o,u,a,t[8],
11,-2022574463);a=i(a,f,o,u,t[11],16,1839030562);u=i(u,a,f,o,t[14],23,-35309556);o=i(o,u,a,f,t[1],4,-1530992060);f=i(f,o,u,a,t[4],
11,1272893353);a=i(a,f,o,u,t[7],16,-155497632);u=i(u,a,f,o,t[10],23,-1094730640);o=i(o,u,a,f,t[13],4,681279174);f=i(f,o,u,a,t[0],
11,-358537222);a=i(a,f,o,u,t[3],16,-722521979);u=i(u,a,f,o,t[6],23,76029189);o=i(o,u,a,f,t[9],4,-640364487);f=i(f,o,u,a,t[12],
11,-421815835);a=i(a,f,o,u,t[15],16,530742520);u=i(u,a,f,o,t[2],23,-995338651);o=s(o,u,a,f,t[0],6,-198630844);f=s(f,o,u,a,t[7],
10,1126891415);a=s(a,f,o,u,t[14],15,-1416354905);u=s(u,a,f,o,t[5],21,-57434055);o=s(o,u,a,f,t[12],6,1700485571);f=s(f,o,u,a,t[3],
10,-1894986606);a=s(a,f,o,u,t[10],15,-1051523);u=s(u,a,f,o,t[1],21,-2054922799);o=s(o,u,a,f,t[8],6,1873313359);f=s(f,o,u,a,t[15],
10,-30611744);a=s(a,f,o,u,t[6],15,-1560198380);u=s(u,a,f,o,t[13],21,1309151649);o=s(o,u,a,f,t[4],6,-145523070);f=s(f,o,u,a,t[11],
10,-1120210379);a=s(a,f,o,u,t[2],15,718787259);u=s(u,a,f,o,t[9],21,-343485551);e[0]=m(o,e[0]);e[1]=m(u,e[1]);e[2]=m(a,e[2]);e[3]=m(f,e[3])}
function t(e,t,n,r,i,s){t=m(m(t,e),m(r,s));return m(t<<i|t>>>32-i,n)}function n(e,n,r,i,s,o,u){return t(n&r|~n&i,e,n,s,o,u)}
function r(e,n,r,i,s,o,u){return t(n&i|r&~i,e,n,s,o,u)}function i(e,n,r,i,s,o,u){return t(n^r^i,e,n,s,o,u)}
function s(e,n,r,i,s,o,u){return t(r^(n|~i),e,n,s,o,u)}function o(t){var n=t.length,r=[1732584193,-271733879,-1732584194,271733878],i;
for(i=64;i<=t.length;i+=64){e(r,u(t.substring(i-64,i)))}t=t.substring(i-64);var s=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
for(i=0;i<t.length;i++)s[i>>2]|=t.charCodeAt(i)<<(i%4<<3);s[i>>2]|=128<<(i%4<<3);if(i>55){e(r,s);for(i=0;i<16;i++)s[i]=0}s[14]=n*8;e(r,s);return r}
function u(e){var t=[],n;for(n=0;n<64;n+=4){t[n>>2]=e.charCodeAt(n)+(e.charCodeAt(n+1)<<8)+(e.charCodeAt(n+2)<<16)+(e.charCodeAt(n+3)<<24)}return t}
function c(e){var t="",n=0;for(;n<4;n++)t+=a[e>>n*8+4&15]+a[e>>n*8&15];return t}
function h(e){for(var t=0;t<e.length;t++)e[t]=c(e[t]);return e.join("")}
function d(e){return h(o(unescape(encodeURIComponent(e))))}
function m(e,t){return e+t&4294967295}var a="0123456789abcdef".split("");return d})();