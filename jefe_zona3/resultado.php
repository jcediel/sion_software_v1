<?php
require("conexao.php");

function parseToXML($htmlStr){
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

// Select all the rows in the markers table

$result_markers = "SELECT a.id_paciente,nom_completo,dir_pac,lat,lo,
													b.fingreso_hosp,
													c.nom_eps,
													d.cdx_presentacion,dx_presentacion,
													e.nomclaseusuario
									 FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
									 									INNER JOIN eps c on c.id_eps=b.id_eps
																		INNER JOIN m_aut_dom d on d.id_adm_hosp=b.id_adm_hosp
																		INNER JOIN clase_usuario e on e.id_cusuario=d.tipo_paciente
									 WHERE a.jefe_zona=1773";
$resultado_markers = mysqli_query($conn, $result_markers);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
  // Add to XML document node
  echo '<marker ';
  echo 'name="' . parseToXML( utf8_encode($row_markers['nom_completo'])) . '" ';
  echo 'address="' . parseToXML($row_markers['dir_pac']) . '" ';
	echo 'cusuario="' . parseToXML($row_markers['nomclaseusuario']) . '" ';
	echo 'cdx="' . parseToXML($row_markers['cdx_presentacion']) . '" ';
	echo 'dx="' . parseToXML($row_markers['dx_presentacion']) . '" ';
	echo 'eps="' . parseToXML($row_markers['nom_eps']) . '" ';
  echo 'lat="' . $row_markers['lat'] . '" ';
  echo 'lng="' . $row_markers['lo'] . '" ';
  echo 'type="' . parseToXML($row_markers['dir_pac']) . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
