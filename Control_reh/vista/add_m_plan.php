<script src = "../js/sha3.js"></script>
    <script>
      function validar(){
        if (document.forms[0].ffinal.value < document.forms[0].finicial.value){
          alert("Apreciado(a) <?php echo $_SESSION["AUT"]["nombre"]?>: la fecha final del plan de intervención no puede ser menor a la fecha inicial.");
          document.forms[0].ffinal.focus();				// Ubicar el cursor
          return(false);
        }
      }
    </script>
<form action="<?php echo PROGRAMA.'?eps='.$eps.'&sede='.$sede.'&servicio='.$servicio.'&buscar=Consultar&opcion=178';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>

	 <section class="panel-success">
     <section class="panel-heading">
  	 	<h4>Datos Plan intervención</h4>
  	 </section>
     <section class="panel-body">
       <article class="col-xs-4">
         <label for="">Fecha Inicial:</label>
         <input type="date" class="form-control" required name="finicial" value="">
         <input type="hidden" class="form-control" name="idadmhosp" value="<?php echo $_REQUEST['idadmhosp']?>">
         <input type="hidden" class="form-control" name="servicio_plan" value="<?php echo $_REQUEST['servicio']?>">
       </article>
       <article class="col-xs-4">
         <label for="">Fecha Final:</label>
         <input type="date" class="form-control" required name="ffinal" value="">
       </article>
       <article class="col-xs-2">
         <label for="">Horas :</label>
         <input type="number" class="form-control" required name="total_hora" value="">
       </article>
       <article class="col-xs-2">
         <label for="">Sesiones :</label>
         <input type="number" class="form-control" required name="total_sesion" value="">
       </article>
     </section>
	 </section>
 </section>
 <div class="row text-center">
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
 </div>
</form>
