//crear abjeto XMLHttpRequest
function creaObjetoAjax () {
     var obj; //variable que recoger� el objeto
     if (window.XMLHttpRequest) { //c�digo para mayor�a de navegadores
        obj=new XMLHttpRequest();
        }
     else { //para IE 5 y IE 6
        obj=new ActiveXObject(Microsoft.XMLHTTP);
        }
     return obj; //devolvemos objeto
     }
//funci�n constructora del objeto:
function ObjetoAjax () {
     var nuevoajax=creaObjetoAjax()
     this.objeto=nuevoajax;
     this.pedirTexto=pedirTextoAjax;
		 this.cargaXML=cargarXML;
     this.cargaTexto=cargarTexto;
     }
//funci�n para el m�todo objeto.pedirTexto(url,id)
function pedirTextoAjax(url,id) {
     var nuevoajax=this.objeto;
     var idajax=id;
     nuevoajax.open("GET",url,true);
     nuevoajax.onreadystatechange=function () {
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var textoAjax=nuevoajax.responseText;
           document.getElementById(idajax).innerHTML=textoAjax;
           }
        }
     nuevoajax.send();
     }
/*funci�n del m�todo cargaXML: devuelve el DOM del XML
como par�metro de la funci�n que le pasamos*/
function cargarXML(url,funcion) {
     var nuevoajax=this.objeto;
     var funcionXML=funcion
     nuevoajax.open("GET",url,true);
     nuevoajax.onreadystatechange=function() {
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var propiedad=nuevoajax.responseXML;
           funcionXML(propiedad);
           }
        }
     nuevoajax.send();
     }
//funci�n del m�todo cargaTexto:
//devuelve el texto del archivo en el par�metro.
function cargarTexto(url,funcion) {
     var nuevoajax=this.objeto;
     var funcionTexto=funcion
     nuevoajax.open("GET",url,true);
     nuevoajax.onreadystatechange=function() {
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var nuevoTexto=nuevoajax.responseText;
           funcionTexto(nuevoTexto);
           }
        }
     nuevoajax.send();
     }

//Funci�n para enviar datos por POSI y devolver en un id:
function pedirPorPost(url,id,datos) {
     //variables que utilizamos en la funci�n (locales)
     var nuevoajax=this.objeto; //creamos objeto XMLHttpRequest
     var idajax=id; //lugar de la p�gina para insertar la respuesta
     var datosajax=datos; //datos a enviar por POST
     //Preparar el envio con open()
     nuevoajax.open("POST",url,true);
     //cambiar las cabeceras para el envio por POST
     nuevoajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     nuevoajax.setRequestHeader("Content-length", datosajax.length);
     nuevoajax.setRequestHeader("Connection", "close");
     //evento que activa la respuesta:
     nuevoajax.onreadystatechange=function () {
        if (nuevoajax.readyState==4 && nuevoajax.status==200) { //al acabar de cargarse
           var textoAjax=nuevoajax.responseText; //recibir respuesta
           document.getElementById(idajax).innerHTML=textoAjax; //insertarla en la p�gina
           }
        }
     //envio de los datos por send()
     nuevoajax.send(datosajax);
     }
//Asociar la funci�n anterior con el m�todo "pedirPost" de ObjetoAjax mediante "prototype";
ObjetoAjax.prototype.pedirPost=pedirPorPost;

//envia datos por post y recoge el resultado en el par�metro de una funci�n:
//devuelve el texto del archivo en el par�metro.
function cargarPost(url,funcion,datos) {
     var nuevoajax=this.objeto;
     var funcionTexto=funcion
     var datosajax=datos;
     nuevoajax.open("POST",url,true);
     nuevoajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     nuevoajax.setRequestHeader("Content-length", datosajax.length);
     nuevoajax.setRequestHeader("Connection", "close");
     nuevoajax.onreadystatechange=function() {
        if (nuevoajax.readyState==4 && nuevoajax.status==200) {
           var nuevoTexto=nuevoajax.responseText;
           funcionTexto(nuevoTexto);
           }
        }
     nuevoajax.send(datosajax);
     }
ObjetoAjax.prototype.cargaPost=cargarPost;
