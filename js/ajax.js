//Creamos el objeto XMLHttpRequest mediante una función:
function creaObjetoAjax () {
         var obj; //variable que recogerá el objeto
         if (window.XMLHttpRequest) { //código para mayoría de navegadores
            obj=new XMLHttpRequest();
            }
         else { //para IE 5 y IE 6
            obj=new ActiveXObject(Microsoft.XMLHTTP);
            }
         return obj; //devolvemos objeto
         }
ant_personales=creaObjetoAjax(); //llamar a funcion crear objeto.
ant_personales.open("GET","textos/ant_personales.txt",true); //preparar petición del objeto
ant_personales.onreadystatechange=leerArchivo; //indicar dónde recoger la respuesta
ant_personales.send() //enviar petición
//función que recoge la respuesta para poder utilizarla
function leerArchivo() {
         if (ant_personales.readyState == 4) { //Comprobar carga página
            if (ant_personales.status == 200) { //Comprobar URL
               texto1=ant_personales.responseText; //Recoger texto
               }
            }
         }
				 function verTexto1() {
				          ver=document.getElementById("respuesta1");
				          ver.innerHTML=texto1;
				          }
				 //función para botón "Ocultar texto"
				 function ocultarTexto1() {
				          nover=document.getElementById("respuesta1");
				          nover.innerHTML="";
				          }

                  ant_psiquiatricos=creaObjetoAjax(); //llamar a funcion crear objeto.
                  ant_psiquiatricos.open("GET","textos/ant_psiquiatricos.txt",true); //preparar petición del objeto
                  ant_psiquiatricos.onreadystatechange=leerArchivo2; //indicar dónde recoger la respuesta
                  ant_psiquiatricos.send() //enviar petición
                  //función que recoge la respuesta para poder utilizarla
                  function leerArchivo2() {
                  				if (ant_psiquiatricos.readyState == 4) { //Comprobar carga página
                  				    if (ant_psiquiatricos.status == 200) { //Comprobar URL
                  				      texto2=ant_psiquiatricos.responseText; //Recoger texto
                  				    }
                  				   }
                  			  }
                  //función para botón "Ver texto"
                  function verTexto2() {
                  	  		ver=document.getElementById("respuesta2");
                  				ver.innerHTML=texto2;
                  				}
                  //función para botón "Ocultar texto"
                  function ocultarTexto2() {
                  			  nover=document.getElementById("respuesta2");
                  				nover.innerHTML="";
                  				}



                          ant_patologico=creaObjetoAjax(); //llamar a funcion crear objeto.
                          ant_patologico.open("GET","textos/ant_patologico.txt",true); //preparar petición del objeto
                          ant_patologico.onreadystatechange=leerArchivo3; //indicar dónde recoger la respuesta
                          	ant_patologico.send() //enviar petición
                          	//función que recoge la respuesta para poder utilizarla
                          	function leerArchivo3() {
                          					if (ant_patologico.readyState == 4) { //Comprobar carga página
                          						  if (ant_patologico.status == 200) { //Comprobar URL
                          							  texto3=ant_patologico.responseText; //Recoger texto
                          							}
                          						 }
                          				  }
                          	//función para botón "Ver texto"
                          	function verTexto3() {
                          					ver=document.getElementById("respuesta3");
                          					ver.innerHTML=texto3;
                          					}
                          	//función para botón "Ocultar texto"
                          	function ocultarTexto3() {
                          					nover=document.getElementById("respuesta3");
                          					nover.innerHTML="";
                          					}


                                    ant_quirurgico=creaObjetoAjax(); //llamar a funcion crear objeto.
                                    ant_quirurgico.open("GET","textos/ant_quirurgico.txt",true); //preparar petición del objeto
                                    ant_quirurgico.onreadystatechange=leerArchivo4; //indicar dónde recoger la respuesta
                                      ant_quirurgico.send() //enviar petición
                                      //función que recoge la respuesta para poder utilizarla
                                      function leerArchivo4() {
                                              if (ant_quirurgico.readyState == 4) { //Comprobar carga página
                                                  if (ant_quirurgico.status == 200) { //Comprobar URL
                                                    texto4=ant_quirurgico.responseText; //Recoger texto
                                                  }
                                                 }
                                              }
                                      //función para botón "Ver texto"
                                      function verTexto4() {
                                              ver=document.getElementById("respuesta4");
                                              ver.innerHTML=texto4;
                                              }
                                      //función para botón "Ocultar texto"
                                      function ocultarTexto4() {
                                              nover=document.getElementById("respuesta4");
                                              nover.innerHTML="";
                                              }

                                              ant_toxicologico=creaObjetoAjax(); //llamar a funcion crear objeto.
                                              ant_toxicologico.open("GET","textos/ant_toxicologico.txt",true); //preparar petición del objeto
                                              ant_toxicologico.onreadystatechange=leerArchivo5; //indicar dónde recoger la respuesta
                                                ant_toxicologico.send() //enviar petición
                                                //función que recoge la respuesta para poder utilizarla
                                                function leerArchivo5() {
                                                        if (ant_toxicologico.readyState == 4) { //Comprobar carga página
                                                            if (ant_toxicologico.status == 200) { //Comprobar URL
                                                              texto5=ant_toxicologico.responseText; //Recoger texto
                                                            }
                                                           }
                                                        }
                                                //función para botón "Ver texto"
                                                function verTexto5() {
                                                        ver=document.getElementById("respuesta5");
                                                        ver.innerHTML=texto5;
                                                        }
                                                //función para botón "Ocultar texto"
                                                function ocultarTexto5() {
                                                        nover=document.getElementById("respuesta5");
                                                        nover.innerHTML="";
                                                        }
                                                        ant_farmacologicos=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                        ant_farmacologicos.open("GET","textos/ant_farmacologicos.txt",true); //preparar petición del objeto
                                                        ant_farmacologicos.onreadystatechange=leerArchivo6; //indicar dónde recoger la respuesta
                                                          ant_farmacologicos.send() //enviar petición
                                                          //función que recoge la respuesta para poder utilizarla
                                                          function leerArchivo6() {
                                                                  if (ant_farmacologicos.readyState == 4) { //Comprobar carga página
                                                                      if (ant_farmacologicos.status == 200) { //Comprobar URL
                                                                        texto6=ant_farmacologicos.responseText; //Recoger texto
                                                                      }
                                                                     }
                                                                  }
                                                          //función para botón "Ver texto"
                                                          function verTexto6() {
                                                                  ver=document.getElementById("respuesta6");
                                                                  ver.innerHTML=texto6;
                                                                  }
                                                          //función para botón "Ocultar texto"
                                                          function ocultarTexto6() {
                                                                  nover=document.getElementById("respuesta6");
                                                                  nover.innerHTML="";
                                                                  }
                                                                  ant_hospitalarios=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                  ant_hospitalarios.open("GET","textos/ant_hospitalarios.txt",true); //preparar petición del objeto
                                                                  ant_hospitalarios.onreadystatechange=leerArchivo7; //indicar dónde recoger la respuesta
                                                                    ant_hospitalarios.send() //enviar petición
                                                                    //función que recoge la respuesta para poder utilizarla
                                                                    function leerArchivo7() {
                                                                            if (ant_hospitalarios.readyState == 4) { //Comprobar carga página
                                                                                if (ant_hospitalarios.status == 200) { //Comprobar URL
                                                                                  texto7=ant_hospitalarios.responseText; //Recoger texto
                                                                                }
                                                                               }
                                                                            }
                                                                    //función para botón "Ver texto"
                                                                    function verTexto7() {
                                                                            ver=document.getElementById("respuesta7");
                                                                            ver.innerHTML=texto7;
                                                                            }
                                                                    //función para botón "Ocultar texto"
                                                                    function ocultarTexto7() {
                                                                            nover=document.getElementById("respuesta7");
                                                                            nover.innerHTML="";
                                                                            }
                                                                            ant_traumatologicos=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                            ant_traumatologicos.open("GET","textos/ant_traumatologicos.txt",true); //preparar petición del objeto
                                                                            ant_traumatologicos.onreadystatechange=leerArchivo8; //indicar dónde recoger la respuesta
                                                                              ant_traumatologicos.send() //enviar petición
                                                                              //función que recoge la respuesta para poder utilizarla
                                                                              function leerArchivo8() {
                                                                                      if (ant_traumatologicos.readyState == 4) { //Comprobar carga página
                                                                                          if (ant_traumatologicos.status == 200) { //Comprobar URL
                                                                                            texto8=ant_traumatologicos.responseText; //Recoger texto
                                                                                          }
                                                                                         }
                                                                                      }
                                                                              //función para botón "Ver texto"
                                                                              function verTexto8() {
                                                                                      ver=document.getElementById("respuesta8");
                                                                                      ver.innerHTML=texto8;
                                                                                      }
                                                                              //función para botón "Ocultar texto"
                                                                              function ocultarTexto8() {
                                                                                      nover=document.getElementById("respuesta8");
                                                                                      nover.innerHTML="";
                                                                                      }
                                                                                      ant_familiares=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                      ant_familiares.open("GET","textos/ant_familiares.txt",true); //preparar petición del objeto
                                                                                      ant_familiares.onreadystatechange=leerArchivo9; //indicar dónde recoger la respuesta
                                                                                        ant_familiares.send() //enviar petición
                                                                                        //función que recoge la respuesta para poder utilizarla
                                                                                        function leerArchivo9() {
                                                                                                if (ant_familiares.readyState == 4) { //Comprobar carga página
                                                                                                    if (ant_familiares.status == 200) { //Comprobar URL
                                                                                                      texto9=ant_familiares.responseText; //Recoger texto
                                                                                                    }
                                                                                                   }
                                                                                                }
                                                                                        //función para botón "Ver texto"
                                                                                        function verTexto9() {
                                                                                                ver=document.getElementById("respuesta9");
                                                                                                ver.innerHTML=texto9;
                                                                                                }
                                                                                        //función para botón "Ocultar texto"
                                                                                        function ocultarTexto9() {
                                                                                                nover=document.getElementById("respuesta9");
                                                                                                nover.innerHTML="";
                                                                                                }
                                                                                                ant_otros=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                ant_otros.open("GET","textos/ant_otros.txt",true); //preparar petición del objeto
                                                                                                ant_otros.onreadystatechange=leerArchivo10; //indicar dónde recoger la respuesta
                                                                                                  ant_otros.send() //enviar petición
                                                                                                  //función que recoge la respuesta para poder utilizarla
                                                                                                  function leerArchivo10() {
                                                                                                          if (ant_otros.readyState == 4) { //Comprobar carga página
                                                                                                              if (ant_otros.status == 200) { //Comprobar URL
                                                                                                                texto10=ant_otros.responseText; //Recoger texto
                                                                                                              }
                                                                                                             }
                                                                                                          }
                                                                                                  //función para botón "Ver texto"
                                                                                                  function verTexto10() {
                                                                                                          ver=document.getElementById("respuesta10");
                                                                                                          ver.innerHTML=texto10;
                                                                                                          }
                                                                                                  //función para botón "Ocultar texto"
                                                                                                  function ocultarTexto10() {
                                                                                                          nover=document.getElementById("respuesta10");
                                                                                                          nover.innerHTML="";
                                                                                                          }
                                                                                                          estadogeneral=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                          estadogeneral.open("GET","textos/estadogeneral.txt",true); //preparar petición del objeto
                                                                                                          estadogeneral.onreadystatechange=leerArchivo11; //indicar dónde recoger la respuesta
                                                                                                            estadogeneral.send() //enviar petición
                                                                                                            //función que recoge la respuesta para poder utilizarla
                                                                                                            function leerArchivo11() {
                                                                                                                    if (estadogeneral.readyState == 4) { //Comprobar carga página
                                                                                                                        if (estadogeneral.status == 200) { //Comprobar URL
                                                                                                                          texto11=estadogeneral.responseText; //Recoger texto
                                                                                                                        }
                                                                                                                       }
                                                                                                                    }
                                                                                                            //función para botón "Ver texto"
                                                                                                            function verTexto11() {
                                                                                                                    ver=document.getElementById("respuesta11");
                                                                                                                    ver.innerHTML=texto11;
                                                                                                                    }
                                                                                                            //función para botón "Ocultar texto"
                                                                                                            function ocultarTexto11() {
                                                                                                                    nover=document.getElementById("respuesta11");
                                                                                                                    nover.innerHTML="";
                                                                                                                    }
                                                                                                                    ccuello=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                    ccuello.open("GET","textos/ccuello.txt",true); //preparar petición del objeto
                                                                                                                    ccuello.onreadystatechange=leerArchivo12; //indicar dónde recoger la respuesta
                                                                                                                      ccuello.send() //enviar petición
                                                                                                                      //función que recoge la respuesta para poder utilizarla
                                                                                                                      function leerArchivo12() {
                                                                                                                              if (ccuello.readyState == 4) { //Comprobar carga página
                                                                                                                                  if (ccuello.status == 200) { //Comprobar URL
                                                                                                                                    texto12=ccuello.responseText; //Recoger texto
                                                                                                                                  }
                                                                                                                                 }
                                                                                                                              }
                                                                                                                      //función para botón "Ver texto"
                                                                                                                      function verTexto12() {
                                                                                                                              ver=document.getElementById("respuesta12");
                                                                                                                              ver.innerHTML=texto12;
                                                                                                                              }
                                                                                                                      //función para botón "Ocultar texto"
                                                                                                                      function ocultarTexto12() {
                                                                                                                              nover=document.getElementById("respuesta12");
                                                                                                                              nover.innerHTML="";
                                                                                                                              }
                                                                                                                              torax=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                              torax.open("GET","textos/torax.txt",true); //preparar petición del objeto
                                                                                                                              torax.onreadystatechange=leerArchivo13; //indicar dónde recoger la respuesta
                                                                                                                                torax.send() //enviar petición
                                                                                                                                //función que recoge la respuesta para poder utilizarla
                                                                                                                                function leerArchivo13() {
                                                                                                                                        if (torax.readyState == 4) { //Comprobar carga página
                                                                                                                                            if (torax.status == 200) { //Comprobar URL
                                                                                                                                              texto13=torax.responseText; //Recoger texto
                                                                                                                                            }
                                                                                                                                           }
                                                                                                                                        }
                                                                                                                                //función para botón "Ver texto"
                                                                                                                                function verTexto13() {
                                                                                                                                        ver=document.getElementById("respuesta13");
                                                                                                                                        ver.innerHTML=texto13;
                                                                                                                                        }
                                                                                                                                //función para botón "Ocultar texto"
                                                                                                                                function ocultarTexto13() {
                                                                                                                                        nover=document.getElementById("respuesta13");
                                                                                                                                        nover.innerHTML="";
                                                                                                                                        }
                                                                                                                                        extremidades=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                        extremidades.open("GET","textos/extremidades.txt",true); //preparar petición del objeto
                                                                                                                                        extremidades.onreadystatechange=leerArchivo14; //indicar dónde recoger la respuesta
                                                                                                                                          extremidades.send() //enviar petición
                                                                                                                                          //función que recoge la respuesta para poder utilizarla
                                                                                                                                          function leerArchivo14() {
                                                                                                                                                  if (extremidades.readyState == 4) { //Comprobar carga página
                                                                                                                                                      if (extremidades.status == 200) { //Comprobar URL
                                                                                                                                                        texto14=extremidades.responseText; //Recoger texto
                                                                                                                                                      }
                                                                                                                                                     }
                                                                                                                                                  }
                                                                                                                                          //función para botón "Ver texto"
                                                                                                                                          function verTexto14() {
                                                                                                                                                  ver=document.getElementById("respuesta14");
                                                                                                                                                  ver.innerHTML=texto14;
                                                                                                                                                  }
                                                                                                                                          //función para botón "Ocultar texto"
                                                                                                                                          function ocultarTexto14() {
                                                                                                                                                  nover=document.getElementById("respuesta14");
                                                                                                                                                  nover.innerHTML="";
                                                                                                                                                  }
                                                                                                                                                  neurologico=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                  neurologico.open("GET","textos/neurologico.txt",true); //preparar petición del objeto
                                                                                                                                                  neurologico.onreadystatechange=leerArchivo15; //indicar dónde recoger la respuesta
                                                                                                                                                    neurologico.send() //enviar petición
                                                                                                                                                    //función que recoge la respuesta para poder utilizarla
                                                                                                                                                    function leerArchivo15() {
                                                                                                                                                            if (neurologico.readyState == 4) { //Comprobar carga página
                                                                                                                                                                if (neurologico.status == 200) { //Comprobar URL
                                                                                                                                                                  texto15=neurologico.responseText; //Recoger texto
                                                                                                                                                                }
                                                                                                                                                               }
                                                                                                                                                            }
                                                                                                                                                    //función para botón "Ver texto"
                                                                                                                                                    function verTexto15() {
                                                                                                                                                            ver=document.getElementById("respuesta15");
                                                                                                                                                            ver.innerHTML=texto15;
                                                                                                                                                            }
                                                                                                                                                    //función para botón "Ocultar texto"
                                                                                                                                                    function ocultarTexto15() {
                                                                                                                                                            nover=document.getElementById("respuesta15");
                                                                                                                                                            nover.innerHTML="";
                                                                                                                                                            }
                                                                                                                                                            abdomen=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                            abdomen.open("GET","textos/abdomen.txt",true); //preparar petición del objeto
                                                                                                                                                            abdomen.onreadystatechange=leerArchivo16; //indicar dónde recoger la respuesta
                                                                                                                                                              abdomen.send() //enviar petición
                                                                                                                                                              //función que recoge la respuesta para poder utilizarla
                                                                                                                                                              function leerArchivo16() {
                                                                                                                                                                      if (abdomen.readyState == 4) { //Comprobar carga página
                                                                                                                                                                          if (abdomen.status == 200) { //Comprobar URL
                                                                                                                                                                            texto16=abdomen.responseText; //Recoger texto
                                                                                                                                                                          }
                                                                                                                                                                         }
                                                                                                                                                                      }
                                                                                                                                                              //función para botón "Ver texto"
                                                                                                                                                              function verTexto16() {
                                                                                                                                                                      ver=document.getElementById("respuesta16");
                                                                                                                                                                      ver.innerHTML=texto16;
                                                                                                                                                                      }
                                                                                                                                                              //función para botón "Ocultar texto"
                                                                                                                                                              function ocultarTexto16() {
                                                                                                                                                                      nover=document.getElementById("respuesta16");
                                                                                                                                                                      nover.innerHTML="";
                                                                                                                                                                      }
                                                                                                                                                                      genital=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                      genital.open("GET","textos/genital.txt",true); //preparar petición del objeto
                                                                                                                                                                      genital.onreadystatechange=leerArchivo17; //indicar dónde recoger la respuesta
                                                                                                                                                                        genital.send() //enviar petición
                                                                                                                                                                        //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                        function leerArchivo17() {
                                                                                                                                                                                if (genital.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                    if (genital.status == 200) { //Comprobar URL
                                                                                                                                                                                      texto17=genital.responseText; //Recoger texto
                                                                                                                                                                                    }
                                                                                                                                                                                   }
                                                                                                                                                                                }
                                                                                                                                                                        //función para botón "Ver texto"
                                                                                                                                                                        function verTexto17() {
                                                                                                                                                                                ver=document.getElementById("respuesta17");
                                                                                                                                                                                ver.innerHTML=texto17;
                                                                                                                                                                                }
                                                                                                                                                                        //función para botón "Ocultar texto"
                                                                                                                                                                        function ocultarTexto17() {
                                                                                                                                                                                nover=document.getElementById("respuesta17");
                                                                                                                                                                                nover.innerHTML="";
                                                                                                                                                                                }
                                                                                                                                                                                
