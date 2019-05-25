<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["fotopac"])){
				if (is_uploaded_file($_FILES["fotopac"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["fotopac"]["name"]);
					$archivo=$_POST["docpac"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["fotopac"]["tmp_name"],LOG.PACIENTES.$archivo)){
						$fotoE=",fotopac='".PACIENTES.$archivo."'";
						$fotoA1=",fotopac";
						$fotoA2=",'".PACIENTES.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'A':
				$sql="INSERT INTO m_producto ( id_bodega, fcreacion, nom_producto, estado_producto, crea_mproducto) VALUES
				('".$_POST["idbog"]."','".date('Y-m-d H:m')."','".$_POST["nomgenerico"]."','Activo','".$_SESSION["AUT"]["id_user"]."')";
				$subtitulo="Medicamento principal";
				$subtitulo1="Adicionado";

			break;
			case 'EVO':
				$sql="INSERT INTO evo_nutrism (id_adm_hosp, id_user, freg_nutrice_sm, hreg_nutrice_sm, evolucion_nutri, estado_evonutri) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
				$subtitulo="Evolución";
				$subtitulo1="Adicionado";

			break;
		}
	//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El $subtitulo  fue $subtitulo1 con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El $subtitulo  NO fue $subtitulo1 !!! .";
		}
	}
}
if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
			case 'ADD':
      $sql="SELECT id_producto,id_bodega,nom_producto,estado_producto FROM m_producto WHERE id_producto=".$_REQUEST['idmp'];
			$boton="Agregar Detalle Medicamento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosMED/add_dproducto.php';
			$subtitulo='Adición detalle de productos.';
			break;
			case 'A':
      $sql="";
			$boton="Agregar Medicamento Principal";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosMED/add_mproducto.php';
			$subtitulo='Creación de medicamento principal.';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_producto"=>"","id_bodega"=>"","nom_producto"=>"","estado_producto"=>"");
			}
		}else{
				$fila=array("id_producto"=>"","id_bodega"=>"","nom_producto"=>"","estado_producto"=>"");
			}
		?>

		<?php include($form1);?>

