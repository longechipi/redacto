//-------- FUNCION PARA BLOQUEAR LETRAS ---------//
function numeros(input,event){    
  var keyCode = event.which ? event.which : event.keyCode;
  var lisShiftkeypressed = event.shiftKey;
      if(lisShiftkeypressed && parseInt(keyCode) != 9){
          return false;
      }
  if((parseInt(keyCode)>=48 && parseInt(keyCode)<=57) || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ || keyCode==8/*BCKSPC*/ || keyCode==46/*DEL*/ || keyCode==9/*TAB*/  || keyCode==45/*minus sign*/ || keyCode==43/*plus sign*/){
      return true;
  }     
  alert("SOLO SE PERMITEN NUMEROS"); 
  input.focus();
  return false;           
}

//-------- FUNCION PARA BLOQUEAR NUMEROS ---------//
function letras(input,event){
  var keyCode = event.which ? event.which : event.keyCode;
  //Small Alphabets
  if(parseInt(keyCode)>=97 && parseInt(keyCode)<=122){
      return true;
  }
  //Caps Alphabets
  if(parseInt(keyCode)>=65 && parseInt(keyCode)<=90){
      return true;
  }
  if(parseInt(keyCode)==32 || parseInt(keyCode)==13 || parseInt(keyCode)==46 || keyCode==9/*TAB*/ || keyCode==8/*BCKSPC*/ || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ ){
      return true;
  }
  alert("SOLO SE PERMITEN LETRAS"); 
  input.focus();
  return false; 
}

//-------- FUNCION PARA VALIDAR FECHAS QUE NO SEAN MAYORES A LA ACTUAL ----------//
function validarFecha(campo) {
    var fechaActual = new Date();
    var añoActual = fechaActual.getFullYear();
    var mesActual = fechaActual.getMonth() + 1; // Sumamos 1 porque getMonth() devuelve valores de 0 a 11
    var diaActual = fechaActual.getDate();
    var fechaActualFormateada = añoActual + '-' + (mesActual < 10 ? '0' + mesActual : mesActual) + '-' + (diaActual < 10 ? '0' + diaActual : diaActual);
    var fechaIngresada = $(campo).val();
  
    if (fechaIngresada >= fechaActualFormateada) {
      swal({
        title: 'Error',
        text: 'La Fecha no puede ser Superior a la Actual',
        type: 'error',
        confirmButtonColor: '#1b61c2',
        confirmButtonButtonText: 'Aceptar'
      });
      $(campo).val('');
    }
  }