<?php
$adm=$_REQUEST['idadmhosp'];
$sqlq="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
               concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
      WHERE b.id_adm_hosp=$adm and f.ffinal is null
      order by 1,3,2";
  //echo $sql;
      if ($tablaq=$bd1->sub_tuplas($sqlq)){

        foreach ($tablaq as $filaq ) {
          ?>
          <article class="col-xs-12">
            <label for="" class="text-success">Ubicacion actual:</label>
            <label for=""><?php echo $filaq['habi'] ?></label>
          </article>

          <?php
        }
      }
 ?>
 <?php
 $adm=$_REQUEST['idadmhosp'];
 $fecha=date('Y-m-d');
 $sqlw="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
                c.fejecucion_inicial formula_desde,c.fejecucion_final formula_hasta,c.tipo_formula tipo_formula,
                c.estado_m_fmedhosp estado_formula
       FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                               left join m_fmedhosp c on (c.id_adm_hosp = b.id_adm_hosp and (CURRENT_DATE between c.fejecucion_inicial and c.fejecucion_final ))
                               left join user e on (e.id_user = c.id_user)

       WHERE b.id_adm_hosp=$adm and c.estado_m_fmedhosp='Solicitado'
       order by 1,3,2";
      //echo $sql;
       if ($tablaw=$bd1->sub_tuplas($sqlw)){

         foreach ($tablaw as $filaw ) {
           ?>
           <article class="col-xs-12">
             <label for="" class="text-success">Formulación:</label>
             <label for=""><?php echo $filaw['tipo_formula'] ?> </label>
             <label for="" class="text-success">Vigencia: </label>
             <label><?php echo $filaw['formla_desde'].' '.$filaw['formula_hasta'] ?></label>
           </article>

           <?php
         }
       }
  ?>
