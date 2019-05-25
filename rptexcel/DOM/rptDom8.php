<?php
    $conexion = new mysqli('localhost','root','515t3m45','emmanuelips',3306);
if (mysqli_connect_errno()) {
    printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    exit();
}
  $f1=$_REQUEST['f1'];
  $f2=$_REQUEST['f2'];
  $eps=$_REQUEST['eps'];
  $sede=$_REQUEST['sede'];
$consulta = "SELECT d.nom_eps,b.tipo_servicio,a.freg_ronda,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
              TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
               e.nombre usuario,
                a.id_ronseg_dom, a.criterio1, a.valor1, a.obs1, a.criterio2, a.valor2, a.obs2, a.criterio3,
                a.valor3, a.obs3, a.criterio4, a.valor4, a.obs4, a.criterio5, a.valor5, a.obs5, a.criterio6,
                a.valor6, a.obs6, a.criterio7, a.valor7, a.obs7, a.criterio8, a.valor8, a.obs8,
                a.criterio9, a.valor9, a.obs9, a.criterio10, a.valor10, a.obs10, a.criterio11, a.valor11,
                a.obs11, a.criterio12, a.valor12, a.obs12, a.criterio13, a.valor13, a.obs13, a.criterio14,
                a.valor14, a.obs14, a.criterio15, a.valor15, a.obs15, a.criterio16, a.valor16, a.obs16,
                a.criterio17, a.valor17, a.obs17, a.criterio18, a.valor18, a.obs18, a.criterio19, a.valor19,
                a.obs19, a.criterio20, a.valor20, a.obs20, a.criterio21, a.valor21, a.obs21, a.criterio22,
                a.valor22, a.obs22, a.criterio23, a.valor23, a.obs23, a.criterio24, a.valor24, a.obs24,
                a.criterio25, a.valor25, a.obs25, a.criterio26, a.valor26, a.obs26, a.criterio27, a.valor27,
                a.obs27, a.criterio28, a.valor28, a.obs28, a.criterio29, a.valor29, a.obs29, a.criterio30, a.valor30, a.obs30
      FROM ronda_seguridad a,adm_hospitalario b,pacientes c,eps d,user e
      WHERE b.id_eps =d.id_eps and
            a.freg_ronda BETWEEN '$f1' and '$f2'
            and b.tipo_servicio = 'Domiciliarios'
            and b.id_adm_hosp = a.id_adm_hosp
            and c.id_paciente = b.id_paciente
            and e.id_user = a.id_user";

