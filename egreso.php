<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-xs-3">
       <label for="">Identificacion:</label>
       <input type="text" name="name" class="form-control" value="<?php echo $fila["tdoc_pac"].':  '.$fila["doc_pac"];?>"<?php echo $atributo1;?>>
       <input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $fila["id_adm_hosp"];?>">
     </article>
     <article class="col-xs-5">
       <label for="">Nombre Completo:</label>
       <input type="text" name="name" class="form-control" value="<?php echo $fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"];?>"<?php echo $atributo1;?>>
     </article>
     <article class="col-xs-3">
       <label for="">Fecha y Hora INGRESO:</label>
       <input type="text" name="name" class="form-control" value="<?php echo $fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"];?>"<?php echo $atributo1;?>>
     </article>
     <article class="col-xs-3">
       <label for="">Fecha egreso:</label>
       <input type="date" name="fegreso" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
       <input type="time" name="hegreso" class="form-control" value="<?php echo date('H:i');?>"<?php echo $atributo1;?>/>
     </article>
     <article class="col-xs-4">
       <label for="">Seleccione Estado de EGRESO:</label>
       <select name="esalida" class="form-control" <?php echo atributo3; ?>>
         <?php
         $ser=$_REQUEST['ser'];
         echo $ser;
         $sql="SELECT id_eegreso,descripeegreso from estado_egreso WHERE servicio='".$ser."'";
         if($tabla=$bd1->sub_tuplas($sql)){
           foreach ($tabla as $fila2) {
             if ($fila["descripeegreso"]==$fila2["descripeegreso"]){
               $sw=' selected="selected"';
             }else{
               $sw="";
             }
           echo '<option value="'.$fila2["descripeegreso"].'"'.$sw.'>'.$fila2["descripeegreso"].'</option>';
           }
         }
         ?>
     </select>
     </article>
     <article class="col-xs-2">
       <label for="">Estado a la SALIDA:</label>
       <select name="viasalida" class="form-control" <?php echo atributo3; ?>>
        <option value=""></option>
        <option value="1">Vivo (a)</option>
        <option value="2">Muerto (a)</option>
       </select>
     </article>
	 </section>
   <section class="panel-body">
     <article class="">
       <label for="">Ubicación del paciente:</label>
       <label for="" class="lead alert alert-info"><?php echo $fila['nom_piso'].' '.$fila['nom_pabellon'].' '.$fila['nom_hab'].'-'.$fila['nom_cama'];?></label>
       <input type="hidden" name="idc" value="<?php echo $fila['idc'];?>"/>
       <input type="hidden" name="ida" value="<?php echo $fila['id_adm_hosp'];?>"/>
       <input type="hidden" name="idu" value="<?php echo $fila['id_ubipaciente'];?>"/>
       <input type="hidden" name="finicial" value="<?php echo $fila['finicial'];?>"/>
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
