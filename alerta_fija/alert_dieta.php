<article class="col-md-12 text-center">
  <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#historia_dieta"><span class="fa fa-utensils"></span> Historico Dietas</button>
</article>

<div id="historia_dieta" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Historico de dietas </h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr class="info">
            <th>TIPO DIETA</th>
            <th>OBSERVACIÓN</th>
          </tr>
        <?php
        $adm=$_REQUEST['idadmhosp'];
        $sqld="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
                     b.id_adm_hosp,
                     c.*
              FROM pacientes a inner JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                                inner join dieta c on c.id_adm_hosp=b.id_adm_hosp
              WHERE c.id_adm_hosp=$adm and estado_dieta='Activa'";

            if ($tablad=$bd1->sub_tuplas($sqld)){
              foreach ($tablad as $filad ) {
              ?>
              <tr>
                <td><?php echo $filad['tipo_dieta'] ?></td>
                <td><?php echo $filad['obs_dieta'] ?></td>
              </tr>


              <?php
              }
            }

         ?>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
