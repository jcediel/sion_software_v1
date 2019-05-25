<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&servicio=Hospitalario&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
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
       <label for="">Fecha retorno:</label>
       <input type="text" name="fecha_regreso" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>>
     </article>
     <?php
     $id=$fila["id_adm_hosp"];
     $sql_parcial="SELECT max(id_h_sparcial) idh FROM historico_salida_parcial WHERE id_adm_hosp='".$id."'";
     //echo $sql_parcial;
     if($tabla_parcial=$bd1->sub_tuplas($sql_parcial)){
       foreach ($tabla_parcial as $fila_parcial) {
         if ($fila_parcial['idh']!='') {
           echo'
           <article class="col-xs-2">
            <input type="text" name="id_h_sparcial" class="form-control" value="'.$fila_parcial['idh'].'">
           </article>
           ';
         }else {
           echo'
           <section class="panel-body">
             <article class="col-md-12">
              <p class="alert alert-danger text-center"><strong><span class="fa fa-warning fa-2x"></span> No hay datos historicos</strong></p>
             </article>
           </section>

           ';
         }
       }
     }
      ?>
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
