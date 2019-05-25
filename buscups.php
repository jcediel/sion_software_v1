<?php
include('config/class.Conexion.php');

class Ajax {

  public $buscador;

  public function Buscar($a){
    $db = new Conexion();
    $sql = $db->query("Select * from cups where descupsmin like '%$a%' or codcupsmin like '%$a%' LIMIT 0,20");

    while ($array = $db->recorrer($sql)) {
      $resultado[] = $array['codcupsmin'].' | '.$array['descupsmin'];
      $resultado['codigo'] = $array['codcupsmin'];
    }
    return $resultado;
  }
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

 ?>
