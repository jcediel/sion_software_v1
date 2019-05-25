<div class="botonhc"id="th-estilo1">
    <a data-toggle="collapse" class="ac" data-target="#datepi" >Datos epicrisis</a> <span class="glyphicon glyphicon-arrow-down"></span>
</div>
<section class="collapse" id="datepi">
            <section class="panel-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT a.id_adm_hosp,h.id_hchosp,e.*,u.* FROM adm_hospitalario a LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp LEFT JOIN epicrisis e on h.id_hchosp=e.id_hchosp  LEFT JOIN user u on u.id_user=e.id_user where a.id_adm_hosp=".$_GET["idadmhosp"];
                  //echo $sql;
                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_epicrisis"].' '.$fila["hreg_epicrisis"].'</strong></td>';
                    echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                    echo'<td class="text-center warning"rowspan="6"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><b>SUBJETIVO</b></td>';
                    echo'<td class="text-left">'.$fila["subjetivo_epicrisis"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>OBJETIVO</b></td>';
                    echo'<td class="text-left">'.$fila["objetivo_epicrisis"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info"><b>ANALISIS</b></td>';
                    echo'<td class="text-left">'.$fila["analisis_epicrisis"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>PLAN TRATAMIENTO</b></td>';
                    echo'<td class="text-left">'.$fila["plant_epicrisis"].'</td>';
                    echo '</tr>';
                    echo"<tr >\n";
                    echo'<td class="text-center info" ><b>DIAGNOSTICO</b></td>';
                    echo'<td class="text-left">'.$fila["cdxp_epi"].' -- '.$fila["ddxp_epi"].' -- '.$fila["tdxp_epi"].'</td>';
                    echo '</tr>';
                  }
                }
              }
                ?>
              </table>
            </section>
</section>
