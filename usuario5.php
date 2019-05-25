<?php
defined("CLAVE5") or die ("Acceso No Autorizado");
?>
<link rel="stylesheet" href="css/bootstrap.css">
	<section>
		<figure>
			<img src="<?php echo $_SESSION["AUT"]["foto"]; ?>"  class="image_login" alt="foto" >
		</figure>
		<figcaption class="fuenteuser">
			<strong>ID:</strong>
				<?php  echo $_SESSION["AUT"]["id_user"]; ?>
			<strong><?php echo $_SESSION["AUT"]["nombre"]; ?></strong>

			<p hidden><?php  echo $_SESSION["AUT"]["id_perfil"]; ?></p>
			<p hidden><?php  echo $_SESSION["AUT"]["firma"]; ?></p>
			<p hidden><?php  echo $_SESSION["AUT"]["supernum"]; ?></p>
			<br>
			<strong><?php echo $_SESSION["AUT"]["especialidad"]; ?></strong>
		  </br>
	 </figcaption>
	</section>
