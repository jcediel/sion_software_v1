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
$consulta = "SELECT d.nom_eps,b.tipo_servicio,a.freg,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
            TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
             e.nombre usuario,
              a.id_visita_dom,criterio1, criterio2, criterio3,
              criterio4, criterio5, criterio6, criterio7, criterio8, criterio9, obs_visita,fallida
    FROM visita_dom_enfermeria a,adm_hospitalario b,pacientes c,eps d,user e
    WHERE b.id_eps =d.id_eps and
          a.freg BETWEEN '$f1' and '$f2'
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
 ->setTitle("INFORME VISITA ENFERMERIA")
 ->setSubject("INFORME VISITA ENFERMERIA")
 ->setDescription("INFORME VISITA ENFERMERIA")
 ->setKeywords("INFORME VISITA ENFERMERIA")
 ->setCategory("Reporte excel");

$tituloReporte = "INFORME VISITA ENFERMERIA";
$titulosColumnas = array('PACIENTE','IDENTIFICACION','FECHA NACIMIENTO','EDAD','PREGUNTA1',
    'RESULTADO1','PREGUNTA2', 'RESULTADO2','PREGUNTA3', 'RESULTADO3','PREGUNTA4', 'RESULTADO4',
    'PREGUNTA5', 'RESULTADO5','PREGUNTA6', 'RESULTADO6','PREGUNTA7', 'RESULTADO7','PREGUNTA8',
    'RESULTADO8','PREGUNTA9', 'RESULTADO9','OBSERVACION','JEFE','FECHA REALIZACION','EPS','FALLIDA');

$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:AA1');

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

                ;
$i = 4;

while ($fila = $resultado->fetch_array()) {

$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
->setCellValue('B'.$i,  utf8_encode($fila['doc_pac']))
->setCellValue('C'.$i,  utf8_encode($fila['fnacimiento']))
->setCellValue('D'.$i,  utf8_encode($fila['edad']))
->setCellValue('E'.$i,  utf8_encode('Verificacion de datos del paciente y cuidador'))
->setCellValue('F'.$i,  utf8_encode($fila['criterio1']))
->setCellValue('G'.$i,  utf8_encode('Verificacion de servicios autorizados'))
->setCellValue('H'.$i,  utf8_encode($fila['criterio2']))
->setCellValue('I'.$i,  utf8_encode('Socializacion de derechos y deberes del usuario y la familia'))
->setCellValue('J'.$i,  utf8_encode($fila['criterio3']))
->setCellValue('K'.$i,  utf8_encode('Revision de criterios de inclusion y exclusion'))
->setCellValue('L'.$i,  utf8_encode($fila['criterio4']))
->setCellValue('M'.$i,  utf8_encode('Socializacion del consentimiento informado de servicios domiciliarios'))
->setCellValue('N'.$i,  utf8_encode($fila['criterio5']))
->setCellValue('O'.$i,  utf8_encode('Socializacion de las funciones del Auxiliar de enfermeria'))
->setCellValue('P'.$i,  utf8_encode($fila['criterio6']))
->setCellValue('Q'.$i,  utf8_encode('Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion'))
->setCellValue('R'.$i,  utf8_encode($fila['criterio7']))
->setCellValue('S'.$i,  utf8_encode('Diligenciamiento de la ronda de seguridad'))
->setCellValue('T'.$i,  utf8_encode($fila['criterio8']))
->setCellValue('U'.$i,  utf8_encode('Aplicacion de encuesta de satisfaccion'))
->setCellValue('V'.$i,  utf8_encode($fila['criterio9']))
->setCellValue('W'.$i,  utf8_encode($fila['obs_visita']))
->setCellValue('X'.$i,  utf8_encode($fila['usuario']))
->setCellValue('Y'.$i,  utf8_encode($fila['freg']))
->setCellValue('Z'.$i,  utf8_encode($fila['nom_eps']))
->setCellValue('AA'.$i,  utf8_encode($fila['fallida']));
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

$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:Z3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:Z".($i-1));

for($i = 'A'; $i <= 'Z'; $i++){
$objPHPExcel->setActiveSheetIndex(0)
->getColumnDimension($i)->setAutoSize(TRUE);
}

// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('consolidadoVenfermeria');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="consolidadoVenfermeria.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}
else{
print_r('No hay resultados para mostrar');
}
?>
