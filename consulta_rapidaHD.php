
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <ul class="nav navbar-nav " id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Medicos <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#hc" type="button" ><span class="fa fa-search"> HC</span></a></li>
          <li><a data-toggle="modal" data-target="#evoluciones" type="button" ><span class="fa fa-search">Evoluciones </span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav " id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Enfermería <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#busnotas" type="button" ><span class="fa fa-search"> Notas enfermería</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Psicológia <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#vipsico" type="button" ><span class="fa fa-search"> Valoración inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evopsico" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Terapia Ocupacional <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#vinicialto" type="button" ><span class="fa fa-search"> Valoración inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evoto" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Trabajo Social <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#valinits" type="button" ><span class="fa fa-search"> Valoración inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evots" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Nutrición <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#valininutri" type="button" ><span class="fa fa-search"> Valoración inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evonutri" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>

  </div>
</article>
<section >
    <section>
      <section class="modal fade" id="hc" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Historia Clínica </h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                
                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,
                n.freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,plantratamiento,
                m.nombre,m.especialidad esp
                FROM adm_hospitalario a LEFT JOIN hc_hospdia n on a.id_adm_hosp=n.id_adm_hosp
                                        left join user m on m.id_user=n.id_user

                where a.id_adm_hosp='".$id."' ";

                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila) {


                    echo"<tr >\n";
                    echo'<td class="text-center success"><span class="fa fa-calendar"></span><strong> '.$fila["freg_hchosp"].'  '.$fila["hreg_hchosp"].' </strong></td>';
                    echo'<td class="text-center success" colspan="9"><span class="fa fa-user-md"> </span><strong>'.$fila["nombre"].' '.$fila["especialidad"].' </strong></td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td colspan="10" class="text-center danger">ANAMNESIS</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo'<td colspan="5" class="text-center info">Motivo de Consulta</td>';
                    echo'<td colspan="5" class="text-center info" >Enfermedad Actual</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td colspan="5" class="text-center">'.$fila["motivo_consulta"].'</td>';
                    echo'<td colspan="5" class="text-left">'.$fila["enfer_actual"].'</td>';
                    echo "</tr>\n";
                    echo '<tr>';
                    echo'<td colspan="5" class="text-center info">Historia Personal</td>';
                    echo'<td colspan="5" class="text-center info" >Historia Familiar</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td colspan="5" class="text-center">'.$fila["his_personal"].'</td>';
                    echo'<td colspan="5" class="text-left">'.$fila["his_familiar"].'</td>';
                    echo "</tr>\n";
                    echo '<tr>';
                    echo'<td colspan="10" class="text-center info">Personalidad Premorbida</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td colspan="10" class="text-center">'.$fila["perso_premorbida"].'</td>';
                    echo "</tr>\n";
                    echo"<tr >\n";
                    echo'<td colspan="10" class="text-center danger">ANTECEDENTES PERSONALES</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo'<td class="text-center info">Alergicos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_alergicos"].'</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td class="text-center info" >Psiquiatricos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_psiquiatrico"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Patológicos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_patologico"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Quirurgicos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_quirurgico"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Toxicológicos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_toxicologico"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Farmacológicos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_farmaco"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Hospitalarios</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_hospitalario"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Gineco-Obstetricos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_gineco"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Traumatológicos</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_traumatologico"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Familiares</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ant_familiar"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Otros Antecedentes</td>';
                      echo'<td colspan="9" class="text-center">'.$fila["otros_ant"].'</td>';
                    echo "</tr>\n";
                    echo"<tr >\n";
                    echo'<td colspan="10" class="text-center danger">EXAMEN FÍSICO</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo'<td class="text-center info">TAS</td>';
                    echo'<td class="text-center info" >TAD</td>';
                    echo'<td class="text-center info" >TAM</td>';
                    echo'<td class="text-center info" >FC</td>';
                    echo'<td class="text-center info" >FR</td>';
                    echo'<td class="text-center info" >SAO2</td>';
                    echo'<td class="text-center info" >PESO</td>';
                    echo'<td class="text-center info" >TALLA</td>';
                    echo'<td class="text-center info" >TEMP</td>';
                    echo'<td class="text-center info" >IMC</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td class="text-center info">'.$fila["tas"].'</td>';
                    echo'<td class="text-center info" >'.$fila["tad"].'</td>';
                    echo'<td class="text-center info" >'.$fila["tam"].'</td>';
                    echo'<td class="text-center info" >'.$fila["fc"].'</td>';
                    echo'<td class="text-center info" >'.$fila["fr"].'</td>';
                    echo'<td class="text-center info" >'.$fila["so"].'</td>';
                    echo'<td class="text-center info" >'.$fila["peso"].'</td>';
                    echo'<td class="text-center info" >'.$fila["talla"].'</td>';
                    echo'<td class="text-center info" >'.$fila["temperatura"].'</td>';
                    echo'<td class="text-center info" >'.$fila["imc"].'</td>';
                    echo "</tr>\n";
                    echo"<tr >\n";
                    echo'<td colspan="10" class="text-center danger">EXPLORACIÓN GENERAL Y REGIONAL</td>';
                    echo '</tr>';
                    echo "<tr>";
                    echo'<td class="text-center info" >Estado General</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["estado_general"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Cabeza y Cuello</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["cabcuello"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Torax</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["torax"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Abdomen</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["abdomen"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Genitourinario</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["genitourinario"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Extremidades</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ext"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Neurologico</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["neurologico"].'</td>';
                    echo "</tr>\n";
                    echo"<tr >\n";
                    echo'<td colspan="10" class="text-center danger">Examen Mental y Analisis</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo'<td colspan="5" class="text-center info">Examen Mental</td>';
                    echo'<td colspan="5" class="text-center info" >Analisis</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td colspan="5" class="text-center">'.$fila["examen_mental"].'</td>';
                    echo'<td colspan="5" class="text-left">'.$fila["analisis"].'</td>';
                    echo "</tr>\n";
                    echo '<tr>';
                    echo'<td colspan="10" class="text-center info">Plan tratamiento</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td colspan="10" class="text-left">'.$fila["plantratamiento"].'</td>';
                    echo "</tr>\n";
                  }
                }
              }
                ?>
              </table>
            </div>

          </div>
        </section>
      </section>
    </section>
