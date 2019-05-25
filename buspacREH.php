<?php
include('config/class.Conexion.php');

class Ajax {

  public $buscador;

  public function Buscar($a){
    $db = new Conexion();
    $sql = $db->query("Select * from pacientes where nom_completo like '%$a%' or doc_pac like '%$a%'  LIMIT 0,20");

    while ($array = $db->recorrer($sql)) {
      $resultado[] = $array['doc_pac'].' | '.$array['nom_completo'];
      $resultado['codigo'] = $array['doc_pac'];
    }
    return $resultado;
  }
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

 ?>
