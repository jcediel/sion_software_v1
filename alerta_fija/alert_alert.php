<?php
$adm=$_REQUEST['idadmhosp'];
$sqls="SELECT clase_dx_hosp
      FROM adm_hospitalario
      WHERE id_adm_hosp=$adm";
  //echo $sqls;
      if ($tablax=$bd1->sub_tuplas($sqls)){

        foreach ($tablax as $filax ) {
          ?>
          <article class="col-md-4">
            <h3><?php echo $subtitulo ?></h3>
          </article>
          <article class="col-md-4">
            <h3 class="text-danger"><?php echo $filax['clase_dx_hosp'] ?></h3>
          </article>
          <div class="col-md-4">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#enf">Plan de cuidado Enfermería</button>
          </div>
          <?php
        }
      }
 ?>
 <div id="enf" class="modal fade" role="dialog">
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Plan de cuidado enfermeria</h4>
       </div>
       <div class="modal-body">
         <?php
         $cdx= $filax['clase_dx_hosp'];
         if ($cdx=='Institucionalizado') {
         ?>
            <section class="panel-body">
              <article class="col-md-6">
                <h3>RIESGOS POTENCIALES</h3>
                <ul>
                  <li>Riesgo de caida</li>
                  <li>Riesgo de aspiración</li>
                  <li>Alteraciones sensoperceptivas (visión-audición)</li>
                  <li>Deficit de autocuidado</li>
                  <li>Riesgo de abandono</li>
                </ul>
              </article>
              <article class="col-md-6">
                <h3>PLAN DE CUIDADO ENFERMERIA</h3>
                <ul>
                  <li>Cabecera elevada a 30°</li>
                  <li>Valorar saturacion de oxigeno</li>
                  <li>Alteraciones sensoperceptivas (visión-audición)</li>
                  <li>Verificar la masticación y salud oral</li>
                  <li>cambios de posición</li>
                  <li>Deambulación asistida</li>
                  <li>Cambio de pañal</li>
                  <li>Promover el autocuidado de uñas y cabello</li>
                  <li>Control de peso</li>
                  <li>Promover la terapia ocupacional</li>
                  <li>Promover el apoyo familiar</li>
                </ul>
              </article>
            </section>
         <?php
          }
         ?>
         <?php
         $cdx= $filax['clase_dx_hosp'];
         if ($cdx=='Agudo Salud mental') {
         ?>
            <section class="panel-body">
              <article class="col-md-6">
                <h3>RIESGOS POTENCIALES</h3>
                <ul>
                  <li>Riesgo de estreñimiento</li>
                  <li>Alteración del patron del sueño</li>
                  <li>Riesgo a violencia</li>
                  <li>Deficit de autocuidado</li>
                  <li>Deterioro de la comunicavción verbal</li>
                  <li>Deterioro de la interacción social</li>
                  <li>Deficit de actividades recreativas</li>
                </ul>
              </article>
              <article class="col-md-6">
                <h3>PLAN DE CUIDADO ENFERMERIA</h3>
                <ul>
                  <li>Control y registro de deposiciones</li>
                  <li>Promover alimentos ricos en agua y fibra</li>
                  <li>Asegurar la intimidad durante las deposiciones</li>
                  <li>Establecer y cumplir horarios de sueño</li>
                  <li>Supervisar las actividades de aseo e higiene</li>
                  <li>Valorar signos de agitación motara</li>
                  <li>Inmovilizar agresión o heteroagresión</li>
                  <li>Promover el autocuidado</li>
                  <li>Minimizar riesgos</li>
                </ul>
              </article>
            </section>
         <?php
          }
         ?>
         <?php
         $cdx= $filax['clase_dx_hosp'];
         if ($cdx=='Farmacodependencia (desintoxicacion)' ||
             $cdx=='Farmacodependencia (deshabituacion)' ||
             $cdx=='Farmacodependencia (Semi-ambulatorio)' ){
         ?>
            <section class="panel-body">
              <article class="col-md-6">
                <h3>RIESGOS POTENCIALES</h3>
                <ul>
                  <li>Riesgo de diarrea</li>
                  <li>Alteración del patron del sueño</li>
                  <li>Riesgo a alteración de la nutrición</li>
                  <li>Riesgo de hipotermia</li>
                  <li>Deficit de autocuidado</li>
                  <li>Deterioro de la interacción social</li>
                </ul>
              </article>
              <article class="col-md-6">
                <h3>PLAN DE CUIDADO ENFERMERIA</h3>
                <ul>
                  <li>Impedir dormir en el día</li>
                  <li>Promover la terapia ocupacional</li>
                  <li>Promover higiene al sueño</li>
                  <li>Establecer y cumplir horarios de sueño</li>
                  <li>valorar signos y sintomas de hipotermia</li>
                  <li>Valorar signos de agitación motara</li>
                  <li>Valorar signos de deshidratación</li>
                  <li>Promover la ingesta de liquido</li>
                  <li>Promover el ejercicio</li>
                  <li>Explicar efectos perjudiciales de la falta de aseo</li>
                </ul>
              </article>
            </section>
         <?php
          }
         ?>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>

   </div>
 </div>
