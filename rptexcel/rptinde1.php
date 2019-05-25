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
	$consulta = "SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,genero,tel_pac,
                b.id_adm_hosp,dep_residencia,
                c.nom_sedes,
                d.nom_eps,
                e.freg_evomed, hreg_evomed, objetivo, subjetivo, analisis_evomed, plan_tratamiento, ddxp, tdxp, ddx1, tdx1, ddx2, tdx2, resp_evomed, estado_evomed,
                f.descripdep
         FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                          INNER JOIN sedes_ips c on c.id_sedes_ips=b.id_sedes_ips
                          INNER JOIN eps d on d.id_eps=b.id_eps
                          INNER JOIN evo_medgen_inde e on e.id_adm_hosp=b.id_adm_hosp
                          LEFT JOIN departamento f on f.coddep=b.dep_residencia
         WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede)
                                  and b.tipo_servicio='Medicina General INDE'
                                  and e.freg_evomed BETWEEN '$f1' and '$f2'
         ORDER BY 2,9 ASC";

	$resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 ){

		date_default_timezone_set('America/Bogota');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Informe de control INDE")
							 ->setSubject("Informe de control INDE")
							 ->setDescription("Informe de control INDE")
							 ->setKeywords("Informe de control INDE")
							 ->setCategory("Reporte excel");

		$tituloReporte = "REPORTE DE MEDICINA GENERAL INDE";
		$titulosColumnas = array('PRIMER NOMBRE','SEGUNDO NOMBRE','PRIMER APELLIDO', 'SEGUNDO APELLIDO', 'TIPO DOC', 'DOCUMENTO','ADM','SEDE', 'EPS','FECHA','HORA', 'OBJETIVO', 'SUBJETIVO', 'ANALISIS', 'PLAN', 'DX', 'TDX', 'MEDICO', 'ESTADO', 'EDAD', 'GENERO','LOCALIDAD','TELEFONO','FNACIMIENTO');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:X1');

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

                ;
		$i = 4;
    $fecha=$_POST["fnacimiento"];
    $segundos= strtotime('now') - strtotime($fecha);
    $diferencia_dias=intval($segundos /60/60/24);
    $dias=floor($diferencia_dias/365);

		while ($fila = $resultado->fetch_array()) {


			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['nom1']))
        		    ->setCellValue('B'.$i,  utf8_encode($fila['nom2']))
		            ->setCellValue('C'.$i,  utf8_encode($fila['ape1']))
        		    ->setCellValue('D'.$i,  utf8_encode($fila['ape2']))
                ->setCellValue('E'.$i,  $fila['tdoc_pac'])
                ->setCellValue('F'.$i,  $fila['doc_pac'])
                ->setCellValue('G'.$i,  $fila['id_adm_hosp'])
                ->setCellValue('H'.$i,  utf8_encode($fila['nom_sedes']))
                ->setCellValue('I'.$i,  utf8_encode($fila['nom_eps']))
                ->setCellValue('J'.$i,  $fila['freg_evomed'])
            		->setCellValue('K'.$i,  $fila['hreg_evomed'])
                ->setCellValue('L'.$i,  utf8_encode($fila['objetivo']))
                ->setCellValue('M'.$i,  utf8_encode($fila['subjetivo']))
                ->setCellValue('N'.$i,  utf8_encode($fila['analisis_evomed']))
                ->setCellValue('O'.$i,  utf8_encode($fila['plan_tratamiento']))
                ->setCellValue('P'.$i,  utf8_encode($fila['ddxp']))
                ->setCellValue('Q'.$i,  utf8_encode($fila['tdxp']))
                ->setCellValue('R'.$i,  utf8_encode($fila['resp_evomed']))
                ->setCellValue('S'.$i,  utf8_encode($fila['estado_evomed']))
                ->setCellValue('T'.$i,  $fila['edad'])
                ->setCellValue('U'.$i,  $fila['genero'])
                ->setCellValue('V'.$i,  utf8_encode($fila['descripdep']))
                ->setCellValue('W'.$i,  utf8_encode($fila['tel_pac']))
                ->setCellValue('X'.$i,  utf8_encode($fila['fnacimiento']));
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:X3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:X".($i-1));

		for($i = 'A'; $i <= 'X'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Medgen');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="MedicinaGeneralInde.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
