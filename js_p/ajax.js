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
                                                                                                                                                                                      text17=genital.responseText; //Recoger texto
                                                                                                                                                                                    }
                                                                                                                                                                                   }
                                                                                                                                                                                }
                                                                                                                                                                        //función para botón "Ver texto"
                                                                                                                                                                        function verTexto17() {
                                                                                                                                                                                ver=document.getElementById("respuesta17");
                                                                                                                                                                                ver.innerHTML=text17;
                                                                                                                                                                                }
                                                                                                                                                                        //función para botón "Ocultar texto"
                                                                                                                                                                        function ocultarTexto17() {
                                                                                                                                                                                nover=document.getElementById("respuesta17");
                                                                                                                                                                                nover.innerHTML="";
                                                                                                                                                                                }
                                                                                                                                                                                faca=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                faca.open("GET","textos/faca.txt",true); //preparar petición del objeto
                                                                                                                                                                                faca.onreadystatechange=leerArchivo18; //indicar dónde recoger la respuesta
                                                                                                                                                                                  faca.send() //enviar petición
                                                                                                                                                                                  //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                  function leerArchivo18() {
                                                                                                                                                                                          if (faca.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                              if (faca.status == 200) { //Comprobar URL
                                                                                                                                                                                                text18=faca.responseText; //Recoger texto
                                                                                                                                                                                              }
                                                                                                                                                                                             }
                                                                                                                                                                                          }
                                                                                                                                                                                  //función para botón "Ver texto"
                                                                                                                                                                                  function verTexto18() {
                                                                                                                                                                                          ver=document.getElementById("respuesta18");
                                                                                                                                                                                          ver.innerHTML=text18;
                                                                                                                                                                                          }
                                                                                                                                                                                  //función para botón "Ocultar texto"
                                                                                                                                                                                  function ocultarTexto18() {
                                                                                                                                                                                          nover=document.getElementById("respuesta18");
                                                                                                                                                                                          nover.innerHTML="";
                                                                                                                                                                                          }
                                                                                                                                                                                          bta=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                          bta.open("GET","textos/bta.txt",true); //preparar petición del objeto
                                                                                                                                                                                          bta.onreadystatechange=leerArchivo19; //indicar dónde recoger la respuesta
                                                                                                                                                                                            bta.send() //enviar petición
                                                                                                                                                                                            //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                            function leerArchivo19() {
                                                                                                                                                                                                    if (bta.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                        if (bta.status == 200) { //Comprobar URL
                                                                                                                                                                                                          text19=bta.responseText; //Recoger texto
                                                                                                                                                                                                        }
                                                                                                                                                                                                       }
                                                                                                                                                                                                    }
                                                                                                                                                                                            //función para botón "Ver texto"
                                                                                                                                                                                            function verTexto19() {
                                                                                                                                                                                                    ver=document.getElementById("respuesta19");
                                                                                                                                                                                                    ver.innerHTML=text19;
                                                                                                                                                                                                    }
                                                                                                                                                                                            //función para botón "Ocultar texto"
                                                                                                                                                                                            function ocultarTexto19() {
                                                                                                                                                                                                    nover=document.getElementById("respuesta19");
                                                                                                                                                                                                    nover.innerHTML="";
                                                                                                                                                                                                    }
                                                                                                                                                                                                    w1=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                    w1.open("GET","textos/w1.txt",true); //preparar petición del objeto
                                                                                                                                                                                                    w1.onreadystatechange=leerArchivo20; //indicar dónde recoger la respuesta
                                                                                                                                                                                                      w1.send() //enviar petición
                                                                                                                                                                                                      //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                      function leerArchivo20() {
                                                                                                                                                                                                              if (w1.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                  if (w1.status == 200) { //Comprobar URL
                                                                                                                                                                                                                    text20=w1.responseText; //Recoger texto
                                                                                                                                                                                                                  }
                                                                                                                                                                                                                 }
                                                                                                                                                                                                              }
                                                                                                                                                                                                      //función para botón "Ver texto"
                                                                                                                                                                                                      function verTexto20() {
                                                                                                                                                                                                              ver=document.getElementById("respuesta20");
                                                                                                                                                                                                              ver.innerHTML=text20;
                                                                                                                                                                                                              }
                                                                                                                                                                                                      //función para botón "Ocultar texto"
                                                                                                                                                                                                      function ocultarTexto20() {
                                                                                                                                                                                                              nover=document.getElementById("respuesta20");
                                                                                                                                                                                                              nover.innerHTML="";
                                                                                                                                                                                                              }
                                                                                                                                                                                                              w2=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                              w2.open("GET","textos/w2.txt",true); //preparar petición del objeto
                                                                                                                                                                                                              w2.onreadystatechange=leerArchivo21; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                w2.send() //enviar petición
                                                                                                                                                                                                                //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                function leerArchivo21() {
                                                                                                                                                                                                                        if (w2.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                            if (w2.status == 200) { //Comprobar URL
                                                                                                                                                                                                                              text21=w2.responseText; //Recoger texto
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                           }
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                //función para botón "Ver texto"
                                                                                                                                                                                                                function verTexto21() {
                                                                                                                                                                                                                        ver=document.getElementById("respuesta21");
                                                                                                                                                                                                                        ver.innerHTML=text21;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                //función para botón "Ocultar texto"
                                                                                                                                                                                                                function ocultarTexto21() {
                                                                                                                                                                                                                        nover=document.getElementById("respuesta21");
                                                                                                                                                                                                                        nover.innerHTML="";
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        w3=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                        w3.open("GET","textos/w3.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                        w3.onreadystatechange=leerArchivo22; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                          w3.send() //enviar petición
                                                                                                                                                                                                                          //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                          function leerArchivo22() {
                                                                                                                                                                                                                                  if (w3.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                      if (w3.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                        text22=w3.responseText; //Recoger texto
                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                     }
                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                          //función para botón "Ver texto"
                                                                                                                                                                                                                          function verTexto22() {
                                                                                                                                                                                                                                  ver=document.getElementById("respuesta22");
                                                                                                                                                                                                                                  ver.innerHTML=text22;
                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                          //función para botón "Ocultar texto"
                                                                                                                                                                                                                          function ocultarTexto22() {
                                                                                                                                                                                                                                  nover=document.getElementById("respuesta22");
                                                                                                                                                                                                                                  nover.innerHTML="";
                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                  n1=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                  n1.open("GET","textos/n1.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                  n1.onreadystatechange=leerArchivo23; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                    n1.send() //enviar petición
                                                                                                                                                                                                                                    //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                    function leerArchivo23() {
                                                                                                                                                                                                                                            if (n1.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                if (n1.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                  text23=n1.responseText; //Recoger texto
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                               }
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                    //función para botón "Ver texto"
                                                                                                                                                                                                                                    function verTexto23() {
                                                                                                                                                                                                                                            ver=document.getElementById("respuesta23");
                                                                                                                                                                                                                                            ver.innerHTML=text23;
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                    //función para botón "Ocultar texto"
                                                                                                                                                                                                                                    function ocultarTexto23() {
                                                                                                                                                                                                                                            nover=document.getElementById("respuesta23");
                                                                                                                                                                                                                                            nover.innerHTML="";
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            n2=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                            n2.open("GET","textos/n2.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                            n2.onreadystatechange=leerArchivo24; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                              n2.send() //enviar petición
                                                                                                                                                                                                                                              //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                              function leerArchivo24() {
                                                                                                                                                                                                                                                      if (n2.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                          if (n2.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                            text24=n2.responseText; //Recoger texto
                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                         }
                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                              //función para botón "Ver texto"
                                                                                                                                                                                                                                              function verTexto24() {
                                                                                                                                                                                                                                                      ver=document.getElementById("respuesta24");
                                                                                                                                                                                                                                                      ver.innerHTML=text24;
                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                              //función para botón "Ocultar texto"
                                                                                                                                                                                                                                              function ocultarTexto24() {
                                                                                                                                                                                                                                                      nover=document.getElementById("respuesta24");
                                                                                                                                                                                                                                                      nover.innerHTML="";
                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                      n3=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                      n3.open("GET","textos/n3.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                      n3.onreadystatechange=leerArchivo25; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                        n3.send() //enviar petición
                                                                                                                                                                                                                                                        //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                        function leerArchivo25() {
                                                                                                                                                                                                                                                                if (n3.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                    if (n3.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                      text25=n3.responseText; //Recoger texto
                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                   }
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                        //función para botón "Ver texto"
                                                                                                                                                                                                                                                        function verTexto25() {
                                                                                                                                                                                                                                                                ver=document.getElementById("respuesta25");
                                                                                                                                                                                                                                                                ver.innerHTML=text25;
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                        //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                        function ocultarTexto25() {
                                                                                                                                                                                                                                                                nover=document.getElementById("respuesta25");
                                                                                                                                                                                                                                                                nover.innerHTML="";
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                administrado1=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                administrado1.open("GET","textos/administrado1.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                administrado1.onreadystatechange=leerArchivo26; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                  administrado1.send() //enviar petición
                                                                                                                                                                                                                                                                  //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                  function leerArchivo26() {
                                                                                                                                                                                                                                                                          if (administrado1.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                              if (administrado1.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                texto26=administrado1.responseText; //Recoger texto
                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                             }
                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                  //función para botón "Ver texto"
                                                                                                                                                                                                                                                                  function verTexto26() {
                                                                                                                                                                                                                                                                          ver=document.getElementById("respuesta26");
                                                                                                                                                                                                                                                                          ver.innerHTML=texto26;
                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                  //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                  function ocultarTexto26() {
                                                                                                                                                                                                                                                                          nover=document.getElementById("respuesta26");
                                                                                                                                                                                                                                                                          nover.innerHTML="";
                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                          administrado2=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                          administrado2.open("GET","textos/administrado2.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                          administrado2.onreadystatechange=leerArchivo27; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                            administrado2.send() //enviar petición
                                                                                                                                                                                                                                                                            //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                            function leerArchivo27() {
                                                                                                                                                                                                                                                                                    if (administrado2.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                                        if (administrado2.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                          texto27=administrado2.responseText; //Recoger texto
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                       }
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                            //función para botón "Ver texto"
                                                                                                                                                                                                                                                                            function verTexto27() {
                                                                                                                                                                                                                                                                                    ver=document.getElementById("respuesta27");
                                                                                                                                                                                                                                                                                    ver.innerHTML=texto27;
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                            //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                            function ocultarTexto27() {
                                                                                                                                                                                                                                                                                    nover=document.getElementById("respuesta27");
                                                                                                                                                                                                                                                                                    nover.innerHTML="";
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                    administrado3=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                                    administrado3.open("GET","textos/administrado3.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                                    administrado3.onreadystatechange=leerArchivo28; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                                      administrado3.send() //enviar petición
                                                                                                                                                                                                                                                                                      //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                                      function leerArchivo28() {
                                                                                                                                                                                                                                                                                              if (administrado3.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                                                  if (administrado3.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                                    texto28=administrado3.responseText; //Recoger texto
                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                 }
                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                      //función para botón "Ver texto"
                                                                                                                                                                                                                                                                                      function verTexto28() {
                                                                                                                                                                                                                                                                                              ver=document.getElementById("respuesta28");
                                                                                                                                                                                                                                                                                              ver.innerHTML=texto28;
                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                      //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                                      function ocultarTexto28() {
                                                                                                                                                                                                                                                                                              nover=document.getElementById("respuesta28");
                                                                                                                                                                                                                                                                                              nover.innerHTML="";
                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                              devuelto1=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                                              devuelto1.open("GET","textos/devuelto1.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                                              devuelto1.onreadystatechange=leerArchivo29; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                                                devuelto1.send() //enviar petición
                                                                                                                                                                                                                                                                                                //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                                                function leerArchivo29() {
                                                                                                                                                                                                                                                                                                        if (devuelto1.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                                                            if (devuelto1.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                                              texto29=devuelto1.responseText; //Recoger texto
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                           }
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                //función para botón "Ver texto"
                                                                                                                                                                                                                                                                                                function verTexto29() {
                                                                                                                                                                                                                                                                                                        ver=document.getElementById("respuesta29");
                                                                                                                                                                                                                                                                                                        ver.innerHTML=texto29;
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                                                function ocultarTexto29() {
                                                                                                                                                                                                                                                                                                        nover=document.getElementById("respuesta29");
                                                                                                                                                                                                                                                                                                        nover.innerHTML="";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                        devuelto2=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                                                        devuelto2.open("GET","textos/devuelto2.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                                                        devuelto2.onreadystatechange=leerArchivo30; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                                                          devuelto2.send() //enviar petición
                                                                                                                                                                                                                                                                                                          //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                                                          function leerArchivo30() {
                                                                                                                                                                                                                                                                                                                  if (devuelto2.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                                                                      if (devuelto2.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                                                        texto30=devuelto2.responseText; //Recoger texto
                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                     }
                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                          //función para botón "Ver texto"
                                                                                                                                                                                                                                                                                                          function verTexto30() {
                                                                                                                                                                                                                                                                                                                  ver=document.getElementById("respuesta30");
                                                                                                                                                                                                                                                                                                                  ver.innerHTML=texto30;
                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                          //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                                                          function ocultarTexto30() {
                                                                                                                                                                                                                                                                                                                  nover=document.getElementById("respuesta30");
                                                                                                                                                                                                                                                                                                                  nover.innerHTML="";
                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                                  devuelto3=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                                                                  devuelto3.open("GET","textos/devuelto3.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                                                                  devuelto3.onreadystatechange=leerArchivo31; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                                                                    devuelto3.send() //enviar petición
                                                                                                                                                                                                                                                                                                                    //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                                                                    function leerArchivo31() {
                                                                                                                                                                                                                                                                                                                            if (devuelto3.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                                                                                if (devuelto3.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                                                                  texto31=devuelto3.responseText; //Recoger texto
                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                               }
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                    //función para botón "Ver texto"
                                                                                                                                                                                                                                                                                                                    function verTexto31() {
                                                                                                                                                                                                                                                                                                                            ver=document.getElementById("respuesta31");
                                                                                                                                                                                                                                                                                                                            ver.innerHTML=texto31;
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                    //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                                                                    function ocultarTexto31() {
                                                                                                                                                                                                                                                                                                                            nover=document.getElementById("respuesta31");
                                                                                                                                                                                                                                                                                                                            nover.innerHTML="";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                            devuelto4=creaObjetoAjax(); //llamar a funcion crear objeto.
                                                                                                                                                                                                                                                                                                                            devuelto4.open("GET","textos/devuelto4.txt",true); //preparar petición del objeto
                                                                                                                                                                                                                                                                                                                            devuelto4.onreadystatechange=leerArchivo32; //indicar dónde recoger la respuesta
                                                                                                                                                                                                                                                                                                                              devuelto4.send() //enviar petición
                                                                                                                                                                                                                                                                                                                              //función que recoge la respuesta para poder utilizarla
                                                                                                                                                                                                                                                                                                                              function leerArchivo32() {
                                                                                                                                                                                                                                                                                                                                      if (devuelto4.readyState == 4) { //Comprobar carga página
                                                                                                                                                                                                                                                                                                                                          if (devuelto4.status == 200) { //Comprobar URL
                                                                                                                                                                                                                                                                                                                                            texto32=devuelto4.responseText; //Recoger texto
                                                                                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                                                                                         }
                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                              //función para botón "Ver texto"
                                                                                                                                                                                                                                                                                                                              function verTexto32() {
                                                                                                                                                                                                                                                                                                                                      ver=document.getElementById("respuesta32");
                                                                                                                                                                                                                                                                                                                                      ver.innerHTML=texto32;
                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                              //función para botón "Ocultar texto"
                                                                                                                                                                                                                                                                                                                              function ocultarTexto32() {
                                                                                                                                                                                                                                                                                                                                      nover=document.getElementById("respuesta32");
                                                                                                                                                                                                                                                                                                                                      nover.innerHTML="";
                                                                                                                                                                                                                                                                                                                                      }
