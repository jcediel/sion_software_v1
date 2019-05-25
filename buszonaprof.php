<?php
include('config/class.Conexion.php');

class Ajax {

  public $buscador;

  public function Buscar($a){
    $db = new Conexion();
    $sql = $db->query("SELECT a.id_user,nombre,especialidad,b.zona_accion from user a INNER JOIN zonificacion b on a.id_user=b.id_user WHERE zona_accion like '%$a%' ");

    while ($array = $db->recorrer($sql)) {
      $resultado[] = $array['nombre'].', '.$array['especialidad'].', '.$array['descrimuni'];
    }
    return $resultado;
  }
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

 ?>
