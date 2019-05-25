
      <h4 >Resumen de Presentación</h4>

        <table class="table table-responsive table-bordered">
          <tr>
            <th class="info text-center">ID</th>
            <th class="info text-center">PROCEDIMIENTO</th>
            <th class="info text-center">FRECUENCIA</th>
            <th class="info text-center">JORNADA</th>
            <th class="info text-center">CANTIDAD</th>
            <th class="info text-center">OBSERVACION</th>
            <th class="info text-center">PROFESIONAL</th>
            <th class="info text-center">RANGO DE ATENCIÓN</th>
          </tr>

          <?php
          $idpprod=$_REQUEST['idpres'];
          $sql1="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,zonificacion,
                       h.id_presentacion_dom,
                       a.id_pprocedimiento,cups,frecuencia,jornada,cantidad,obs_cups,
                       b.id_pprofesional,finicial,ffinal,
                       c.nombre,
                       d.descupsmin
                FROM pacientes p INNER JOIN presentacion_dom h on p.id_paciente=h.id_paciente
                                 LEFT JOIN pprocedimiento a on h.id_presentacion_dom=a.id_presentacion_dom
                                 LEFT JOIN pprofesional b on a.id_pprocedimiento=b.id_pprocedimiento
                                 LEFT JOIN user c on b.id_user=c.id_user
                                 LEFT JOIN cups d on a.cups=d.codcups
                WHERE h.id_presentacion_dom=$idpprod group by p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,zonificacion,
                             a.id_pprocedimiento,cups,frecuencia,jornada,cantidad,obs_cups,
                             b.id_pprofesional,finicial,ffinal,
                             c.nombre,
                             d.descupsmin";
                echo $sql1;
        if ($tabla1=$bd1->sub_tuplas($sql1)){
          foreach ($tabla as $fila1 ) {
            if ($fila1['id_pprofesional']=='') {
              echo"<tr>\n";
              echo'<td class="text-right alert-danger">'.$fila1["id_pprocedimiento"].'</td>';
              echo'<td class="text-left alert-danger">'.$fila1["descupsmin"].'</td>';
              echo'<td class="text-left alert-danger">'.$fila1["frecuencia"].'</td>';
              echo'<td class="text-left alert-danger">'.$fila1["jornada"].'</td>';
              echo'<td class="text-left alert-danger">'.$fila1["cantidad"].'</td>';
              echo'<td class="text-left alert-danger">'.$fila1["obs_cups"].'</td>';
              echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
              echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
              echo "</tr>\n";
            }else {
              echo"<tr>\n";
              echo'<td class="text-right alert-info">'.$fila1["id_pprocedimiento"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["descupsmin"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["frecuencia"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["jornada"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["cantidad"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["obs_cups"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["nombre"].'</td>';
              echo'<td class="text-left alert-info">'.$fila1["finicial"].' | '.$fila1["ffinal"].'</td>';
              echo "</tr>\n";
            }
          }
        }
          ?>
        </table>
