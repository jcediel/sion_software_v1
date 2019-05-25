<?php
    $conexion = new mysqli('localhost','root','515t3m45','emmanuelips',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
  $f1=$_REQUEST['f1'];
  $f2=$_REQUEST['f2'];
  $eps=$_REQUEST['eps'];
  $bodega=$_REQUEST['bodega'];
	$consulta = "SELECT a.id_m_fmedhosp,a.id_adm_hosp,a.id_user,a.id_bodega,a.freg_m_fmedhosp,a.fejecucion_inicial,a.fejecucion_final
                 ,a.tipo_formula,a.estado_m_fmedhosp,a.servicio,a.dx_formula,a.dx1_formula,a.dx2_formula,a.user_upt,
                 b.freg,b.medicamento,b.via,b.frecuencia,b.estado_med,b.rad_mipres,b.tipo_mipres,b.soporte,b.cod_med,
                 b.user_actualiza,(b.dosis1 + b.dosis2 + b.dosis3 + b.dosis4) dosis,
                 c.freg_farmacia,c.nom_dosi,c.cant_dosi,c.estado_dosi,c.obs_dosi,c.fadmin,c.cant_admin,
                 c.hora_admin,c.estado_admin,c.obs_admin,c.resp_adm,
                 e.nom_completo,
                 m.nombre despacho,
                 n.nombre devulve

           FROM m_fmedhosp a INNER JOIN d_fmedhosp b on (b.id_m_fmedhosp = a.id_m_fmedhosp)
                             INNER JOIN dosificacion_med c on (c.id_d_fmedhosp = b.id_d_fmedhosp )
                             INNER JOIN adm_hospitalario d on d.id_adm_hosp=a.id_adm_hosp
                             INNER JOIN pacientes e on e.id_paciente=d.id_paciente
                             LEFT JOIN user m on m.id_user=c.id_user
                             LEFT JOIN user n on n.id_user=c.resp_adm

           WHERE c.freg_farmacia BETWEEN CAST('$f1' as DATE)  AND CAST('$f2' as DATE)
                 and a.id_bodega in($bodega)
                 and c.estado_admin = 'Devuelto'
           ORDER BY c.fadmin DESC,e.nom_completo ASC";

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
							 ->setTitle("INFORME DEVOLUCION MEDICAMENTOS")
							 ->setSubject("INFORME DEVOLUCION MEDICAMENTOS")
							 ->setDescription("INFORME DEVOLUCION MEDICAMENTOS")
							 ->setKeywords("INFORME DEVOLUCION MEDICAMENTOS")
							 ->setCategory("Reporte excel SM");

		$tituloReporte = "INFORME DEVOLUCION MEDICAMENTOS";
		$titulosColumnas = array('PACIENTE','MEDICAMENTO','FECHA DESPACHO','DOSIS DESPACHO','CANTIDAD DESPACHO','RESPONSABLE DESPACHO','FECHA DEVOLUCION','DOSIS DEVOLUCION','CANTIDAD DEVOLUCION','RESPONSABLE DEVOLUCION','OBSERVACION DEVOLUCION');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:I1');

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
                ->setCellValue('I3',  $titulosColumnas[8]);


		$i = 6;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
        		    ->setCellValue('B'.$i,  $fila['medicamento'])
		            ->setCellValue('C'.$i,  utf8_encode($fila['freg_farmacia']))
        		    ->setCellValue('D'.$i,  $fila['nom_dosi'])
                ->setCellValue('E'.$i,  $fila['cant_dosi'])
                ->setCellValue('F'.$i,  $fila['fadmin'])
                ->setCellValue('G'.$i,  $fila['nom_dosi'])
                ->setCellValue('H'.$i,  $fila['cant_admin'])
                ->setCellValue('I'.$i,  $fila['obs_admin']);
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:I".($i-1));

		for($i = 'A'; $i <= 'I'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('DEVOLUCIONES');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="devoluciones.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
