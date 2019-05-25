<?php
echo'<p><strong class="text-danger">Verificacion de datos del paciente y cuidador</strong></p>
     <p><strong class="text-primary">Resultado: </strong>';
     $valor1=$fila['criterio1'];
     if ($valor1==0) {
       echo 'No Aplica</p>';
     }
     if ($valor1==1) {
       echo 'SI</p>';
     }
     if ($valor1==2) {
       echo 'NO</p>';
     }

echo'<p><strong class="text-danger">Verificacion de servicios autorizados</strong></p>
     <p><strong class="text-primary">Resultado: </strong>';
     $valor1=$fila['criterio2'];
     if ($valor1==0) {
       echo 'No Aplica</p>';
     }
     if ($valor1==1) {
       echo 'SI</p>';
     }
     if ($valor1==2) {
       echo 'NO</p>';
     }
echo'<p><strong class="text-danger">Socializacion de derechos y deberes del usuario y la familia</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio3'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Revision de criterios de inclusion y exclusion</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio4'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Socializacion del consentimiento informado de servicios domiciliarios</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio5'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Socializacion de las funciones del Auxiliar de enfermeria</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio6'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio7'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Diligenciamiento de la ronda de seguridad</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio8'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Aplicacion de encuesta de satisfaccion</strong></p>
<p><strong class="text-primary">Resultado: </strong>';
$valor1=$fila['criterio9'];
if ($valor1==0) {
  echo 'No Aplica</p>';
}
if ($valor1==1) {
  echo 'SI</p>';
}
if ($valor1==2) {
  echo 'NO</p>';
}
echo'<p><strong class="text-danger">Observacion:</strong></p>
<p>'.$fila["obs_visita"].'</p>';
