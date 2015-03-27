function eventosgloblaes(){
     $(document).mousedown(function(){ 
                       window.top.$('.dropdown.open').removeClass('open');
                    });
    $(document).ready(function(){  
                $(document).bind("contextmenu", function(e){  
                    return false;  
                });  
            }); 
    
}

function selectAgencia(data){
    datos={};
    datos["action"]="obtenerCasosGenerales";
    datos["data"]=data[0];
    ajax(datos);
    
    
   // $(".btnsw").bootstrapSwitch('state',false, true);
    $(".btnsw").bootstrapSwitch().on("switchChange.bootstrapSwitch", function (event, state) {
        //alert("Switch pressed");
        if(state){
            document.getElementById($(this).attr("data-text")).disabled = true;
        }
        else{
            document.getElementById($(this).attr("data-text")).disabled = false;        
        }
    });
    $('.bootstrap-switch-handle-on').attr("class", "glyphicon glyphicon-ok-sign bootstrap-switch-handle-on bootstrap-switch-info");
    $('.bootstrap-switch-handle-off').attr("class", "glyphicon glyphicon-remove bootstrap-switch-handle-on bootstrap-switch-danger");
    
    $('.btndesp').on("click",function () {
       
        porNombre=document.getElementsByName("opcionesdesp"+$(this).attr("data-text"));
        // Recorremos todos los valores del radio button para encontrar el
        lugardesp="nada";
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                lugardesp=porNombre[i].value;
        }
        
        if(lugardesp=='agencia'){
            lugardesp=data[0]
        }
        if(lugardesp=='nada'){
            alert("Seleccione la oficina de Despacho..");
        }else{
            despachar={};
            despachar["action"]="despacharAcc";
            despachar["agenciiaid"]=lugardesp;
            despachar["casoid"]=$(this).attr("data-text");
            console.log(despachar); 
            ajax(despachar);            
        }
        //$(".btnsw")[1].bootstrapSwitch('state')
        
    });
    
    
    $('.btnprocaso').on("click",function () {
        idcaso = $(this).attr("data-text");
        ncasos = $($(".btn"+idcaso)).length;
        obsercaso = "";
        modelo = $(this).attr("data-modelo");
        motivo_id="";
        inventario_id="";
        observacionesvacio=false;
                var accesorios=[];
                var caso={};
                var h=0;
                caso["action"]='procesarCaso';
                caso["casoid"]=idcaso;
                
                for (i=0;i< ncasos;i++){
                    motivo_id=$($(".btn"+idcaso)[i]).attr("data-motivo");
                    inventario_id=$($(".btn"+idcaso)[i]).attr("data-inventario_id");
                    console.log("MOTIVO->"+motivo_id);
                   //console.log($($(".btn"+idcaso)[i]).bootstrapSwitch('state'));
                   $("#"+$($(".btn"+idcaso)[i]).attr("data-text")).attr( "style","");
                   if ($($(".btn"+idcaso)[i]).bootstrapSwitch('state')){
                        obsercaso = $("#"+$($(".btn"+idcaso)[i]).attr("data-text")).val();    
                        accesorios[i]=[true,$($(".btn"+idcaso)[i]).attr("data-text"),"", motivo_id, inventario_id];
                   
                   }
                   else{
                        obsercaso = $("#"+$($(".btn"+idcaso)[i]).attr("data-text")).val(); 
                        if(obsercaso.length<=7){
                            observacionesvacio=true;
                           $("#"+$($(".btn"+idcaso)[i]).attr("data-text")).attr("style",'border-color: red;border-width: 2px;')
                        }
                        accesorios[i]=[false,$($(".btn"+idcaso)[i]).attr("data-text"),obsercaso.replace(/^\s+|\s+$/gm,''), motivo_id];
                   }
                }
                caso["accesorios"]=accesorios;
                caso["modelo_id"]=modelo;
                if (observacionesvacio){
                    alert("Las Observaciones para el accesorio rechazado debe contener al menos  caracteres, Complete los Campos en rojo.");
                }
                else{
                    if (confirm('¿Esta seguro que desea procesar este caso?, no se prodrá deshacer esta acción..')) {
                        //console.log(caso);
                        ajax(caso);
                    } else {
                        // Do nothing!
                    }
                }
        //console.log(accesorios.length);
                                    
    }); 
    
    casosproc={};
    casosproc["action"]="buscarCasosProc";
    //console.log(casosproc);
    ajax(casosproc);
}

