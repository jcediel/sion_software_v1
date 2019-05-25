<?php
ini_set("session.cookie_lifetime","10800");
ini_set("session.gc_maxlifetime","10800");
session_start();
require_once("config/config5.php");
include('conexion.php');
if (isset($_GET["salir"])){
	if ($_GET["salir"] == $_SESSION["AUT"]["id_user"]){
	    session_unset();
		session_destroy();
		}
}
if (!isset($_SESSION["AUT"]["id_user"])){
	header("location:index.php");
}
	$bd1=new subase();
	$error1="";
		if (!$bd1->obtener_conexion()){			//comparacion implicita
 			$error1="Error en conexion a base de datos";
		}
function saber_dia($nombredia) {
		$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
		$fecha = $dias[date('N', strtotime($nombredia))];
		echo $fecha;	
}
function RestarHoras($horaini,$horafin)
		{
			$horai=substr($horaini,0,2);
			$mini=substr($horaini,3,2);
			$segi=substr($horaini,6,2);

			$horaf=substr($horafin,0,2);
			$minf=substr($horafin,3,2);
			$segf=substr($horafin,6,2);

			$ini=((($horai*60)*60)+($mini*60)+$segi);
			$fin=((($horaf*60)*60)+($minf*60)+$segf);

			$dif=$fin-$ini;

			$difh=floor($dif/3600);
			$difm=floor(($dif-($difh*3600))/60);
			$difs=$dif-($difm*60)-($difh*3600);
			return date("H-i-s",mktime($difh,$difm,$difs));
		}
