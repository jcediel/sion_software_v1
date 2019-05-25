<?php
class MySQL {

    private $conexion;

    public function MySQL() {

        if (!isset($this->conexion)) {
            $this->conexion = (mysql_connect("localhost", "root", "Edma1988")) or die(mysql_error());
            mysql_select_db("cabina", $this->conexion) or die(mysql_error());
        }
        mysql_query("SET NAMES 'utf8'");
        //para traduccion de los meses en mysql es_ES="EspaÃ±ol"
        mysql_query("SET lc_time_names = 'es_ES'");
    }

    public function consulta($consulta) {

        $resultado = mysql_query($consulta, $this->conexion);

        if ($this->getError()) return $this->getDebugError();

        return $resultado;
    }


  public function fetch_assoc($data){

           return  mysql_fetch_assoc($data);
  }


  public function respondeData($data){
       $rows=array();
        while ($fila=$this->fetch_assoc($data)) {
           $rows[]=$fila;
        }
        return $rows;
  }


    function getError() {
        $error = mysql_error($this->conexion);
        return $error;
    }


    function getDebugError() {
        $delimiter = "Cannot delete or update a parent row: a foreign key constraint fails";
        $arr = explode('(', $this->getError());
        $error = trim($arr[0]);
        $cad = "";
        if ($error == $delimiter) {
            $cad = 'No se puede borrar/actualizar este registro porque esta relacionado con otros gastos';
        } else {
            echo $cad = $this->getError();
        }

        if (!empty($cad)) {
            throw new Exception($cad);
        }
    }
}
?>