function desabilitarElementos(caso){
    $(".btn"+caso).bootstrapSwitch('disabled',true);
    $("#divprocaso"+caso).hide();
    $(".txtarea"+caso).attr("disabled",true);
   
    nacc=$(".btn"+caso).length;
    booldespachar=false;
    for(i=0;i<nacc;i++){
         if($(".btn"+caso)[i].checked){
           booldespachar=true;  
         }
    }
    console.log(booldespachar);
    if(booldespachar){
        $("#divdesp"+caso).show();
    }
}
function cargarBadges(){
    cargar={};
    cargar["action"]="cargarBadges";
    //console.log(casosproc);
    ajax(cargar);
}
function ajax(datos,tipodato){
    
    
       $.ajax({
        url     : "./BD/swtichprepared.php",
        async   : false,
        data    : datos,
        dataType: "JSON",
        type    :"post",
        error   : function(err,textStatus, jqXHR){///////Ya no debeira funcionar.......
          error= err;
           
          console.log(textStatus);
          console.log(jqXHR);
          console.log(err);
          //alert("Error");
        },
        success:function(resp, textStatus, jqXHR){
                //console.log(resp) ;

                switch (resp.evento) {

                 case "guardar":
                   
                     if (resp.respuesta.error){
                          //  console.log(resp.respuesta);
                        if (resp.respuesta.codeerror==23505){
                            alert("Ya este registro Existe");
                            break;
                        }
                        alert("Error..");
                        break;
                     }
                     else{
                        //console.log(resp) ;
                        if ($("#tablaEstadosActividades").children().length > 0) {              
                            $("#tablaEstadosActividades").dataTable().fnClearTable();
                            $("#tablaEstadosActividades").dataTable().fnDestroy();
                            $("#tablaEstadosActividades thead > tr >  th").hide();
                        }   
                        cargarTablas("obtenerEstados", "", "#tablaEstadosActividades", null, [0],"./Clases/modelEstadosActividad.php");
                        alert("Registrado Exitosamente..");
                     }
                    
                        break;
                        
                case "cargarBadges":
                        //console.log(resp.respuesta);
                        $.each(resp.respuesta,function(key,val){
                            //console.log(val)
                            $.each(val,function(keys,valor){
                                console.log(keys+"-->"+valor);
                            });
                            $("#totalCasos").text(val.totalCasos);
                            $("#casosPendientes").text(val.casosPendientes);
                            $("#casosProcesados").text(val.casosProcesados);
                            $("#casosDespachados").text(val.casosDespachados);
                            $("#casosRechazados").text(val.casosDenegados);
                                
                        });
                        break;
                        
                case "despacharAcc":
                        console.log(resp);
                        $(".panel"+resp.respuesta).hide();                       
                        alert("Despachado exitosamente");
                        cargarBadges()
                        break;
                        
                case "procesarCaso":
                        desabilitarElementos(resp.respuesta);
                        alert("Procesado Exitosamente");//console.log(resp)
                        cargarBadges();
                        break;
                
                case "obtenerCasosGenerales":
                        $("#agentes").html("")
                        if (resp.respuesta.length==0){
                           // console.log(resp.respuesta);
                            $("#sincasos").show();                            
                        }else{
                            $("#sincasos").hide();  
                            $("#agentes").html(resp.respuesta);
                        }
                        
                        cargarBadges();
                        break;
                
                default:
                        break;
                }
               
                if (resp.hasOwnProperty("casosproc")){
                $.each(resp.casosproc,function(key,val){
                       // console.log(key+"->"+val);
                        console.log(val)
                        desabilitarElementos(val);
                       
                   });
                // console.log(resp);    
                }
                
        }
    });
}  