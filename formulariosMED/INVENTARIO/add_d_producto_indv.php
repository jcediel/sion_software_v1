<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "configuraciones/bus_pac_adm.php",
              minLength: 2,
              select: function(event, ui) {
        event.preventDefault();
                  $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);
        $('#documento').val(ui.item.documento);

         }
          });
  });
</script>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].ffarmaceutica.value=="GOTAS"
            || document.forms[0].ffarmaceutica.value=="SOLUCION ORAL"
            || document.forms[0].ffarmaceutica.value=="JARABE"
            || document.forms[0].ffarmaceutica.value=="SUSPENSION"
            || document.forms[0].ffarmaceutica.value=="SOLUCION OFTALMICA"
            || document.forms[0].ffarmaceutica.value=="LOCION"
            || document.forms[0].ffarmaceutica.value=="AEROSOL"
            || document.forms[0].ffarmaceutica.value=="POLVO PARA RECONTITUIR"
            || document.forms[0].ffarmaceutica.value=="SHAMPOO"
            || document.forms[0].ffarmaceutica.value=="JALEA"){
              if (document.forms[0].total_fraccion.value == "") {
                alert("REGENTE <?php echo $_SESSION["AUT"]["nombre"]?> : Debe ingresar fraccion de este medicamento para permitir guardar la información");
      					document.forms[0].total_fraccion.focus();				// Ubicar el cursor
      					return(false);
              }
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?opcion=97';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h2><?php echo $subtitulo ?></h2></section>

    <section class="panel-body"><!-- Información del m_producto -->
      <article class="col-md-8">
				<label for="">Medicamento Principal:</label>
				<input type="text" name="nomgenerico" class="form-control text-center" value="<?php echo $fila["nom_producto"];?>"/>
				<input type="hidden" name="id_producto" class="form-control text-center" value="<?php echo $fila["id_producto"];?>"<?php echo $atributo1;?>/>
        <input type="hidden" name="id_dproducto" class="form-control text-center" value="<?php echo $fila["id_dproducto"];?>"<?php echo $atributo1;?>/>
			</article>
			<article class="col-md-4 ">
				<label for="">Seleccione Bodega:</label>
        <select name="id_bodega" class="form-control"  required="" <?php echo $atributo2; ?>>
          <option value="<?php echo $fila['idbog'] ?>"><?php echo $fila['nom_bodega'] ?></option>
          <?php
          $sql="SELECT id_bodega,nom_bodega from bodega ORDER BY id_bodega ASC";
          if($tabla=$bd1->sub_tuplas($sql)){
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
    </section>
		<section class="panel panel-primary">
      <section class="panel-heading"><h3>Datos específicos del Medicamento</h3></section>
      <section class="panel-body">
				<article class="col-md-4 ">
					<label for="">Principio Activo:</label>
					<input type="text" name="pactivo" class="form-control" value="<?php echo $fila['pactivo'] ?>" required="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-4">
					<label for="">Concentracion:</label>
					<input type="text" name="concentracion" value="<?php echo $fila['concentracion'] ?>" class="form-control" required="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-4">
					<label for="">Forma farmaceutica:</label>
					<select class="form-control" name="ffarmaceutica" required="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" <?php echo $atributo2 ?>>
						<option value="<?php echo $fila['ffarmaceutica'] ?>"><?php echo $fila['ffarmaceutica'] ?></option>
						<option value="CAPSULA">CAPSULA</option>
						<option value="TABLETA">TABLETA</option>
						<option value="GRAGEAS">GRAGEAS</option>
						<option value="COMPRIMIDO">COMPRIMIDO</option>
						<option value="SOLUCION INYECTABLE">SOLUCION INYECTABLE</option>
						<option value="SOLUCION ORAL">SOLUCION ORAL</option>
						<option value="SUSPENSION">SUSPENSION</option>
						<option value="POLVO PARA RECONTITUIR">POLVO PARA RECONTITUIR</option>
						<option value="CREMA">CREMA</option>
						<option value="GEL">GEL</option>
						<option value="JALEA">JALEA</option>
						<option value="UNGUENTO">UNGUENTO</option>
						<option value="UNGUENTO OFTALMICO">UNGUENTO OFTALMICO</option>
						<option value="SOLUCION PERFUSION">SOLUCION PERFUSION</option>
						<option value="JARABE">JARABE</option>
						<option value="AEROSOL">AEROSOL</option>
						<option value="GOTAS">GOTAS</option>
						<option value="UNIDAD">UNIDAD</option>
					</select>
				</article>
			</section>
			<section class="panel-body">
				<article class="col-md-4 ">
					<label for="">Nombre Comercial:</label>
					<input type="text" class="form-control" name="nom_comercial" value="<?php echo $fila['nom_comercial'] ?>" <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-2 ">
					<label for="">Lote:</label>
					<input type="text" class="form-control" name="lote" value="<?php echo $fila['lote'] ?>" required="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-3">
					<label for="">Fecha de vencimiento:</label>
					<input type="date" class="form-control" name="fvencimiento" value="<?php echo $fila['fvencimiento'] ?>" required="" <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-3">
					<?php include("fabbusqueda.php");?>
				</article>
				<article class="col-md-2">
					<label for="">Registro INVIMA:</label>
					<input type="text" class="form-control" name="reg_invima" value="<?php echo $fila['reg_invima'] ?>" required="" <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-3 ">
					<label for="">CUM:</label>
					<input type="text" class="form-control" name="cum" value="<?php echo $fila['cum'] ?>" required="" <?php echo $atributo2 ?>>
				</article>
				<article class="col-md-3 ">
					<label for="">Cantidad:</label>
					<input type="text" class="form-control" name="cantidad" value="<?php echo $fila['cantidad'] ?>" required="">
					<input type="hidden" class="form-control" name="cantidad_ant" value="<?php echo $fila['cantidad'] ?>" required="">
				</article>
				<article class="col-md-3 ">
					<label for="">Fracción:</label>
					<input type="text" class="form-control" name="total_fraccion" value="<?php echo $fila['total_fraccion'] ?>" >
					<input type="hidden" class="form-control" name="total_fraccion_ant" value="<?php echo $fila['total_fraccion'] ?>" >
				</article>
			</section>
    </section>
		<section class="panel panel-primary">
      <section class="panel-heading"><h3>Propiedad del medicamento</h3></section>
      <section class="panel-body">
				<article class="col-md-12">
					<label for="">El medicamento que esta ingresando es traido por el paciente?</label>
					<select class="form-control" name="propio">
						<option value=""></option>
						<option value="1">SI</option>
						<option value="0">NO</option>
					</select>
				</article>
				<article class="col-md-12">
					<article class="col-md-4">
	          <label for="">Busqueda Paciente:</label>
	          <input type="text" class="form-control" name="idpac" id="codigo" placeholder="Digite numero de documento" value="">
	        </article>
	        <article class="col-md-4">
	          <label for="">Paciente seleccionado:</label>
	          <input type="text"class="form-control" name="nompac" id="descripcion"  required=""value="" <?php echo $atributo1;?>>
	        </article>
				</article>
			</section>
    </section>

  	</section>

  </section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
