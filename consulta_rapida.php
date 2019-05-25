  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav " id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Medicos <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#hc" type="button" ><span class="fa fa-search"> HC</span></a></li>
          <li><a data-toggle="modal" data-target="#evoluciones" type="button" ><span class="fa fa-search">Evoluciones Psiquiatria</span></a></li>
          <li><a data-toggle="modal" data-target="#evolucionesmg" type="button" ><span class="fa fa-search">Evoluciones Medicina general</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav " id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Enfermería <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#busnotas" type="button" ><span class="fa fa-search"> Notas enfermería</span></a></li>
          <li><a  data-toggle="modal" data-target="#signos" type="button" ><span class="fa fa-search"> Signos Vitales</span></a></li>
          <li><a  data-toggle="modal" data-target="#liquidos" type="button" ><span class="fa fa-search"> Liquidos</span></a></li>
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
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Ocupacional <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#valinicioto" type="button" ><span class="fa fa-search"> Valoración inicial</span></a></li>
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
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Resultados <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#lab" type="button" ><span class="fa fa-flask"> Laboratorio Clinico</span></a></li>
        </ul>
      </li>
    </ul>
  </div>
<section >
    <section>
      <section class="modal fade" id="hc" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Historia Clínica Ingreso</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,
                             n.freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,plantratamiento,ddxp,tdxp,ddx1,tdx1,ddx2,tdx2,
                             m.nombre

                             FROM adm_hospitalario a LEFT JOIN hc_hospitalario n on a.id_adm_hosp=n.id_adm_hosp
                                                     LEFT JOIN user m on m.id_user=n.id_user

                             where a.id_adm_hosp='".$id."'";

                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {


                    echo"<tr >\n";
                    echo'<td class="text-center success"><span class="fa fa-calendar"></span><strong> '.$fila["freg_hchosp"].'  '.$fila["hreg_hchosp"].' </strong></td>';
                    echo'<td class="text-center success" colspan="9"><strong>Medico que realiza:</strong> '.$fila["nombre"].'  <span class="fa fa-user-md"> </span><strong>'.$fila["resp_hchosp"].' </strong></td>';
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
                    echo "<tr>";
                    echo'<td class="text-center info" >Diagnostico Principal:</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ddxp"].' -- '.$fila["tdxp"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Diagnostico Relacionado 1:</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ddx1"].' -- '.$fila["tdx1"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Diagnostico Relacionado 2:</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ddx2"].' -- '.$fila["tdx2"].'</td>';
                    echo "</tr>\n";
                    echo "<tr>";
                    echo'<td class="text-center info" >Diagnostico Relacionado 3:</td>';
                    echo'<td colspan="9" class="text-center">'.$fila["ddx3"].' -- '.$fila["tdx3"].'</td>';
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
<section>
  <article >
    <section class="modal fade" id="signos" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Historico de Signos Vitales</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_sv,hreg_sv,tas_s,tad_s,tm_s,fr_s,fc_s,temp_s,spo_s,resp_sv FROM adm_hospitalario a LEFT JOIN signos_vitales n on a.id_adm_hosp=n.id_adm_hosp where a.id_adm_hosp='".$id."' order by n.freg_sv DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><span class="fa fa-calendar"></span> '.$fila["freg_sv"].'</td>';
                  echo'<td class="text-center info">TA Sistólica</td>';
                  echo'<td class="text-center info">TA Diastólica</td>';
                  echo'<td class="text-center info">TA Media</td>';
                  echo'<td class="text-center info" >FR</td>';
                  echo'<td class="text-center info">FC</td>';
                  echo'<td class="text-center info" >TEMP</td>';
                  echo'<td class="text-center info" >SpO</td>';
                  echo'<td class="text-center success"><span class="fa fa-user"></span> Responsable</td>';
                  echo"</tr>";
                  echo "<tr>";
                  echo'<td class="text-center">'.$fila["hreg_sv"].'</td>';
                  echo'<td class="text-center">'.$fila["tas_s"].'</td>';
                  echo'<td class="text-center">'.$fila["tad_s"].'</td>';
                  echo'<td class="text-center">'.$fila["tm_s"].'</td>';
                  echo'<td class="text-center">'.$fila["fr_s"].'</td>';
                  echo'<td class="text-center">'.$fila["fc_s"].'</td>';
                  echo'<td class="text-center">'.$fila["temp_s"].'</td>';
                  echo'<td class="text-center">'.$fila["spo_s"].'</td>';
                  echo'<td class="text-center">'.$fila["resp_sv"].'</td>';
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
  </article>
</section>
<section >
    <section>
      <section class="modal fade" id="evolucionesmg" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Historico de Evoluciones medicas Medicina General</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,max(id_evomed),max(objetivo),
                             max(subjetivo),max(analisis_evomed),max(plan_tratamiento),max(justificacion_hosp),dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
                             u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                      FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user
                      where e.id_adm_hosp='".$_GET["idadmhosp"]."' and u.id_perfil=4
                       group by e.id_adm_hosp,e.freg_evomed,e.hreg_evomed,u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                      ORDER BY freg_evomed DESC";
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
                    echo'<td class="text-left">'.$fila["max(subjetivo)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>OBJETIVO</b></td>';
                    echo'<td class="text-left">'.$fila["max(objetivo)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><b>ANALISIS</b></td>';
                    echo'<td class="text-left">'.$fila["max(analisis_evomed)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>PLAN TRATAMIENTO</b></td>';
                    echo'<td class="text-left">'.$fila["max(plan_tratamiento)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>JUSTIFICACION HOSPITALIZACION</b></td>';
                    echo'<td class="text-left">'.$fila["max(justificacion_hosp)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>DIAGNOSTICO</b></td>';
                    echo'<td class="text-left">
                          <p>'.$fila["dxp"].' -- '.$fila["ddxp"].' -- '.$fila["tdxp"].'</p>
                          <p>'.$fila["dx1"].' -- '.$fila["ddx1"].' -- '.$fila["tdx1"].'/<p>
                          <p>'.$fila["dx2"].' -- '.$fila["ddx2"].' -- '.$fila["tdx2"].'/<p></td>';
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
      <section class="modal fade" id="evoluciones" role="dialog">
        <section class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Historico de Evoluciones medicas Psiquiatria</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,max(id_evomed),max(objetivo),
                             max(subjetivo),max(analisis_evomed),max(plan_tratamiento),max(justificacion_hosp),dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
                             u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                      FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user
                      where e.id_adm_hosp='".$_GET["idadmhosp"]."' and u.id_perfil=3
                      group by e.id_adm_hosp,e.freg_evomed,e.hreg_evomed,u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                      ORDER BY freg_evomed DESC";
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
                    echo'<td class="text-left">'.$fila["max(subjetivo)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>OBJETIVO</b></td>';
                    echo'<td class="text-left">'.$fila["max(objetivo)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><b>ANALISIS</b></td>';
                    echo'<td class="text-left">'.$fila["max(analisis_evomed)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>PLAN TRATAMIENTO</b></td>';
                    echo'<td class="text-left">'.$fila["max(plan_tratamiento)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>JUSTIFICACION HOSPITALIZACION</b></td>';
                    echo'<td class="text-left">'.$fila["max(justificacion_hosp)"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>DIAGNOSTICO</b></td>';
                    echo'<td class="text-left">
                          <p>'.$fila["dxp"].' -- '.$fila["ddxp"].' -- '.$fila["tdxp"].'</p>
                          <p>'.$fila["dx1"].' -- '.$fila["ddx1"].' -- '.$fila["tdx1"].'/<p>
                          <p>'.$fila["dx2"].' -- '.$fila["ddx2"].' -- '.$fila["tdx2"].'/<p></td>';
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
                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evo_psico,hreg_evo_psico,obj_sesion,actividades,resultado,obs_evo_psico,resp_evo_psico FROM adm_hospitalario a LEFT JOIN evo_psicologia n on a.id_adm_hosp=n.id_adm_hosp where a.id_adm_hosp='".$id."' order by n.freg_evo_psico DESC ";

                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><span class="fa fa-calendar"></span><strong> '.$fila["freg_evo_psico"].' '.$fila["hreg_evo_psico"].'</strong></td>';
                    echo'<td class="text-center danger"><span class="fa fa-user-md"></span><strong> '.$fila["resp_evo_psico"].'</strong></td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><strong>TIPO SESIÓN</strong></td>';
                    echo'<td class="text-left">'.$fila["tipo_sesion"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><strong>OBJETIVO SESIÓN</strong></td>';
                    echo'<td class="text-left">'.$fila["obj_sesion"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><strong>ACTIVIDADES</strong></td>';
                    echo'<td class="text-left">'.$fila["actividades"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><strong>RESULTADOS</strong></td>';
                    echo'<td class="text-left">'.$fila["resultado"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><strong>OSERVACIONES</strong></td>';
                    echo'<td class="text-left">'.$fila["obs_evo_psico"].'</td>';
                    echo '</tr>';
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
                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.id_valini_psico,freg_valini_psico,hreg_valini_hosp,motivo_hosp,conducta_personal,hipo_predisposicion,hipo_adquisicion,hipo_mantenimiento,estado_valini_psico,resp_valini_psico FROM adm_hospitalario a LEFT JOIN valini_psicologia n on a.id_adm_hosp=n.id_adm_hosp where a.id_adm_hosp='".$id."' order by n.freg_valini_psico DESC";

                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><span class="fa fa-calendar"></span> '.$fila["freg_valini_psico"].' '.$fila["hreg_valini_psico"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info">Motivo Hospitalización:</td>';
                    echo'<td class="text-left">'.$fila["motivo_hosp"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Conducta Problema:</td>';
                    echo'<td class="text-left">'.$fila["conducta_personal"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info">Hipótesis de predisposición:</td>';
                    echo'<td class="text-left">'.$fila["hipo_predisposicion"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Hipótesis de adquisición:</td>';
                    echo'<td class="text-left">'.$fila["hipo_adquisicion"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" >Hipótesis de mantenimiento:</td>';
                    echo'<td class="text-left">'.$fila["hipo_mantenimiento"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center success"><span class="fa fa-user"></span> Responsable</td>';
                    echo'<td class="text-center">'.$fila["resp_valini_psico"].'</td>';
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
<section>
  <section class="modal fade" id="valinicioto" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Valoración Inicial Terapia Ocupacional</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_toce_sm, freg_toce_sm, hreg_toce_sm, evaluacion_to,
                          concepto_to, dx_to, plan_intervencion, recomendaciones_to, estado_toce_sm,
                         u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                  FROM toce_sm e LEFT JOIN user u on e.id_user=u.id_user
                  where e.id_adm_hosp=$id order by 4 DESC";
              //echo $sql;
            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_toce_sm"].' '.$fila["hreg_toce_sm"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>VALORACION INICIAL TERAPIA OCUPACIONAL</b></td>';
                echo'<td class="text-left">Evaluación Ocupacional: </td>';
                echo'<td class="text-left text-">'.$fila["evaluacion_to"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Concepto Ocupacional: </td>';
                echo'<td class="text-left text-">'.$fila["concepto_to"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Diagnostico Ocupacional: </td>';
                echo'<td class="text-left text-">'.$fila["dx_to"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Plan intervención: </td>';
                echo'<td class="text-left text-">'.$fila["plan_intervencion"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"></td>';
                echo'<td class="text-left">Recomendaciones:</td>';
                echo'<td class="text-left text-">'.$fila["recomendaciones_to"].'</td>';
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
              $sql="SELECT e.id_adm_hosp,freg_evoto,hreg_evoto,evolucion_to,
                           u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                    FROM evo_to e LEFT JOIN user u on e.id_user=u.id_user
                    where e.id_adm_hosp='".$_GET["idadmhosp"]."' ORDER BY freg_evoto DESC, hreg_evoto ASC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evoto"].' '.$fila["hreg_evoto"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION TERAPIA OCUPACIONAL</b></td>';
                  echo'<td class="text-left">'.$fila["evolucion_to"].'</td>';
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
            $sql="SELECT e.id_adm_hosp,freg_nota,hreg_nota,descripnota,u.cuenta,nombre,doc,rm_profesional,especialidad,firma FROM nota_enfermeria e LEFT JOIN user u on e.id_user=u.id_user  where e.id_adm_hosp='".$_GET["idadmhosp"]."' order by 2 DESC";

            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_nota"].' '.$fila["hreg_nota"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>NOTA DE ENFERMERIA</b></td>';
                echo'<td class="text-left">'.$fila["descripnota"].'</td>';
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
          <h4 class="modal-title" >Valoración Inicial Trabajo social</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_tsce_sm, id_adm_hosp, freg_tsce_sm, hreg_tsce_sm, tipo_atencion, h_familiar, estudio_socio, concepto_ts, recomendaciones, estado_tsce_sm,
                         u.cuenta,nombre,doc,rm_profesional,especialidad,firma
                  FROM tsce_sm e LEFT JOIN user u on e.id_user=u.id_user
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
  <section class="modal fade" id="evots" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Historico de Evoluciones Trabajo social</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT e.id_adm_hosp,freg_evots,hreg_evots,evolucion_ts,u.cuenta,nombre,doc,rm_profesional,especialidad,firma FROM evo_ts e LEFT JOIN user u on e.id_user=u.id_user  where e.id_adm_hosp='".$_GET["idadmhosp"]."' order by 2 DESC";

            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evots"].' '.$fila["hreg_evots"].'</strong></td>';
                echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info"><b>EVOLUCION TRABAJO SOCIAL</b></td>';
                echo'<td class="text-left">'.$fila["evolucion_ts"].'</td>';
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
<section>
  <section class="modal fade" id="lab" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Resultados Laboratorios</h4>
        </div>
        <div class="modal-body">
          <table class="table table-responsive table-bordered">

            <tr>
              <th class="text-center info">ID</th>
              <th class="text-center info">FECHA REGISTRO</th>
              <th class="text-center info">ESTADO ORDEN</th>
              <th colspan="2" class="text-center"></th>
            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){
            $idpaciente=$_GET["idadmhosp"];
            $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
                         b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
                         c.nombre,
                         d.archivo

                  FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
                                          left join user c on c.id_user=b.id_user
                                          left join soportes_lab d on d.id_master_prod=b.id_master_prod

                  WHERE a.id_adm_hosp='".$idpaciente."'  order by fecha_orden DESC";
                //echo $sql;
            if ($tabla=$bd1->sub_tuplas($sql)){
              foreach ($tabla as $fila ) {
                  if ($fila['estado_orden']=='Solicitado') {
                      echo"<tr >\n";
                      echo'<td class="text-left"><strong>ADM: </strong>'.$fila["id_adm_hosp"].'<br> <strong>M: </strong>'.$fila["id_master_prod"].'</td>';
                      $id=$fila["id_master_prod"];
                      echo'<td class="text-left">
                            <p><strong>Fecha: </strong>'.$fila["fecha_orden"].'</p>
                            <p><strong>Servicio: </strong>'.$fila["servicio"].'</p>
                            <p><strong>Atención: </strong>'.$fila["tipo_atencion"].'</p>
                            <p class="alert alert-info"><strong >Estado: </strong>'.$fila["estado_orden"].'</p>
                           </td>';
                      echo'<th class="text-left">
                            <button data-toggle="collapse" class="btn btn-primary text-center" data-target="#vh'.$fila['id_master_prod'].'">Ver procedimientos agregados<span class="glyphicon glyphicon-arrow-down"></span> </button>
                            <section id="vh'.$fila['id_master_prod'].'" class="collapse">
                            <table class="table table-bordered">
                            <tr>
                              <td>PROCEDIMIENTO</td>
                              <td>ESTADO</td>
                            </tr>
                              ';
                              $sqld = "SELECT id_d_procedimiento, id_master_prod, freg, cod_cups, procedimiento, observacion, estado_prod, freg_muestra, resp_muestra, obs_muestra,
                                             freg_procesa, resp_procesa, obs_procesa, freg_inter, nota_inter, resp_inter
                                      FROM detalle_procedimiento
                                      WHERE id_master_prod=$id";
                              if ($tablad=$bd1->sub_tuplas($sqld)){
                                  foreach ($tablad as $filad ) {
                                    if ($filad['estado_prod']=='Solicitado') {
                                      echo '<tr>';
                                      echo '<td class="fuente_proced info">'.$filad['procedimiento'].'</td>';
                                      echo '<td class="fuente_proced info"><span class="fa fa-pause fa-2x text-danger"></span>Pendiente por TOMA DE MUESTRA</td>';
                                      echo '</tr>';
                                    }
                                    if ($filad['estado_prod']=='Muestra') {
                                      echo '<tr>';
                                      echo '<td class="fuente_proced danger">'.$filad['procedimiento'].'</td>';
                                      echo '<td class="fuente_proced danger"><span class="fa fa-spinner fa-pulse fa-2x text-danger"></span>Pendiente por PROCESAR</td>';

                                      echo '</tr>';
                                    }
                                    if ($filad['estado_prod']=='Procesada') {
                                      echo '<tr>';
                                      echo '<td class="fuente_proced success">'.$filad['procedimiento'].'</td>';
                                      echo '<td class="fuente_proced success">';
                                             $inter=$filad['procedimiento'];
                                             if ($inter=='') {
                                               echo'<p>No hay registro de interpretacion</p>';
                                             }else {
                                               echo'<p>'.$filad['nota_inter'].'</p>';
                                             }
                                      echo'</td>';
                                            $prod=$filad['id_d_procedimiento'];
                                            $sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
                                                       b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
                                                       c.nombre,
                                                       d.archivo

                                                FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
                                                                        left join user c on c.id_user=b.id_user
                                                                        left join soportes_lab d on d.id_master_prod=b.id_master_prod

                                                WHERE d.archivo like '%$prod%'  order by fecha_orden DESC";
                                                if ($tablas=$bd1->sub_tuplas($sqls)){
                                                   foreach ($tablas as $filas ) {
                                                    echo'<th class="text-center success" ><a href="'.$filas['archivo'].'" data-toggle="popover" title="Soporte individual de laboratorio" data-content="Some content inside the popover" target="_blank"><button type="button" class="btn btn-primary" ><span class="fa fa-flask"></span></button></a></th>';
                                                  }
                                                }
                                      echo '</tr>';
                                    }
                                  }
                              }
                      echo'</table></section>
                            </th>';
                            $fecha=date('Y-m-d');
                      echo'<th class="text-center" >
                            <p><a href="'.$fila['archivo'].'" target="_blank"><button type="button" class="btn btn-success" ><span class="fa fa-eye"></span> Ver soportes</button></a></p>
                           </th>';
                      echo "</tr>\n";
                  }
                }
              }else {
                $doc=$_REQUEST['doc'];
                echo"<tr >\n";
                echo'<td colspan="8" class="text-center"><h2 class="alert alert-danger text-center">No existen Ordenes de servicio creadas en admisión '.$fila['id_adm_hosp'].'</h2></th>';
                echo "</tr>\n";
              }
            }
            ?>
          </table>
        </div>

      </div>
    </section>
  </section>
</section>