function valorEnLetras($x)
		{
		if ($x<0) { $signo = "menos ";}
		else      { $signo = "";}
		$x = abs ($x);
		$C1 = $x;
		$G6 = floor($x/(1000000));  // 7 y mas
		$E7 = floor($x/(100000));
		$G7 = $E7-$G6*10;   // 6
		$E8 = floor($x/1000);
		$G8 = $E8-$E7*100;   // 5 y 4
		$E9 = floor($x/100);
		$G9 = $E9-$E8*10;  //  3
		$E10 = floor($x);
		$G10 = $E10-$E9*100;  // 2 y 1
		$G11 = round(($x-$E10)*100,0);  // Decimales
		//////////////////////
		$H6 = unidades($G6);
		if($G7==1 AND $G8==0) { $H7 = "Cien "; }
		else {    $H7 = decenas($G7); }
		$H8 = unidades($G8);
		if($G9==1 AND $G10==0) { $H9 = "Cien "; }
		else {    $H9 = decenas($G9); }
		$H10 = unidades($G10);
		if($G11 < 10) { $H11 = ""; }
		else { $H11 = $G11; }
		/////////////////////////////
		    if($G6==0) { $I6=" "; }
		elseif($G6==1) { $I6="Millón "; }
		         else { $I6="Millones "; }
		if ($G8==0 AND $G7==0) { $I8=" "; }
		         else { $I8="Mil "; }
		$I10 = " ";
		$I11 = " ";
		$C3 = $signo.$H6.$I6.$H7.$I7.$H8.$I8.$H9.$I9.$H10.$I10.$H11.$I11;
		return $C3; //Retornar el resultado
		}
		function unidades($u)
		{
		    if ($u==0)  {$ru = " ";}
		elseif ($u==1)  {$ru = "Uno ";}
		elseif ($u==2)  {$ru = "Dos ";}
		elseif ($u==3)  {$ru = "Tres ";}
		elseif ($u==4)  {$ru = "Cuatro ";}
		elseif ($u==5)  {$ru = "Cinco ";}
		elseif ($u==6)  {$ru = "Seis ";}
		elseif ($u==7)  {$ru = "Siete ";}
		elseif ($u==8)  {$ru = "Ocho ";}
		elseif ($u==9)  {$ru = "Nueve ";}
		elseif ($u==10) {$ru = "Diez ";}
		elseif ($u==11) {$ru = "Once ";}
		elseif ($u==12) {$ru = "Doce ";}
		elseif ($u==13) {$ru = "Trece ";}
		elseif ($u==14) {$ru = "Catorce ";}
		elseif ($u==15) {$ru = "Quince ";}
		elseif ($u==16) {$ru = "Dieciseis ";}
		elseif ($u==17) {$ru = "Decisiete ";}
		elseif ($u==18) {$ru = "Dieciocho ";}
		elseif ($u==19) {$ru = "Diecinueve ";}
		elseif ($u==20) {$ru = "Veinte ";}
		elseif ($u==21) {$ru = "Veintiuno ";}
		elseif ($u==22) {$ru = "Veintidos ";}
		elseif ($u==23) {$ru = "Veintitres ";}
		elseif ($u==24) {$ru = "Veinticuatro ";}
		elseif ($u==25) {$ru = "Veinticinco ";}
		elseif ($u==26) {$ru = "Veintiseis ";}
		elseif ($u==27) {$ru = "Veintisiente ";}
		elseif ($u==28) {$ru = "Veintiocho ";}
		elseif ($u==29) {$ru = "Veintinueve ";}
		elseif ($u==30) {$ru = "Treinta ";}
		elseif ($u==31) {$ru = "Treinta y uno ";}
		elseif ($u==32) {$ru = "Treinta y dos ";}
		elseif ($u==33) {$ru = "Treinta y tres ";}
		elseif ($u==34) {$ru = "Treinta y cuatro ";}
		elseif ($u==35) {$ru = "Treinta y cinco ";}
		elseif ($u==36) {$ru = "Treinta y seis ";}
		elseif ($u==37) {$ru = "Treinta y siete ";}
		elseif ($u==38) {$ru = "Treinta y ocho ";}
		elseif ($u==39) {$ru = "Treinta y nueve ";}
		elseif ($u==40) {$ru = "Cuarenta ";}
		elseif ($u==41) {$ru = "Cuarenta y uno ";}
		elseif ($u==42) {$ru = "Cuarenta y dos ";}
		elseif ($u==43) {$ru = "Cuarenta y tres ";}
		elseif ($u==44) {$ru = "Cuarenta y cuatro ";}
		elseif ($u==45) {$ru = "Cuarenta y cinco ";}
		elseif ($u==46) {$ru = "Cuarenta y seis ";}
		elseif ($u==47) {$ru = "Cuarenta y siete ";}
		elseif ($u==48) {$ru = "Cuarenta y ocho ";}
		elseif ($u==49) {$ru = "Cuarenta y nueve ";}
		elseif ($u==50) {$ru = "Cincuenta ";}
		elseif ($u==51) {$ru = "Cincuenta y uno ";}
		elseif ($u==52) {$ru = "Cincuenta y dos ";}
		elseif ($u==53) {$ru = "Cincuenta y tres ";}
		elseif ($u==54) {$ru = "Cincuenta y cuatro ";}
		elseif ($u==55) {$ru = "Cincuenta y cinco ";}
		elseif ($u==56) {$ru = "Cincuenta y seis ";}
		elseif ($u==57) {$ru = "Cincuenta y siete ";}
		elseif ($u==58) {$ru = "Cincuenta y ocho ";}
		elseif ($u==59) {$ru = "Cincuenta y nueve ";}
		elseif ($u==60) {$ru = "Sesenta ";}
		elseif ($u==61) {$ru = "Sesenta y uno ";}
		elseif ($u==62) {$ru = "Sesenta y dos ";}
		elseif ($u==63) {$ru = "Sesenta y tres ";}
		elseif ($u==64) {$ru = "Sesenta y cuatro ";}
		elseif ($u==65) {$ru = "Sesenta y cinco ";}
		elseif ($u==66) {$ru = "Sesenta y seis ";}
		elseif ($u==67) {$ru = "Sesenta y siete ";}
		elseif ($u==68) {$ru = "Sesenta y ocho ";}
		elseif ($u==69) {$ru = "Sesenta y nueve ";}
		elseif ($u==70) {$ru = "Setenta ";}
		elseif ($u==71) {$ru = "Setenta y uno ";}
		elseif ($u==72) {$ru = "Setenta y dos ";}
		elseif ($u==73) {$ru = "Setenta y tres ";}
		elseif ($u==74) {$ru = "Setenta y cuatro ";}
		elseif ($u==75) {$ru = "Setenta y cinco ";}
		elseif ($u==76) {$ru = "Setenta y seis ";}
		elseif ($u==77) {$ru = "Setenta y siete ";}
		elseif ($u==78) {$ru = "Setenta y ocho ";}
		elseif ($u==79) {$ru = "Setenta y nueve ";}
		elseif ($u==80) {$ru = "Ochenta ";}
		elseif ($u==81) {$ru = "Ochenta y uno ";}
		elseif ($u==82) {$ru = "Ochenta y dos ";}
		elseif ($u==83) {$ru = "Ochenta y tres ";}
		elseif ($u==84) {$ru = "Ochenta y cuatro ";}
		elseif ($u==85) {$ru = "Ochenta y cinco ";}
		elseif ($u==86) {$ru = "Ochenta y seis ";}
		elseif ($u==87) {$ru = "Ochenta y siete ";}
		elseif ($u==88) {$ru = "Ochenta y ocho ";}
		elseif ($u==89) {$ru = "Ochenta y nueve ";}
		elseif ($u==90) {$ru = "Noventa ";}
		elseif ($u==91) {$ru = "Noventa y uno ";}
		elseif ($u==92) {$ru = "Noventa y dos ";}
		elseif ($u==93) {$ru = "Noventa y tres ";}
		elseif ($u==94) {$ru = "Noventa y cuatro ";}
		elseif ($u==95) {$ru = "Noventa y cinco ";}
		elseif ($u==96) {$ru = "Noventa y seis ";}
		elseif ($u==97) {$ru = "Noventa y siete ";}
		elseif ($u==98) {$ru = "Noventa y ocho ";}
		else            {$ru = "Noventa y nueve ";}
		return $ru; //Retornar el resultado
		}
		function decenas($d)
		{
		    if ($d==0)  {$rd = "";}
		elseif ($d==1)  {$rd = "Ciento ";}
		elseif ($d==2)  {$rd = "Doscientos ";}
		elseif ($d==3)  {$rd = "Trescientos ";}
		elseif ($d==4)  {$rd = "Cuatrocientos ";}
		elseif ($d==5)  {$rd = "Quinientos ";}
		elseif ($d==6)  {$rd = "Seiscientos ";}
		elseif ($d==7)  {$rd = "Setecientos ";}
		elseif ($d==8)  {$rd = "Ochocientos ";}
		else            {$rd = "Novecientos ";}
		return $rd; //Retornar el resultado
		}
