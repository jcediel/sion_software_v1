<?php
include('config/class.Conexion.php');

class Ajax {

  public $buscador;

  public function Buscar($a){
    $db = new Conexion();
    $sql = $db->query("Select * from cie where descripdx like '%$a%' or coddx like '%$a%'  LIMIT 0,20");

    while ($array = $db->recorrer($sql)) {
      $resultado[] = $array['coddx'].' | '.$array['descripdx'];
      $resultado['codigo'] = $array['coddx'];
    }
    return $resultado;
  }
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

 ?>
