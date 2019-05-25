
<div id="registro_<?php echo $fila_detalle["id_d_aut_dom"]?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notas Radicadas por el profesional <?php echo $fila_detalle['profesional'] ?></h4>
      </div>
      <div class="modal-body">
        <form action="auxiliares_dom/reg_notas_realizadas.php"  method="POST">
          <section class="panel-body">
            <article class="col-md-12">
              <label for="">Registre aqui las notas presentadas por el profesional</label>
              <input type="number" class="form-control" name="cradica" value="" min=0 max=62>
              <input type="hidden" name="resp_radica" value="<?php echo $_SESSION['AUT']['id_user']?>">
              <input type="hidden" name="fecha_radica" value="<?php echo date('Y-m-d') ?>">
              <input type="hidden" name="id_profesional" value="<?php echo $fila_detalle['id_prof_d_dom'] ?>">
              <input type="hidden" name="f1" value="<?php echo $_GET['f1'] ?>">
              <input type="hidden" name="f2" value="<?php echo $_GET['f2'] ?>">
              <input type="hidden" name="t" value="<?php echo $_GET['tprofesional'] ?>">
              <input type="hidden" name="doc" value="<?php echo $_GET['doc'] ?>">
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
       <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
     </div>
      </div>

    </div>

  </div>

<?php