?>
<!DOCTYPE html>
<html>
 <head>
 	<meta charset="UTF-8">
	<!-- Bootstrap Core CSS -->
	<link href="css_p/bootstrap.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="css_p/sb-admin.css" rel="stylesheet">
	<link href="css_p/estilo.css" rel="stylesheet">
	<!-- animaciones e iconos CSS -->
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css_p/fuentes.css">
  <link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/jqueryui.css">
	<link rel="stylesheet" href="css/sweetalert.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- fullcalendar -->
	<link rel='stylesheet' href='css_p/fullcalendar.css' />

	<script src="js/sweetalert.min.js"></script>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js_p/ajax.js"></script>
	<script src="js_p/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script>
	  $( function() {
	    $( "#tabs" ).tabs();
			$( "#tabs_alertas" ).tabs();
			$( "#tabs_consulta_nota" ).tabs();
			$( "#tabs_consulta_nota1" ).tabs();
	  } );
	</script>

	<script>
			function mostrarprov(){
				var bodega = $("#bodega").val();
				$.ajax({
					url: "proveedores.php",
					data: {idpais:bodega},
					type: "POST",
					success: function(resultado){
	        			$("#proveedores").html(resultado);
	    			}
	    		});
	    	}
	</script>
	<script>
			function mostrarbod(){
				var bodega = $("#sede").val();
				$.ajax({
					url: "bodegasel.php",
					data: {idpais:bodega},
					type: "POST",
					success: function(resultado){
	        			$("#bodeguita").html(resultado);
	    			}
	    		});
	    	}
	</script>
	<script>
			function mostrardep(){
				var bodega = $("#dep").val();
				$.ajax({
					url: "depandmun.php",
					data: {idpais:bodega},
					type: "POST",
					success: function(resultado){
	        			$("#municipio").html(resultado);
	    			}
	    		});
	    	}
	</script>
	<script>
			function mostrarpiso(){
				var pab = $("#piso").val();
				$.ajax({
					url: "buspabellon.php",
					data: {pabellon:pab},
					type: "POST",
					success: function(resultado){
	        			$("#pabellon").html(resultado);
	    			}
	    		});
	    	}
	</script>
	<script>
			function mostrarhab(){
				var hab = $("#pabellon").val();
				$.ajax({
					url: "bushab.php",
					data: {habitacion:hab},
					type: "POST",
					success: function(resultado){
								$("#habitacion").html(resultado);
						}
					});
				}
	</script>
	<script>
			function pisoxsede(){
				var sede = $("#sede").val();
				$.ajax({
					url: "buspisoxsede.php",
					data: {sedes:sede},
					type: "POST",
					success: function(resultado){
								$("#piso").html(resultado);
						}
					});
				}
	</script>
	<script type="text/javascript">
