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
	$consulta = "SELECT d.nom_eps,b.tipo_servicio,a.freg_encuesta,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
              TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
               e.nombre usuario,
                a.pregunta1,a.valor1,a.pregunta2,a.valor2,a.pregunta3,a.valor3,a.pregunta4,a.valor4,
                a.pregunta5,a.valor5,a.pregunta6,a.valor6,a.pregunta7,a.valor7,a.pregunta8,a.valor8,a.pregunta9,
                a.valor9,a.pregunta10,a.valor10,a.pregunta11,a.valor11,a.pregunta12,a.valor12,a.pregunta13,
                a.valor13,a.pregunta14,a.valor14,a.pregunta15,a.valor15,a.pregunta16,a.valor16,a.pregunta17,
                a.valor17,a.pregunta18,a.valor18,a.pregunta19,a.valor19,a.pregunta20,a.valor20,a.pregunta21,
                a.valor21,a.pregunta22,a.valor22,a.pregunta23,a.valor23,a.pregunta24,a.valor24,a.pregunta25,
                a.valor25,a.pregunta26,a.valor26,a.pregunta27,a.valor27,a.pregunta28,a.valor28,a.pregunta29,
              a.valor29,a.pregunta30,a.valor30,a.pregunta31,a.valor31,a.pregunta32,a.valor32,a.pregunta33,
              a.valor33,a.obs33,a.pregunta34,valor34
      FROM encuesta_dom a,adm_hospitalario b,pacientes c,eps d,user e
      WHERE b.id_eps =d.id_eps and
            a.freg_encuesta BETWEEN '$f1' and '$f2'
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
							 ->setTitle("INFORME ENCUESTA SATISFACCION")
							 ->setSubject("INFORME ENCUESTA SATISFACCION")
							 ->setDescription("INFORME ENCUESTA SATISFACCION")
							 ->setKeywords("INFORME ENCUESTA SATISFACCION")
							 ->setCategory("Reporte excel");

		$tituloReporte = "INFORME ENCUESTA SATISFACCION";
		$titulosColumnas = array('PACIENTE','IDENTIFICACION','FECHA NACIMIENTO','EDAD','PREGUNTA1', 'RESULTADO1','PREGUNTA2', 'RESULTADO2','PREGUNTA3', 'RESULTADO3','PREGUNTA4', 'RESULTADO4','PREGUNTA5', 'RESULTADO5','PREGUNTA6', 'RESULTADO6','PREGUNTA7', 'RESULTADO7','PREGUNTA8', 'RESULTADO8',
    'PREGUNTA9', 'RESULTADO9','PREGUNTA10', 'RESULTADO10','PREGUNTA11', 'RESULTADO11','PREGUNTA12', 'RESULTADO12','PREGUNTA13', 'RESULTADO13','PREGUNTA14', 'RESULTADO14','PREGUNTA15', 'RESULTADO15','PREGUNTA16', 'RESULTADO16','PREGUNTA17', 'RESULTADO17','PREGUNTA18', 'RESULTADO18',
    'PREGUNTA19', 'RESULTADO19','PREGUNTA20', 'RESULTADO20','PREGUNTA21', 'RESULTADO21','PREGUNTA22', 'RESULTADO22','PREGUNTA23', 'RESULTADO23','PREGUNTA24', 'RESULTADO24','PREGUNTA25', 'RESULTADO25','PREGUNTA27', 'RESULTADO27','PREGUNTA28', 'RESULTADO28','PREGUNTA29', 'RESULTADO29',
    'PREGUNTA30', 'RESULTADO30','PREGUNTA31', 'RESULTADO31','PREGUNTA32', 'RESULTADO32','PREGUNTA33', 'RESULTADO33','PREGUNTA34', 'RESULTADO34','OBSERVACION', 'JEFE','FECHA REALIZACION','EPS');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:BV1');

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
                ;
		$i = 3;

		while ($fila = $resultado->fetch_array()) {

			$objPHPExcel->setActiveSheetIndex(0)

                ->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
		            ->setCellValue('B'.$i,  utf8_encode($fila['doc_pac']))
        		    ->setCellValue('C'.$i,  utf8_encode($fila['fnacimiento']))
            		->setCellValue('D'.$i,  utf8_encode($fila['edad']))
                ->setCellValue('E'.$i,  utf8_encode($fila['pregunta1']))
                ->setCellValue('F'.$i,  utf8_encode($fila['valor1']))
                ->setCellValue('G'.$i,  utf8_encode($fila['pregunta2']))
                ->setCellValue('H'.$i,  utf8_encode($fila['valor2']))
                ->setCellValue('I'.$i,  utf8_encode($fila['pregunta3']))
                ->setCellValue('J'.$i,  utf8_encode($fila['valor3']))
                ->setCellValue('K'.$i,  utf8_encode($fila['pregunta4']))
                ->setCellValue('L'.$i,  utf8_encode($fila['valor4']))
		            ->setCellValue('M'.$i,  utf8_encode($fila['pregunta5']))
        		    ->setCellValue('N'.$i,  utf8_encode($fila['valor5']))
            		->setCellValue('O'.$i,  utf8_encode($fila['pregunta6']))
                ->setCellValue('P'.$i,  utf8_encode($fila['valor6']))
                ->setCellValue('Q'.$i,  utf8_encode($fila['pregunta7']))
                ->setCellValue('R'.$i,  utf8_encode($fila['valor7']))
                ->setCellValue('S'.$i,  utf8_encode($fila['pregunta8']))
                ->setCellValue('T'.$i,  utf8_encode($fila['valor8']))
                ->setCellValue('U'.$i,  utf8_encode($fila['pregunta9']))
                ->setCellValue('V'.$i,  utf8_encode($fila['valor9']))
                ->setCellValue('W'.$i,  utf8_encode($fila['pregunta10']))
		            ->setCellValue('X'.$i,  utf8_encode($fila['valor10']))
        		    ->setCellValue('Y'.$i,  utf8_encode($fila['pregunta11']))
            		->setCellValue('Z'.$i,  utf8_encode($fila['valor11']))
                ->setCellValue('AA'.$i,  utf8_encode($fila['pregunta12']))
                ->setCellValue('AB'.$i,  utf8_encode($fila['valor12']))
                ->setCellValue('AC'.$i,  utf8_encode($fila['pregunta13']))
                ->setCellValue('AD'.$i,  utf8_encode($fila['valor13']))
                ->setCellValue('AE'.$i,  utf8_encode($fila['pregunta14']))
                ->setCellValue('AF'.$i,  utf8_encode($fila['valor14']))
                ->setCellValue('AG'.$i,  utf8_encode($fila['pregunta15']))
                ->setCellValue('AH'.$i,  utf8_encode($fila['valor15']))
		            ->setCellValue('AI'.$i,  utf8_encode($fila['pregunta16']))
        		    ->setCellValue('AJ'.$i,  utf8_encode($fila['valor16']))
            		->setCellValue('AK'.$i,  utf8_encode($fila['pregunta17']))
                ->setCellValue('AL'.$i,  utf8_encode($fila['valor17']))
                ->setCellValue('AM'.$i,  utf8_encode($fila['pregunta18']))
                ->setCellValue('AN'.$i,  utf8_encode($fila['valor18']))
                ->setCellValue('AO'.$i,  utf8_encode($fila['pregunta19']))
                ->setCellValue('AP'.$i,  utf8_encode($fila['valor19']))
                ->setCellValue('AQ'.$i,  utf8_encode($fila['pregunta20']))
                ->setCellValue('AR'.$i,  utf8_encode($fila['valor20']))
                ->setCellValue('AS'.$i,  utf8_encode($fila['pregunta21']))
		            ->setCellValue('AT'.$i,  utf8_encode($fila['valor21']))
        		    ->setCellValue('AU'.$i,  utf8_encode($fila['pregunta22']))
            		->setCellValue('AV'.$i,  utf8_encode($fila['valor22']))
                ->setCellValue('AW'.$i,  utf8_encode($fila['pregunta23']))
                ->setCellValue('AX'.$i,  utf8_encode($fila['valor23']))
                ->setCellValue('AY'.$i,  utf8_encode($fila['pregunta24']))
                ->setCellValue('AZ'.$i,  utf8_encode($fila['valor24']))
                ->setCellValue('BA'.$i,  utf8_encode($fila['pregunta25']))
                ->setCellValue('BB'.$i,  utf8_encode($fila['valor25']))
                ->setCellValue('BC'.$i,  utf8_encode($fila['pregunta26']))
                ->setCellValue('BD'.$i,  utf8_encode($fila['valor26']))
		            ->setCellValue('BE'.$i,  utf8_encode($fila['pregunta27']))
        		    ->setCellValue('BF'.$i,  utf8_encode($fila['valor27']))
            		->setCellValue('BG'.$i,  utf8_encode($fila['pregunta28']))
                ->setCellValue('BH'.$i,  utf8_encode($fila['valor28']))
                ->setCellValue('BI'.$i,  utf8_encode($fila['pregunta29']))
                ->setCellValue('BJ'.$i,  utf8_encode($fila['valor29']))
                ->setCellValue('BK'.$i,  utf8_encode($fila['pregunta30']))
                ->setCellValue('BL'.$i,  utf8_encode($fila['valor30']))
                ->setCellValue('BM'.$i,  utf8_encode($fila['pregunta31']))
                ->setCellValue('BN'.$i,  utf8_encode($fila['valor31']))
                ->setCellValue('BO'.$i,  utf8_encode($fila['pregunta32']))
		            ->setCellValue('BP'.$i,  utf8_encode($fila['valor32']))
        		    ->setCellValue('BQ'.$i,  utf8_encode($fila['pregunta33']))
            		->setCellValue('BR'.$i,  utf8_encode($fila['valor33']))
                ->setCellValue('BS'.$i,  utf8_encode($fila['pregunta34']))
                ->setCellValue('BT'.$i,  utf8_encode($fila['valor34']))
                ->setCellValue('BU'.$i,  utf8_encode($fila['obs33']))
                ->setCellValue('BV'.$i,  utf8_encode($fila['usuario']))
                ->setCellValue('BW'.$i,  utf8_encode($fila['freg_encuesta']))
                ->setCellValue('BX'.$i,  utf8_encode($fila['nom_eps']))

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
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
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
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
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
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFd9b7f4')
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:BX1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:BX3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:BX".($i-1));

		for($i = 'A'; $i <= 'BX'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('consolidadoE');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="consolidadoEncuesta.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
