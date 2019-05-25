
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav " id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Valoraciones <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#hc" type="button" ><span class="fa fa-search"> HC</span></a></li>
          <li><a data-toggle="modal" data-target="#evoluciones" type="button" ><span class="fa fa-search">Val </span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav " id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Psicologia <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#vipsico" type="button" ><span class="fa fa-search"> Valoracion inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evopsico" type="button" ><span class="fa fa-search"> Psicologia</span></a></li>

        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Fisioterapia <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#vifisio" type="button" ><span class="fa fa-search"> Valoracion inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evofisio" type="button" ><span class="fa fa-search"> Evoluciones Fisioterapia</span></a></li>

        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Ocupacional <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#vinicialto" type="button" ><span class="fa fa-search"> Valoracion inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evoto" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Fonoaudiologia <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#valfono" type="button" ><span class="fa fa-search"> Valoracion inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evofono" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav" id="barra">
      <li class="dropdown">
        <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Respiratoria <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  data-toggle="modal" data-target="#valtr" type="button" ><span class="fa fa-search"> Valoracion inicial</span></a></li>
          <li><a  data-toggle="modal" data-target="#evotr" type="button" ><span class="fa fa-search"> Evoluciones</span></a></li>
        </ul>
      </li>
    </ul>
  </div>
<section>
  <article >
    <section class="modal fade" id="evopsico" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Psicologia</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evopsico_dom, hreg_evopsico_dom, hreg_regpsico_dom, hfin_evopsico_dom, estado_evopsico_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_psico_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evopsico_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evopsico_dom"].' '.$fila["hreg_evopsico_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evolucionpsico_dom"].'</td>';
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
  </article>
</section>

<section>
  <article >
    <section class="modal fade" id="evotap" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones TAP</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evotap_dom, hreg_evotap_dom, evoluciontap_dom, estado_evotap_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_tap_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evotap_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evotap_dom"].' '.$fila["hreg_evotap_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evoluciontap_dom"].'</td>';
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
  </article>
</section>

<section>
  <article >
    <section class="modal fade" id="evopsicocog" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Psicologia Cognitiva</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evopsicocog_dom, hreg_evopsicocog_dom, evolucionpsicocog_dom, estado_evopsicocog_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_psicocog_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evopsicocog_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evopsicocog_dom"].' '.$fila["hreg_evopsicocog_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evolucionpsicocog_dom"].'</td>';
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
  </article>
</section>

<section>
  <article >
    <section class="modal fade" id="evofisio" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Fisioterapia</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evofisio_dom, hreg_evofisio_dom, hreg_regfisio_dom, hfin_evofisio_dom, evolucionfisio_dom, estado_evofisio_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_fisio_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evofisio_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evofisio_dom"].' '.$fila["hreg_evofisio_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';

                  echo'<td class="text-left">'.$fila["evolucionfisio_dom"].'</td>';
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
  </article>
</section>



<section>
  <article >
    <section class="modal fade" id="evoto" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Terapia Ocupacional</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evoto_dom, hreg_evoto_dom, hreg_regto_dom, hfin_evoto_dom, evolucionto_dom, estado_evoto_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_to_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evoto_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evoto_dom"].' '.$fila["hreg_evoto_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evolucionto_dom"].'</td>';
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
  </article>
</section>

<section>
  <article >
    <section class="modal fade" id="evofono" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Fonoaudiologia</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evofono_dom,hreg_evofono_dom, hreg_regfono_dom, hfin_evofono_dom, evolucionfono_dom, estado_evofono_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_fono_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evofono_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evofono_dom"].' '.$fila["hreg_evofono_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evolucionfono_dom"].'</td>';
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
  </article>
</section>

<section>
  <article >
    <section class="modal fade" id="evotr" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Terapia Respiratoria</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.freg_evotr_dom,hreg_evotr_dom, hreg_regtr_dom, hfin_evotr_dom, evoluciontr_dom, estado_evotr_dom,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_tr_dom n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' order by n.freg_evotr_dom DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evotr_dom"].' '.$fila["hreg_evotr_dom"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evoluciontr_dom"].'</td>';
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
  </article>
</section>
