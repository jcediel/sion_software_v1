<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-md-12">
       <input type="hidden" name="id_paciente" value="<?php echo $fila["id_paciente"];?>">
       <label for="">Seleccione Jefe:</label>
       <select name="jefe_zona" class="form-control" <?php echo atributo3; ?> required="">
         <option value=""></option>
         <?php
         $sql="SELECT id_user,nombre from user WHERE jz=1 and estado='Activo' ORDER BY id_user ASC";
         if($tabla=$bd1->sub_tuplas($sql)){
           foreach ($tabla as $fila2) {
             if ($fila["id_user"]==$fila2["id_user"]){
               $sw=' selected="selected"';
             }else{
               $sw="";
             }
           echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
           }
         }
         ?>
       </select>
     </article>
     <article class="col-md-6">
       <label for="">Nombre paciente:</label>
       <input type="text" name="nombre" value="<?php echo $fila['nom_completo'] ?>" class="form-control" required="">
     </article>
     <article class="col-md-6">
       <label for="">Documeto paciente:</label>
       <input type="text" name="doc_pac" value="<?php echo $fila['doc_pac'] ?>" class="form-control" required="">
     </article>
     <article class="col-md-6">
       <label for="">Telefono paciente:</label>
       <input type="text" name="tel_pac" value="<?php echo $fila['tel_pac'] ?>" class="form-control" required="">
     </article>
     <article class="col-md-6">
       <label for="">Direccion paciente:</label>
       <input type="text" name="dir_pac" value="<?php echo $fila['dir_pac'] ?>" class="form-control" required="">
     </article>

	 </section>
 </section>
 <div class="row text-center">
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
 </div>
		</section>
	</form>