</section>

<section >
    <section>
      <section class="modal fade" id="evoluciones" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Historico de Evoluciones medicas</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT e. id_adm_hosp,freg_evomed, hreg_evomed, objetivo, subjetivo, analisis_evomed, plan_tratamiento,dxp, ddxp, tdxp, dx1, ddx1, tdx1, dx2, ddx2, tdx2, estado_evomed,u.cuenta,nombre,doc,rm_profesional,especialidad,firma FROM evo_medhd e LEFT JOIN user u on e.id_user=u.id_user  where e.id_adm_hosp='".$_GET["idadmhosp"]."' ORDER BY freg_evomed DESC";
                  //echo $sql;
                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evomed"].' '.$fila["hreg_evomed"].'</strong></td>';
                    echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                    echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><b>SUBJETIVO</b></td>';
                    echo'<td class="text-left">'.$fila["subjetivo"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>OBJETIVO</b></td>';
                    echo'<td class="text-left">'.$fila["objetivo"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><b>ANALISIS</b></td>';
                    echo'<td class="text-left">'.$fila["analisis_evomed"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>PLAN TRATAMIENTO</b></td>';
                    echo'<td class="text-left">'.$fila["plan_tratamiento"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>DIAGNÓSTICO</b></td>';
                    echo'<td class="text-left">'.$fila["ddxp"].' -- '.$fila["tdxp"].'</td>';
                    echo '</tr>';
                  }
                }
              }
                ?>
              </table>
            </div>

          </div>
        </section>
      </section>
    </section>
</section>
<section >
    <section>
      <section class="modal fade" id="evopsico" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Historico de Evoluciones Psicologia</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT e.id_adm_hosp id,e.freg_evo_psico fecha,e.hreg_evo_psico hora,concat('TIPO SESION: ',e.tipo_sesion,' \nOBJETIVO SESION: ', e.obj_sesion,' \nACTIVIDADES: ', e.actividades,' \nRESULTADO:', e.resultado,' \nOBSERVACION: ', e.obs_evo_psico) evolucion,
                             u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                      FROM evo_psicologia e LEFT JOIN user u on e.id_user=u.id_user
                      WHERE e.id_adm_hosp='".$_GET["idadmhosp"]."'

                      UNION
                      SELECT e.id_adm_hosp id,e.freg_evohd fecha,e.hreg_evohd hora,e.evolucion_hd evolucion,
                                   u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                            FROM evo_psicohd_sm e LEFT JOIN user u on e.id_user=u.id_user
                            WHERE e.id_adm_hosp='".$_GET["idadmhosp"]."'

                      order by fecha DESC, hora ASC";

                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><span class="fa fa-calendar"></span><strong> '.$fila["fecha"].' '.$fila["hora"].'</strong></td>';
                    echo'<td class="text-center danger"><span class="fa fa-user-md"></span><strong> '.$fila["nombre"].'</strong></td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><strong>EVOLUCIÓN PSICOLOGIA</strong></td>';
                    echo'<td class="text-left">'.$fila["evolucion"].'</td>';
                    echo"<tr >\n";
                  }
                }
              }
                ?>
              </table>
            </div>
          </div>
        </section>
      </section>
    </section>
