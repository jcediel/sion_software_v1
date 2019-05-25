<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].sesion_asignada.value > document.forms[0].cantidad_autorizada.value){
					alert(" <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede asignar más sesiones de las autorizadas.");
					document.forms[0].sesion_asignada.focus();			// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
  <section class="panel-heading">
    <h3>Asignación de profesionales</h3>
  </section>
	<section class="panel-body">
		<?php
			$id_adm=$_REQUEST['idadm'];
			$sql_paciente="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,email_pac,dir_pac,tel_pac,
														b.fingreso_hosp,id_eps,
														c.nom_barrio,
														d.nom_upz,
														e.nom_localidad,
														f.nombre_acu, dir_acu, tel_acu, parentesco_acu
										 FROM pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										 									left join info_acudiente f on f.id_adm_hosp=b.id_adm_hosp
										 									left join barrio c on c.id_barrio=a.zonificacion
																			left JOIN upz d on c.id_upz=d.id_upz
																			LEFT JOIN localidades e on e.id_localidad=d.id_localidad
										 WHERE b.id_adm_hosp=$id_adm";
										// echo $sql_paciente;
			if ($tabla_paciente=$bd1->sub_tuplas($sql_paciente)){
				foreach ($tabla_paciente as $fila_paciente) {
					?>
					<article class="col-md-4">
						<label for="">Paciente:</label>
						<label class="text-success"><?php echo $fila_paciente['nom1'].' '.$fila_paciente['nom2'].' '.$fila_paciente['ape1'].' '.$fila_paciente['ape2']?></label>
						<input type="hidden" name="nom" value="<?php echo $fila_paciente['nom1'].' '.$fila_paciente['nom2'].' '.$fila_paciente['ape1'].' '.$fila_paciente['ape2']?>">
					</article>
					<article class="col-md-4">
						<label for="">Identificación:</label>
						<label class="text-success"><?php echo $fila_paciente['tdoc_pac'].': '.$fila_paciente['doc_pac']?></label>
						<input type="hidden" name="doc_pac" value="<?php echo $fila_paciente['tdoc_pac'].' '.$fila_paciente['doc_pac']?>">
						<input type="hidden" name="eps" value="<?php echo $fila_paciente['id_eps']?>">
						<input type="text" name="dir" value="<?php echo $fila_paciente['dir_pac']?>" class="form-control">
						<input type="hidden" name="tel" value="<?php echo $fila_paciente['tel_pac']?>">
						<input type="hidden" name="barrio" value="<?php echo $fila_paciente['nom_barrio'].' '.$fila_paciente['nom_localidad']?>">
					</article>
					<article class="col-md-4">
						<label for="">Cuidador Primario:</label>
						<label class="text-success"><?php echo $fila_paciente['nombre_acu']?></label>
						<input type="hidden" name="nom_acu" value="<?php echo $fila_paciente['nombre_acu']?>">
						<input type="hidden" name="dir_acu" value="<?php echo $fila_paciente['dir_acu']?>">
						<input type="hidden" name="tel_acu" value="<?php echo $fila_paciente['tel_acu']?>">
					</article>
					<?php
				}
			}
		 ?>

	</section>
  <section class="panel-body">
    <article class="col-md-2">
      <label for="">CUPS a realizar:</label>
      <input type="hidden" name="id_d_aut_dom" value="<?php echo $fila['id_d_aut_dom']?>">
      <input type="text" class="form-control" name="cups" value="<?php echo $fila['cups']?>" <?php echo $atributo1 ?>>
    </article>
    <article class="col-md-6">
      <label for="">Descripción del procedimiento:</label>
      <input type="text" class="form-control" name="procedimiento" value="<?php echo $fila['procedimiento']?>" <?php echo $atributo1 ?>>
    </article>
    <article class="col-md-4">
      <?php
      echo '<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idm='.$_REQUEST['idm'].'&idd='.$_REQUEST['idd'].'&doc='.$_REQUEST['doc'].'&nc=ED%20MA%20GA%20LON&servicio=Domiciliarios&formato='.$fila['cups'].'&idadm='.$_REQUEST['idadm'].'"><button type="button" class="btn btn-primary" > Buscar profesional <span class="fa fa-search fa-2x"></span> </button></a>';
       ?>
    </article>
    <?php
    $cups=$fila['cups'];
    $servicio=$_REQUEST['servicio'];
    $detalle=$_REQUEST['idd'];
    $sql_cups="SELECT codcupsmin,especialidad,tipo_procedimiento FROM cups WHERE codcupsmin='$cups'";
  //echo $sql_cups;
    if ($tabla_cups=$bd1->sub_tuplas($sql_cups)){
      foreach ($tabla_cups as $fila_cups) {
        if ($servicio=='Domiciliarios' && $fila_cups['tipo_procedimiento']=='MEDICINA DOMICILIARIA') {
          echo'<article class="col-md-6">
                <label for="">Especialidad:</label>
                <input type="text" class="form-control" name="" value="'.$fila_cups['especialidad'].'" '.$atributo1.'>
               </article>';
          echo'<article class="col-md-6">
                <label for="">Clasificación del Procedimiento:</label>
                <input type="text" class="form-control" name="" value="'.$fila_cups['tipo_procedimiento'].'" '.$atributo1.'>
               </article>
            </section>';
        }
      }
    }
    $sql_detalle="SELECT id_d_aut_dom, id_m_aut_dom, freg, cups, procedimiento, cantidad, finicio,
                      ffinal, num_aut_externa, estado_d_aut_dom, intervalo, profesional, f_prof
               FROM d_aut_dom WHERE id_d_aut_dom=$detalle";
  //echo $sql_detalle;
    if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
      foreach ($tabla_detalle as $fila_detalle) {
        $estado=$fila_detalle['estado_d_aut_dom'];
        if ($estado==1 || $estado==2) {
          echo'<article class="col-md-6">
                <label for="">Cantidad Autorizada:</label>
                <input type="text" class="form-control" name="cantidad_autorizada" value="'.$fila_detalle['cantidad'].'" '.$atributo1.'>
               </article>';
          echo'<article class="col-md-6">
                <label for="">Tiempo de realización:</label>
                <input type="text" class="form-control" name="atencion" value="'.$fila_detalle['finicio'].' - '.$fila_detalle['ffinal'].'" '.$atributo1.'>
               </article>';
        }
      }
    }
     ?>
     <section class="panel-body">
       <?php
        $formato=$_REQUEST['formato'];
        if ($formato=='890111') {
        ?>
          <section class="panel-body">
            <article class="col-md-12">
              <label for="">Seleccione Profesional:</label>
              <select class="form-control" required name="profesional">
                <option value=""></option>
                <?php
                $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('FISIOTERAPIA') ORDER BY nombre ASC";
                if($tabla=$bd1->sub_tuplas($sql)){
                  foreach ($tabla as $fila2) {
                    if ($fila["id_user"]==$fila2["id_user"]){
                      $sw=' selected="selected"';
                    }else{
                      $sw="";
                    }
                  echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';

                  }
                }
                 ?>
								 <option value="125"'.$sw.'>Angelica Hernandez</option>
              </select>
            </article>

          </section>
          <div class="row text-center">
            <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
            <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
            <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
          </div>

        <?php
        }
        ?>
        <?php
         $formato=$_REQUEST['formato'];
         if ($formato=='890110') {
         ?>
           <section class="panel-body">
             <article class="col-md-12">
               <label for="">Seleccione Profesional:</label>
               <select class="form-control" required name="profesional">
                 <option value=""></option>
                 <?php
                 $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('FONOAUDIOLOGIA') ORDER BY nombre ASC";
                 if($tabla=$bd1->sub_tuplas($sql)){
                   foreach ($tabla as $fila2) {
                     if ($fila["id_user"]==$fila2["id_user"]){
                       $sw=' selected="selected"';
                     }else{
                       $sw="";
                     }
                   echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';
                   }
                 }
                  ?>
               </select>
             </article>

           </section>
           <div class="row text-center">
             <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
             <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
             <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
           </div>

         <?php
         }
         ?>
         <?php
          $formato=$_REQUEST['formato'];
          if ($formato=='890113') {
          ?>
            <section class="panel-body">
              <article class="col-md-12">
                <label for="">Seleccione Profesional:</label>
                <select class="form-control" required name="profesional">
                  <option value=""></option>
                  <?php
                  $sql="SELECT a.id_user,nombre,especialidad,tel_user,b.nombre_perfil  from user a inner join perfil b on a.id_perfil=b.id_perfil
									 where a.especialidad in ('TERAPIA OCUPACIONAL') ORDER BY a.nombre ASC";
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_user"]==$fila2["id_user"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].' '.$fila2['nombre_perfil'].'</option>';
                    }
                  }
                   ?>
                </select>
              </article>

            </section>
            <div class="row text-center">
              <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
              <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
              <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
            </div>

          <?php
          }
          ?>
          <?php
           $formato=$_REQUEST['formato'];
           if ($formato=='890112') {
           ?>
             <section class="panel-body">
               <article class="col-md-12">
                 <label for="">Seleccione Profesional:</label>
                 <select class="form-control" required name="profesional">
                   <option value=""></option>
                   <?php
                   $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('FISIOTERAPIA') ORDER BY nombre ASC";
                   if($tabla=$bd1->sub_tuplas($sql)){
                     foreach ($tabla as $fila2) {
                       if ($fila["id_user"]==$fila2["id_user"]){
                         $sw=' selected="selected"';
                       }else{
                         $sw="";
                       }
                     echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';

                     }
                   }
                    ?>
										<option value="125"'.$sw.'>Angelica Hernandez</option>
                 </select>
               </article>

             </section>
             <div class="row text-center">
               <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
               <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
               <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
             </div>

           <?php
           }
           ?>
					 <?php
            $formato=$_REQUEST['formato'];
            if ($formato=='890101') {
            ?>
              <section class="panel-body">
                <article class="col-md-12">
                  <label for="">Seleccione Profesional:</label>
                  <select class="form-control" required name="profesional">
                    <option value=""></option>
                    <?php
                    $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('MEDICINA GENERAL') ORDER BY nombre ASC";
                    if($tabla=$bd1->sub_tuplas($sql)){
                      foreach ($tabla as $fila2) {
                        if ($fila["id_user"]==$fila2["id_user"]){
                          $sw=' selected="selected"';
                        }else{
                          $sw="";
                        }
                      echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';
                      }
                    }
                     ?>
                  </select>
                </article>

              </section>
              <div class="row text-center">
                <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
                <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
                <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
              </div>

            <?php
            }
            ?>
						<?php
             $formato=$_REQUEST['formato'];
             if ($formato=='890105') {
             ?>
               <section class="panel-body">
                 <article class="col-md-12">
                   <label for="">Seleccione Profesional:</label>
                   <select class="form-control" required name="profesional">
                     <option value=""></option>
                     <?php
                     $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('Aux. Enfermeria') ORDER BY nombre ASC";
                     if($tabla=$bd1->sub_tuplas($sql)){
                       foreach ($tabla as $fila2) {
                         if ($fila["id_user"]==$fila2["id_user"]){
                           $sw=' selected="selected"';
                         }else{
                           $sw="";
                         }
                       echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';
                       }
                     }
                      ?>
                   </select>
                 </article>

               </section>
               <div class="row text-center">
                 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
                 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
                 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
               </div>

             <?php
             }
             ?>
						 <?php
							 $formato=$_REQUEST['formato'];
							 if ($formato=='890106') {
							 ?>
								 <section class="panel-body">
									 <article class="col-md-12">
										 <label for="">Seleccione Profesional:</label>
										 <select class="form-control" required name="profesional">
											 <option value=""></option>
											 <?php
											 $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('NUTRICION') ORDER BY nombre ASC";
											 if($tabla=$bd1->sub_tuplas($sql)){
												 foreach ($tabla as $fila2) {
													 if ($fila["id_user"]==$fila2["id_user"]){
														 $sw=' selected="selected"';
													 }else{
														 $sw="";
													 }
												 echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';
												 }
											 }
												?>
										 </select>
									 </article>

								 </section>
								 <div class="row text-center">
									 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
									 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
									 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
								 </div>

							 <?php
							 }
							 ?>
							 <?php
								 $formato=$_REQUEST['formato'];
								 if ($formato=='890108') {
								 ?>
									 <section class="panel-body">
										 <article class="col-md-12">
											 <label for="">Seleccione Profesional:</label>
											 <select class="form-control" required name="profesional">
												 <option value=""></option>
												 <?php
												 $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('PSICOLOGIA') ORDER BY nombre ASC";
												 if($tabla=$bd1->sub_tuplas($sql)){
													 foreach ($tabla as $fila2) {
														 if ($fila["id_user"]==$fila2["id_user"]){
															 $sw=' selected="selected"';
														 }else{
															 $sw="";
														 }
													 echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';
													 }
												 }
													?>
											 </select>
										 </article>

									 </section>
									 <div class="row text-center">
										 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
										 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
										 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
									 </div>

								 <?php
								 }
								 ?>
								 <?php
									$formato=$_REQUEST['formato'];
									if ($formato=='F890121' || $formato=='F890122' || $formato=='F890123' || $formato=='F890124' || $formato=='F890125') {
									?>
										<section class="panel-body">
											<article class="col-md-12">
												<label for="">Seleccione Profesional:</label>
												<select class="form-control" required name="profesional">
													<option value=""></option>
													<?php
													$sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('Aux. Enfermeria') ORDER BY nombre ASC";
													if($tabla=$bd1->sub_tuplas($sql)){
														foreach ($tabla as $fila2) {
															if ($fila["id_user"]==$fila2["id_user"]){
																$sw=' selected="selected"';
															}else{
																$sw="";
															}
														echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';

														}
													}
													 ?>

												</select>
											</article>

										</section>
										<div class="row text-center">
											<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
											<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
											<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
										</div>

									<?php
									}
									?>
									<?php
									 $formato=$_REQUEST['formato'];
									 if ($formato=='F891842') {
									 ?>
										 <section class="panel-body">
											 <article class="col-md-12">
												 <label for="">Seleccione Profesional:</label>
												 <select class="form-control" required name="profesional">
													 <option value=""></option>
													 <?php
													 $sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('Jefe Enfermeria') and id_perfil=91 ORDER BY nombre ASC";
													 if($tabla=$bd1->sub_tuplas($sql)){
														 foreach ($tabla as $fila2) {
															 if ($fila["id_user"]==$fila2["id_user"]){
																 $sw=' selected="selected"';
															 }else{
																 $sw="";
															 }
														 echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';

														 }
													 }
														?>

												 </select>
											 </article>

										 </section>
										 <div class="row text-center">
											 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
											 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
											 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
										 </div>

									 <?php
									 }
									 ?>
									 <?php
										$formato=$_REQUEST['formato'];
										if ($formato=='EMM1020') {
										?>
											<section class="panel-body">
												<article class="col-md-12">
													<label for="">Seleccione Profesional:</label>
													<select class="form-control" required name="profesional">
														<option value=""></option>
														<?php
														$sql="SELECT id_user,nombre,especialidad,tel_user from user where especialidad in ('Jefe Enfermeria') and id_perfil=91 ORDER BY nombre ASC";
														if($tabla=$bd1->sub_tuplas($sql)){
															foreach ($tabla as $fila2) {
																if ($fila["id_user"]==$fila2["id_user"]){
																	$sw=' selected="selected"';
																}else{
																	$sw="";
																}
															echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.utf8_decode($fila2["nombre"]).' --- <strong>tel:</<strong> '.$fila2["tel_user"].'</option>';

															}
														}
														 ?>

													</select>
												</article>

											</section>
											<div class="row text-center">
												<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
												<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
												<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
											</div>

										<?php
										}
										?>

     </section>

   </form>
</section>
