/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function limpiarCajas(){
        
        $("input").val("");
        
    }

function asignarColor(fondo,borde,texto,url) { 
 $("#mensaje").css("background-color",fondo );
 $("#mensaje").css("border-color",borde);
 $("#mensaje").css("color",texto);
 $("#mensaje").css("background-image",url);
 }

function error() { 
setTimeout("asignarColor('#FFBABA','#e5582b','#D8000C','url(../utiles/image/error.png)')",1);
}
 
 function exito() { 
 setTimeout("asignarColor('#DFF2BF','#aacc5b','#4F8A10','url(../utiles/image/exito.png)')",1);
 }
 
  function cargando() { 
 setTimeout("asignarColor('#BDE5F8','#00529B','#00529B','url(../utiles/image/cargando.gif)')",1);
 }
 
 function ocultar(){
 setTimeout("$('#mensaje').hide();", 2000);
 setTimeout("$('#overlay').hide();", 2000);
 }
    
