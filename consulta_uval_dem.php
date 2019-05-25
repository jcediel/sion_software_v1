<div class="botonhc"id="th-estilo1">
    <a data-toggle="collapse" class="ac" data-target="#datevo" >Datos ULTIMA valoracion</a> <span class="glyphicon glyphicon-arrow-down"></span>
</div>
<section class="collapse" id="datevo">
            <section class="panel-body">
              <table class="table table-bordered">
                <tr>

                </tr>
                <?php
                if (isset($_REQUEST["idadmhosp"])){
                $id=$_REQUEST["idadmhosp"];
                $sql="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,dxp,ddxp,tdxp,u.cuenta,nombre,doc,rm_profesional,especialidad,firma FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user  where e.id_adm_hosp='".$_GET["idadmhosp"]."' group by e.id_adm_hosp,e.freg_evomed,e.hreg_evomed,u.cuenta,nombre,doc,rm_profesional,especialidad,firma ORDER BY freg_evomed DESC limit 1";
                  //echo $sql;
                if ($tabla=$bd1->sub_tuplas($sql)){
                  //echo $sql;
                  foreach ($tabla as $fila ) {

                    echo"<tr >\n";
                    echo'<td class="text-center danger"><strong><span class="fa fa-calendar"></span> '.$fila["freg_evomed"].' '.$fila["hreg_evomed"].'</strong></td>';
                    echo'<td class="text-center success"><strong><span class="fa fa-user-md"></span> '.$fila["nombre"].' </strong></td>';
                    echo'<td class="text-center warning"rowspan="6"><strong><span class="fa fa-medkit"></span> '.$fila["especialidad"].' </strong></td>';
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
                    echo'<td class="text-center info" ><b>DIAGNOSTICOS</b></td>';
                    echo'<td class="text-left"> <input type="text" name="dx" class="form-control" value="'.$fila["ddxp"].'" '.$atributo1.'></td>';
                    echo '</tr>';
                  }
                }
              }
                ?>
              </table>
            </section>
</section>
