
var bPaginate = true ;
var bScrollCollapse= false;
var sScrollY= null;
var searching = true;
var bLengthChange =true;
var bSort = true ;
var iDisplayLength  = 10 ;
var cambiarDiseno = {};

 /*
var cambiarDiseno['tamano'];
var cambiarDiseno['bPaginate'];
var cambiarDiseno['bScrollCollapse'];
var cambiarDiseno['searching'];
var cambiarDiseno['bLengthChange'];
var cambiarDiseno['iDisplayLength'];
*/

function crearTh(datos,tabla){
  var tablatemp=tabla;
  var tabla=tabla;
  var classOpc ="indice";
  var indice=null;
          $(tabla).html("<thead><tr class=\"rowtabla\">");
          tabla+=" thead tr";
          $.each(datos,function(k,v){ 
              var th = $("<th>",{
                  css:{
                    "padding-left":"4px",
                    "padding-right":"4px",
                    "padding-bottom":"4px",
                    "padding-top":"4px",
                  },
                  html : v
              });
              if(k===indice){
                $(th).addClass(classOpc);
              }
              $(tabla).append(th);
        //    $(tabla).append("<th style=\"padding-left: 4px;padding-right: 4px;padding-top: 2px;padding-bottom: 2px;\">"+v+"</th>");
          });

        if (tablatemp=="#tablaAccesoriosOrden")
            $(tabla).append("<th>Recibido</th>");
        else
            $(tabla).append("<th>Accion</th>");
         }

