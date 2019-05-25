<?php
$cat=$_REQUEST['CAT'];
if ($cat==1) {
  ?>
  <form action="<?php echo PROGRAMA.'?opcion=97';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
    <section class="panel panel-default">
      <section class="panel-heading"><h4><?php echo $subtitulo ?></h4></section>
      <section class="panel-body"><!-- Información del m_producto -->
        <article class="col-xs-12 animated flipInY alert alert-danger">
          <ul> <strong> <span class="fa fa-info-circle"></span> RECUERDE: El medicamento principal que va a registrar debe poseer las siguientes características:</strong>
            <li>El nombre del medicamento principal consta de : principio activo + concentración + forma farmacéutica. <i>Ejemplo:</i> "ACETAMINOFEN 500MG TABLETA"</li>
            <li>El nombre del medicamento principal no puede repetirse es único. Por lo tanto el software no le permitirá guardar un registro repetido.</li>
            <li>Tenga cuenta que los productos detallados que se anidan a este medicamento principal contienen toda la información</li>
          </ul>
        </article>
       </section>
       <section class="panel-body">
         <article class="col-md-4">
          <label for="">Descripción del producto:</label>
          <input type="text" name="nom_producto" class="form-control text-center" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $fila["nom_producto"];?>"<?php echo $atributo3;?>/>
          <input type="hidden" name="cat" value="<?php echo $cat ?>">
          <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto'] ?>">
        </article>
        <article class="col-md-2">
          <label for="">Grupo terapeutico:</label>
          <select class="form-control" name="gterapeutico" required="">
            <option value=""></option>
            <?php
            $sql="SELECT id_gterapia,descripcion_gterapia from grupo_terapeutico ORDER BY descripcion_gterapia ASC";
            if($tabla=$bd1->sub_tuplas($sql)){
              foreach ($tabla as $fila2) {
                if ($fila["id_gterapia"]==$fila2["id_gterapia"]){
                  $sw=' selected="selected"';
                }else{
                  $sw="";
                }

              echo '<option value="'.$fila2["id_gterapia"].'"'.$sw.'>'.$fila2["descripcion_gterapia"].'</option>';
              }
            }
            ?>
          </select>
        </article>
        <article class="col-md-2">
          <label for="">POS:</label>
          <select recuired="" class="form-control" name="pos">
            <option value="<?php echo $fila["pos"];?>"><?php echo $fila["pos"];?></option>
            <option value="0">POS</option>
            <option value="1">NO POS</option>
          </select>
        </article>
        <article class="col-md-2">
          <label for="">Controlado:</label>
          <select recuired="" class="form-control" name="controlado">
            <option value="<?php echo $fila["controlado"];?>"><?php echo $fila["controlado"];?></option>
            <option value="0">NO</option>
            <option value="1">SI</option>
          </select>
        </article>
        <article class="col-md-2">
          <label for="">Costo Mayor:</label>
          <select recuired="" class="form-control" name="altocosto">
            <option value="<?php echo $fila["altocosto"];?>"><?php echo $fila["altocosto"];?></option>
            <option value="0">NO</option>
            <option value="1">SI</option>
          </select>
        </article>
       </section>
       <section class="panel-body">
         <article class="col-md-2">
          <label for="">Embalaje:</label>
          <select class="form-control" name="embalaje">
            <option value="<?php echo $fila["embalaje"];?>"><?php echo $fila["embalaje"];?></option>
            <option value="UNIDAD">UNIDAD</option>
            <option value="PAQUETE">PAQUETE</option>
            <option value="FRASCO">FRASCO</option>
          </select>
         </article>
         <article class="col-md-2">
           <label for="">Unidad:</label>
           <input type="number" class="form-control" name="unidad" value="<?php echo $fila['unidad'] ?>">
           </select>
         </article>
         <article class="col-md-8">
           <label for="">En caso de ser NO POS, aclarar aqui la exepción :</label>
           <textarea name="exepcion" class="form-control" rows="5" cols="80"><?php echo $fila['exepcion'] ?></textarea>
           </select>
         </article>
       </section>
    <div class="row text-center">
      <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
    </div>
    </section>
  </form>
  <?php
}
if ($cat==2) {
  ?>
  <form action="<?php echo PROGRAMA.'?opcion=97';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
    <section class="panel panel-default">
      <section class="panel-heading"><h4><?php echo $subtitulo ?></h4></section>

       <section class="panel-body">
         <article class="col-md-4">
          <label for="">Descripción del producto:</label>
          <input type="text" name="nom_producto" class="form-control text-center" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $fila["nom_producto"];?>"<?php echo $atributo3;?>/>
          <input type="hidden" name="cat" value="<?php echo $cat ?>">
          <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto'] ?>">
        </article>
        <article class="col-md-2">
          <label for="">Grupo terapeutico:</label>
          <select class="form-control" name="gterapeutico" required="">
            <option values="DISPOSITIVO MEDICO">DISPOSITIVO MEDICO</option>
          </select>
        </article>
        <article class="col-md-2">
          <label for="">POS:</label>
          <select recuired="" class="form-control" name="pos">
            <option value="<?php echo $fila["pos"];?>"><?php echo $fila["pos"];?></option>
            <option value="0">POS</option>
            <option value="1">NO POS</option>
          </select>
        </article>
        <article class="col-md-2">
          <label for="">Controlado:</label>
          <select recuired="" class="form-control" name="controlado">
            <option value="<?php echo $fila["controlado"];?>"><?php echo $fila["controlado"];?></option>
            <option value="0">NO</option>
            <option value="1">SI</option>
          </select>
        </article>
        <article class="col-md-2">
          <label for="">Alto Costo:</label>
          <select recuired="" class="form-control" name="altocosto">
            <option value="<?php echo $fila["altocosto"];?>"><?php echo $fila["altocosto"];?></option>
            <option value="0">NO</option>
            <option value="1">SI</option>
          </select>
        </article>
       </section>
       <section class="panel-body">
         <article class="col-md-2">
          <label for="">Embalaje:</label>
          <select class="form-control" name="embalaje">
            <option value="<?php echo $fila["embalaje"];?>"><?php echo $fila["embalaje"];?></option>
            <option value="UNIDAD">UNIDAD</option>
            <option value="PAQUETE">PAQUETE</option>
            <option value="FRASCO">FRASCO</option>
          </select>
         </article>
         <article class="col-md-2">
           <label for="">Unidad:</label>
           <input type="number" class="form-control" name="unidad" value="<?php echo $fila['unidad'] ?>">
           </select>
         </article>
         <article class="col-md-8">
          <label for="">Clasificación de Riesgo:</label>
          <select class="form-control" name="clase_riesgo">
            <option value="<?php echo $fila["clase_riesgo"];?>"><?php echo $fila["clase_riesgo"];?></option>
            <option value="I(A)">Riesgo Bajo (Instrumental quirúrgico / Gasa.)</option>
            <option value="IIa(B)"> Riesgo Moderado (Agujas hipodérmicas / equipo de succión)</option>
            <option value="IIb(C)"> Riesgo Alto (Ventilador pulmonar / implantes ortopédicos)</option>
            <option value="III(D)"> Riesgo Muy Alto (Válvulas cardiacas / marcapasos.)</option>
          </select>
         </article>
         <article class="col-md-12">
           <label for="">En caso de ser NO POS, aclarar aqui la exepción :</label>
           <textarea name="exepcion" class="form-control" rows="5" cols="80" placeholder="AQUI puedes realizar un listado de los CIE10 que generan excepcion de NO POS"><?php echo $fila['exepcion'] ?></textarea>
           </select>
         </article>
       </section>
    <div class="row text-center">
      <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
    </div>
    </section>
  </form>
  <?php
}
 ?>
