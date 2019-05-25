<!DOCTYPE html>
<html>
<head>
	<title>Mi primer formulario</title>
</head>
<body>
	<h1>Titulo de la pagina</h1>
	<?php 
		$numero1 = 5;
		$numero2 = 10;
		$imagen = "imagenes/logo-mw.jpg";
		if($numero1 > $numero2){
	?>
			<p>aqui va un parrafo</p>
			<a href="http://www.masterweb.la">Ir a Master</a>
			<img src="<?php echo $imagen; ?>">
	<?php }else{ ?>
		<h2>No se cumplio</h2>
		<p>Que noooo se cumplio la condicion</p>
	<?php } ?>


</body>
</html>