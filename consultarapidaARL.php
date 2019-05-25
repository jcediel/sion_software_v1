<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav " id="barra">
    <li class="dropdown">
      <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Historico de Evoluciones <span class="caret"></span></button>
      <ul class="dropdown-menu">

        <li><a data-toggle="modal"  data-target="#evoto" type="button" ><span class="fa fa-search">Evoluciones</span></a></li>
      </ul>
    </li>
  </ul>
</div>
<?php
$mes= date('m') ;
$y=date('Y');
if ($mes==1) {
$f1='2017-01-01';
$f2='2017-01-31';
}
if ($mes==2) {
  $f1=$y.'-01-01';
  $f2=$y.'-02-31';
  }
  if ($mes==3) {
    $f1=$y.'-02-01';
    $f2=$y.'-03-31';
    }
    if ($mes==4) {
      $f1=$y.'-03-01';
      $f2=$y.'-04-31';
      }
      if ($mes==5) {
        $f1=$y.'-04-01';
        $f2=$y.'-05-31';
        }
        if ($mes==6) {
          $f1=$y.'-05-01';
          $f2=$y.'-06-31';
          }
          if ($mes==7) {
            $f1=$y.'-06-01';
            $f2=$y.'-07-31';
            }
            if ($mes==8) {
              $f1=$y.'-07-01';
              $f2=$y.'-08-31';
              }
              if ($mes==9) {
                $f1=$y.'-08-01';
                $f2=$y.'-09-31';
                }
                if ($mes==10) {
                  $f1=$y.'-09-01';
                  $f2=$y.'-10-31';
                  }
                  if ($mes==11) {
                    $f1=$y.'-10-01';
                    $f2=$y.'-11-31';
                    }
                    if ($mes==12) {
                      $f1=$y.'-11-01';
                      $f2=$y.'-12-31';
                      }

?>
<!-- consulta rapida TERAPIA OCUPACIONAL -->
<section>
<article >
  <section class="modal fade" id="evoto" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Historico de Evoluciones </h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idadmhosp"])){

            $id=$_REQUEST["idadmhosp"];
            $sql="SELECT a.id_adm_hosp,n.id_evoarl,freg_evo_arl, hreg_evo_arl,evolucion_arl, estado_evo_arl, u.nombre,especialidad
            FROM adm_hospitalario a LEFT JOIN evolucion_arl n on a.id_adm_hosp=n.id_adm_hosp
                                    LEFT join user u on n.id_user=u.id_user
            WHERE a.id_adm_hosp='".$id."' and u.nombre='".$_SESSION["AUT"]["nombre"]."' and n.freg_evo_arl BETWEEN '".$f1."' and '".$f2."'
            order by n.freg_evo_arl ASC";
            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evo_arl"].' '.$fila["hreg_evo_arl"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td  class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evolucion_arl"].'</td>';
                  echo'<td class="text-center alert-danger"><b>ID: </b>'.$fila["id_evoarl"].'</td>';
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
