$(document).ready(function(){
    //$("#contCaso").hide();
    $("#buscarCaso").click(function(){
        idCaso=$("#idCaso").val();
        $.getJSON('BD/consulta.php?caso='+idCaso, function(json) {
            console.log(json);
            strHTML="";
            strHTML+="<tr>";

            strHTML+="</tr>";
        }).fail(function(j, t){
            console.log("Per Error: " + t);
        });
    });
});