<?php
include('config/class.Conexion.php');

class Ajax {

  public $buscador;

  public function Buscar($a){
    $db = new Conexion();
    $sql = $db->query("SELECT a.descrimuni,
                              b.nom_localidad,
                              c.nom_upz,
                              d.nom_barrio
                       FROM municipios a INNER JOIN localidades b on a.codmuni=b.codmuni
                                         INNER JOIN upz c on b.id_localidad=c.id_localidad
                                         INNER JOIN barrio d on c.id_upz=d.id_upz
                       WHERE d.nom_barrio like '%$a%' order by nom_barrio DESC");

    while ($array = $db->recorrer($sql)) {
      $resultado[] = $array['nom_barrio'].', '.$array['nom_localidad'].', '.$array['descrimuni'];
    }
    return $resultado;
  }
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

 ?>