function cargarTablas(action,data,tabla,cambiarDiseno,columnasvisibles,url,urlIdioma){
  var header=[];
   datos = {
               action          : action,
               accion          : action,
               data            : data
          }
  var tabla=tabla;
    if(urlIdioma==null){
        urlIdioma="./";
    }
 if(url==null){
    dir="./BD/swtichprepared.php";
  }else{
    dir=url;
  }

  $.ajax({
            url:dir,
            data:datos,
            dataType:"json",
            type:"POST",
            async :true,
            error:function(req,err){
              console.log(req);
              $(tabla).hide();
             },
            success: function(resp) {
              var data =[];
              var data2=[];
              var ih=0;
              var op=0;
              var datostr=[];
              if(resp.length==0){
                
                switch (tabla){
                    case "#tablaUsuariosConsultaMorosos":
                         $(".colmorosos").hide();
                    break;
                    
                }

                return 0;
              }
              Keys = Object.keys(resp[0]);
              var cont=0;
              Keys.map(function(v){
                   Keys[cont]=v.charAt(0).toUpperCase()+v.slice(1);
                   cont++;
              })
              cont=0;
              crearTh(Keys,tabla);//Añadir Thead a la Tabla, con los object Key obtenidos

                $.each(resp, function (ix, itemx) {
                 op++;
                 data=[];        
                 $.each(itemx, function (ixx, itemxx) {
                    ih++;
                    data.push(itemxx);
                 });
              data2[ix]=data;//creo el array con el array del tr dentro..
              ih=0;
              });
                  //console.log(data);
                if(cambiarDiseno!=null){
                      sScrollY  = cambiarDiseno['tamano'];
                      bPaginate = cambiarDiseno['bPaginate'];
                      bScrollCollapse = cambiarDiseno['bScrollCollapse'];
                      searching = cambiarDiseno['searching'];
                      bLengthChange = cambiarDiseno['bLengthChange'];
                      iDisplayLength = cambiarDiseno['iDisplayLength'];
                      bJQueryUI: cambiarDiseno['bJQueryUI'];
                      //bSort = cambiarDiseno['bSort'];
                }
                else{
                   bJQueryUI: true,
                   bPaginate = true ;
                   bScrollCollapse= false;
                   sScrollY= "";
                }

              $(tabla).dataTable( {
                "bRetrieve" :true,
                "bJQueryUI": true,
                "iDisplayLength": iDisplayLength ,
                "bSort" :"true",
                "sScrollY": sScrollY,
                "bScrollCollapse": bScrollCollapse,
                "bPaginate":bPaginate,
                "searching": searching,
                "bLengthChange": bLengthChange,
                "data": data2,
                "bJQueryUI":false,
                //"async": false,
                "oLanguage" : {                   
                  "sUrl": urlIdioma +"dataTables/spa_SPA.txt"
                },          
                "aoColumnDefs": [
                    {
                        "aTargets": [-1],
                        "mData": null,
                        "sDefaultContent" :"<button style='padding:3px'class='botonRow  btn btn-primary '>Editar</span></button>",
                        "mRender": function (data, type, full) {
                        }
                  }, 
                  {
                      "targets": columnasvisibles,
                      "visible": false,
                      "searchable": false
                  }  
                ],
                    
                "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ){
                          if (tabla==="#tablaAccesorios"){
                              $(nRow).children().each(function(index, td) {

                                  if(index == 4)  {
                                      // console.log($(td).text());
                                      if ($(td).html() == "Disponible") {
                                      }else{
                                          $(td).attr("style","background-color:rgb(204, 255, 204)")
                                      }
                                  }
                              });

                          }
                    if(tabla==="#tablaOrdenes"){
                        var boton = $(nRow).find(".botonRow");
                        var btnEmpleado = $(nRow).find(".botonRow");

                        $(btnEmpleado).removeClass("btn-primary").html("<span class='glyphicon glyphicon-search'></span>");
                        $(btnEmpleado).addClass(" btn-info");
                        $(btnEmpleado).off();// Se elimina el Evento anterior
                        $(btnEmpleado).on("click",function () {
                            $(nRow).removeClass("selected");
                            console.log(aData);

                            detallesOrdenAsignacion(aData);
                            console.log(aData[0]);

                        });
                        $(btnEmpleado).parent().attr('style','text-align:center');
                    }

                    if(tabla==="#tablaAccesoriosOrden"){
                        var boton = $(nRow).find(".botonRow");
                        var btnEmpleado = $(nRow).find(".botonRow");
                        $(nRow).attr("data-id",aData[0])
                        $(nRow).addClass("trAccesorios");
                        if (aData[4]=='1'){

                            $(btnEmpleado).removeClass("btn-primary").parent().html("<div class=' make-switch col-lg-2'><input data-text='"+aData[1]+"' data-id='"+aData[7]+"' id=btnsw class ='btnsw btn' type='checkbox' data-off-color='danger' data-on-color='info' data-size='large' data-on-text='' data-off-text='' checked disabled> </div>");
                        }else{
                            $(btnEmpleado).removeClass("btn-primary").parent().html("<div class=' make-switch col-lg-2'><input data-text='"+aData[1]+"' data-id='"+aData[7]+"' id=btnsw class ='btnsw btn' type='checkbox' data-off-color='danger' data-on-color='info' data-size='large' data-on-text='' data-off-text='' > </div>");
                        }
                        $(btnEmpleado).parent().attr('style','text-align:center');
                    }
                    if(tabla==="#tabla_ofc"){
                             var boton = $(nRow).find(".botonRow");
                                 var btnEmpleado = $(nRow).find(".botonRow");
                                 $(btnEmpleado).removeClass("btn-primary").html("<span class='icon-ok'>Ver Detalles</span>");
                                 $(btnEmpleado).addClass(" btn-info");
                                 $(btnEmpleado).off();// Se elimina el Evento anterior 
                                 $(btnEmpleado).on("click",function () {
                                    $(nRow).removeClass("selected");
                                    //alert("VER DETALLES xD");
                                    selectAgencia(aData);
                                 }); 
                                 $(btnEmpleado).parent().attr('style','text-align:center');
                          } 
                },

                "fnDrawCallback": function () {
                    if(tabla==="#tablaAccesoriosOrden"){
                        $(".btnsw").bootstrapSwitch();
                        $('.bootstrap-switch-handle-on').attr("class", "glyphicon glyphicon-ok-sign bootstrap-switch-handle-on bootstrap-switch-info");
                        $('.bootstrap-switch-handle-off').attr("class", "glyphicon glyphicon-remove bootstrap-switch-handle-on bootstrap-switch-danger");
                    }

                    var tabla1 = $(tabla).DataTable();
                     var cadenatabla = tabla + " tbody";
                     $(cadenatabla).on( 'click', 'tr', function () {

                         if ( $(this).hasClass('selected') ) {
                          }
                         else {
                           tabla1.$('tr.selected').removeClass('selected');
                           $(this).addClass('selected');
                          }
                     });
                 }
                //aoColumns..
              });  // datatable 
              }//succes
});//ajax
}