</section>
<section >
    <section>
      <section class="modal fade" id="vipsico" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Valoración inicial Psicologia</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_psicoce_sm, hreg_psicoce_sm,m_consulta,h_personal_familiar,evaluacion_psicologica,analisis_caso,recomendaciones,plan_tratamiento,estado_psicoce_sm,u.nombre FROM adm_hospitalario a LEFT JOIN psicohd_sm n on a.id_adm_hosp=n.id_adm_hosp LEFT JOIN user u on a.id_adm_hosp=u.id_adm_hosp where a.id_adm_hosp='".$id."' order by n.freg_psicoce_sm DESC";

                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><span class="fa fa-calendar"></span> '.$fila["freg_psicoce_sm"].' '.$fila["hreg_psicoce_sm"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info">Motivo de consulta:</td>';
                    echo'<td class="text-left">'.$fila["m_consulta"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Historia Familiar y Personal:</td>';
                    echo'<td class="text-left">'.$fila["h_personal_familiar"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info">Evaluación psicologica:</td>';
                    echo'<td class="text-left">'.$fila["evaluacion_psicologica"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Analisis del caso:</td>';
                    echo'<td class="text-left">'.$fila["analisis_caso"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Recomendaciones:</td>';
                    echo'<td class="text-left">'.$fila["recomendaciones"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Plan de tratamiento:</td>';
                    echo'<td class="text-left">'.$fila["plan_tratamiento"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center success"><span class="fa fa-user"></span> Responsable</td>';
                    echo'<td class="text-center">'.$fila["nombre"].'</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td class="text-center"></td>';
                    echo "</tr>\n";
                  }
                }
              }
                ?>
              </table>
            </div>
          </div>
        </section>
      </section>
    </section>
</section>

<section >
    <section>
      <section class="modal fade" id="vinicialto" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Valoración inicial Terapia Ocupacional</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,
                             n.id_toce_sm,  freg_toce_sm, hreg_toce_sm, evaluacion_to, concepto_to, dx_to, plan_intervencion, recomendaciones_to, estado_toce_sm ,
                             u.nombre
                      FROM adm_hospitalario a LEFT JOIN tohd_sm n on a.id_adm_hosp=n.id_adm_hosp
                                              LEFT JOIN user u on n.id_user=u.id_user
                      WHERE a.id_adm_hosp='".$id."'

                      ORDER BY n.freg_toce_sm DESC";
  //echo $sql;
                if ($tabla=$bd1->sub_tuplas($sql)){

                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><span class="fa fa-calendar"></span> '.$fila["freg_toce_sm"].' '.$fila["hreg_toce_sm"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info">Evaluación Ocupacional: </td>';
                    echo'<td class="text-left">'.$fila["evaluacion_to"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Concepto Ocupacional: </td>';
                    echo'<td class="text-left">'.$fila["concepto_to"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info">Diagnostico Ocupacional:</td>';
                    echo'<td class="text-left">'.$fila["dx_to"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Plan intervención:</td>';
                    echo'<td class="text-left">'.$fila["plan_intervencion"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Recomendaciones:</td>';
                    echo'<td class="text-left">'.$fila["recomendaciones_to"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center success"><span class="fa fa-user"></span> Responsable</td>';
                    echo'<td class="text-center">'.$fila["nombre"].'</td>';
                    echo"</tr>";
                    echo "<tr>";
                    echo'<td class="text-center"></td>';
                    echo "</tr>\n";
                  }
                }
              }
                ?>
              </table>
            </div>
          </div>
        </section>
      </section>
    </section>
</section>
<section >
  <section>
    <section class="modal fade" id="evoto" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Historico de Evoluciones Terapia ocupacional</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT e.id_adm_hosp id,e.freg_evoto fecha,e.hreg_evoto hora,e.evolucion_to evolucion,
                           u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                    FROM evo_tohd_sm e LEFT JOIN user u on e.id_user=u.id_user
                    WHERE e.id_adm_hosp='".$_GET["idadmhosp"]."'

                    UNION
                    SELECT e.id_adm_hosp id,e.freg_evoto fecha,e.hreg_evoto hora,e.evolucion_to evolucion,
                                 u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                          FROM evo_to e LEFT JOIN user u on e.id_user=u.id_user
                          WHERE e.id_adm_hosp='".$_GET["idadmhosp"]."'

                    order by fecha DESC, hora ASC";
              //echo $sql;
              if ($tabla=$bd1->sub_tuplas($sql)){

                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["fecha"].' '.$fila["hora"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION TERAPIA OCUPACIONAL</b></td>';
                  echo'<td class="text-left">'.$fila["evolucion"].'</td>';
                  echo '</tr>';
                }
              }
            }
              ?>
            </table>
          </div>

        </div>
      </section>
    </section>
  </section>
</section>

<section>
  <section class="modal fade" id="busnotas" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Historico de Notas de Enfermería</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_notahd, id_adm_hosp, freg_notahd, hreg_notahd, notahd, estado_notahd, resp_notahd,
                         u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                  FROM nota_hd_sm e LEFT JOIN user u on e.id_user=u.id_user
                  WHERE e.id_adm_hosp='".$_GET["idadmhosp"]."' ORDER BY 2 DESC";

            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_notahd"].' '.$fila["hreg_notahd"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>REGISTRO DE ENFERMERIA</b></td>';
                echo'<td class="text-left">'.$fila["notahd"].'</td>';
                echo '</tr>';

              }
            }
          }
            ?>
          </table>
        </div>

      </div>
    </section>
  </section>
</section>

<section>
  <section class="modal fade" id="evots" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Historico de Evoluciones Trabajo social Hospital dia</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_evohd, id_adm_hosp, freg_evohd, hreg_evohd, evolucion_hd, estado_evohd,
                         u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                  FROM evo_tshd_sm e LEFT JOIN user u on e.id_user=u.id_user
                  where e.id_adm_hosp=$id order by 4 DESC";
              //echo $sql;
            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evohd"].' '.$fila["hreg_evohd"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>EVOLUCION TRABAJO SOCIAL</b></td>';
                echo'<td class="text-left">'.$fila["evolucion_hd"].'</td>';
                echo'<td class="text-left text-">ID: '.$fila["id_evohd"].'</td>';
                echo '</tr>';
              }
            }
          }
            ?>
          </table>
        </div>
      </div>
    </section>
  </section>
