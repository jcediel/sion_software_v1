<?php
  $adm=$fila['idpac'];
  $servicio=$_REQUEST['servicio'];
  $sql_admision="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  c.descripestadoc,
  d.descriafiliado,
  e.descritusuario,
  f.descriocu,
  g.descripdep,
  h.descrimuni,
  i.descripuedad,
  j.nom_eps,
  m.nombre_acu,dir_acu,tel_acu,parentesco_acu,
  n.nombre_aco,dir_aco,tel_aco,parentesco_aco
  FROM pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
        left join estado_civil c on (c.codestadoc = a.estadocivil)
        left join tusuario e on (e.codtusuario=b.tipo_usuario)
        left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
        left join ocupacion f on (f.codocu=b.ocupacion)
        left join departamento g on (g.coddep=b.dep_residencia)
        left join municipios h on (h.codmuni=b.mun_residencia)
        left join uedad i on (i.coduedad=a.uedad)
        left join eps j on (j.id_eps=b.id_eps)
        left join info_acudiente m on (m.id_adm_hosp=b.id_adm_hosp)
        left join info_acompanante n on (n.id_adm_hosp=b.id_adm_hosp)
  WHERE a.id_paciente = $adm limit 1";
  //echo $sql_admision;
  if ($tabla_admision=$bd1->sub_tuplas($sql_admision)){
    foreach ($tabla_admision as $fila_admision) {
      ?>
      <div class="botonhc" >
          <a data-toggle="collapse" class="ac" data-target="#datpac" >Datos del Paciente</a> <span class="glyphicon glyphicon-arrow-down"></span>
      </div>
        <section class="collapse" id="datpac">
          <section class="panel-body"><!--section de eps-->
            <article class="col-md-8 text-center">
              <label for="">Nombre Completo:</label>
              <input type="text" name="pacnom" class="form-control text-center" value="<?php echo $fila_admision["nom1"];?> <?php echo $fila_admision["nom2"];?> <?php echo $fila_admision["ape1"];?> <?php echo $fila_admision["ape2"];?>"<?php echo $atributo1;?>/>
            </article>
            <article class="col-md-1">
              <label for="">DI:</label>
              <input type="text" name="tdoc" class="form-control text-center" value="<?php echo $fila_admision["tdoc_pac"];?> "<?php echo $atributo1;?>/>
            </article>
            <article class="col-md-3">
              <label for="">Documento:</label>
              <input type="text" name="doc" class="form-control text-center" value="<?php echo $fila_admision["doc_pac"];?>"<?php echo $atributo1;?>/>
            </article>
            <article class="col-md-5">
              <label for="">Edad:</label>
              <?php
              $fecha=$fila_admision["fnacimiento"];
              $segundos= strtotime('now') - strtotime($fecha);
              $diferencia_dias=intval($segundos/60/60/24/365);
              ?>
              <input type="text" name="edad" class="form-control text-center" value="Edad: <?php echo $diferencia_dias;?> <?php echo $fila_admision["descripuedad"];?> | Fecha nacimiento: <?php echo $fila_admision["fnacimiento"];?>"<?php echo $atributo1;?>/>
            </article>
            <article class="col-md-2">
              <label for="">Genero:</label>
              <input type="text" name="genero" class="form-control text-center" value="<?php echo $fila_admision["genero"];?>" <?php echo $atributo1;?>/>
            </article>
            <article class="col-md-1">
              <label for="">Rh:</label>
              <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila_admision["rh"];?>" <?php echo $atributo1;?>/>
            </article>
            <article class="col-md-2">
              <label for="">Estado Civil:</label>
              <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila_admision["descripestadoc"];?>" <?php echo $atributo1;?>/>
            </article>
            <article class="col-md-5">
              <label for="">Email:</label>
              <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila_admision["email_pac"];?>" <?php echo $atributo1;?>/>
            </article>
            <article class="col-md-7">
              <label for="">Dirección:</label>
              <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila_admision["dir_pac"].' - '.$fila_admision["descripdep"]. '-' .$fila_admision["descrimuni"];?>" <?php echo $atributo1;?>/>
            </article>

            <article class="col-md-3">
              <label for="">Teléfono:</label>
              <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila_admision["tel_pac"];?>" <?php echo $atributo1;?>/>
            </article>
            <article class="col-md-2">
              <label for="">Religión:</label>
              <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila_admision["religion"];?>"<?php echo $atributo1;?>/>
            </article>
          </section>
          <section class="panel-body">

            <article class="col-md-3">
              <label for="">Fecha y Hora Ingreso:</label>
              <input type="text" name="fhingreso" class="form-control" value="<?php echo $fila_admision["fingreso_hosp"];?>  <?php echo $fila_admision["hingreso_hosp"];?>"<?php echo $atributo1?>/>
            </article>
            <article class="col-md-4">
              <label for="">EPS:</label>
              <input type="hidden" name="ideps" value="<?php echo $fila_admision["ideps"];?>">
              <input type="text" name="eps" class="form-control" value="<?php echo $fila_admision["nom_eps"];?>"<?php echo $atributo1?>/>
            </article>
            <article class="col-md-2">
              <label for="">Regimen:</label>
              <input type="text" name="fhingreso" class="form-control" value="<?php echo $fila_admision["descritusuario"];?>"<?php echo $atributo1?>/>
            </article>
            <article class="col-md-2">
              <label for="">Afiliación:</label>
              <input type="text" name="fhingreso" class="form-control" value="<?php echo $fila_admision["descriafiliado"];?>"<?php echo $atributo1?>/>
            </article>
          </section>
        </section>

      <?php
    }
  }
  ?>
