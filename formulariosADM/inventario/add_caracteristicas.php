<section class="panel panel-default">
  <section class="panel-heading">
    <h2><?php echo $subtitulo ?></h2>
  </section>
  <section class="panel-body">
    <form action="<?php echo PROGRAMA.'?opcion=201';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
      <input type="hidden" name="id_equipo" value="<?php echo $_GET["id"] ?>">
      <section>      
      </section>
      <section class="row">
          <article class="col-md-12">
            <h3 class="text-center"><?php echo 'Hardware'; ?></h3>
          </article>
          <article class="col-md-3">
            <label class="text-center">Nombre Equipo: <strong class="text-danger">*</strong> </label><br>
            <input type="text" class="form-control text-center" required name="nombre_equipo" value="<?php echo $fila["nombre_equipo"];?>"<?php echo $atributo2;?>/>
          </article>
          <article class="col-md-2">
            <label class="text-center">DD: <strong class="text-danger">*</strong> </label><br>
            <select class="form-control" name="disco_duro">
              <option value="128GB">128GB</option>
              <option value="256GB">256GB</option>
              <option value="512GB">512GB</option>
              <option value="1TB">1TB</option>
            </select>
           </article>
           <article class="col-md-2">
            <label class="text-center">RAM: <strong class="text-danger">*</strong> </label><br>
            <select class="form-control" name="ram">
              <option value="1GB">1GB</option>
              <option value="2GB">2GB</option>
              <option value="4GB">4GB</option>
              <option value="6GB">6GB</option>
              <option value="8GB">8GB</option>
              <option value="16GB">16GB</option>
            </select>
           </article>
          <article class="col-md-5">
            <label class="text-center">Procesador: <strong class="text-danger">*</strong> </label><br>
            <input type="text" class="form-control text-center" required name="procesador" value="<?php echo $fila["procesador"];?>"<?php echo $atributo2;?>/>
          </article>
      </section>
      <section class="row">
          <article class="col-md-12">
            <h3 class="text-center"><?php echo 'Software'; ?></h3>
          </article>
          <article class="col-md-3">
           <label class="text-center">Sistema operativo: <strong class="text-danger">*</strong> </label><br>
           <select class="form-control" name="sistema_operativo">
             <option value="Ubuntu 18-04">Ubuntu 18-04</option>
             <option value="Ubuntu 16-04">Ubuntu 16-04</option>
             <option value="Windows 10">Windows 10</option>
             <option value="Windows 7">Windows 7</option>
           </select>
          </article>
          <article class="col-md-3">
            <label class="text-center">Licencia: <strong class="text-danger">*</strong> </label><br>
            <input type="text" class="form-control text-center" required name="licencia" value="<?php echo $fila["licencia"];?>"<?php echo $atributo2;?>/>
          </article>
          <article class="col-md-3">
           <label class="text-center">Ofimatica: <strong class="text-danger">*</strong> </label><br>
           <select class="form-control" name="ofimatica">
             <option value="libre office">libre office</option>
             <option value="Office 2016">Office 2016</option>
             <option value="Office 2010">Office 2010</option>
           </select>
          </article>
          <article class="col-md-3">
            <label class="text-center">Licencia ofimatica: <strong class="text-danger">*</strong> </label><br>
            <input type="text" class="form-control text-center" required name="licencia_ofimatica" value="<?php echo $fila["licencia_ofimatica"];?>"<?php echo $atributo2;?>/>
          </article>
        <section class="col-md-10 col-sm-12">
          <article >
            <label class="text-center">Aplicaciones instaladas<strong class="text-danger">*</strong></label><br>
            <input type="text" class="form-control text-center" required name="aplicaciones" value="<?php echo $fila["aplicaciones"];?>"<?php echo $atributo2;?>/>
          </article>
        </section>
      </section>
      <section class="row">
          <article class="col-md-12">
            <h3 class="text-center"><?php echo 'Red'; ?></h3>
          </article>
          <article class="col-md-3">
          <label class="text-center">Tipo de red: <strong class="text-danger">*</strong> </label><br>
          <select class="form-control" name="tipo_red">
            <option value="2">DHCP</option>
            <option value="1">Estatica</option>
          </select>
         </article>
             <article class="col-md-3">
            <label class="text-center">IP: <strong class="text-danger">*</strong> </label><br>
            <input type="text" class="form-control text-center" required name="ip" value="<?php echo $fila["ip"];?>"<?php echo $atributo2;?>/>
             </article>
             <article class="col-md-3">
            <label class="text-center">Mascara de red: <strong class="text-danger">*</strong> </label><br>
            <input type="text" class="form-control text-center" required name="mascara" value="<?php echo $fila["mascara"];?>"<?php echo $atributo2;?>/>
             </article>
             <article class="col-md-3">
             <label class="text-center">Puerta de enlace: <strong class="text-danger">*</strong> </label><br>
             <select class="form-control" name="gateway">
               <option value="192.168.2.1">192.168.2.1</option>
               <option value="192.168.4.1">192.168.4.1</option>
               <option value="192.168.5.1">192.168.5.1</option>
               <option value="192.168.6.1">192.168.6.1</option>
               <option value="192.168.7.1">192.168.7.1</option>
             </select>
            </article>
        </section><br>
        <section class="row">
          <article class="col-md-6">
              <label class="text-center">Observaciones<strong class="text-danger">*</strong></label><br>
              <input type="text" class="form-control text-center" required name="observaciones" value="<?php echo $fila["observaciones"];?>"<?php echo $atributo2;?>/>
          </article>
            <p class="row card-body"></p>
        </section>
      <div class="panel-body text-center">
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </div>
    </form>