</section>

<section>
  <section class="modal fade" id="valinits" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Valoración Inicial Trabajo social Hospital Dia</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_tsce_sm, id_adm_hosp, freg_tsce_sm, hreg_tsce_sm, tipo_atencion, h_familiar, estudio_socio, analisis, concepto_ts, recomendaciones, estado_tsce_sm,
                         u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                  FROM tshd_sm e LEFT JOIN user u on e.id_user=u.id_user
                  where e.id_adm_hosp=$id order by 4 DESC";
              //echo $sql;
            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_tsce_sm"].' '.$fila["hreg_tsce_sm"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>VALORACION INICIAL TRABAJO SOCIAL</b></td>';
                echo'<td class="text-left">Tipo atención:</td>';
                echo'<td class="text-left text-">'.$fila["tipo_atencion"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Historia familiar:</td>';
                echo'<td class="text-left text-">'.$fila["h_familiar"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Estudio socioeconomico:</td>';
                echo'<td class="text-left text-">'.$fila["estudio_socio"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Analisis:</td>';
                echo'<td class="text-left text-">'.$fila["analisis"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Concepto:</td>';
                echo'<td class="text-left text-">'.$fila["concepto_ts"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Recomendaciones:</td>';
                echo'<td class="text-left text-">'.$fila["recomendaciones"].'</td>';
                echo '</tr>';
              }
            }
          }
            ?>
          </table>
        </div>
      </div>
    </section>
  </section>
</section>

<section>
  <section class="modal fade" id="evonutri" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Historico de Evoluciones Nutricion</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_adm_hosp,freg_nutrice_sm,hreg_nutrice_sm,evolucion_nutri,u.cuenta,nombre,doc,rm_profesional,especialidad,firma FROM evo_nutrism e LEFT JOIN user u on e.id_user=u.id_user  where e.id_adm_hosp='".$_GET["idadmhosp"]."' order by 2 DESC";

            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_nutrice_sm"].' '.$fila["hreg_nutrice_sm"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>EVOLUCION NUTRICION</b></td>';
                echo'<td class="text-left">'.$fila["evolucion_nutri"].'</td>';
                echo '</tr>';

              }
            }
          }
            ?>
          </table>
        </div>

      </div>
    </section>
  </section>
