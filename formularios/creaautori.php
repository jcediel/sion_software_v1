<link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
<script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
<script src="js/jquery-ui.min.js" charset="utf-8"></script>

<script type="text/javascript">
$('document').ready(function() {
	
    $("#add").click(function() {
        var intId = $("#buildyourform div").length + 1;
        var fieldWrapper = $("<div class=\"fieldwrapper \" id=\"field" + intId + "\"/>");
        var fName = $("<input type=\"text\" class=\"fieldname form-control\" id=\"buscar\"/>");
        var removeButton = $("<input type=\"button\" class=\"remove btn-primary\" value=\"Quitar\" />");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
    });
    $("#preview").click(function() {
        $("#yourform").remove();
        var fieldSet = $("<fieldset id=\"yourform\"><legend>Your Form</legend></fieldset>");
        $("#buildyourform div").each(function() {
            var id = "input" + $(this).attr("id").replace("field","");
            var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname").first().val() + "</label>");
            var input;
            switch ($(this).find("select.fieldtype").first().val()) {
                case "checkbox":
                    input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id + "\" />");
                    break;
                case "textbox":
                    input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id + "\" />");
                    break;
                case "textarea":
                    input = $("<textarea id=\"" + id + "\" name=\"" + id + "\" ></textarea>");
                    break;
            }
            fieldSet.append(label);
            fieldSet.append(input);
        });
        $("body").append(fieldSet);
    });
});
</script>
<form action="<?php echo PROGRAMA.'?&opcion=31';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
		<section class="panel-body">
	  	<?php
	    include("consulta_paciente.php");
	  	?>
		</section>
		<section class="panel-body">
			<article class="col-xs-7">
				<label for="">Numero Autorizacion:</label>
				<input type="text" name="num_autorizacion" class="form-control" value="">
			</article>
			<article class="col-xs-6">
				<label for="">Fecha inicial:</label>
				<input type="date" name="finicial" class="form-control" value="">
			</article>
			<article class="col-xs-6">
				<label for="">Fecha Final:</label>
				<input type="date" name="ffinal" class="form-control" value="">
			</article>
			<article class="col-xs-5">
				<label for="">Clasificacion de zona:</label>
				<select class="form-control" name="zeps">
					<option value=""></option>
					<option value="Sanitas Zona IN">Sanitas Zona IN</option>
					<option value="Sanitas Soacha">Sanitas Soacha</option>
					<option value="Sanitas normal">Sanitas normal</option>
					<option value="No aplica">No aplica</option>
				</select>
			</article>
			<article class="col-xs-5">
				<label for="">Clasificacion de Usuario:</label>
				<select class="form-control" name="clase_usuario">
					<option value=""></option>
					<option value="Cronico">Cronico</option>
					<option value="Puntual">Puntual</option>
					<option value="PHD">PHD</option>
					<option value="No aplica">No aplica</option>
				</select>
			</article>
			<article class="col-xs-12">
				<?php include("dxbuscarautori.php");?>
			</article>

			<article class="col-xs-12">
				<fieldset id="buildyourform">
    			<legend>Agregar los procedimientos correspondientes a la autorizacion</legend>
				</fieldset>
				<input type="button" value="Preview form" class="add" id="preview" />
				<input type="button" value="Add a field" class="add" id="add" />
			</article>
			<article class="col-xs-5">
				<label for="">Seleccione tipo de pago</label>
				<input type="radio" class="radio" name="tipo_pago"
					<?php if (isset($tmuscular1) && $tmuscular1=="Copago") echo "checked";?>	value="Copago">
			</article>
		</section>
		<section class="panel panel-footer">
			<div class="row text-center">
	  		<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
				<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
			</div>
  	</section>
</form>
