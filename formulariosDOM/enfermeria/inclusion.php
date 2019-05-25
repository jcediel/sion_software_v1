<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label>Fecha registro:</label>
        <input type="text" class="form-control" name="freg_inclusion" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="idadmhosp" value="<?php echo $_REQUEST['idadmhosp'] ?>"<?php echo $atributo1?>>
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-6 text-left">
        <label>Domicilio ubicado en area de georeferenciación.</label>
        <input type="hidden" class="form-control" name="criterio1" value="Domicilio ubicado en area de georreferenciacion."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor1">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs1" class="form-control"  rows="4" cols="80"></textarea>
      </article>
      <article class="col-md-6 text-left">
        <label>Diagnóstico definido, respuesta adecuada al tratamiento instaurado.</label>
        <input type="hidden" class="form-control" name="criterio2" value="Diagnóstico definido, respuesta adecuada al tratamiento instaurado."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor2">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs2" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Estabilidad hemodinámica del paciente.</label>
        <input type="hidden" class="form-control" name="criterio3" value="Estabilidad hemodinámica del paciente."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor3">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs3" class="form-control"  rows="4" cols="80"></textarea>
      </article>


      <article class="col-md-6 text-left">
        <label>Firma del consentimiento informado.</label>
        <input type="hidden" class="form-control" name="criterio4" value="Firma del consentimiento informado."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor4">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs4" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Aceptación del servicio por parte del paciente y cuidador</label>
        <input type="hidden" class="form-control" name="criterio5" value="Aceptación del servicio por parte del paciente y cuidador"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor5">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs5" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Lectura y firma de derechos y deberes.</label>
        <input type="hidden" class="form-control" name="criterio6" value="Lectura y firma de derechos y deberes."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor6">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs6" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Cuenta con cuidador primario, entendiendo por cuidador primario aquella persona que conviviendo con el paciente acepta asumir los cuidados basicos en cuanto a alimentacion, higiene, y administracion del tratamiento.</label>
        <input type="hidden" class="form-control" name="criterio7" value="Cuenta con cuidador primario, entendiendo por cuidador primario aquella persona que conviviendo con el paciente acepta asumir los cuidados basicos en cuanto a alimentacion, higiene, y administracion del tratamiento."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor7">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs7" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Accesibilidad al domicilio</label>
        <input type="hidden" class="form-control" name="criterio8" value="Accesibilidad al domicilio"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor8">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs8" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Servicios públicos:  acueducto, alcantarillado, energía</label>
        <input type="hidden" class="form-control" name="criterio9" value="Servicios públicos:  acueducto, alcantarillado, energía"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor9">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs9" class="form-control"  rows="4" cols="80"></textarea>
      </article>
      <article class="col-md-6 text-left">
          <label>Telefonía fija o móvil</label>
          <input type="hidden" class="form-control" name="criterio10" value="Telefonía fija o móvil"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor10">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs10" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Baño con sanitario, ducha, lavamanos, dispositivos de seguridad (silla, baranda, piso antideslizante etc)</label>
          <input type="hidden" class="form-control" name="criterio11" value="Baño con sanitario, ducha, lavamanos, dispositivos de seguridad (silla, baranda, piso antideslizante etc)"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor11">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs11" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Área para almacenamiento de residuos generados en la atención para su posterior transporte a la sede de la IPS.</label>
          <input type="hidden" class="form-control" name="criterio12" value="Área para almacenamiento de residuos generados en la atención para su posterior transporte a la sede de la IPS."<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor12">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs12" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Transporte de residuos por parte de la IPS garantizando las normas de bioseguridad</label>
          <input type="hidden" class="form-control" name="criterio13" value="Transporte de residuos por parte de la IPS garantizando las normas de bioseguridad"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor13">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs13" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>En el domicilio el auxiliar cuenta con insumos de bioseguridad para manejo del paciente.</label>
          <input type="hidden" class="form-control" name="criterio14" value="En el domicilio el auxiliar cuenta con insumos de bioseguridad para manejo del paciente."<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor14">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs14" class="form-control"  rows="4" cols="80"></textarea>
        </article>
    </section>
    <section class="panel-body">
     <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
     <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </section>
 		</section>
  </form>
