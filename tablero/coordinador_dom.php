<section class="panel panel-default bg-section">
  <section class="panel-heading">
    <h1 class="display-5 animated zoomIn">Hola, <?php echo $_SESSION['AUT']['nombre'] ?></h1>
    <h3>Aqui puedes realizar Consulta de profesionales activos, Creación de anuncios y seguimiento a notificaciones de las jefes de zona.</h3>
  </section>
  <section class="panel-body">
    <article class="col-md-4 col-sm-12">
      <button data-toggle="collapse" class="btn btn-info btn-lg text-center" data-target="#lista_profesionales"><span class="fa fa-user-md fa-4x"></span><br> Profesionales activos</button>
    </article>
    <article class="col-md-4  col-sm-12">
      <?php
      echo'<a href="'.PROGRAMA.'?opcion=196"><button type="button" class="btn btn-success btn-lg" ><span class="fa fa-newspaper fa-4x"></span><br> Crear Anuncio </button></a>';
       ?>
    </article>
    <article class="col-md-4  col-sm-12">
      <?php
      echo'<a href="'.PROGRAMA.'?opcion=197"><button type="button" class="btn btn-danger btn-lg" ><span class="fa fa-thumbs-down fa-4x"></span><br> NO Like </button></a>';
       ?>
    </article>
  </section>
