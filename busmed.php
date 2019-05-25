<?php
include('config/class.Conexion.php');

class Ajax {

  public $buscador;

  public function Buscar($a){
    $db = new Conexion();

    $sql = $db->query("SELECT * FROM m_producto WHERE nom_producto like '%$a%'  LIMIT 0,20");

    while ($array = $db->recorrer($sql)) {
      $resultado[] = $array['nom_producto'];
    }
    return $resultado;

  }
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

 ?>
