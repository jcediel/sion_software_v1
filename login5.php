<?php
  require_once("config/config5.php");
  $error1 = "Bienvenido a la plataforma web del Consorcio Emmanuel";
  if ( isset($_POST["cuenta"]) && isset($_POST["clave"]) ){
    //print_r($_POST);
    $bd1 = new subase();
    if ($bd1->obtener_conexion()){		// Comparación implícita
      $sql = "SELECT id_user,nombre,foto,id_perfil,especialidad
              FROM user
              WHERE cuenta='".$_POST["cuenta"]."' AND clave = '".$_POST["clave"]."' AND estado ='".$_POST["estado"]."'";
      if ( $fila = $bd1->sub_fila($sql) ){
        session_start();
        $_SESSION["AUT"] = $fila;
        header("location:".PROGRAMA);
      } elseif ($bd1->obtener_error()=="") {
        $error1 = "Error: Cuenta o clave errada";
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
<html>
<head>
<meta charset="UTF-8">
<link rel="shortcut icon" href="images/favicon.png">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/sun.css">
<link rel="stylesheet" href="css/fuentes.css" media="screen" title="no title" charset="utf-8">
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Chewy" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<title>Emmanuel IPS Software</title>
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
<body >
  <div class="sun">
      <div class="ray_box">
          <div class="ray ray1"></div>
          <div class="ray ray2"></div>
          <div class="ray ray3"></div>
          <div class="ray ray4"></div>
          <div class="ray ray5"></div>
          <div class="ray ray6"></div>
          <div class="ray ray7"></div>
          <div class="ray ray8"></div>
          <div class="ray ray9"></div>
          <div class="ray ray10"></div>
      </div>
  </div>
  <section class="f">
    <form action="<?php echo LOGINI;?>" method="POST" onsubmit = "return validar()">					<!-- Se asignan los datos que se vayan a enviar al mismo archivo-->
    <section class="panel-body col-xs-8 text-right">
      <figure class="text-center animated zoomIn">
        <img src="images/logoP.png" class="image_inicio_login" alt="" />
        <img src="images/Clinica Emmanue Finall.png" class="image_inicio_login" alt="" />
        <img src="images/logo_inde-01.png" class="image_inicio_login" alt="" />
      </figure>
    </section>
    <section class="panel-body col-xs-4">
        <article id="logintitle" class="animated jello text-center fuentep">
          <?php echo SOFTWARE;?>
        </article>
        <article class="text-center">
          <label for="" class="text-left fuenteb">Usuario: </label><br>
          <input type="text" name="cuenta" class="form-login"/>
        </article>
        <article class="text-center">
          <label for="" class="text-left fuenteb">Contraseña: </label><br>
          <input type="password" class="form-login" name="clave"/>
          <input type="hidden" name="estado" value="Activo"/>
        </article>
        <br>
        <article class="text-center">
          <input class="btn btn-primary" type="submit" value="Aceptar"/>
          <input class="btn btn-primary" type="reset"  value="Limpiar"/>
      </article>

    </section>
    <section class="panel-body col-xs-12">
      <article class="fuentep text-center">
        <?php echo $error1; ?>
      </article>
      <article class="text-center animated fadeInUp ">
        <p class="fuentep">

        </p>
      </article>
    </section>
  </form>
  </section>




</body>
</html>
