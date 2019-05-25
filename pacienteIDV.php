<table class="table table-bordered">
  <thead class="thead-inverse ">
    <tr>
      <th class="text-center danger">PACIENTE</th>
      <th class="text-center danger">UBICACION</th>
      <th class="text-center danger"></th>
    </tr>
  </thead>
  <?php
$doc=$_REQUEST['doc'];
  $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
               b.id_adm_hosp,
               c.id_ubipaciente,
               d.nom_cama,
               e.nom_hab,
               f.nom_pabellon,
               g.nom_piso
      FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                       INNER JOIN ubipaciente c on b.id_adm_hosp=c.id_adm_hosp
                       INNER JOIN cama d on d.id_cama=c.id_cama
                       INNER JOIN habitacion e on e.id_habitacion=d.id_habitacion
                       INNER JOIN pabellon f on f.id_pabellon=e.id_pabellon
                       INNER JOIN piso g on g.id_piso=f.id_piso
      WHERE b.estado_adm_hosp='Activo' and a.doc_pac=$doc and c.ffinal is null";
      //echo $sql;
if ($tabla=$bd1->sub_tuplas($sql)){
  foreach ($tabla as $fila ) {

        echo"<tr >\n";
        echo'<td class="text-center">
                <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
                <p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].'</p>
             </td>';
        echo'<td class="text-center">
                <p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
                <p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
             </td>';
        echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_piso" > </td>';
        // aqui sería pertinente colocar un boton que me muestre un modal con todas las dosificaciones hechas al paciente en el mes
        echo"</tr >\n";

  }
}
?>
</table>
