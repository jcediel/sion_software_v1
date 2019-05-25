<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <button class="btn btn-success" data-toggle="modal" data-target="#hc" type="button" >Valoraciones Iniciales </button>
</div>
<section>
  <article >
    <section class="modal fade" id="hc" role="dialog">
      <section class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" >Evoluciones Musicoterapia</h4>
          </div>
          <article class="col-xs-5">
            <form  method="post">
              <label for="">Fecha inicial:</label>
              <input type="date" name="f1"  class="form-control" value="">
              <label for="">Fecha final:</label>
              <input type="date" name="f2"  class= "form-control" value="">

            </form>

          </article>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>

              </tr>
              <?php
              if (isset($_REQUEST["idadmhosp"])){
              $id=$_REQUEST["idadmhosp"];
              $sql="SELECT a.id_adm_hosp,estado_adm_hosp,n.id_evomusico_reh,freg_evomusico_reh, hreg_evomusico_reh, evolucionmusico_reh, estado_evomusico_reh,u.nombre,especialidad FROM adm_hospitalario a LEFT JOIN evo_musico_reh n on a.id_adm_hosp=n.id_adm_hosp LEFT join user u on n.id_user=u.id_user where a.id_adm_hosp='".$id."' and freg_evomusico_reh='".$f1."' and '".$f2."' order by n.freg_evomusico_reh DESC";

              if ($tabla=$bd1->sub_tuplas($sql)){
                //echo $sql;
                foreach ($tabla as $fila ) {

                  echo"<tr >\n";
                  echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evomusico_reh"].' '.$fila["hreg_evomusico_reh"].'</strong></td>';
                  echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                  echo'<td class="text-center warning"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                  echo '</tr>';
                  echo"<tr >\n";
                  echo'<td class="text-center info"><b>EVOLUCION</b></td>';
                  echo'<td class="text-left">'.$fila["evolucionmusico_reh"].'</td>';
                  echo'<td class="text-center"><b>ID: </b>'.$fila["id_evomusico_reh"].'</td>';
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
