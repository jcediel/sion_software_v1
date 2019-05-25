<div class="col-xs-12 text-left animated fadeInLeft">
    <button data-toggle="collapse" class="btn btn-success" data-target="#datevo"><strong>Ver plan en ultima evolución </strong><span class="fa fa-eye fa-2x animated shake"></span> </button>
</div>
<section class="collapse" id="datevo">
  <section class="panel-body text-left">

      <?php
      if (isset($_REQUEST["idadmhosp"])){
      $id=$_REQUEST["idadmhosp"];
      $sql1="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,dxp,ddxp,tdxp,
      u.cuenta,nombre,doc,rm_profesional,especialidad,firma
      FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user
      where e.id_adm_hosp='".$_GET["idadmhosp"]."'
      ORDER BY id_evomed DESC LIMIT 1";
        //echo $sql;
      if ($tabla1=$bd1->sub_tuplas($sql1)){
        //echo $sql;
        foreach ($tabla1 as $fila1 ) {

          echo"<section>";
            echo"<article class='col-xs-4'>";
              echo'<label ><b>Plan tratamiento:</b></td>';
            echo"</article >";
            echo"<article class='alert alert-info col-xs-8'>";
              echo'<label class="text-center">'.$fila1["plan_tratamiento"].'</td>';
            echo"</article >";
            echo"<article class='col-xs-3'>";
              echo'<label ><b>Diagnostico:</b></td>';
            echo"</article >";
            echo"<article class='alert alert-info col-xs-2'>";
              echo'<label class="text-center">'.$fila1["dxp"].'</td>';
            echo"</article >";
            echo"<article class='alert alert-info col-xs-7'>";
              echo'<label class="text-center">'.$fila1["ddxp"].'</td>';
            echo"</article >";
          echo '</section>';
        }
      }
    }
      ?>

  </section>
</section>
