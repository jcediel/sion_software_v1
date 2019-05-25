<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#username').blur(function(){


    $('#Info').html('<span class="fa fa-spinner	fa-spin"></span>').fadeOut(1000);

    var username = $(this).val();
    var dataString = 'username='+username;

    $.ajax({
      type: "POST",
      url: "formulariosADM/usuarios/comprobar_cuenta.php",
      data: dataString,
      success: function(data) {
        $('#Info').fadeIn(1000).html(data);
      }
    });
  });
});
</script>
<script src = "js/sha3.js"></script>
<script>
function validar(){
  if (document.forms[0].nombre.value == ""){
    alert("NO PODEMOS CREAR EL USUARIO SIN UN NOMBRE");
    document.forms[0].nombre.focus();				// Ubicar el cursor
    return(false);
  }
  if (document.forms[0].username.value == ""){
    alert("NO PODEMOS CREAR EL USUARIO SIN UNA CUENTA");
    document.forms[0].username.focus();				// Ubicar el cursor
    return(false);
  }

  if (document.forms[0].clave1.value == document.forms[0].clave2.value ){
    if (document.forms[0].clave1.value != ""){
      document.forms[0].clave1.value = CryptoJS.SHA3(document.forms[0].clave1.value);
      document.forms[0].clave2.value = document.forms[0].clave1.value;
    }
  }else{
    alert("Error en confirmacion de la clave!");
    document.forms[0].clave1.value = "";
    document.forms[0].clave2.value = "";
    document.forms[0].clave1.focus();				// Ubicar el cursor
    return(false);
  }
}
</script>
<form action="<?php echo PROGRAMA.'?ident='.$doc.'&buscar=Consultar&opcion=1';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="card">
    <section class="card-header">
      <h3><?php echo $subtitulo; ?></h3>
    </section><br>
    <div class="container col-md-12">
      <div class="panel-group col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4><strong>Datos personales</strong></h4>
          </div>
          <div class="panel-body">
            <section class="row">
              <article class="col-md-4">
                <label class="text-center">Nombre: <strong class="text-danger">*</strong></label><br>
                <input type="hidden" name="idu" value="<?php echo $fila['id_user']?>">
                <input type="text" class="form-control text-center" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required name="nombre" value="<?php echo $fila["nombre"];?>"<?php echo $atributo2;?>/>
              </article>
              <article class="col-md-2">
                <label class="text-center">Tipo Documento: <strong class="text-danger">*</strong></label><br>
                <select name="tdoc" class="form-control" <?php echo atributo3; ?>>
                  <option value="<?php echo $fila["tdoc"];?>"><?php echo $fila["tdoc"];?></option>
                  <?php
                  $sql="SELECT tipo,descri_tipo from tdocumentos ORDER BY descri_tipo ASC";
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["tipo"]==$fila2["tipo"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                      echo '<option value="'.$fila2["tipo"].'"'.$sw.'>'.$fila2["descri_tipo"].'</option>';
                    }
                  }
                  ?>
                </select>
              </article>
              <article class="col-md-2">
                <label class="text-center">Documento: <strong class="text-danger">*</strong> </label><br>
                <input type="text" class="form-control text-center" required name="doc" value="<?php echo $fila["doc"];?>"<?php echo $atributo2;?>/>
              </article>
              <article class="col-md-4">
                <label class="text-center">Dirección: <strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="dir_user" value="<?php echo $fila["dir_user"];?>"<?php echo $atributo2;?>/>
              </article>
            </section>
            <section class="row card-body"><br>
              <article class="col-md-3">
                <label class="text-center">Teléfono: <strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="tel_user" value="<?php echo $fila["tel_user"];?>"<?php echo $atributo2;?>/>
              </article>
              <article class="col-md-3">
                <label class="text-center">Email: <strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="email" value="<?php echo $fila["email"];?>"<?php echo $atributo2;?>/>
              </article>
              <article class="col-md-3">
                <label class="text-center">Registro Medico: <strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="rm_profesional" value="<?php echo $fila["rm_profesional"];?>"<?php echo $atributo2;?>/>
              </article>
            </section>
          </div>
        </div><br>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4><strong>Datos de cuenta</strong><h4>
            </div>
            <div class="panel-body">
              <article class="col-md-2">
                <label for="">Cuenta: <strong class="text-danger">*</strong></label>
                <input id="username" class="form-control" name="username" type="text" value="<?php echo $fila["cuenta"];?>" />
                <div id="Info"></div>
              </article>
              <article class="col-md-2">
                <label>Clave: <strong class="text-danger">*</strong></label><br>
                <input type="password" class="form-control" name="clave1" value=""<?php echo $atributo2;?>/>
              </article>
              <article class="col-md-2">
                <label>Confirmar Clave: <strong class="text-danger">*</strong></label><br>
                <input type="password" class="form-control" name="clave2" value=""<?php echo $atributo2;?>/>
              </article >
              <article class="col-md-3">
                <label>Perfil: <strong class="text-danger">*</strong></label><br>
                <select name="id_perfil" class="form-control" <?php echo atributo3; ?>>
                  <?php
                  $sql="SELECT id_perfil,nombre_perfil from perfil WHERE estado_perfil=1 ORDER BY nombre_perfil ASC";
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_perfil"]==$fila2["id_perfil"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                      echo '<option value="'.$fila2["id_perfil"].'"'.$sw.'>'.$fila2["nombre_perfil"].'</option>';
                    }
                  }
                  ?>
                </select>
              </article>
              <article class="col-md-3">
                <label for="">Especialidad: <strong class="text-danger">*</strong></label>
                <select name="especialidad" class="form-control" <?php echo atributo3; ?>>
                  <option value="<?php echo $fila["especialidad"];?>"><?php echo $fila["especialidad"];?></option>
                  <?php
                  $sql="SELECT descripespec from ESPECIALIDADES ORDER BY descripespec ASC";
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["descripespec"]==$fila2["descripespec"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                      echo '<option value="'.$fila2["descripespec"].'"'.$sw.'>'.$fila2["descripespec"].'</option>';
                    }
                  }

                  ?>
                </select>
              </article>
              <article class="col-md-2">
                <label for="">Jefe Zona?: </label>
                <select name="jz" class="form-control" <?php echo atributo3; ?>>
                  <option value="<?php echo $fila["jz"];?>"><?php echo $fila["jz"];?></option>
                  <option value="0">NO</option>
                  <option value="1">SI</option>
                </select>
              </article>
            </div>
          </div><br>
          <div class="panel panel-primary">
              <div class="panel-body text-center">
                <article class="col-md-6 alert alert-info">
                  <label>Aqui se carga la foto del usuario</label><br>
                  <label><strong class="text-danger"> Tamaño Max 2MB</strong></label><br>
                  <label><strong class="text-danger">Tipo de archivo JPG, BMP, PNG</strong></label>
                  <label><i><?php echo $fila["foto"];?></i></label>
                  <img src="<?php echo '/'.$fila["foto"];?>" alt="" class="image_inicio_login"/>
                  <input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
                </article>
                <article class="col-md-6 alert alert-warning">
                  <label>Aqui se carga la firma del usuario</label><br>
                  <label><strong class="text-danger"> Tamaño Max 2MB</strong></label><br>
                  <label><strong class="text-danger">Tipo de archivo JPG, BMP, PNG</strong></label>
                  <label><i><?php echo $fila["firma"];?></i></label>
                  <img src="<?php echo $fila["firma"];?>" alt="" class="image_inicio_login"/>
                  <input type="file" class="form-control" name="firma" <?php echo $atributo3; ?>/>
                </article>
              </div>
            </div><br>
            <div class="panel-body text-center">
              <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
              <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
              <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
            </div>
          </div>
        </div>
      </section>
    </form>
