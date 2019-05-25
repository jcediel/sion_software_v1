<form action="<?php echo PROGRAMA.'?opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
    <article class="col-md-4">
      <label for="">Seleccione SEDE:</label>
      <select name="id_sedes_ips" class="form-control" required="" <?php echo atributo3; ?>>
        <option value=""></option>
        <?php
        $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips WHERE id_sedes_ips in (1,3) ORDER BY id_sedes_ips ASC";

        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
          }
        }
        ?>
      </select>
    </article>
    <article class="col-md-4">
     <label for="">Seleccione Auxiliar:</label>
     <select name="auxiliar" class="form-control" required="" <?php echo atributo3; ?>>
       <option value=""></option>
       <option value="0">Sin Auxiliar</option>
       <option value="bhm">BHM</option>
       <?php
       $sql="SELECT id_user,nombre from user WHERE id_perfil in (76,77) ";

       if($tabla=$bd1->sub_tuplas($sql)){
         foreach ($tabla as $fila2) {
           if ($fila["id_user"]==$fila2["id_user"]){
             $sw=' selected="selected"';
           }else{
             $sw="";
           }
         echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
         }
       }
       ?>
     </select>
    </article>
    <article class="col-md-4">
     <label for="">Seleccione Conductor:</label>
     <select name="conductor" class="form-control" required="" <?php echo atributo3; ?>>
       <option value=""></option>
       <option value="bhm">BHM</option>
       <?php
       $sql="SELECT id_conductor,nombre_conductor from conductor where estado_conductor='Activo'";

       if($tabla=$bd1->sub_tuplas($sql)){
         foreach ($tabla as $fila2) {
           if ($fila["id_conductor"]==$fila2["id_conductor"]){
             $sw=' selected="selected"';
           }else{
             $sw="";
           }
         echo '<option value="'.$fila2["id_conductor"].'"'.$sw.'>'.$fila2["nombre_conductor"].'</option>';
         }
       }
       ?>
     </select>
   </article>
	</section>
  <section class="panel-body">
    <article class="col-md-4">
      <label for="">Nombre ruta:</label>
      <input type="text" class="form-control" name="nom_ruta" placeholder="Ej: RF-01" value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
    </article>
    <article class="col-md-8">
      <label for="">Descripción:</label>
      <input type="text" class="form-control" name="descripcion" placeholder="Ej: funza-mosquera-facatativa" value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
    </article>
    <article class="col-md-4">
      <label for="">Jornada:</label>
      <select class="form-control" required name="jornada">
        <option value=""></option>
        <option value="M">Mañana</option>
        <option value="T">Tarde</option>
      </select>
    </article>
    <article class="col-md-4">
      <label for="">Capacidad:</label>
      <select class="form-control" required name="capacidad">
        <option value=""></option>
        <option value="6">6</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="25">25</option>
        <option value="28">28</option>
        <option value="30">30</option>
        <option value="33">33</option>
      </select>
    </article>
  </section>
 </section>
 <div class="row text-center">
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
 </div>
		</section>
	</form>
