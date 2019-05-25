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
  $doc=$_REQUEST['doc'];
  if ($doc!='') {
    $consulta = "SELECT a.doc_pac,nom_completo,
                 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
                 c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
                 d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion,
                 estado_prod, freg_muestra, resp_muestra, obs_muestra,freg_procesa, resp_procesa, obs_procesa,
                 freg_inter, nota_inter, resp_inter,
                 e.nom_eps
          FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                           LEFT JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
                           LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
                           LEFT JOIN eps e on e.id_eps = b.id_eps
          WHERE d.freg BETWEEN '$f1' and '$f2' and b.id_sedes_ips in ($sede) and b.id_eps in ($eps) and d.estado_prod='Procesada' and a.doc_pac='$doc'
          ORDER BY d.estado_prod ASC, e.nom_eps ASC, a.doc_pac ASC";
  }else {
    $consulta = "SELECT a.doc_pac,nom_completo,
                 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
                 c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
                 d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion,
                 estado_prod, freg_muestra, resp_muestra, obs_muestra,freg_procesa, resp_procesa, obs_procesa,
                 freg_inter, nota_inter, resp_inter,
                 e.nom_eps
          FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                           LEFT JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
                           LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
                           LEFT JOIN eps e on e.id_eps = b.id_eps
          WHERE d.freg BETWEEN '$f1' and '$f2' and b.id_sedes_ips in ($sede) and b.id_eps in ($eps) and d.estado_prod='Procesada'
          ORDER BY d.estado_prod ASC, e.nom_eps ASC, a.doc_pac ASC";
  }


	$resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 ){

		date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("GASTO DE PROCEDIMIENTOS")
							 ->setSubject("GASTO DE PROCEDIMIENTOS")
							 ->setDescription("GASTO DE PROCEDIMIENTOS")
							 ->setKeywords("GASTO DE PROCEDIMIENTOS")
							 ->setCategory("Reporte excel SM");

		$tituloReporte = "GASTO DE PROCEDMIENTOS";
		$titulosColumnas = array('DOCUMENTO','PACIENTE','FECHA PROCESADO','CUPS', 'PROCEDIMIENTO','EPS');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:F1');

		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A2',  $titulosColumnas[0])
		            ->setCellValue('B2',  $titulosColumnas[1])
        		    ->setCellValue('C2',  $titulosColumnas[2])
            		->setCellValue('D2',  $titulosColumnas[3])
                ->setCellValue('E2',  $titulosColumnas[4])
                ->setCellValue('F2',  $titulosColumnas[5]);


		$i = 6;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $fila['doc_pac'])
        		    ->setCellValue('B'.$i,  utf8_encode($fila['nom_completo']))
		            ->setCellValue('C'.$i,  $fila['freg_procesa'])
        		    ->setCellValue('D'.$i,  $fila['cod_cups'])
                ->setCellValue('E'.$i,   utf8_encode($fila['procedimiento']))
                ->setCellValue('F'.$i,   utf8_encode($fila['nom_eps']))
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:F".($i-1));

		for($i = 'A'; $i <= 'F'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('gastoProcedimientos');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,3);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="GastoProcedimientos.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
