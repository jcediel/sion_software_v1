<?php
    $conexion = new mysqli('localhost','root','515t3m45','emmanuelips',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
  $f1=$_REQUEST['f1'];
  $f2=$_REQUEST['f2'];
	$consulta = "SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
                      b.id_evofisio_ce id, b.freg_evofisio_ce fecha, b.hreg_evofisio_ce hora, ('931000') cups,
                      c.nombre profesional,c.especialidad
              FROM pacientes a inner join adm_hospitalario d on a.id_paciente=d.id_paciente
                              left join evo_fisio_ce b on b.id_adm_hosp=d.id_adm_hosp
                              left join user c on c.id_user=b.id_user

              WHERE freg_evofisio_ce BETWEEN '".$f1."' AND '".$f2."'

              UNION

              SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
                                  b.id_evofono_ce id, b.freg_evofono_ce fecha, b.hreg_evofono_ce hora, ('937000') cups,
                                  c.nombre profesional,c.especialidad
              FROM pacientes a inner join adm_hospitalario d on a.id_paciente=d.id_paciente
                               left join evo_fono_ce b on b.id_adm_hosp=d.id_adm_hosp
                               left join user c on c.id_user=b.id_user

              WHERE freg_evofono_ce BETWEEN '".$f1."' AND '".$f2."'

              UNION

              SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
                     b.id_evoto_ce id, b.freg_evoto_ce fecha, b.hreg_evoto_ce hora, ('938300') cups,
                     c.nombre profesional,c.especialidad
              FROM pacientes a inner join adm_hospitalario d on a.id_paciente=d.id_paciente
                              left join evo_to_ce b on b.id_adm_hosp=d.id_adm_hosp
                              left join user c on c.id_user=b.id_user

              WHERE freg_evoto_ce BETWEEN '".$f1."' AND '".$f2."'
              UNION

              SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
                     b.id_evotr_ce id, b.freg_evotr_ce fecha, b.hreg_evotr_ce hora,('939400') cups,
                     c.nombre profesional,c.especialidad
              FROM pacientes a inner join adm_hospitalario d on a.id_paciente=d.id_paciente
                              left join evo_tr_ce b on b.id_adm_hosp=d.id_adm_hosp
                              left join user c on c.id_user=b.id_user

              WHERE freg_evotr_ce BETWEEN '".$f1."' AND '".$f2."'

              UNION

              SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
                                  b.id_valini_ce,freg fecha,hreg hora,('') cups,
                                  c.nombre profesional,c.especialidad
              FROM pacientes a inner join adm_hospitalario d on a.id_paciente=d.id_paciente
                               left join val_ini_ce b on b.id_adm_hosp=d.id_adm_hosp
                               left join user c on c.id_user=b.id_user

              WHERE freg BETWEEN '".$f1."' AND '".$f2."'";

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
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de alumnos")
							 ->setKeywords("reporte alumnos carreras")
							 ->setCategory("Reporte excel");

		$tituloReporte = "DETALLE DE EVOLUCIONES CONSULTA EXTERNA";
		$titulosColumnas = array('TIPO DOC','DOCUMENTO','PACIENTE', 'FECHA', 'HORA','PROFESIONAL','CUPS', 'ESPECIALIDAD');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:H1');

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
                ->setCellValue('H3',  $titulosColumnas[7]);

		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $fila['tdoc_pac'])
        		    ->setCellValue('B'.$i,  $fila['doc_pac'])
		            ->setCellValue('C'.$i,  utf8_encode($fila['paciente']))
        		    ->setCellValue('D'.$i,  $fila['fecha'])
                ->setCellValue('E'.$i,  $fila['hora'])
                ->setCellValue('F'.$i,  utf8_encode($fila['profesional']))
                ->setCellValue('G'.$i,  utf8_encode($fila['cups']))
            		->setCellValue('H'.$i,  $fila['especialidad']);
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
            		'rgb' => 'c47cf2'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
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
    	            	'rgb' => '3a2a47'
                   	)
               	)
           	)
        ));

		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:H".($i-1));

		for($i = 'A'; $i <= 'H'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('evoluciones');

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