<?php
}else{
  if ($check=='si') {
  	echo'<section>';
  	echo '<script>swal("EXCELENTE !!! '.$subtitulo.'","","success")</script>';
  	echo'</section>';
  }if ($check=='no') {
  	echo'<section>';
  	echo '<script>swal("DEBES REVISAR EL PROCESO !!! '.$subtitulo.'","","error")</script>';
  	echo'</section>';
  }
// nivel 1?>

<section class="panel panel-default">
  <section class="panel panel-success">
      <section class="panel-heading">Administracion de medicamentos QR</section>
      <section class="panel-body">
          <?php
          $pac=$_GET['idadmhosp'];
          $servicio=$_GET['servicio'];
          if (isset($pac)) {
            $sql_admision="SELECT a.id_paciente idp,tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,fnacimiento,TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,dir_pac,tel_pac,rh,email_pac,genero,fotopac,nom_completo,
            b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
            c.descripestadoc,
            d.descriafiliado,
            e.descritusuario,
            f.descriocu,
            g.descripdep,
            h.descrimuni,
            i.descripuedad,
            j.nom_eps,
            m.nombre_acu,dir_acu,tel_acu,parentesco_acu,
            n.nombre_aco,dir_aco,tel_aco,parentesco_aco
            FROM pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join estado_civil c on (c.codestadoc = a.estadocivil)
                  left join tusuario e on (e.codtusuario=b.tipo_usuario)
                  left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
                  left join ocupacion f on (f.codocu=b.ocupacion)
                  left join departamento g on (g.coddep=b.dep_residencia)
                  left join municipios h on (h.codmuni=b.mun_residencia)
                  left join uedad i on (i.coduedad=a.uedad)
                  left join eps j on (j.id_eps=b.id_eps)
                  left join info_acudiente m on (m.id_adm_hosp=b.id_adm_hosp)
                  left join info_acompanante n on (n.id_adm_hosp=b.id_adm_hosp)
            WHERE b.id_adm_hosp = $pac and tipo_servicio='$servicio'";
            if ($tabla_admision=$bd1->sub_tuplas($sql_admision)){
              foreach ($tabla_admision as $fila_admision) {
                ?>
                <section class="panel-body">
                  <section class="row col-md-8">
                    <article class="col-md-6">
                      <label for="">Paciente: </label>
                      <p> <?php echo $fila_admision['nom_completo'] ?></p>
                    </article>
                    <article class="col-md-6">
                      <label for="">DI: </label>
                      <p><?php echo $fila_admision['tdoc_pac'].' '.$fila_admision['doc_pac'] ?></p>
                    </article>
                    <article class="col-md-6">
                      <label for="">Edad: </label>
                      <p><?php echo $fila_admision['edad'].' | '.$fila_admision['fnacimiento'] ?></p>
                    </article>
                    <article class="col-md-6">
                      <label for="">Genero:</label>
                      <p> <?php echo $fila_admision['genero'] ?></p>
                    </article>
                    <article class="col-md-6">
                      <label for="">Contacto:</label>
                      <p><strong>Nombre: </strong><?php echo $fila_admision['nombre_acu'] ?> <strong class="text-danger"><?php echo $fila_admision['parentesco'] ?></strong></p>
                      <p><?php echo $fila_admision['tel_acu'] ?> <?php echo $fila_admision['tel_aco'] ?></p>
                    </article>
                  </section>
                  <section class="row col-md-4">
                    <article class="col-md-12">
                      <img src="<?php echo $fila_admision['fotopac'] ?>" class="img-rounded" width="100px" alt="">
                    </article>
                  </section>
                </section>
                <?php
              }
            } // Fin consulta de datos generales
            ?>
            <section class="panel-body">
              <article class="col-md-3 col-sm-12">
                <button type="button" class="btn btn-info btn-lg text-center" data-toggle="modal" data-target="#antpersonal">Antecedentes<br>Personales<br><span class="fa fa-user fa-2x"></span></button>
                <div id="antpersonal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Antecedentes Personales del paciente</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                      $adm=$_GET['idadmhosp'];
                      $sql_ant="SELECT ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,
          						ant_traumatologico,ant_familiar,otros_ant FROM hc_hospitalario WHERE id_adm_hosp=$adm";
                      if ($tabla_ant=$bd1->sub_tuplas($sql_ant)){
                        foreach ($tabla_ant as $fila_ant) {
                          ?>
                          <article class="col-md-12">
                            <label for="">Antecedente Alergico:</label>
                            <label for=""><?php echo $fila_ant['ant_alergicos'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Patologico:</label>
                            <label for=""><?php echo $fila_ant['ant_patologico'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Quirurgico:</label>
                            <label for=""><?php echo $fila_ant['ant_quirurgico'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Toxicologico:</label>
                            <label for=""><?php echo $fila_ant['ant_toxicologico'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Farmacologico:</label>
                            <label for=""><?php echo $fila_ant['ant_farmaco'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Ginecologico:</label>
                            <label for=""><?php echo $fila_ant['ant_gineco'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Psiquiatrico:</label>
                            <label for=""><?php echo $fila_ant['ant_psiquiatrico'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Hospitalarios:</label>
                            <label for=""><?php echo $fila_ant['ant_hospitalario'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Traumatologico:</label>
                            <label for=""><?php echo $fila_ant['ant_traumatologico'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Antecedente Familiar:</label>
                            <label for=""><?php echo $fila_ant['ant_familiar'] ?></label>
                          </article>
                          <article class="col-md-12">
                            <label for="">Otros Antecedentes:</label>
                            <label for=""><?php echo $fila_ant['otros_ant'] ?></label>
                          </article>
                          <?php
                        }
                      }
                      ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
              </article>

              <article class="col-md-3 col-sm-12">
                <button type="button" class="btn btn-info btn-lg text-center" data-toggle="modal" data-target="#ult_evoluciones_p">Evoluciones<br>Psiquiatria<br><span class="fa fa-notes-medical fa-2x"></span></button>
                <div id="ult_evoluciones_p" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Ultimas evoluciones Psiquiatria</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                      $id=$_REQUEST["idadmhosp"];
                      $sql_p="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,max(id_evomed),max(objetivo),
                                   max(subjetivo),max(analisis_evomed),max(plan_tratamiento),max(justificacion_hosp),dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
                                   u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                            FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user
                            where e.id_adm_hosp='".$_GET["idadmhosp"]."' and u.id_perfil=3
                            group by e.id_adm_hosp,e.freg_evomed,e.hreg_evomed,u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                            ORDER BY freg_evomed DESC LIMIT 0,5";
                        //echo $sql;
                      if ($tabla_p=$bd1->sub_tuplas($sql_p)){
                        //echo $sql;
                        foreach ($tabla_p as $fila_p) {
                          ?>
                          <section class="panel-body">
                            <article class="col-md-12">
                              <p><strong>Fecha Registro:</strong> <?php echo $fila_p["freg_evomed"]. ' ' .$fila_p["hreg_evomed"] ?> </p>
                              <p><strong>Medico Registra:</strong> <?php echo $fila_p["nombre"]. ' ' .$fila_p["hreg_evomed"] ?> </p>
                              <p><strong>Fecha Registro:</strong> <?php echo $fila_p["freg_evomed"]. ' ' .$fila_p["especialidad"] ?> </p>
                            </article>
                            <article class="col-md-12">
                              <p><strong>Objetivo:</strong> <?php echo $fila_p["max(objetivo)"] ?> </p>
                              <p><strong>Subjetivo:</strong> <?php echo $fila_p["max(subjetivo)"] ?> </p>
                              <p><strong>Analisis:</strong> <?php echo $fila_p["max(analisis_evomed)"] ?> </p>
                              <p><strong>Plan Tratamiento:</strong> <?php echo $fila_p["max(plan_tratamiento)"] ?> </p>
                            </article>
                            <article class="col-md-6">
                              <p><strong>Justificacion:</strong> <?php echo $fila_p["max(justificacion_hosp)"] ?> </p>
                            </article>
                            <article class="col-md-6">
                              <p><?php echo $fila_p["dxp"].' -- '.$fila_p["ddxp"].' -- '.$fila_p["tdxp"]?></p>
                              <p><?php echo $fila_p["dx1"].' -- '.$fila_p["ddx1"].' -- '.$fila_p["tdx1"]?></p>
                              <p><?php echo $fila_p["dx2"].' -- '.$fila_p["ddx2"].' -- '.$fila_p["tdx2"]?></p>
                            </article>
                          </section>
                          <?php
                        }
                      }
                      ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
            </article>
              <article class="col-md-3 col-sm-12">
                <button type="button" class="btn btn-info btn-lg text-center" data-toggle="modal" data-target="#ult_evoluciones_mg">Evoluciones<br>M.General<br><span class="fa fa-notes-medical fa-2x"></span></button>
                <div id="ult_evoluciones_mg" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Ultimas evoluciones Medicina general</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                      $id=$_REQUEST["idadmhosp"];
                      $sql_mg="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,max(id_evomed),max(objetivo),
                                   max(subjetivo),max(analisis_evomed),max(plan_tratamiento),max(justificacion_hosp),dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
                                   u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                            FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user
                            where e.id_adm_hosp='".$_GET["idadmhosp"]."' and u.id_perfil=4
                             group by e.id_adm_hosp,e.freg_evomed,e.hreg_evomed,u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                            ORDER BY freg_evomed DESC LIMIT 0,5";
                        //echo $sql;
                      if ($tabla_mg=$bd1->sub_tuplas($sql_mg)){
                        //echo $sql;
                        foreach ($tabla_mg as $fila_mg) {
                          ?>
                          <section class="panel-body">
                            <article class="col-md-12">
                              <p><strong>Fecha Registro:</strong> <?php echo $fila_mg["freg_evomed"]. ' ' .$fila_mg["hreg_evomed"] ?> </p>
                              <p><strong>Medico Registra:</strong> <?php echo $fila_mg["nombre"]. ' ' .$fila_mg["hreg_evomed"] ?> </p>
                              <p><strong>Fecha Registro:</strong> <?php echo $fila_mg["freg_evomed"]. ' ' .$fila_mg["especialidad"] ?> </p>
                            </article>
                            <article class="col-md-12">
                              <p><strong>Objetivo:</strong> <?php echo $fila_mg["max(objetivo)"] ?> </p>
                              <p><strong>Subjetivo:</strong> <?php echo $fila_mg["max(subjetivo)"] ?> </p>
                              <p><strong>Analisis:</strong> <?php echo $fila_mg["max(analisis_evomed)"] ?> </p>
                              <p><strong>Plan Tratamiento:</strong> <?php echo $fila_mg["max(plan_tratamiento)"] ?> </p>
                            </article>
                            <article class="col-md-6">
                              <p><strong>Justificacion:</strong> <?php echo $fila_mg["max(justificacion_hosp)"] ?> </p>
                            </article>
                            <article class="col-md-6">
                              <p><?php echo $fila_mg["dxp"].' -- '.$fila_mg["ddxp"].' -- '.$fila_mg["tdxp"]?></p>
                              <p><?php echo $fila_mg["dx1"].' -- '.$fila_mg["ddx1"].' -- '.$fila_mg["tdx1"]?></p>
                              <p><?php echo $fila_mg["dx2"].' -- '.$fila_mg["ddx2"].' -- '.$fila_mg["tdx2"]?></p>
                            </article>
                          </section>
                          <?php
                        }
                      }
                      ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
              </article>
              <article class="col-md-3 col-sm-12">
                <button type="button" class="btn btn-info btn-lg text-center" data-toggle="modal" data-target="#formulas">Historico<br>Formulas<br><span class="fa fa-pills fa-2x"></span></button>
                <div id="formulas" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Historico de formulación</h4>
                      </div>
                      <div class="modal-body">
                        <section class="panel-body col-md-12">
                          <table class="table table-bordered">
                            <tr>
                              <td>FORMULA</td>
                              <td>HISTORICO<br>FORMULA</td>
                            </tr>
                            <?php
                           $idpaciente=$_GET["idadmhosp"];
                           $servicio=$_GET["servicio"];

                           $sql_master="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
                                        b.id_m_fmedhosp,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,
                                        estado_m_fmedhosp,servicio,
                                        c.nombre,especialidad

                                 FROM adm_hospitalario a LEFT JOIN m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
                                                         LEFT JOIN user c on b.id_user=c.id_user

                                 WHERE a.id_adm_hosp='".$idpaciente."' and b.servicio='$servicio'
                                ORDER BY fejecucion_final DESC";
                             // echo $sql_master;
                           if ($tablasql_master=$bd1->sub_tuplas($sql_master)){
                             foreach ($tablasql_master as $fila_sql_master) {
                               echo '<tr>
                                      <td>
                                        <p><strong>Fecha Registro:</strong> '.$fila_sql_master["freg_m_fmedhosp"].'</p>
                                        <p><strong>Fecha Ejecución:</strong> '.$fila_sql_master["fejecucion_inicial"].' - '.$fila_sql_master["fejecucion_final"].'</p>
                                        <p><strong>Tipo Formula:</strong> '.$fila_sql_master["tipo_formula"].'</p>
                                        <p><strong>Responsable:</strong> '.$fila_sql_master["nombre"].' '.$fila_sql_master["especialidad"].'</p>
                                      </td>';
                                      $idm=$fila_sql_master["id_m_fmedhosp"];// consulta de quien extendio la formula
                                      $sql_master_his="SELECT a.id_m_fmedhosp,
                                                              b.new_fecha,
                                                              c.nombre

                                           FROM m_fmedhosp a LEFT JOIN log_extension_formula b on a.id_m_fmedhosp=b.formula_ext
                                                                   LEFT JOIN user c on b.user_ext=c.id_user

                                           WHERE formula_ext=$idm ";
                                       //echo $sql_master_his;
                                     if ($tablasql_master_his=$bd1->sub_tuplas($sql_master_his)){
                                       foreach ($tablasql_master_his as $fila_sql_master_his) {
                                         echo '<td>
                                                 <p class="text-success"><strong>EXTENSIÓN DE FECHA</strong></p>
                                                 <p><strong>Nueva Fecha:</strong> '.$fila_sql_master_his["new_fecha"].'</p>
                                                 <p><strong>Medico que extendio:</strong> '.$fila_sql_master_his["nombre"].'</p>
                                               ';
                                       }
                                     }else {
                                       echo '<td>
                                              <p class="text-success"><strong>No se realizo extensión de esta Formula</strong></p>
                                            ';
                                     }
                                     $idm=$fila_sql_master["id_m_fmedhosp"];
                                     $sql_master1="SELECT a.id_m_fmedhosp,
                                                             b.fecha, usuario, formula,
                                                             c.nombre

                                          FROM m_fmedhosp a LEFT JOIN log_master_formula b on a.id_m_fmedhosp=b.formula
                                                                  LEFT JOIN user c on b.usuario=c.id_user

                                          WHERE formula=$idm ";
                                      //echo $sql_master1;
                                    if ($tablasql_master1=$bd1->sub_tuplas($sql_master1)){
                                      foreach ($tablasql_master1 as $fila_sql_master1) {
                                        echo '
                                                <p class="text-danger"><strong>CANCELACION DE FORMULA</strong></p>
                                                <p><strong>Fecha Cancelación:</strong> '.$fila_sql_master1["fecha"].'</p>
                                                <p><strong>Medico responsable:</strong> '.$fila_sql_master1["nombre"].'</p>
                                              </td>';
                                      }
                                    }else {
                                      echo '
                                               <p class="text-danger"><strong>Formula no fue canceladaa</strong></p>
                                             </td>';
                                    }
                                    echo'<td>';
                                    $idm=$fila_sql_master["id_m_fmedhosp"];
                                    $sqldetalle="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
                                                 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula,
                                                 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp,rad_mipres,tipo_mipres,soporte,cod_med,estado_med,
                                                 d.pos

                                          FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
                                                                  left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp
                                                                  left join m_producto d on c.cod_med=d.id_producto

                                          WHERE b.id_m_fmedhosp='".$idm."'";
                                     //echo $sqldetalle;
                                   if ($tablasqldetalle=$bd1->sub_tuplas($sqldetalle)){
                                     foreach ($tablasqldetalle as $fila_sqldetalle) {
                                       $estado_detalle=$fila_sqldetalle['estado_med'];
                                       if ($estado_detalle=='Solicitado') {
                                         echo '<article class="alert alert-info">
                                                <p>'.$fila_sqldetalle["medicamento"].'</p>
                                                <p>'.$fila_sqldetalle["via"].' - '.$fila_sqldetalle["via"].'</p>
                                                <p><strong>D1: </strong>'.$fila_sqldetalle["dosis1"].' - <strong>D2: </strong>'.$fila_sqldetalle["dosis2"].' - <strong>D3: </strong>'.$fila_sqldetalle["dosis3"].' - <strong>D4: </strong>'.$fila_sqldetalle["dosis4"].'</p>
                                               </article>
                                             ';
                                       }else {
                                         echo '<article class="alert alert-danger">
                                                <p>'.$fila_sqldetalle["medicamento"].'</p>
                                                <p>'.$fila_sqldetalle["via"].' - '.$fila_sqldetalle["via"].'</p>
                                                <p><strong>D1: </strong>'.$fila_sqldetalle["dosis1"].' - <strong>D2: </strong>'.$fila_sqldetalle["dosis2"].' - <strong>D3: </strong>'.$fila_sqldetalle["dosis3"].' - <strong>D4: </strong>'.$fila_sqldetalle["dosis4"].'</p>';
                                                $det=$fila_sqldetalle["id_d_fmedhosp"];
                                                $sql_logdetalle="SELECT a.fecha,b.nombre
                                                                 FROM log_detalle_formula a left join user b on a.usuario=b.id_user
                                                                                            left join d_fmedhosp c on c.id_d_fmedhosp=a.medicamento
                                                                 WHERE a.medicamento = $det";
                                                                 if ($tabla_logdetalle=$bd1->sub_tuplas($sql_logdetalle)){
                                                                   foreach ($tabla_logdetalle as $fila_logdetalle) {
                                                                     echo'<p><strong>Responsable Cancelación: </strong>'.$fila_logdetalle["nombre"].' - '.$fila_logdetalle["fecha"].'</p>';
                                                                   }
                                                                 }
                                         echo'</article>';
                                       }


                                     }
                                   }
                                   echo'</td>';
                                echo'</tr>';
                             }
                           }
                           ?>
                          </table>
                        </section>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
              </article>
            </section>
						<section class="panel-body">
							<section class="col-md-12">
								<?php
								date_default_timezone_set('America/Bogota');
								$hora=date('H:i');
								$fecha=date('Y-m-d');
								echo '<article class="col-md-12">
												<h2 class="text-center"><strong class="text-danger">Hora actual: </strong>'.$hora.'  <strong class="text-danger">Fecha actual: </strong>'.$fecha.'</h2>
											</article>';
								 ?>
							</section>
						</section>
						<section class="panel-body">
							<?php
								$idadm=$_GET['idadmhosp'];
								if ($hora > '05:00' && $hora < '9:00') {
									$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
															 b.id_adm_hosp,
															 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
															 d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
															 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi, fadmin, hora_admin ,nom_admin, cant_admin, estado_admin, obs_admin,
															 f.nombre
												FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																				 LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																				 LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																				 LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
																				 LEFT  JOIN user f on (f.id_user=e.resp_adm)

												WHERE b.id_adm_hosp='".$idadm."' and  nom_dosi='6am-8am' and freg_farmacia='".$fecha."' and cant_dosi > 0 ";
							//echo $sql;
									if ($tabla=$bd1->sub_tuplas($sql)){
										foreach ($tabla as $fila) {
											$est_
											?>
											<section class="col-md-12">
												<article class="col-md-12">
													label
												</article>
											</section>
											<?php
										}
									}
								}
							?>
						</section>
            <?php
          }// cierre del isset de documento
           ?>

      </section>
    </section>
</section>
	<?php
}
?>
