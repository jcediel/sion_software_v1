<?php

      $buscar = $_POST['b'];

      if(!empty($buscar)) {
            buscar($buscar);
      }

      function buscar($b) {
            $con = mysql_connect('localhost','root', 'Edma1988');
            mysql_select_db('emmanuelips', $con);

            $sql = mysql_query("SELECT * FROM cie WHERE descripdx LIKE '%".$b."%' LIMIT 10" ,$con);

            $contar = @mysql_num_rows($sql);

            if($contar == 0){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{
              while($row = mysql_fetch_array($sql))
              {
              	echo '<p>';
              	echo '<input type="text" class="form-control" value="'.$row['coddx'].'">';
              	echo '<input type="text" class="form-control" value="'.$row['descripdx'].'">';
                echo '<button class="btn btn-success">Seleccionar</button>';
              	echo '</p>';
              }
              }mysql_free_result($respuesta);
              }

?>
