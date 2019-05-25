<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idadmhosp='.$return1.'&servicio='.$return2.'&atencion='.$return5.'&sede='.$return6.'&doc='.$return3.'&tf='.$return4;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

      <?php
      $servicio=$_REQUEST['servicio'];
      $atencion=$_REQUEST['atencion'];

      if ($servicio=='Hospitalario' || $servicio=='Hospital dia' || $servicio=='Consulta Externa SM' || $servicio=='Domiciliarios') {
        if ($atencion=='Hospitalario') { //validacion de formulario creacion de formula en hospitalario
          ?>
          <section class="panel panel-default">
            <section class="panel-heading"><h4><?php echo $subtitulo; ?></h4></section>
            <section class="panel-body">
            <article class="col-xs-1">
              <label for="">ID:</label>
              <input type="text"  name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>"<?php echo $atributo1;?>/>
              <input type="hidden"  name="servicio" class="form-control" value="<?php echo $_GET["servicio"];?>"<?php echo $atributo1;?>/>
              <input type="hidden"  name="idm" class="form-control" value="<?php echo $fila["id_m_fmedhosp"];?>"<?php echo $atributo1;?>/>
            </article>
            <article class="col-xs-3">
              <label for="">Fecha inical de ejecución:</label>
              <input type="date" name="fejecucion_inicial" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo2;?>>
            </article>
            <article class="col-xs-3">
              <label for="">Fecha final de ejecución:</label>
              <input type="date" name="fejecucion_final" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo2;?>>
            </article>
            <article class="col-xs-4">
              <label for="">Tipo de formula:</label>
              <select class="form-control"  name="tipo_formula" required="" <?php echo $atributo2;?>>
                <option values="<?php echo $fila["tipo_formula"];?>"><?php echo $fila["tipo_formula"];?></option>
                <option values="Programada">Programada</option>
                <option values="Evento">Evento</option>
              </select>
            </article>
            <article class="col-xs-5">
              <label for="">Seleccione Bodega: </label>
              <select name="idbodega" class="form-control"  required=""  <?php echo atributo3; ?>>
                <option values="<?php echo $fila["id_bodega"];?>"><?php echo $fila["nom_bodega"];?></option>
                <?php
                $tf=$_REQUEST['tf'];
                if ($tf==N) {
                  $sql="SELECT id_bodega,nom_bodega from bodega where id_sedes_ips='".$_REQUEST['sede']."' and tipo_bodega in ('Farmacia','Carro de medicamentos')";
                  //echo $sql;
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_bodega"]==$fila2["id_bodega"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
                    }
                  }
                }
                if ($tf==E) {
                  $sql="SELECT id_bodega,nom_bodega from bodega where id_sedes_ips='".$_REQUEST['sede']."' and tipo_bodega in ('Carro de paro')";
                  //echo $sql;
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_bodega"]==$fila2["id_bodega"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
                    }
                  }
                }

                ?>
              </select>
            </article>
            <article class="col-xs-7 text-center">
              <h4>Diagnostico de la formula:</h4>
              <?php
              $date=date('Y-m-d');
              $perfil=$_SESSION['AUT']['id_perfil'];
              $sql="SELECT a.dxp,dx1,dx2,
                           b.nombre,id_perfil
                    FROM evolucion_medica a INNER JOIN user b on a.id_user=b.id_user
                    WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_evomed='$date' and b.id_perfil in ($perfil)";
                    //echo $sql;
              if($tabla=$bd1->sub_tuplas($sql)){
                foreach ($tabla as $fila2) {

                    $dx=$fila2['dxp'];
                    $dx1=$fila2['dx1'];
                    $dx2=$fila2['dx2'];

                    $dxt=substr($dx, 0,4);
                    $dx1t=substr($dx1, 0,4);
                    $dx2t=substr($dx2, 0,4);
                    echo'<article class="col-md-6"><label>Principal: </label><input type="text" class="form-control" name="dx_formula" value="'.$dxt.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-6"><label>Relacionado 1: </label><input type="text" class="form-control" name="dx1_formula" value="'.$dx1t.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-6"><label>Relacionado 2: </label><input type="text" class="form-control" name="dx2_formula" value="'.$dx2t.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-6"><label>Profesional: </label><input type="text" class="form-control" name="dxformula" value="'.$fila2['nombre'].'" '.$atributo1.'></article>';
                    ?>

                    <article class="col-md-12">
                    </a>
                      <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
                      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
                      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
                    </a>
                    </article><?php
                }
              }else {
                echo '<p class="alert alert-danger animated jello">No existe evolución del día presente, esto podria afectar procesos de formulación
                      <br><a href="'.PROGRAMA.'?opcion=19&mante=EVO&idadmhosp='.$_REQUEST["idadmhosp"].'&doc='.$_REQUEST["doc"].'&servicio=Hospitalario"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span>Desea Realizar Evolución ?</button></a></p>';
              }
               ?>
            </article>
          </section>
        </section>
          <?php
        }else {
          ?>
          <section class="panel panel-default">
            <section class="panel-heading"><h4><?php echo $subtitulo; ?></h4></section>
            <section class="panel-body">
            <article class="col-xs-1">
              <label for="">ID:</label>
              <input type="text"  name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>"<?php echo $atributo1;?>/>
              <input type="hidden"  name="servicio" class="form-control" value="<?php echo $_GET["servicio"];?>"<?php echo $atributo1;?>/>
              <input type="hidden"  name="idm" class="form-control" value="<?php echo $fila["id_m_fmedhosp"];?>"<?php echo $atributo1;?>/>
            </article>
            <article class="col-xs-2">
              <label for="">Fecha inical:</label>
              <input type="date" name="fejecucion_inicial" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo2;?>>
            </article>
            <article class="col-xs-2">
              <label for="">Fecha final:</label>
              <?php
              $fecha =date('Y-m-d');
              $nuevafecha = strtotime ( '+32 day' , strtotime ( $fecha ) ) ;
              $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
                ?>
              <input type="date" name="fejecucion_final" class="form-control" value="<?php echo $nuevafecha;?>" <?php echo $atributo2;?>>
            </article>
            <article class="col-xs-2">
              <label for="">Tipo de formula:</label>
              <?php $atencion=$_REQUEST['atencion'] ?>
              <input type="text" class="form-control" name="tipo_formula" value="<?php echo $atencion ?>" <?php echo $atributo1 ?>>
            </article>
            <article class="col-xs-4">
              <label for="">Seleccione Bodega: </label>
              <select name="idbodega" class="form-control"  required=""  <?php echo atributo3; ?>>
                <option values="<?php echo $fila["id_bodega"];?>"><?php echo $fila["nom_bodega"];?></option>
                <?php
                $tf=$_REQUEST['tf'];
                if ($tf==N) {
                  $sql="SELECT id_bodega,nom_bodega from bodega where id_sedes_ips='".$_REQUEST['sede']."' and tipo_bodega in ('Farmacia','Carro de medicamentos')";
                  //echo $sql;
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_bodega"]==$fila2["id_bodega"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
                    }
                  }
                }
                if ($tf==E) {
                  $sql="SELECT id_bodega,nom_bodega from bodega where id_sedes_ips='".$_REQUEST['sede']."' and tipo_bodega in ('Carro de paro')";
                  //echo $sql;
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_bodega"]==$fila2["id_bodega"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
                    }
                  }
                }
                if ($tf==A) {
                  $sql="SELECT id_bodega,nom_bodega from bodega where id_sedes_ips='".$_REQUEST['sede']."' and tipo_bodega in ('Ambulatoria')";
                  //echo $sql;
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_bodega"]==$fila2["id_bodega"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
                    }
                  }
                }

                ?>
              </select>
            </article>
            <article class="col-xs-12 text-center">
              <h4>Diagnostico de la formula:</h4>
              <?php
              $date=date('Y-m-d');
              $mes=date('m');
              $perfil=$_SESSION['AUT']['id_perfil'];
              //echo $perfil;
              $sql="SELECT a.dxp,dx1,dx2,
                           b.nombre,id_perfil
                    FROM evolucion_medica a INNER JOIN user b on a.id_user=b.id_user
                    WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_evomed='$date' and b.id_perfil in (3,4,49,48,1)
                    UNION
                    SELECT a.dxp,dx1,dx2,
                                 b.nombre,id_perfil
                          FROM hc_sm_pv a INNER JOIN user b on a.id_user=b.id_user
                          WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_hcsm_pv	='$date' and b.id_perfil in (3,4,49,48,1)

                          UNION

                          SELECT a.dxp,dx1,dx2,
                                 b.nombre,id_perfil
                                FROM hcini_dom a INNER JOIN user b on a.id_user=b.id_user
                                WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_hchosp	BETWEEN '2018-$mes-01' and '2018-$mes-31' and b.id_perfil in (3,4,49,48,1) limit 1
                    ";

                    //echo $sql;
              if($tabla=$bd1->sub_tuplas($sql)){
                foreach ($tabla as $fila2) {

                    $dx=$fila2['dxp'];
                    $dx1=$fila2['dx1'];
                    $dx2=$fila2['dx2'];

                    $dxt=substr($dx, 0,4);
                    $dx1t=substr($dx1, 0,4);
                    $dx2t=substr($dx2, 0,4);
                    echo'<article class="col-md-3"><label>Principal: </label><input type="text" class="form-control" name="dx_formula" value="'.$dxt.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-3"><label>Relacionado 1: </label><input type="text" class="form-control" name="dx1_formula" value="'.$dx1t.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-3"><label>Relacionado 2: </label><input type="text" class="form-control" name="dx2_formula" value="'.$dx2t.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-3"><label>Profesional: </label><input type="text" class="form-control" name="dxformula" value="'.$fila2['nombre'].'" '.$atributo1.'></article>';
                    ?>

                    <article class="col-md-12">
                    </a>
                      <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
                      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
                      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
                    </a>
                    </article><?php
                }
              }else {
                echo '<p class="alert alert-danger animated jello">No existe evolución del día presente, esto podria afectar procesos de formulación.
                      <br><a href="'.PROGRAMA.'?opcion=19&mante=EVO&idadmhosp='.$_REQUEST["idadmhosp"].'&doc='.$_REQUEST["doc"].'&servicio=Hospitalario"><button type="button" class="btn btn-primary " >
                    <span class="fa fa-stethoscope"></span>Desea Realizar Evolución ?</button></a></p>';
              }
               ?>

              <?php
              $date=date('Y-m-d');
              $perfil=$_SESSION['AUT']['id_perfil'];
            //  echo $perfil;
              $sql_hc="SELECT a.dxp,dx1,dx2,
                           b.nombre,id_perfil
                    FROM hc_hospitalario a INNER JOIN user b on a.id_user=b.id_user
                    WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_hchosp	='$date' and b.id_perfil in (3,4,49,48,1)

                    UNION

                    SELECT a.dxp,dx1,dx2,
                                 b.nombre,id_perfil
                          FROM hc_sm_pv a INNER JOIN user b on a.id_user=b.id_user
                          WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_hcsm_pv	='$date' and b.id_perfil in (3,4,49,48,1)

                          UNION

                          SELECT a.dxp,dx1,dx2,
                                 b.nombre,id_perfil
                                FROM hcini_dom a INNER JOIN user b on a.id_user=b.id_user
                                WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."' and a.freg_hchosp	='$date' and b.id_perfil in (3,4,49,48,1) limit 1";
                    //echo $sql;
              if($tabla_hc=$bd1->sub_tuplas($sql_hc)){
                foreach ($tabla_hc as $fila_hc) {

                    $dx=$fila_hc['dxp'];
                    $dx1=$fila_hc['dx1'];
                    $dx2=$fila_hc['dx2'];

                    $dxt=substr($dx, 0,4);
                    $dx1t=substr($dx1, 0,4);
                    $dx2t=substr($dx2, 0,4);
                    echo'<article class="col-md-3"><label>Principal: </label><input type="text" class="form-control" name="dx_formula" value="'.$dxt.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-3"><label>Relacionado 1: </label><input type="text" class="form-control" name="dx1_formula" value="'.$dx1t.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-3"><label>Relacionado 2: </label><input type="text" class="form-control" name="dx2_formula" value="'.$dx2t.'" '.$atributo1.'></article>';
                    echo'<article class="col-md-3"><label>Profesional: </label><input type="text" class="form-control" name="dxformula" value="'.$fila_hc['nombre'].'" '.$atributo1.'></article>';
                    ?>
                    <article class="col-md-12">
                    </a>
                      <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
                      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
                      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
                    </a>
                    </article>
                    <?php
                }
              }else {
                echo '<article class="col-md-12"><p class="text-danger">No tiene HC de ingreso para realizar el dia de hoy</p></article>';
              }
               ?>
            </article>
          </section>
        </section>
          <?php
        }
      }
       ?>
</form>