$resultado = $conexion->query($consulta);
if($resultado->num_rows > 0 ){

date_default_timezone_set('America/Bogota');

if (PHP_SAPI == 'cli')
die('Este archivo solo se puede ver desde un navegador web');

/** Se agrega la libreria PHPExcel */
require_once '../lib/PHPExcel/PHPExcel.php';

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
 ->setTitle("INFORME RONDA DE SEGURIDAD")
 ->setSubject("INFORME RONDA DE SEGURIDAD")
 ->setDescription("INFORME RONDA DE SEGURIDAD")
 ->setKeywords("INFORME RONDA DE SEGURIDAD")
 ->setCategory("Reporte excel");

$tituloReporte = "INFORME RONDA DE SEGURIDAD";
$titulosColumnas = array('PACIENTE','IDENTIFICACION','FECHA NACIMIENTO','EDAD','PREGUNTA1',
    'RESULTADO1','OBSERVACION','PREGUNTA2', 'RESULTADO2','OBSERVACION','PREGUNTA3', 'RESULTADO3','OBSERVACION','PREGUNTA4', 'RESULTADO4','OBSERVACION',
    'PREGUNTA5', 'RESULTADO5','OBSERVACION','PREGUNTA6', 'RESULTADO6','OBSERVACION','PREGUNTA7', 'RESULTADO7','OBSERVACION','PREGUNTA8',
    'RESULTADO8','OBSERVACION','PREGUNTA9', 'RESULTADO9','OBSERVACION','PREGUNTA10', 'RESULTADO10','OBSERVACION','PREGUNTA11', 'RESULTADO11','OBSERVACION',
    'PREGUNTA12', 'RESULTADO12','OBSERVACION','PREGUNTA13', 'RESULTADO13','OBSERVACION','PREGUNTA14', 'RESULTADO14','OBSERVACION','PREGUNTA15',
    'RESULTADO15','OBSERVACION','PREGUNTA16', 'RESULTADO16','OBSERVACION','PREGUNTA17', 'RESULTADO17','OBSERVACION','PREGUNTA18', 'RESULTADO18','OBSERVACION',
    'PREGUNTA19', 'RESULTADO19','OBSERVACION','PREGUNTA20', 'RESULTADO20','OBSERVACION','PREGUNTA21', 'RESULTADO21','OBSERVACION','PREGUNTA22',
    'RESULTADO22','OBSERVACION','PREGUNTA23', 'RESULTADO23','OBSERVACION','PREGUNTA24', 'RESULTADO24','OBSERVACION','PREGUNTA25', 'RESULTADO25','OBSERVACION'
    ,'PREGUNTA26', 'RESULTADO26','OBSERVACION','PREGUNTA27', 'RESULTADO27','OBSERVACION','PREGUNTA28', 'RESULTADO28','OBSERVACION','PREGUNTA29', 'RESULTADO29','OBSERVACION',
    'PREGUNTA30', 'RESULTADO30','OBSERVACION', 'JEFE','FECHA REALIZACION','EPS');

$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:CS1');

// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1',$tituloReporte)
->setCellValue('A3',  $titulosColumnas[0])
->setCellValue('B3',  $titulosColumnas[1])
->setCellValue('C3',  $titulosColumnas[2])
->setCellValue('D3',  $titulosColumnas[3])
->setCellValue('E3',  $titulosColumnas[4])
->setCellValue('F3',  $titulosColumnas[5])
->setCellValue('G3',  $titulosColumnas[6])
->setCellValue('H3',  $titulosColumnas[7])
->setCellValue('I3',  $titulosColumnas[8])
->setCellValue('J3',  $titulosColumnas[9])
->setCellValue('K3',  $titulosColumnas[10])
->setCellValue('L3',  $titulosColumnas[11])
->setCellValue('M3',  $titulosColumnas[12])
->setCellValue('N3',  $titulosColumnas[13])
->setCellValue('O3',  $titulosColumnas[14])
->setCellValue('P3',  $titulosColumnas[15])
->setCellValue('Q3',  $titulosColumnas[16])
->setCellValue('R3',  $titulosColumnas[17])
->setCellValue('S3',  $titulosColumnas[18])
->setCellValue('T3',  $titulosColumnas[19])
->setCellValue('U3',  $titulosColumnas[20])
->setCellValue('V3',  $titulosColumnas[21])
->setCellValue('W3',  $titulosColumnas[22])
->setCellValue('X3',  $titulosColumnas[23])
->setCellValue('Y3',  $titulosColumnas[24])
->setCellValue('Z3',  $titulosColumnas[25])
->setCellValue('AA3',  $titulosColumnas[26])
->setCellValue('AB3',  $titulosColumnas[27])
->setCellValue('AC3',  $titulosColumnas[28])
->setCellValue('AD3',  $titulosColumnas[29])
->setCellValue('AE3',  $titulosColumnas[30])
->setCellValue('AF3',  $titulosColumnas[31])
->setCellValue('AG3',  $titulosColumnas[32])
->setCellValue('AH3',  $titulosColumnas[33])
->setCellValue('AI3',  $titulosColumnas[34])
->setCellValue('AJ3',  $titulosColumnas[35])
->setCellValue('AK3',  $titulosColumnas[36])
->setCellValue('AL3',  $titulosColumnas[37])
->setCellValue('AM3',  $titulosColumnas[38])
->setCellValue('AN3',  $titulosColumnas[39])
->setCellValue('AO3',  $titulosColumnas[40])
->setCellValue('AP3',  $titulosColumnas[41])
->setCellValue('AQ3',  $titulosColumnas[42])
->setCellValue('AR3',  $titulosColumnas[43])
->setCellValue('AS3',  $titulosColumnas[44])
->setCellValue('AT3',  $titulosColumnas[45])
->setCellValue('AU3',  $titulosColumnas[46])
->setCellValue('AV3',  $titulosColumnas[47])
->setCellValue('AW3',  $titulosColumnas[48])
->setCellValue('AX3',  $titulosColumnas[49])
->setCellValue('AY3',  $titulosColumnas[50])
->setCellValue('AZ3',  $titulosColumnas[51])
->setCellValue('BA3',  $titulosColumnas[52])
->setCellValue('BB3',  $titulosColumnas[53])
->setCellValue('BC3',  $titulosColumnas[54])
->setCellValue('BD3',  $titulosColumnas[55])
->setCellValue('BE3',  $titulosColumnas[56])
->setCellValue('BF3',  $titulosColumnas[57])
->setCellValue('BG3',  $titulosColumnas[58])
->setCellValue('BH3',  $titulosColumnas[59])
->setCellValue('BI3',  $titulosColumnas[60])
->setCellValue('BJ3',  $titulosColumnas[61])
->setCellValue('BK3',  $titulosColumnas[62])
->setCellValue('BL3',  $titulosColumnas[63])
->setCellValue('BM3',  $titulosColumnas[64])
->setCellValue('BN3',  $titulosColumnas[65])
->setCellValue('BO3',  $titulosColumnas[66])
->setCellValue('BP3',  $titulosColumnas[67])
->setCellValue('BQ3',  $titulosColumnas[68])
->setCellValue('BR3',  $titulosColumnas[69])
->setCellValue('BS3',  $titulosColumnas[70])
->setCellValue('BT3',  $titulosColumnas[71])
->setCellValue('BU3',  $titulosColumnas[72])
->setCellValue('BV3',  $titulosColumnas[73])
->setCellValue('BW3',  $titulosColumnas[74])
->setCellValue('BX3',  $titulosColumnas[75])
->setCellValue('BY3',  $titulosColumnas[76])
->setCellValue('BZ3',  $titulosColumnas[77])
->setCellValue('CA3',  $titulosColumnas[78])
->setCellValue('CB3',  $titulosColumnas[79])
->setCellValue('CC3',  $titulosColumnas[80])
->setCellValue('CD3',  $titulosColumnas[81])
->setCellValue('CE3',  $titulosColumnas[82])
->setCellValue('CF3',  $titulosColumnas[83])
->setCellValue('CG3',  $titulosColumnas[84])
->setCellValue('CH3',  $titulosColumnas[85])
->setCellValue('CI3',  $titulosColumnas[86])
->setCellValue('CJ3',  $titulosColumnas[87])
->setCellValue('CK3',  $titulosColumnas[88])
->setCellValue('CL3',  $titulosColumnas[89])
->setCellValue('CM3',  $titulosColumnas[90])
->setCellValue('CN3',  $titulosColumnas[91])
->setCellValue('CO3',  $titulosColumnas[92])
->setCellValue('CP3',  $titulosColumnas[93])
->setCellValue('CQ3',  $titulosColumnas[94])
->setCellValue('CR3',  $titulosColumnas[95])
->setCellValue('CS3',  $titulosColumnas[96])
                ;
$i = 4;

while ($fila = $resultado->fetch_array()) {

$objPHPExcel->setActiveSheetIndex(0)

                ->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
            ->setCellValue('B'.$i,  utf8_encode($fila['doc_pac']))
            ->setCellValue('C'.$i,  utf8_encode($fila['fnacimiento']))
            ->setCellValue('D'.$i,  utf8_encode($fila['edad']))
                ->setCellValue('E' .$i,  utf8_encode($fila['criterio1']))
->setCellValue('F' .$i,  utf8_encode($fila['valor1']))
->setCellValue('G' .$i,  utf8_encode($fila['obs1']))
->setCellValue('H' .$i,  utf8_encode($fila['criterio2']))
->setCellValue('I' .$i,  utf8_encode($fila['valor2']))
->setCellValue('J' .$i,  utf8_encode($fila['obs2']))
->setCellValue('K' .$i,  utf8_encode($fila['criterio3']))
->setCellValue('L' .$i,  utf8_encode($fila['valor3']))
->setCellValue('M' .$i,  utf8_encode($fila['obs3']))
->setCellValue('N' .$i,  utf8_encode($fila['criterio4']))
->setCellValue('O' .$i,  utf8_encode($fila['valor4']))
->setCellValue('P' .$i,  utf8_encode($fila['obs4']))
->setCellValue('Q' .$i,  utf8_encode($fila['criterio5']))
->setCellValue('R' .$i,  utf8_encode($fila['valor5']))
->setCellValue('S' .$i,  utf8_encode($fila['obs5']))
->setCellValue('T' .$i,  utf8_encode($fila['criterio6']))
->setCellValue('U' .$i,  utf8_encode($fila['valor6']))
->setCellValue('V' .$i,  utf8_encode($fila['obs6']))
->setCellValue('W' .$i,  utf8_encode($fila['criterio7']))
->setCellValue('X' .$i,  utf8_encode($fila['valor7']))
->setCellValue('Y' .$i,  utf8_encode($fila['obs7']))
->setCellValue('Z' .$i,  utf8_encode($fila['criterio8']))
->setCellValue('AA' .$i,  utf8_encode($fila['valor8']))
->setCellValue('AB' .$i,  utf8_encode($fila['obs8']))
->setCellValue('AC' .$i,  utf8_encode($fila['criterio9']))
->setCellValue('AD' .$i,  utf8_encode($fila['valor9']))
->setCellValue('AE' .$i,  utf8_encode($fila['obs9']))
->setCellValue('AF' .$i,  utf8_encode($fila['criterio10']))
->setCellValue('AG' .$i,  utf8_encode($fila['valor10']))
->setCellValue('AH' .$i,  utf8_encode($fila['obs10']))
->setCellValue('AI' .$i,  utf8_encode($fila['criterio11']))
->setCellValue('AJ' .$i,  utf8_encode($fila['valor11']))
->setCellValue('AK' .$i,  utf8_encode($fila['obs11']))
->setCellValue('AL' .$i,  utf8_encode($fila['criterio12']))
->setCellValue('AM' .$i,  utf8_encode($fila['valor12']))
->setCellValue('AN' .$i,  utf8_encode($fila['obs12']))
->setCellValue('AO' .$i,  utf8_encode($fila['criterio13']))
->setCellValue('AP' .$i,  utf8_encode($fila['valor13']))
->setCellValue('AQ' .$i,  utf8_encode($fila['obs13']))
->setCellValue('AR' .$i,  utf8_encode($fila['criterio14']))
->setCellValue('AS' .$i,  utf8_encode($fila['valor14']))
->setCellValue('AT' .$i,  utf8_encode($fila['obs14']))
->setCellValue('AU' .$i,  utf8_encode($fila['criterio15']))
->setCellValue('AV' .$i,  utf8_encode($fila['valor15']))
->setCellValue('AW' .$i,  utf8_encode($fila['obs15']))
->setCellValue('AX' .$i,  utf8_encode($fila['criterio16']))
->setCellValue('AY' .$i,  utf8_encode($fila['valor16']))
->setCellValue('AZ' .$i,  utf8_encode($fila['obs16']))
->setCellValue('BA' .$i,  utf8_encode($fila['criterio17']))
->setCellValue('BB' .$i,  utf8_encode($fila['valor17']))
->setCellValue('BC' .$i,  utf8_encode($fila['obs17']))
->setCellValue('BD' .$i,  utf8_encode($fila['criterio18']))
->setCellValue('BE' .$i,  utf8_encode($fila['valor18']))
->setCellValue('BF' .$i,  utf8_encode($fila['obs18']))
->setCellValue('BG' .$i,  utf8_encode($fila['criterio19']))
->setCellValue('BH' .$i,  utf8_encode($fila['valor19']))
->setCellValue('BI' .$i,  utf8_encode($fila['obs19']))
->setCellValue('BJ' .$i,  utf8_encode($fila['criterio20']))
->setCellValue('BK' .$i,  utf8_encode($fila['valor20']))
->setCellValue('BL' .$i,  utf8_encode($fila['obs20']))
->setCellValue('BM' .$i,  utf8_encode($fila['criterio21']))
->setCellValue('BN' .$i,  utf8_encode($fila['valor21']))
->setCellValue('BO' .$i,  utf8_encode($fila['obs21']))
->setCellValue('BP' .$i,  utf8_encode($fila['criterio22']))
->setCellValue('BQ' .$i,  utf8_encode($fila['valor22']))
->setCellValue('BR' .$i,  utf8_encode($fila['obs22']))
->setCellValue('BS' .$i,  utf8_encode($fila['criterio23']))
->setCellValue('BT' .$i,  utf8_encode($fila['valor23']))
->setCellValue('BU' .$i,  utf8_encode($fila['obs23']))
->setCellValue('BV' .$i,  utf8_encode($fila['criterio24']))
->setCellValue('BW' .$i,  utf8_encode($fila['valor24']))
->setCellValue('BX' .$i,  utf8_encode($fila['obs24']))
->setCellValue('BY' .$i,  utf8_encode($fila['criterio25']))
->setCellValue('BZ' .$i,  utf8_encode($fila['valor25']))
->setCellValue('CA' .$i,  utf8_encode($fila['obs25']))
->setCellValue('CB' .$i,  utf8_encode($fila['criterio26']))
->setCellValue('CC' .$i,  utf8_encode($fila['valor26']))
->setCellValue('CD' .$i,  utf8_encode($fila['obs26']))
->setCellValue('CE' .$i,  utf8_encode($fila['criterio27']))
->setCellValue('CF' .$i,  utf8_encode($fila['valor27']))
->setCellValue('CG' .$i,  utf8_encode($fila['obs27']))
->setCellValue('CH' .$i,  utf8_encode($fila['criterio28']))
->setCellValue('CI' .$i,  utf8_encode($fila['valor28']))
->setCellValue('CJ' .$i,  utf8_encode($fila['obs28']))
->setCellValue('CK' .$i,  utf8_encode($fila['criterio29']))
->setCellValue('CL' .$i,  utf8_encode($fila['valor29']))
->setCellValue('CM' .$i,  utf8_encode($fila['obs29']))
->setCellValue('CN' .$i,  utf8_encode($fila['criterio30']))
->setCellValue('CO' .$i,  utf8_encode($fila['valor30']))
->setCellValue('CP' .$i,  utf8_encode($fila['obs30']))
->setCellValue('CQ' .$i,  utf8_encode($fila['usuario']))
->setCellValue('CR' .$i,  utf8_encode($fila['freg_ronda']))
->setCellValue('CS' .$i,  utf8_encode($fila['nom_eps']))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ;
$i++;
}

$estiloTituloReporte = array(
        'font' => array(
        'name'      => 'Verdana',
            'bold'      => true,
            'italic'    => false,
                'strike'    => false,
               'size' =>16,
            'color'     => array(
                'rgb' => 'FFFFFF'
               )
            ),
        'fill' => array(
'type'=> PHPExcel_Style_Fill::FILL_SOLID,
'color'=> array('argb' => 'FF220835')
),
            'borders' => array(
               'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE
               )
            ),
            'alignment' =>  array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'   => 0,
        'wrap'          => TRUE
    )
        );

$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' => array(
'type'=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '1AA55E'
        ),
        'endcolor'   => array(
            'argb' => 'FF431a5d'
        )
),
            'borders' => array(
            'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '1AA55E'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '1AA55E'
                    )
                )
            ),
'alignment' =>  array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'          => TRUE
    ));

$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray(
array(
           'font' => array(
               'name'      => 'Arial',
               'color'     => array(
                   'rgb' => '000000'
               )
           ),
           'fill' => array(
'type'=> PHPExcel_Style_Fill::FILL_SOLID,
'color'=> array('argb' => 'FFd9b7f4')
),
           'borders' => array(
               'left'     => array(
                   'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array(
                'rgb' => 'A3DBBE'
                   )
               )
           )
        ));

$objPHPExcel->getActiveSheet()->getStyle('A1:CS1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:CS3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:CS".($i-1));

for($i = 'A'; $i <= 'CS'; $i++){
$objPHPExcel->setActiveSheetIndex(0)
->getColumnDimension($i)->setAutoSize(TRUE);
}

// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('consolidadoR');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="consolidadoRonda.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}
else{
print_r('No hay resultados para mostrar');
}
?>
