<form action="<?php echo PROGRAMA.'?&opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
  <?php include("consulta_ultimaEvo.php");?>
	<h4 id="th-estilot">Generacion de formulas medicas hospitalarias</h4>
  <section class="panel-body">
    <article class="col-md-3 form-group">
      <label for="">Seleccione bodega:</label>
      <select name="bodega" class="form-control"  required=""  <?php echo atributo3; ?>>
        <option value=""></option>
        <?php
				$sede=$_GET['idsede'];
        $sql="SELECT id_bodega,nom_bodega from bodega where id_sedes_ips=".$sede;

        if($tabla=$bd1->sub_tuplas($sql)){
					echo $sql;
          foreach ($tabla as $fila2) {
            if ($fila["id_bodega"]==$fila2["id_bodega"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
          }
        }
        ?>
      </select>
    </article>
		<article class="col-xs-3 form-group">
			<label for="">Fecha inicial de formula:</label>
			<input type="date" class="form-control" name="finicial" value="<?php echo date('Y-m-d') ;?>">
		</article>
		<article class="col-xs-3 form-group">
			<label for="">Fecha final de formula:</label>
			<input type="date" class="form-control" name="ffinal" value="<?php echo date('Y-m-d') ;?>">
		</article>
		<article class="col-xs-3 form-group">
			<label for="">Tipo de formula:</label>
			<select class="form-control" name="tipo_formula" required="">
				<option value=""></option>
				<option value="Inmediata">Inmediata</option>
				<option value="Programada">Programada</option>
				<option value="Amulatoria">Amulatoria</option>
			</select>
		</article>
  </section>
	<section class="panel-body"> <!--evolucion to-->
    <article class="col-xs-12 form-group">
			<?php include("buscarmed.php");?>
		</article>
	</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
