<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-xs-2">
       <input type="hidden" name="idadm" value="<?php echo $fila["id_adm_hosp"];?>">
       <label for="">Parentesco:</label>
       <select name="parentesco" class="form-control" <?php echo atributo3; ?> required="">
         <option value="<?php echo $fila['parentesco_acu'] ?>"><?php echo $fila['parentesco_acu'] ?></option>
         <?php
         $sql="SELECT id_parentesco,parentescos from parentesco ORDER BY id_parentesco ASC";
         if($tabla=$bd1->sub_tuplas($sql)){
           foreach ($tabla as $fila2) {
             if ($fila["parentescos"]==$fila2["parentescos"]){
               $sw=' selected="selected"';
             }else{
               $sw="";
             }
           echo '<option value="'.$fila2["parentescos"].'"'.$sw.'>'.$fila2["parentescos"].'</option>';
           }
         }
         ?>
       </select>
     </article>
     <article class="col-xs-4">
       <label for="">Nombre completo:</label>
       <input type="text" name="nombre" value="<?php echo $fila['nombre_acu'] ?>" class="form-control" required="">
     </article>
     <article class="col-xs-6">
       <label for="">Dirección:</label>
       <input type="text" name="direccion" value="<?php echo $fila['dir_pac'] ?>" class="form-control" required="">
     </article>
     <article class="col-xs-2">
       <label for="">Teléfono:</label>
       <input type="tel" name="telefono" value="<?php echo $fila['tel_pac'] ?>" class="form-control" required="">
     </article>
     <article class="col-xs-4">
       <input type="hidden" name="responsable" value="<?php echo $_SESSION["AUT"]["nombre"]; ?>" class="form-control">
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
