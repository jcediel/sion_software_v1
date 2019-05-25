<section class="panel panel-default">
  <section class="panel-heading">
    <h1>Seguimiento a bitacora de procedimiento</h1>
  </section>
  <section class="panel-body">
    <?php
    $user=$_SESSION['AUT']['id_perfil'];
    //echo $user;
    if ($user==46) {
      $sql_like="SELECT a.freg,c.doc_pac,c.nom_completo,a.id_bit_pro,a.tipo_bitacora,a.estado_bitacora,a.respuesta,a.fecha_responde,
                        f.id_d_aut_dom,f.procedimiento,a.descripcion_bitacora,
                        d.nombre,
                        g.nombre rta_user
      from bitacora_procedimiento a,adm_hospitalario b,m_aut_dom e,d_aut_dom f,pacientes c,user d,user g
      where f.id_d_aut_dom = a.id_d_aut_dom
              and   e.id_m_aut_dom = f.id_m_aut_dom
              and   e.id_adm_hosp  = b.id_adm_hosp
              and   c.id_paciente = b.id_paciente
              and   d.id_user = a.id_user
              and   a.tipo_bitacora = 'NEGATIVO'
              and   f.cups='890105'
      ORDER BY a.freg DESC";
              if ($tabla_like=$bd1->sub_tuplas($sql_like)){
                foreach ($tabla_like as $fila_like) {
                  echo'<section class="panel-body">';
                  echo'<article class="col-md-6">
                        <p><strong class="text-danger">Paciente:</strong> '.$fila_like["nom_completo"].'</p>
                        <p><strong class="text-danger">Identificación:</strong> '.$fila_like["doc_pac"].'</p>
                        <p><strong class="text-danger">Jefe:</strong>  '.$fila_like["nombre"].'</p>
                       </article>';
                  echo'<article class="col-md-6">
                        <p><strong class="text-danger">ID procedimiento:</strong>  '.$fila_like["id_d_aut_dom"].'</p>
                        <p><strong class="text-danger">Procedimiento:</strong>  '.$fila_like["procedimiento"].'</p>
                        <p class="text-danger"> '.$fila_like["tipo_bitacora"].'</p>
                       </article>';
                  echo'<article class="col-md-12">
                        <p><strong class="text-danger">Fecha de cargue: </strong>'.$fila_like["freg"].'</p>
                        <p><strong class="text-danger">Descripción: </strong><br>'.$fila_like["descripcion_bitacora"].'</p>
                       </article>';
                  echo'<article class="col-md-12">';
                        $estado=$fila_like['estado_bitacora'];
                        if ($estado==1 || $estado=='') {
                          $fecha=date('Y-m-d');
                          echo'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rta_bitacora_'.$fila_like["id_bit_pro"].'">Responder</button>
                              <div id="rta_bitacora_'.$fila_like["id_bit_pro"].'" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form action="Funcion_base/respuesta_bitacora_procedimiento.php" method="POST">
                                      <section class="panel-body">
                                        <article class="col-md-12">
                                          <label>Respuesta:</label>
                                          <textarea class="form-control" name="respuesta"></textarea>
                                          <input type="hidden" class="form-control" name="resp_responde" value="'.$_SESSION['AUT']['id_user'].'">
                                          <input type="hidden" class="form-control" name="id" value="'.$fila_like["id_bit_pro"].'">
                                          <input type="hidden" class="form-control" name="fecha_responde" value="'.$fecha.'">
                                          <input type="hidden" class="form-control" name="estado" value="2">
                                        </article>
                                      </section>
                                      <section class="panel-body">
                                        <article class="col-md-12">
                                          <input type="submit" value="Guardar">
                                        </article>
                                      </section>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>

                                </div>
                              </div>';
                        }else {
                          echo'<article class="col-md-12">
                                <p><strong>Fecha de respuesta: </strong>'.$fila_like["fecha_respuesta"].'</p>
                                <p><strong>Respuesta: </strong><br>'.$fila_like["respuesta"].'</p>
                               </article>';
                        }
                  echo'</article>';
                  echo'</section>';
                }
              }

    }
    if ($user==45) {
      $sql_like="SELECT a.freg,c.doc_pac,c.nom_completo,a.id_bit_pro,a.tipo_bitacora,a.estado_bitacora,a.respuesta,a.fecha_responde,
                        f.id_d_aut_dom,f.procedimiento,a.descripcion_bitacora,
                        d.nombre
      from bitacora_procedimiento a,adm_hospitalario b,m_aut_dom e,d_aut_dom f,pacientes c,user d
      where f.id_d_aut_dom = a.id_d_aut_dom
              and   e.id_m_aut_dom = f.id_m_aut_dom
              and   e.id_adm_hosp  = b.id_adm_hosp
              and   c.id_paciente = b.id_paciente
              and   d.id_user = a.id_user
              and   a.tipo_bitacora = 'NEGATIVO'
              and   f.cups in ('890101','890106','890108','890111','890110','890112','890113')
      ORDER BY a.freg DESC";
            //  echo $sql_like;
              if ($tabla_like=$bd1->sub_tuplas($sql_like)){
                foreach ($tabla_like as $fila_like) {
                  echo'<section class="panel-body">';
                  echo'<article class="col-md-6">
                        <p><strong class="text-danger">Paciente:</strong> '.$fila_like["nom_completo"].'</p>
                        <p><strong class="text-danger">Identificación:</strong> '.$fila_like["doc_pac"].'</p>
                        <p><strong class="text-danger">Jefe:</strong>  '.$fila_like["nombre"].'</p>
                       </article>';
                  echo'<article class="col-md-6">
                        <p><strong class="text-danger">ID procedimiento:</strong>  '.$fila_like["id_d_aut_dom"].'</p>
                        <p><strong class="text-danger">Procedimiento:</strong>  '.$fila_like["procedimiento"].'</p>
                        <h2 class="text-danger"> '.$fila_like["tipo_bitacora"].'</h2>
                       </article>';
                  echo'<article class="col-md-12">
                        <p><strong class="text-danger">Fecha de cargue: </strong>'.$fila_like["freg"].'</p>
                        <p><strong class="text-danger">Descripción: </strong><br>'.$fila_like["descripcion_bitacora"].'</p>
                       </article>';
                  echo'<article class="col-md-12">';
                        $estado=$fila_like['estado_bitacora'];
                        if ($estado==1 || $estado=='') {
                          $fecha=date('Y-m-d');
                          echo'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rta_bitacora_'.$fila_like["id_bit_pro"].'">Responder</button>
                              <div id="rta_bitacora_'.$fila_like["id_bit_pro"].'" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Respuesta a bitacora de procedimiento</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form action="Funcion_base/respuesta_bitacora_procedimiento.php" method="POST">
                                      <section class="panel-body">
                                        <article class="col-md-12">
                                          <label>Respuesta:</label>
                                          <textarea class="form-control" name="respuesta"></textarea>
                                          <input type="hidden" class="form-control" name="resp_responde" value="'.$_SESSION['AUT']['id_user'].'">
                                          <input type="hidden" class="form-control" name="id" value="'.$fila_like["id_bit_pro"].'">
                                          <input type="hidden" class="form-control" name="fecha_responde" value="'.$fecha.'">
                                          <input type="hidden" class="form-control" name="estado" value="2">
                                        </article>
                                      </section>
                                      <section class="panel-body">
                                        <article class="col-md-12">
                                          <input type="submit" value="Guardar">
                                        </article>
                                      </section>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>

                                </div>
                              </div>';
                        }else {
                          echo'<article class="col-md-12 alert alert-success">
                                <p><strong>Fecha de respuesta: </strong>'.$fila_like["fecha_responde"].'</p>
                                <p><strong>Respuesta: </strong><br>'.$fila_like["respuesta"].'</p>
                               </article>';
                        }
                  echo'</article>';
                  echo'</section>';
                }
              }

    }

     ?>
  </section>
</section>