$('document').ready(function() {
			$('#buscarcups').autocomplete({
				source : 'buscups.php'
			});
		});
	</script>
	<script type="text/javascript">
	$('#reader').html5_qrcode(function(data){
		// do something when code is read
	},
	function(error){
		//show read errors
	}, function(videoError){
		//the video stream could be opened
	}
);
	</script>


 	<title>SION Software</title>

 	<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nombre.value == ""){
					alert("Se requiere el nombre del usuario!");
					document.forms[0].nombre.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].cuenta.value == ""){
					alert("Se requiere la cuenta del usuario!");
					document.forms[0].cuenta.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].clave1.value == document.forms[0].clave2.value ){
					if (document.forms[0].clave1.value != ""){
						document.forms[0].clave1.value = CryptoJS.SHA3(document.forms[0].clave1.value);
						document.forms[0].clave2.value = document.forms[0].clave1.value;
					}
				}else{
					alert("Error en confirmacion de la clave!");
					document.forms[0].clave1.value = "";
					document.forms[0].clave2.value = "";
					document.forms[0].clave1.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
					$('#diade').modal('show');
			})
		</script>
 </head>
 <body>
 

	 <div id="wrapper" class="lt_general">

			 <!-- Navigation -->
			 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					 <!-- Brand and toggle get grouped for better mobile display -->
					 <div class="navbar-header">
							 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
									 <span class="sr-only">Toggle navigation</span>
									 <span class="icon-bar"></span>
									 <span class="icon-bar"></span>
									 <span class="icon-bar"></span>
							 </button>
							 <a class="navbar-brand" href="index.html">

								 <span class="lt_brand"><strong>SION software</strong></span></a>
					 </div>
					 <!-- Top Menu Items -->
					 <ul class="nav navbar-right top-nav">


							 <?php
								$usuario=$_SESSION['AUT']['id_user'];
								$perfil=$_SESSION['AUT']['id_perfil'];
								if ($perfil==10 || $perfil==78 || $perfil==82 || $perfil==80 || $perfil==81 || $perfil==73 || $perfil==74 || $perfil==7 ) {
									?>
									<li class="dropdown"><!--Notificación y creación de PQRS -->
	 									 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angry text-danger"></i>
	 									 </a>
	 									 <ul class="dropdown-menu message-dropdown">
	 											 <li class="message-preview">
	 												<section class="panel-body">
														<div class="col-md-12">
																<span class="col-md-6">
																		<img class="rounded-circle" src="images/pqrs.png" alt="">
																</span>
																<div class="col-md-6">
																	<a href="<?php echo PROGRAMA.'?opcion=103&mante=A'?>" align="center" >
																		<button type="button" class="btn btn-primary" >Nueva PQRS</button>
																	</a>
																</div>
														</div>
	 												</section>
	 											 </li>
	 									 </ul>
	 							 </li>
									<?php
								}
								if ($perfil==1 || $perfil==40 || $perfil==45 || $perfil==47 || $perfil==46 || $perfil==84 || $perfil==49 || $perfil==85 || $perfil==89) {
									?>
									<li class="dropdown"><!--Notificación y creación de PQRS -->
			 							 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angry">
											 <?php
											 	 $perfil=$_SESSION['AUT']['id_user'];
  							         $sqlp="SELECT count(id_pqr) pqrs,responsable_rta_pqrs
  							                FROM pqr
  							                WHERE  estado_pqrs in (1) and responsable_rta_pqrs in ($perfil)";

  							         if ($tablap=$bd1->sub_tuplas($sqlp)){
  							           foreach ($tablap as $filap ) {
  							            if ($filap['pqrs']>0 && $filap['responsable_rta_pqrs']==$perfil) {
  							              echo' <span class="badge shake-slow shake-constant shake-constant--hover"><p>'.$filap['pqrs'].'</p></span>
  							              <script>swal("Atención !!! '.$_SESSION["AUT"]["nombre"].'","tienes casos de PQRS en sistema para responder.","info")</script>';
  							            }else {
  							                echo'<span class="badge">'.$filap['pqrs'].'</span>';
  							            }

  							           }
  							         }

  							       ?>
											 </i>
			 							 </a>
			 							 <ul class="dropdown-menu message-dropdown">
			 									 <li class="message-preview">

			 													 <div class="media">
			 															 <span class="pull-left">
			 																	 <img class="media-object" src="" alt="">
			 															 </span>
			 															 <div class="media-body">

																				 <?php
																				 	 $perfil=$_SESSION['AUT']['id_user'];
									  							         $sql_detalle2="SELECT a.id_pqr, id_user_reg,linea_negocio, medio_registro, tipo_cliente,
																					 							 tipo_solicitud, fecha_radicado, hora_radicado, contacto_cliente, descripcion_pqrs, responsable_rta_pqrs,
																												 clasificacion, estado_pqrs, soporte_pqr,
																												 b.nomserv,
																												 c.nom_completo,
																												 d.nom_eps,
																												 e.nom_sedes
									  							                FROM pqr a left join tipo_servicio b on a.linea_negocio=b.id_serv
																														 left join pacientes c on c.id_paciente=a.id_paciente
																														 left join eps d on d.id_eps=a.id_eps
																														 left join sedes_ips e on e.id_sedes_ips=a.id_sedes_ips
									  							                WHERE  estado_pqrs in (1,2) and responsable_rta_pqrs in ($perfil)";

									  							         if ($tabla_detalle2=$bd1->sub_tuplas($sql_detalle2)){
									  							           foreach ($tabla_detalle2 as $fila_detalle2) {
									  							            if ($fila_detalle2['estado_pqrs']==1 && $fila_detalle2['responsable_rta_pqrs']==$perfil) {
																									$categoria=$fila_detalle2['clasificacion'];

																									$fradicado=$fila_detalle2['fecha_radicado'];
																									$segundos= strtotime('now') - strtotime($fradicado);
																									$diferencia_dias=intval($segundos /60/60/24);

																								if ($categoria=='A') {
																									if ($diferencia_dias<=3) {
																										?>
																										<article class="alert alert-info">
																											<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fila_detalle2['fecha_radicado'].' - '.$fila_detalle2['hora_radicado'] ?></p>
																											<p><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></p>
																											<p><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></p>
																											<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=RTA&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Responder</button></a></p>
																										</article>
																										<?php
																									}else {
																										?>
																										<article class="alert alert-danger">
																											<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fila_detalle2['fecha_radicado'].' - '.$fila_detalle2['hora_radicado'] ?></p>
																											<p><small><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></small></p>
																											<p><small><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></small></p>
																											<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=RTA&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Responder</button></a></p>
																										</article>
																										<?php
																									}

																								}
																								if ($categoria=='B') {
																									if ($diferencia_dias<=10) {
																										?>
																										<article class="alert alert-info">
																											<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fila_detalle2['fecha_radicado'].' - '.$fila_detalle2['hora_radicado'] ?></p>
																											<p><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></p>
																											<p><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></p>
																											<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=RTA&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Responder</button></a></p>
																										</article>
																										<?php
																									}else {
																										?>
																										<article class="alert alert-danger">
																											<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fila_detalle2['fecha_radicado'].' - '.$fila_detalle2['hora_radicado'] ?></p>
																											<p><small><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></small></p>
																											<p><small><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></small></p>
																											<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=RTA&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Responder</button></a></p>
																										</article>
																										<?php
																									}

																								}
																								if ($categoria=='C') {
																									if ($diferencia_dias<=15) {
																										?>
																										<article class="alert alert-info">
																											<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fila_detalle2['fecha_radicado'].' - '.$fila_detalle2['hora_radicado'] ?></p>
																											<p><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></p>
																											<p><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></p>
																											<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=RTA&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Responder</button></a></p>
																										</article>
																										<?php
																									}else {
																										?>
																										<article class="alert alert-danger">
																											<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fila_detalle2['fecha_radicado'].' - '.$fila_detalle2['hora_radicado'] ?></p>
																											<p><small><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></small></p>
																											<p><small><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></small></p>
																											<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=RTA&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Responder</button></a></p>
																										</article>
																										<?php
																									}

																								}
									  							            }
																							if ($fila_detalle2['estado_pqrs']==2 && $fila_detalle2['responsable_rta_pqrs']==$perfil) {
																								if ($fila_detalle2['clasificacion']=='A') {
																									?>
																									<article class="alert alert-warning">
																										<p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo 'RAD: '.$fila_detalle2['fecha_radicado'].' - RTA: '.$fila_detalle2['fecha_rta'] ?></p>
																										<p><small><?php echo $fila_detalle2['tipo_solicitud'].': '.$fila_detalle2['nom_completo'] ?></small></p>
																										<p><small><?php echo 'Categoria de PQRS: '.$fila_detalle2['clasificacion'] ?></small></p>
																										<p><a href="<?php echo PROGRAMA.'?opcion=103&mante=PLAN&idp='.$fila_detalle2['id_pqr'].'&cat='.$fila_detalle2['clasificacion'].''?>" align="center" ><button type="button" class="btn btn-danger" >Agregar<br>Plan Acción</button></a></p>
																									</article>
																									<?php
																								}
																							}

									  							           }
									  							         }
									  							       ?>
			 															 </div>
			 													 </div>
			 											 </a>
			 									 </li>

			 							 </ul>
			 					 </li>
									<?php
								}
								?>
							 <?php //alertas de referencia, ordenes dx, cambios en farmacia
							 $usr=$_SESSION['AUT']['id_perfil'];
							 if ($usr==1 || $usr==3 || $usr==4 || $usr==49) {
							 ?>
							 <li class="dropdown">
							     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell">
							       <?php
							         $sqlp="SELECT count(id_referencia) presentados
							                FROM referencia
							                WHERE  estado_referencia in (1)";
							         if ($tablap=$bd1->sub_tuplas($sqlp)){
							           foreach ($tablap as $filap ) {
							            if ($filap['presentados']>0) {
							              echo' <span class="badge shake-slow shake-constant shake-constant--hover"><p>'.$filap['presentados'].'</p></span>
							              <script>swal("Atención !!! '.$_SESSION["AUT"]["nombre"].'","Hay alertas de presentación de pacientes en estado PENDIENTE o PRESENTADO, por favor contestar.","info")</script>';
							            }else {
							                echo'<span class="badge">'.$filap['presentados'].'</span>';
							            }

							           }
							         }
							       ?> </i></a>
							     <ul class="dropdown-menu message-dropdown">
							         <li class="message-preview">
							             <a href="#">
							                 <div class="media">
							                     <span class="pull-left">
							                         <span class="fa fa-users fa-3x text-success"></span>
							                     </span>
							                     <div class="media-body">
							                         <h5 class="media-heading"><strong>Presentación Hospitalaria</strong>
							                         </h5>
							                         <?php
							                            $sqlp="SELECT count(id_referencia) cuantos
							                                   FROM referencia
							                                   WHERE  estado_referencia in (1,4)";
							                            if ($tablap=$bd1->sub_tuplas($sqlp)){
							                              foreach ($tablap as $filap ) {
							                                echo' <p><i>Hay </i> <strong class="text-danger">'.$filap['cuantos'].'</strong><i> casos de presentación Pendientes. </i></p>';
							                              }
							                            }
							                          ?>

							                         <p><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#pac_presentados">Ver Detalle</button></p>

							                     </div>
							                 </div>
							             </a>
							         </li>
							     </ul>
							 </li>
							 <?php
							 }
							  ?>

							 <li class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> <?php echo $_SESSION["AUT"]["id_user"]; ?></i> <?php echo $_SESSION["AUT"]["nombre"]; ?></strong> <b class="caret"></b></a>
									 <ul class="dropdown-menu">
											 <li>
													 <a href="<?php echo PROGRAMA."?opcion=160&user=".$_SESSION["AUT"]["id_user"]; ?>"><i class="fa fa-fw fa-user"></i> Perfil</a>
											 </li>
											 <li class="text-center">
													 <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#carnet"><span class="fa fa-address-card"></span> Carnet</button>
											 </li>
											 <li>
													 <a href="<?php echo PROGRAMA.'?opcion=200'?>"><i class="fa fa-fw fa-envelope"></i> Capacitación</a>
											 </li>
											 <li>
													<a href="<?php echo PROGRAMA."?opcion=199"?>"><i class="fa fa-fw fa-hands-helping"></i> Help Desk</a>
											</li>
											<li>
												 <a href="<?php echo PROGRAMA."?opcion=206"?>"><i class="fas fa-utensils"></i> Food</a>
										 </li>
											 <li class="divider"></li>
											 <li>
													 <a href="<?php echo PROGRAMA."?salir=".$_SESSION["AUT"]["id_user"]; ?>" class="text-center"><i class="fa fa-fw fa-power-off"></i> Salir</a>
											 </li>
									 </ul>
							 </li>
					 </ul>

					 <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
					 <div class="collapse navbar-collapse navbar-ex1-collapse" id="reject">
							 <ul class="nav navbar-nav side-nav ">
								 <li >
										 <a href="<?php echo PROGRAMA;?>"><i class="fa fa-fw fa-tachometer-alt"></i> Principal</a>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#conf"><i class="fa fa-fw fa-cogs"></i> Configuración <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="conf" class="collapse">
												 <li>
														 <?php include("menus/menu".VERSION.".php");?>
												 </li>
										 </ul>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#adm"><i class="fa fa-fw fa-briefcase"></i> Administración <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="adm" class="collapse">
												 <li>
														 <?php include("menus/menuA".VERSION.".php");?>
												 </li>
										 </ul>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#sm"><i class="fa fa-fw fa-hospital-o"></i> Salud Mental <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="sm" class="collapse">
												 <li>
														 <?php include("menus/menuAS".VERSION.".php");?>
												 </li>

										 </ul>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#dom"><i class="fa fa-fw fa-ambulance"></i> Domiciliarios <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="dom" class="collapse">
												 <li>
														 <?php include("menus/menuDOM".VERSION.".php");?>
												 </li>

										 </ul>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#emm"><i class="fa fa-fw fa-child"></i> Emmanuel <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="emm" class="collapse">
												 <li>
														 <?php include("menus/menuCE".VERSION.".php");?>
												 </li>
												 <li>
														 <?php include("menus/menuREH".VERSION.".php");?>
												 </li>

										 </ul>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#inde"><i class="fa fa-fw fa-puzzle-piece"></i> INDE <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="inde" class="collapse">
											 <li>
													 <?php include("menus/menuDEM".VERSION.".php");?>
											 </li>

										 </ul>
								 </li>
								 <li>
										 <a href="javascript:;" data-toggle="collapse" data-target="#rpt"><i class="fa fa-fw fa-pie-chart"></i> Reportes <i class="fa fa-fw fa-caret-down"></i></a>
										 <ul id="rpt" class="collapse">
											 <li>
													 <?php include("menus/menuR".VERSION.".php");?>
											 </li>
										 </ul>
								 </li>

							 </ul>
					 </div>
					 <!-- /.navbar-collapse -->
			 </nav>
			 <!--Modal para alerta pacientes presentados-->
			 <div id="pac_presentados" class="modal fade" role="dialog">
					 <div class="modal-dialog">
						 <div class="modal-content">
							 <div class="modal-header">
								 <button type="button" class="close" data-dismiss="modal">&times;</button>
								 <h4 class="modal-title">Pacientes presentados</h4>
							 </div>
							 <div class="modal-body">
									<?php
									$med=$_SESSION['AUT']['id_user'];
									$sql1="SELECT a.nom_completo,doc_pac,
																b.id_referencia,f_correo,h_correo,estado_referencia,
																c.nom_eps,
																d.nombre
												 FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
																					INNER JOIN eps c on c.id_eps=b.id_eps
																					INNER JOIN user d on d.id_user=b.medico_asignado
												 WHERE estado_referencia in (1,4) ORDER BY estado_referencia ASC";
												 //echo $sql1;
												 if ($tabla1=$bd1->sub_tuplas($sql1)){
													foreach ($tabla1 as $fila1) {
														echo '<section class="panel-body">';
														if ($fila1['estado_referencia']==1) {
															echo '<section class="col-md-12 alert alert-info">
																			<article class="col-md-4">
																				<p><strong>Paciente: </strong>'.$fila1['nom_completo'].'</p>
																				<p><strong>Fecha: </strong>'.$fila1['f_correo'].'--<strong>Hora: </strong>'.$fila1['h_correo'].'</p>
																				<p><strong>Medico Asignado: </strong>'.$fila1['nombre'].'</p>
																			</article>
																			<article class="col-md-4">
																					<p><strong>PRESENTADO</strong></p>
																			</article>
																			<article class="col-md-4">
																				<a href="'.PROGRAMA.'?opcion=185&mante=RTAPRESENTACION&idr='.$fila1["id_referencia"].'&docc='.$fila1['doc_pac'].'">
																				<button type="button" class="btn btn-info">
																				<span class="fa fa-check"></span> Responder</button></a>
																			</article>
																		</section>
																		<br>';
														}
														if ($fila1['estado_referencia']==4) {
															echo '<section class="col-md-12 alert alert-warning">
																			<article class="col-md-4">
																				<p><strong>Paciente: </strong>'.$fila1['nom_completo'].'</p>
																				<p><strong>Fecha: </strong>'.$fila1['f_correo'].'--<strong>Hora: </strong>'.$fila1['h_correo'].'</p>
																				<p><strong>Medico Asignado: </strong>'.$fila1['nombre'].'</p>
																			</article>
																			<article class="col-md-4">
																					<p><strong>PENDIENTE</strong></p>';
																					$idref=$fila1['id_referencia'];
																					$sql2="SELECT a.id_referencia,
																												b.f_rta,h_rta,
																												d.nombre
																								 FROM referencia a INNER JOIN rta_referencia b on a.id_referencia=b.id_referencia
																																	INNER JOIN user d on d.id_user=b.resp_rta
																								 WHERE b.id_referencia=$idref";
																								 		//echo $sql2;
																								 if ($tabla2=$bd1->sub_tuplas($sql2)){
																									foreach ($tabla2 as $fila2) {
																										echo'<p><strong>Medico Que responde: </strong>'.$fila2['nombre'].'</p>';
																									}
																								 }
																echo'</article>
																			<article class="col-md-4">
																				<a href="'.PROGRAMA.'?opcion=185&mante=RTAPRESENTACION&idr='.$fila1["id_referencia"].'&docc='.$fila1['doc_pac'].'">
																				<button type="button" class="btn btn-warning">
																				<span class="fa fa-check"></span> Responder</button></a>
																			</article>
																		</section>';
														}
														echo '</section>';
													}
												}
									 ?>

							 </div>
							 <div class="modal-footer">
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							 </div>
						 </div>
					 </div>
				 </div>
				 <div id="carnet" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Carnet Institucional</h4>
								</div>
								<div class="modal-body fondo_carnet_modal">
									<?php
									$id_user=$_SESSION["AUT"]["id_user"];
									$sql_user="SELECT id_user, id_perfil, nombre, cuenta, clave, foto, email, tdoc, doc,
																		dir_user, tel_user, rm_profesional, especialidad, firma, estado, fresp_user,
																		resp_user, jz
														 FROM user WHERE id_user=$id_user";

														 if ($tabla_user=$bd1->sub_tuplas($sql_user)){
																foreach ($tabla_user as $fila_user) {
																	?>
																	<section class="panel-body">
																		<article class="col-md-12 text-center">
																			<img src="<?php echo $fila_user["foto"];?>" alt="" class="image_inicio_login"/>
																		</article>
																		<article class="col-md-4">
																			<label for="">Nombre:</label>
																			<label for=""><?php echo $fila_user["nombre"]; ?></label>
																		</article>
																		<article class="col-md-4">
																			<label for="">Identificación:</label>
																			<label for=""><?php echo $fila_user["tdoc"].': '.$fila_user["doc"]; ?></label>
																		</article>
																	</section>
																	<?php
																}
														 }
									 ?>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
			 <div id="page-wrapper">

					 <div class="container-fluid">
						 <?php include("contenido".VERSION.".php");?>
					 </div>
					 <!-- /.container-fluid -->
			 </div>
			 <!-- /#page-wrapper -->

	 </div>
	 <!-- /#wrapper -->
	 <script>
	 $("#menu-toggle").click(function(e) {
			 e.preventDefault();
			 $("#wrapper").toggleClass("toggled");
	 });
	 </script>
	 <!-- jQuery -->
	 <script src="js_p/jquery.js"></script>

	 <!-- Bootstrap Core JavaScript -->
	 <script src="js_p/bootstrap.min.js"></script>

	 <script src="js/jquery-ui.min.js" charset="utf-8"></script>

	 <!-- fullcalendar-->
	 <script src='js_p/moment.min.js'></script>
	 <script src='js_p/fullcalendar.js'></script>
	 <script src="js_p/locale-all.js" charset="utf-8"></script>

	 <!-- graficas de highcharts -->
	 <script src="reportes_graficos/charts/js/highcharts.js"></script>
	 <script src="reportes_graficos/charts/js/modules/exporting.js"></script>

</body>
</html>
