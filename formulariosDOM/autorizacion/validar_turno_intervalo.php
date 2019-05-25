<?php
if ($cups=='F890121' || $cups=='F890122' || $cups=='F890123' || $cups=='F890124' || $cups=='F890125') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM administracion_med_dom WHERE id_d_aut_dom=$id_vcant and estado_adm_med='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Horas</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];

              $realizador=$_SESSION['AUT']['id_user'];

              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-left">';
                $intervalo=$fila_detalle['intervalo'];

                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';

                echo'</th>';
                include('apoyos/enfermeria_dom1.php');
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
                echo'</th>';
              }
            }
          }else {
            $supernum=$_SESSION['AUT']['supernum'];
            if ($supernum==1) {
              echo'<th class="text-left">';
              $intervalo=$fila_detalle['intervalo'];

              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';

              echo'</th>';
              include('apoyos/enfermeria_dom1.php');
            }
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';
          $turno_validar=$fila_detalle['intervalo'];

            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            //echo $hoy;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
               </th>';
              include('apoyos/enfermeria_dom2.php');
          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada PROD:'.$fila_detalle['id_d_aut_dom'].'</p>
             </th>';
      }
    }
  }
}

if ($turno==3) {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM enferdom3 WHERE id_d_aut_dom=$id_vcant and estado_nota='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Horas</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];

              $realizador=$_SESSION['AUT']['id_user'];

              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-left">';
                $intervalo=$fila_detalle['intervalo'];
                if ($intervalo==24) {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }else {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }
                echo'</th>';
                include('apoyos/enfermeria_dom1.php');
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
                echo'</th>';
              }
            }
          }else {
            $supernum=$_SESSION['AUT']['supernum'];
            if ($supernum==1) {
              echo'<th class="text-left">';
              $intervalo=$fila_detalle['intervalo'];
              if ($intervalo==24) {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }else {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }
              echo'</th>';
              include('apoyos/enfermeria_dom1.php');
            }
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';
          $turno_validar=$fila_detalle['intervalo'];

          if ($turno_validar==24 || $turno_validar==12 || $turno_validar==8 || $turno_validar==6 || $turno_validar==3) {
            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            //echo $hoy;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          }
          echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
               </th>';
              include('apoyos/enfermeria_dom2.php');
          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada PROD:'.$fila_detalle['id_d_aut_dom'].'</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
             </th>';
             include('apoyos/enfermeria_dom2.php');
      }
    }
  }
}

if ($turno==6) {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM enferdom6 WHERE id_d_aut_dom=$id_vcant and estado_nota='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Horas</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];

              $realizador=$_SESSION['AUT']['id_user'];

              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-left">';
                $intervalo=$fila_detalle['intervalo'];
                if ($intervalo==24) {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }else {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }
                echo'</th>';
                include('apoyos/enfermeria_dom1.php');
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
                echo'</th>';
              }
            }
          }else {
            $supernum=$_SESSION['AUT']['supernum'];
            if ($supernum==1) {
              echo'<th class="text-left">';
              $intervalo=$fila_detalle['intervalo'];
              if ($intervalo==24) {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }else {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }
              echo'</th>';
              include('apoyos/enfermeria_dom1.php');
            }
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';
          $turno_validar=$fila_detalle['intervalo'];

          if ($turno_validar==24 || $turno_validar==12 || $turno_validar==8 || $turno_validar==6 || $turno_validar==3) {
            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            //echo $hoy;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          }
          echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
               </th>';
              include('apoyos/enfermeria_dom2.php');
          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada PROD:'.$fila_detalle['id_d_aut_dom'].'</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
             </th>';
             include('apoyos/enfermeria_dom2.php');
      }
    }
  }
}

