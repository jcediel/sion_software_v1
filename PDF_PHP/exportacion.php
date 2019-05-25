<?php   
	
include "bd/DSaIiConexion.php";

	$obj = new MySQL();
	$sql = "SELECT * FROM usuario";
	$res = $obj->consulta($sql);
	$data = $obj->respondeData($res);

    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es');
        $html2pdf->setDefaultFont('Arial');

        $tabla = '<style type="text/css">
<!--
th{
	text-align : center;
	background-color : #6D6D6D;
	color : #fff;
	font-weight : normal;
    padding : 5px
}

td{
	text-align : center;
}

-->
</style>';

        $tabla.='<h1 align="center">Listado de Usuarios</h1>';

 	 	$tabla.='<br/><table width="1024" border="0" cellpadding="0" cellspacing="0">
      		 		<tr>
							<th style="width:70px;">#</th>
							<th style="width:146px;">Nombre</th>
							<th style="width:146px;">Apellido</th>
							<th style="width:146px;">Direccion</th>
							<th style="width:146px;">Telefono</th>
       				 </tr>';

     if(count($data)!=0){
     	 $tabla.='<tbody>';
     	  foreach ($data as $row) {
     	  $tabla.='<tr>
				<td style="width:70px;">'.$row["id"].'</td>
				<td style="width:146px;">'.$row["nombre"].'</td>
				<td style="width:146px;">'.$row["apellido"].'</td>
				<td style="width:146px;">'.$row["direccion"].'</td>
				<td style="width:146px;">'.$row["telefono"].'</td>
       		 </tr>';	
     	  }
     	  $tabla.='</tbody>';
     }
        $tabla.='</table>';
        $html2pdf->writeHTML($tabla);
        $html2pdf->Output();
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


 ?>

