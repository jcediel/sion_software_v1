<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body ">
		 <article class="col-xs-1">
 			<label for="">ID:</label>
 			<input type="text"  name="idpaci" class="form-control" value="<?php echo $fila["id_paciente"];?>"<?php echo $atributo2;?>/>
 		</article>
 		<article class="col-xs-3">
 			<label for="">Tipo documento:</label>
 			<select name="tdocpac" class="form-control" <?php echo atributo3; ?> required="">
				<option value="<?php echo $fila['tipo']; ?>"><?php echo $fila['descri_tipo']; ?></option>
 				<?php
 				$sql="SELECT tipo,descri_tipo from tdocumentos ORDER BY tipo DESC";
 				if($tabla=$bd1->sub_tuplas($sql)){
 					foreach ($tabla as $fila2) {
 						if ($fila["tipo"]==$fila2["tipo"]){
 							$sw=' selected="selected"';
 						}else{
 							$sw="";
 						}
 					echo '<option value="'.$fila2["tipo"].'"'.$sw.'>'.$fila2["descri_tipo"].'</option>';
 					}
 				}
 				?>
 		</select>
 		</article>
		<article class="col-xs-2">
			<label for="">Identificación Paciente:<span class="fa fa-info-circle" data-toggle="popover" title="Digite el número de identificación sin puntos" data-content=""></span></label>
			<input type="text" name="docpac" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $fila["doc_pac"];?>"<?php echo $atributo2;?> required=""/>
		</article>
		<article class="col-xs-4">
			<label for="">Foto Paciente:</label>
			<?php echo $fila["fotopac"];?><br/>
			<input type="file" class="form-control" name="fotopac" <?php echo $atributo2; ?>/><br>
		</article>
		<figure class="col-xs-2">
			<i class="fa fa-exclamation fa-2x text-danger text-center"><img src="<?php echo $fila["foto"];?>" alt=" Sería ideal la foto" class="image_inicio_login"/></i>
		</figure>
	 </section>
	 <section class="panel-body">
		 <article class="col-xs-2">
			 <label for="">Primer Nombre:</label>
			 <input type="text" value="<?php echo $fila["nom1"];?>" name="nom1" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""  value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
		 </article>
		 <article class="col-xs-2">
			 <label for="">Segundo Nombre:</label>
			 <input type="text" value="<?php echo $fila["nom2"];?>" name="nom2"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  value="<?php echo $fila["modelo"];?>"<?php echo $atributo2;?>/>
		 </article>
		 <article class="col-xs-2">
			 <label for="">Primer Apellido:</label>
			 <input type="text" value="<?php echo $fila["ape1"];?>" name="ape1"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required="" value="<?php echo $fila["capacidad_pasajeros"];?>"<?php echo $atributo2;?>/>
		 </article>
		 <article class="col-xs-2">
			 <label for="">Segundo Apellido:</label>
			 <input type="text" value="<?php echo $fila["ape2"];?>" name="ape2" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"   value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
		 </article>
		 <article class="col-xs-2">
			<label for="">Fecha Nacimiento:</label>
			<input type="date" class="form-control" name="fnacimiento" value="<?php echo $fila["fnacimiento"];?>"  required=""/>
		</article>
		<article class="col-xs-1">
			<label for="">Edad:</label>
			<label for="" class="lead text-danger">?
				<?php
				if ($fila["uedad"]==1) {
					echo $fila["edad"].' Años';
				}
				if ($fila["uedad"]==2) {
					echo $fila["edad"].' Meses';
				}
				if ($fila["uedad"]==3) {
					echo $fila["edad"].' Días';
				}
				?></label>
		</article>
	 </section>
	 <section class="panel-body">
		 <article class="col-xs-3">
			 <label for="">Dirección Paciente:</label>
			 <input type="text" name="dirpac"  class="form-control" value="<?php echo $fila["dir_pac"];?>"<?php echo $atributo2;?> required=""/>
		 </article>
		 <article class="col-xs-3">
			 <label for="">Teléfono Paciente:</label>
			 <input type="number" name="telpac"  class="form-control" value="<?php echo $fila["tel_pac"];?>"<?php echo $atributo2;?> required=""/>
		 </article>
		 <article class="col-xs-2">
			 <label for="">Estado Civil: </label>
			 <select name="estadocivil" value="<?php echo $fila["estadoci"];?>" class="form-control" <?php echo atributo3; ?> required="">
				 <option value="<?php echo $fila['estadocivil'];?>"><?php echo $fila['estadocivil'];?></option>
				 <?php
				 $sql="SELECT codestadoc,descriPestadoc from estado_civil ORDER BY codestadoc ASC";
				 if($tabla=$bd1->sub_tuplas($sql)){
					 foreach ($tabla as $fila2) {
						 if ($fila["descriPestadoc"]==$fila2["descriPestadoc"]){
							 $sw=' selected="selected"';
						 }else{
							 $sw="";
						 }
					 echo '<option value="'.$fila2["descriPestadoc"].'"'.$sw.'>'.$fila2["descriPestadoc"].'</option>';
					 }
				 }
				 ?>
			 </select>
		 </article>
		 <article class="col-xs-4">
			 <label for="">Email Paciente:</label>
			 <input type="email" name="emailpac"  class="form-control" value="<?php echo $fila["email_pac"];?>"<?php echo $atributo2;?>/>
		 </article>
	 </section>
	 <section class="panel-body">
		 <article class="col-xs-2">
 			<label for="">Genero:</label>
 			<select name="genero" value="<?php echo $fila["genero"];?>" class="form-control" <?php echo atributo3; ?> required="">
				<option value="<?php echo $fila['genero']; ?>"><?php echo $fila['genero']; ?></option>
 				<?php
 				$sql="SELECT codsexo,descrisexo from sexo ORDER BY descrisexo ASC";
 				if($tabla=$bd1->sub_tuplas($sql)){
 					foreach ($tabla as $fila2) {
 						if ($fila["descrisexo"]==$fila2["descrisexo"]){
 							$sw=' selected="selected"';
 						}else{
 							$sw="";
 						}
 					echo '<option value="'.$fila2["descrisexo"].'"'.$sw.'>'.$fila2["descrisexo"].'</option>';
 					}
 				}
 				?>
 			</select>
 		</article>
 		<article class="col-xs-2">
 			<label for="">RH:</label>
 			<select class="form-control" name="rh" required="">
				<option value="<?php echo $fila['rh'];?>"><?php echo $fila['rh'];?></option>
 				<option value="O-">O-</option>
 				<option value="O+">O+</option>
 				<option value="B-">B-</option>
 				<option value="B+">B+</option>
 				<option value="A-">A-</option>
 				<option value="A+">A+</option>
 				<option value="AB-">AB-</option>
 				<option value="AB+">AB+</option>
 			</select>
 		</article>
		<article class="col-xs-2">
			<label for="">Etnia</label>
			<select name="etnia" class="form-control" <?php echo atributo3; ?> required="">
				<option value="<?php echo $fila['etnia'];?>"><?php echo $fila['etnia'];?></option>
				<?php
				$sql="SELECT codetnia,descripetnia from etnia ORDER BY codetnia ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["descripetnia"]==$fila2["descripetnia"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["descripetnia"].'"'.$sw.'>'.$fila2["descripetnia"].'</option>';
					}
				}
				?>
			</select>
		</article>
		<article class="col-xs-2">
			<label for="">Lateralidad:</label>
			<select class="form-control" name="lateralidad" required="">
				<option value="<?php echo $fila['lateralidad'];?>"><?php echo $fila['lateralidad'];?></option>
				<option value="DIESTRO">DIESTRO</option>
				<option value="SINIESTRO">SINIESTRO</option>
				<option value="AMBIDIESTRO">AMBIDIESTRO</option>
			</select>
		</article>
		<article class="col-xs-2">
			<label for="">Profesión:</label>
			<select name="profesion" class="form-control" <?php echo atributo3; ?> required="">
				<option value="<?php echo $fila['profesion'];?>"><?php echo $fila['profesion'];?></option>
				<?php
				$sql="SELECT descripprof from profesiones ORDER BY descripprof ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["descripprof"]==$fila2["descripprof"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["descripprof"].'"'.$sw.'>'.$fila2["descripprof"].'</option>';
					}
				}
				?>
			</select>
		</article>
		<article class="col-xs-2">
			<label for="">Religión:</label>
			<select class="form-control" name="religion" required="">
				<option value="<?php echo $fila['religion'] ?>"><?php echo $fila['religion'] ?></option>
				<option value="HINDUISMO">HINDUISMO</option>
				<option value="CRISTIANISMO">CRISTIANISMO</option>
        <option value="CATOLISISMO">CATOLISISMO</option>
				<option value="BUDISMO">BUDISMO</option>
				<option value="JAINISMO">JAINISMO</option>
				<option value="JUDAISMO">JUDAISMO</option>
				<option value="ISLAMISMO">ISLAMISMO</option>
				<option value="TAOISMO">TAOISMO</option>
				<option value="BRAHAMISMO">BRAHAMISMO</option>
				<option value="ATEO">ATEO</option>
				<option value="OTRA">OTRA</option>
			</select>
		</article>
	 </section>
 </section>
 <div class="row text-center">
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
	 <input type="reset" class="btn btn-primary" Value="Reestablecer"/>
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
 </div>
		</section>
	</form>