if ($turno==8) {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM enferdom8 WHERE id_d_aut_dom=$id_vcant and estado_nota='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Horas</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];

              $realizador=$_SESSION['AUT']['id_user'];

              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-left">';
                $intervalo=$fila_detalle['intervalo'];
                if ($intervalo==24) {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }else {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }
                echo'</th>';
                include('apoyos/enfermeria_dom1.php');
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
                echo'</th>';
              }
            }
          }else {
            $supernum=$_SESSION['AUT']['supernum'];
            if ($supernum==1) {
              echo'<th class="text-left">';
              $intervalo=$fila_detalle['intervalo'];
              if ($intervalo==24) {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }else {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }
              echo'</th>';
              include('apoyos/enfermeria_dom1.php');
            }
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';
          $turno_validar=$fila_detalle['intervalo'];

          if ($turno_validar==24 || $turno_validar==12 || $turno_validar==8 || $turno_validar==6 || $turno_validar==3) {
            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            //echo $hoy;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          }
          echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
               </th>';
              include('apoyos/enfermeria_dom2.php');
          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada PROD:'.$fila_detalle['id_d_aut_dom'].'</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
             </th>';
             include('apoyos/enfermeria_dom2.php');
      }
    }
  }
}

if ($turno==12) {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM enferdom12 WHERE id_d_aut_dom=$id_vcant and estado_nota='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Horas</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];

              $realizador=$_SESSION['AUT']['id_user'];

              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-left">';
                $intervalo=$fila_detalle['intervalo'];
                if ($intervalo==24) {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }else {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }
                echo'</th>';
                include('apoyos/enfermeria_dom1.php');
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
                echo'</th>';
              }
            }
          }else {
            $supernum=$_SESSION['AUT']['supernum'];
            if ($supernum==1) {
              echo'<th class="text-left">';
              $intervalo=$fila_detalle['intervalo'];
              if ($intervalo==24) {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }else {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }
              echo'</th>';
              include('apoyos/enfermeria_dom1.php');
            }
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
                <article class="alert alert-danger animated bounceIn col-md-12">
                 <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
                 <p>Fecha inicio:'.$fila_detalle['finicio'].' Fecha final:'.$fila_detalle['ffinal'].'</p>
                </article>
                ';
          $turno_validar=$fila_detalle['intervalo'];

          if ($turno_validar==24 || $turno_validar==12 || $turno_validar==8 || $turno_validar==6 || $turno_validar==3) {
            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          }
          echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
               </th>';
              include('apoyos/enfermeria_dom2.php');
          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada PROD:'.$fila_detalle['id_d_aut_dom'].'</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
             </th>';
             include('apoyos/enfermeria_dom2.php');
      }
    }
  }
}

if ($turno==24) {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM enferdom12 WHERE id_d_aut_dom=$id_vcant and estado_nota='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      $cant=$cantidad*2;
      if ($realizado < $cant) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Horas</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];

              $realizador=$_SESSION['AUT']['id_user'];

              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-left">';
                $intervalo=$fila_detalle['intervalo'];
                if ($intervalo==24) {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }else {
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
                echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
                }
                echo'</th>';
                include('apoyos/enfermeria_dom1.php');
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
                echo'</th>';
              }
            }
          }else {
            $supernum=$_SESSION['AUT']['supernum'];
            if ($supernum==1) {
              echo'<th class="text-left">';
              $intervalo=$fila_detalle['intervalo'];
              if ($intervalo==24) {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }else {
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
              echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar<br>Registros</button></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
              }
              echo'</th>';
              include('apoyos/enfermeria_dom1.php');
            }
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';
          $turno_validar=$fila_detalle['intervalo'];

          if ($turno_validar==12 || $turno_validar==8 || $turno_validar==6 || $turno_validar==3) {
            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            //echo $hoy;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno='.$fila_detalle["intervalo"].'&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Nota Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          }
          if ($turno_validar==24) {
            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            ////echo $hoy;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=D&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-sun"></span> Nota<br>Enfermería</button></a></p>';
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&turno=24&tipo=N&idd='.$idd.'&v1='.$fila_detalle["finicio"].'&v2='.$fila_detalle["ffinal"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-moon"></span> Nota<br>Enfermería</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>';
             echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MED&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'&idd='.$idd.'"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe"></span> Administración<br>Medicamentos</button></a></p>';
            }
          }
          echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
               </th>';
              include('apoyos/enfermeria_dom2.php');
          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada PROD:'.$fila_detalle['id_d_aut_dom'].'</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle["id_d_aut_dom"].'_vencida"><span class="fa fa-search"></span> Consultar</button></p>
             </th>';
             include('apoyos/enfermeria_dom2.php');
      }
    }
  }
}
 ?>
