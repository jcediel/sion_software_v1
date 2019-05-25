<?php
  require_once("config/config5.php");
  $error1 = "Bienvenido a la plataforma web del Consorcio Emmanuel";
  if ( isset($_POST["cuenta"]) && isset($_POST["clave"]) ){
    //print_r($_POST);
    $bd1 = new subase();
    if ($bd1->obtener_conexion()){		// Comparación implícita
      $sql = "SELECT id_user,nombre,foto,id_perfil,supernum,especialidad,firma
              FROM user
              WHERE cuenta='".$_POST["cuenta"]."' AND clave = '".$_POST["clave"]."' AND estado ='".$_POST["estado"]."'";
      if ( $fila = $bd1->sub_fila($sql) ){
        session_start();
        $_SESSION["AUT"] = $fila;
        header("location:".PROGRAMA);
      } elseif ($bd1->obtener_error()=="") {
        $error1 = "Cuenta o contraseña no son correctas.";
      } else {
        $error1 = $bd1->obtener_error();
      }
    }else{
      //$error1 = "Error: No hay conexión a servidor de Base de Datos";
      $error1 = $bd1->obtener_error();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>SION Software</title>

    <link href="assets/css/hover_pack.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/colors/color-74c9be.css" rel="stylesheet">
    <link href="assets/css/animations.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">


    <!-- Main Jquery & Hover Effects. Should load first -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/hover_pack.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src = "js/sha3.js"></script>
    <script>
      function validar(){
        if (document.forms[0].cuenta.value == ""){
          alert("Upssss!! No digitaste Nombre de Usuario (Username)");
          document.forms[0].cuenta.focus();				// Ubicar el cursor
          return(false);
        }
        if (document.forms[0].clave.value == ""){
          alert("Upssss!! No digitaste Contraseña de Usuario (Password)");
          document.forms[0].clave.focus();				// Ubicar el cursor
          return(false);
        }
        document.forms[0].clave.value = CryptoJS.SHA3(document.forms[0].clave.value);
      }
    </script>
  </head>

  <body>

    <section class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content fuente_login_modal">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
						<h4 class="modal-title">Acceso a SION software</h4>
					</div>
					<div class="modal-body">
            <form action="<?php echo LOGINI;?>" method="POST" onsubmit = "return validar()">					<!-- Se asignan los datos que se vayan a enviar al mismo archivo-->
          		<section class="text-center">
          			<article class="col-xs-12">
          				<figure  class="text-center animated fadeInLeft  col-xs-4" >
          					<img src="images/logoP.png" class="image_login2" alt="Logo_principal">
          				</figure>
                  <figure  class="text-center animated fadeInLeft  col-xs-4" >
          					<img src="images/Clinica Emmanue Finall.png" class="image_login2" alt="Logo_principal">
          				</figure>
          				<figure  class="text-center animated fadeInRight col-xs-4" >
          					<img src="images/logo_inde-01.png" class="image_login2" alt="Logo_principal">
          				</figure>
          			</article>
          			<article class="text-center">
          				<label for="" class="text-left">Usuario: </label><br>
          				<input type="text" name="cuenta" class="form-login"/>
          			</article>
          			<article class="text-center">
          				<label for="" class="text-left">Contraseña: </label><br>
          				<input type="password" class="form-login" name="clave"/>
          				<input type="hidden" name="estado" value="Activo"/>
          			</article>
          			<br>
          			<article>
          				<input class="btn btn-primary" type="submit" value="Aceptar"/>
          				<input class="btn btn-primary" type="reset"  value="Limpiar"/>
          			</article>
          			<br>
          			<article>
          				<?php echo $error1; ?>
          			</article>
          		</section>
          	</form>
					</div>
					<div class="modal-footer">
            <div class="col-xs-2 text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
            </div>
					</div>
				</div>

			</div>
		</section>

    <div id="headerwrap">
    	<div class="container">
			<div class="row centered">
				<div class="col-lg-8 col-lg-offset-2 mt">
					<h1 class="animation slideDown">SION SOFTWARE </h1>
          <h3> Website de gestión y administración para Consorcio Emmanuel</h3>
    				<p class="mt"><button type="button" class="btn btn-cta btn-lg"  data-toggle="modal" data-target="#myModal">Acceder</button></p>
				</div>

			</div><!-- /row -->
    	</div><!-- /container -->
    </div> <!-- /headerwrap -->


	<div class="container">
    <div class="col-xs-12">
      <figure class="col-xs-4 text-center"><img src="images/logoP.png" class="img_inicial animated animated slideLeft img-round" alt=""></figure>
      <figure class="col-xs-4 text-center"><img src="images/Clinica Emmanue Finall.png " class="img_inicial animated slideUp img-round" alt=""></figure>
      <figure class="col-xs-4 text-center"><img src="images/logo_inde-01.png" class="img_inicial animated animated slideRight img-round" alt=""></figure>
    </div>
	</div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/retina.js"></script>


  	<script>
		$(window).scroll(function() {
			$('.si').each(function(){
			var imagePos = $(this).offset().top;

			var topOfWindow = $(window).scrollTop();
				if (imagePos < topOfWindow+400) {
					$(this).addClass("slideUp");
				}
			});
		});
	</script>


  </body>
</html>
