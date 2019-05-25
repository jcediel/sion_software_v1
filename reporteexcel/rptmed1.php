<?php
    $conexion = new mysqli('localhost','root','515t3m45','emmanuelips',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
  $f1=$_REQUEST['f1'];
  $f2=$_REQUEST['f2'];
  $eps=$_REQUEST['eps'];
	$consulta = "SELECT f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
               b.fingreso_hosp,b.fegreso_hosp,
               b.id_adm_hosp,
               g.id_producto,pos,altocosto,exepcion,
               d.medicamento,
               h.tarifa_v tarifa,cod_eps_md,
               n.dxp,
               sum(cant_dosi) dosis,
               sum(cant_dosi)/g.unidad unidades
        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                         INNER JOIN eps f on (f.id_eps = b.id_eps)
                         LEFT JOIN hc_hospitalario n on (n.id_adm_hosp = b.id_adm_hosp)
                         INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
                         INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                         INNER JOIN m_producto g on (g.id_producto = d.cod_med  and g.estado_propio = 2)
                         LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                         LEFT  JOIN convenio_medicamento h on (h.id_eps = b.id_eps and h.id_producto = g.id_producto)
        WHERE c.estado_m_fmedhosp='solicitado' and freg_farmacia between CAST('$f1' AS DATE) and  CAST('$f2' AS DATE) and f.id_eps in ($eps)
        GROUP BY f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,medicamento,g.unidad ORDER BY 1,3";

	$resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 ){

		date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte medicamentos a facturar")
							 ->setSubject("Reporte medicamentos a facturar")
							 ->setDescription("Reporte medicamentos a facturar")
							 ->setKeywords("Reporte medicamentos a facturar")
							 ->setCategory("Reporte excel");

		$tituloReporte = "REPORTE DE GASTO MEDICAMENTOS";
		$titulosColumnas = array('EPS','PACIENTE','IDENTIFICACION', 'INGRESO/EGRESO', 'ID PRODUCTO','CODEPS','MEDICAMENTO', 'CLASIFICACION','DOSIS','UNIDADES', 'VALOR');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:K1');

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
                ->setCellValue('K3',  $titulosColumnas[10]);

		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $fila['nom_eps'])
        		    ->setCellValue('B'.$i,  $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'])
		            ->setCellValue('C'.$i,  utf8_encode($fila['doc_pac']))
        		    ->setCellValue('D'.$i,  $fila['fingreso_hosp'].' '.$fila['fegreso_hosp'])
                ->setCellValue('E'.$i,  $fila['id_producto'])
                ->setCellValue('F'.$i,  utf8_encode($fila['cod_eps_md']))
                ->setCellValue('G'.$i,  utf8_encode($fila['medicamento']))
                ->setCellValue('H'.$i,  utf8_encode($clase))
                ->setCellValue('I'.$i,  utf8_encode($fila['dosis']))
                ->setCellValue('J'.$i,  utf8_encode(ceil($fila['unidades'])))
            		->setCellValue('K'.$i,  $fila['tarifa']);
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:K".($i-1));

		for($i = 'A'; $i <= 'K'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Medicamentos');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="evoconsultaexterna.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