</section>
<section class="panel-body">
  <article class="col-md-12">
    <section id="lista_profesionales" class="collapse">
      <?php
      echo'<table class="table table-bordered">
      <tr>
        <th>#</th>
        <th>PROFESIONAL</th>
        <th>IMAGENES</th>
        <th>AUTORIZADO</th>
      </tr>
        ';
      $user=$_SESSION['AUT']['id_user'];
      $sql="SELECT a.id_user, nombre,
                     cuenta, clave, foto, email, tdoc, doc, dir_user, tel_user, rm_profesional,
                     especialidad, firma, estado,jz, supernum ,
                   b.nombre_perfil
            FROM user a inner join perfil b on b.id_perfil=a.id_perfil
            WHERE a.estado='Activo' and a.id_perfil in (21,22,23,24,25,26,27,28,31,32,33,34)
            ORDER by especialidad ASC";
          $i=1;
          if ($tabla=$bd1->sub_tuplas($sql)){
            foreach ($tabla as $fila) {
              echo"<tr >\n";
              echo'<td class="text-center">
                    <p>'.$i++.'<p>
                   </td>';
              echo'<td class="text-left">
                    <p>'.$fila["nombre"].'<p>
                    <p>'.$fila["doc"].'</p>
                    <p><strong>Tel: </strong>: '.$fila["tel_user"].'</p>
                    <p><strong>Dirección: </strong> '.$fila["dir_user"].'</p>
                    <p><strong>Email: </strong> '.$fila["email"].'</p>
                    <p><strong>RM: </strong> '.$fila["rm_profesional"].'</p>
                    <p><strong>Especialidad: </strong> '.$fila["especialidad"].'</p>
                   </td>';
              echo'<td class="text-left">
                    <p><strong>Perfil: </strong>'.$fila["nombre_perfil"].'</p>
                    <p><img src="'.$fila["foto"].'" alt="sin foto"  class="img-responsive" width="40%"></p>
                    <p><img src="'.$fila["firma"].'" alt="sin firma"  class="img-responsive" width="40%"></p>
                ';
              echo'</td>';
              echo'<td class="text-left">';
              $user=$fila['id_user'];
              $sql_pacXprof_count="SELECT h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac, c.tipo_usuario,b.zonificacion,
                           c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
                           count(IFNULL(c.id_adm_hosp,0)) cuantos,d.id_m_aut_dom, IFNULL(e.id_d_aut_dom,0),
                           e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
                           e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
                           e.temporalidad,g.nombre profesional,
                           j.nom_sedes,
                           cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones

                    from adm_hospitalario c INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
                                            INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom
                                                     and CURRENT_DATE BETWEEN
                                                    CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
                                            INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
                                            INNER JOIN eps h on (h.id_eps = c.id_eps)
                                            INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
                                            LEFT  JOIN profesional_d_dom f on (f.id_d_aut_dom = e.id_d_aut_dom)
                                            LEFT  JOIN user g on (g.id_user = f.profesional)
                                            LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
                    where c.tipo_servicio = 'Domiciliarios' and c.estado_adm_hosp = 'Activo' and f.profesional=$user";
                    if ($tabla_pacXprof_count=$bd1->sub_tuplas($sql_pacXprof_count)){
                      foreach ($tabla_pacXprof_count as $fila_pacXprof_count) {
                        $c=$fila_pacXprof_count['cuantos'];
                        if ($c > 0) {
                          echo'<p>El profesional tiene '.$fila_pacXprof_count['cuantos'].' asignados</p>';
                          $user=$fila['id_user'];
                          echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#lista_pacientes_'.$user.'"> Pacientes asignados</button>';
                          echo'<div id="lista_pacientes_'.$user.'" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Pacientes Asignados</h4>
                                </div>
                                <div class="modal-body">';
                                $user=$fila['id_user'];
                                $sql_pacXprof="SELECT h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac, c.tipo_usuario,b.zonificacion,
                                             c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
                                             IFNULL(c.id_adm_hosp,0),d.id_m_aut_dom, IFNULL(e.id_d_aut_dom,0),
                                             e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
                                             e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
                                             e.temporalidad,g.nombre profesional,
                                             j.nom_sedes,
                                             cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones

                                      from adm_hospitalario c INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
                                                              INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom
                                                                       and CURRENT_DATE BETWEEN
                                                                      CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
                                                              INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
                                                              INNER JOIN eps h on (h.id_eps = c.id_eps)
                                                              INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
                                                              LEFT  JOIN profesional_d_dom f on (f.id_d_aut_dom = e.id_d_aut_dom)
                                                              LEFT  JOIN user g on (g.id_user = f.profesional)
                                                              LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
                                      where c.tipo_servicio = 'Domiciliarios' and c.estado_adm_hosp = 'Activo' and f.profesional=$user";
                                      if ($tabla_pacXprof=$bd1->sub_tuplas($sql_pacXprof)){
                                        foreach ($tabla_pacXprof as $fila_pacXprof) {

                                        echo'<section class="panel-body">
                                          <article class="col-md-12">
                                            <p>'.$fila_pacXprof["nom_completo"].'<p>
                                            <p><strong>'.$fila_pacXprof["tdoc_pac"].' </strong>: '.$fila_pacXprof["doc_pac"].'</p>
                                            <p><strong>EPS: </strong>'.$fila_pacXprof["nom_eps"].'</p>
                                            <p><strong>SEDE: </strong>'.$fila_pacXprof["nom_sedes"].'</p>
                                          </article>
                                          <article class="col-md-12">
                                            <p><strong>ID M: </strong>'.$fila_pacXprof["id_m_aut_dom"].'</p>
                                            <p><strong>ID D: </strong>'.$fila_pacXprof["IFNULL(e.id_d_aut_dom,0)"].'</p>
                                            <p><strong>Intervalo/turno: </strong>'.$fila_pacXprof["intervalo"].'</p>
                                            <p><strong>Tipo Paciente: </strong>'.$fila_pacXprof["nomclaseusuario"].'</p>
                                            <p><strong>'.$fila_pacXprof["cups"].' </strong>'.$fila_pacXprof["procedimiento"].'</p>
                                            <p><strong>Vigencia: </strong>'.$fila_pacXprof["finicio"].' -- '.$fila_pacXprof["ffinal"].'</p>
                                          </article>
                                          <article class="col-md-12">
                                            <p><strong>Autorizado: </strong>'.$fila_pacXprof["cantidad"].'</p>
                                            <p><strong>Realizado: </strong>'.$fila_pacXprof["sesiones"].'</p>
                                          </article>
                                        </section>';

                                        }
                                      }else {

                                        echo'<p class="alert alert-danger"><h2>No hay pacientes asignados para este profesional</h2></p>';
                                      }
                                echo'</div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>';
                        }else {
                          echo'<p>El profesional tiene '.$fila_pacXprof_count['cuantos'].' asignados</p>';
                        }
                      }
                    }


              echo'</td>';

              echo "</tr>\n";
            }
          }
      ?>
       </table>
    </section>
  </article>
</section>