</section>
<section>
  <section class="modal fade" id="valininutri" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Valoración por Nutrición</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_nutri,hreg_nutri,motivo_nutri,val_nutricional,dx_nutricional,plan_nutricional FROM adm_hospitalario a LEFT JOIN val_nutricion n on a.id_adm_hosp=n.id_adm_hosp where a.id_adm_hosp='".$id."' order by n.freg_nutri DESC";

            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {

                echo"<tr >\n";
                echo'<td class="text-center danger"><span class="fa fa-calendar"></span><strong> '.$fila["freg_nutri"].' '.$fila["hreg_nutri"].' </strong></td>';
                echo'<td class="text-center danger"><span class="fa fa-user-md">  </span><strong> '.$fila["resp_nutri"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><strong>Motivo Consulta:</strong></td>';
                echo'<td class="text-left">'.$fila["motivo_nutri"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info" ><strong>Valoración nutricional:</strong></td>';
                echo'<td class="text-left">'.$fila["val_nutricional"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><strong>Diagnostico nutricional:</strong></td>';
                echo'<td class="text-left">'.$fila["dx_nutricional"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><strong>Plan nutricional:</strong></td>';
                echo'<td class="text-left">'.$fila["plan_nutricional"].'</td>';
                echo '</tr>';

              }
            }
          }
            ?>
          </table>
        </div>

      </div>
    </section>
  </section>
</section>
