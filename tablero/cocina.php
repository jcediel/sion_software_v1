<section class="panel panel-primary">
  <section class="panel-heading text-center">
    <h1>Herramientas para personal de cocina</h1>
  </section>
  <section class="panel-body">
    <section class="col-md-4 text-center">
      <?php
       echo '<a href="'.PROGRAMA.'?opcion=206"><button type="button" class="btn btn-success btn-lg"><span class="fa fa-utensils fa-3x"></span> <br>Entrega<br>almuerzo</button></a>';
       ?>
    </section>
    <section class="col-md-4">
      <?php
      $fh=date('Y-m-d');
      $sql_solicitado="SELECT COUNT(id_food) cuantos
                        FROM food
                        WHERE freg_food='$fh' AND estado_food=1";
          if ($tablau=$bd1->sub_tuplas($sql_solicitado)){
            foreach ($tablau as $filau) {
              echo '<article class="alert alert-info text-center animated bounceInUp">
                      <h4>Cantidad almuerzos<br>solicitados</h4>
                      <h1><strong>'.$filau['cuantos'].'</strong></h1>
                    </article>';
            }
          }
       ?>
    </section>
    <section class="col-md-4 text-right">
      <?php
      $fh=date('Y-m-d');
      $sql_solicitado="SELECT COUNT(id_food) cuantos
                        FROM food
                        WHERE freg_food='$fh' AND estado_food=2";
          if ($tablau=$bd1->sub_tuplas($sql_solicitado)){
            foreach ($tablau as $filau) {
              echo '<article class="alert alert-success text-center animated bounceInDown">
                      <h4>Cantidad almuerzos<br>entregados</h4>
                      <h1><strong>'.$filau['cuantos'].'</strong></h1>
                    </article>';
            }
          }
       ?>
    </section>
  </section>
</section>
