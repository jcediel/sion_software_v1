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
	$consulta = "SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,genero,
               a.id_adm_hosp,estado_adm_hosp,fegreso_hosp,IFNULL(a.fegreso_hosp, '".$f2."') fecha_fin,fingreso_hosp,
               IF(IFNULL(a.fegreso_hosp,0)=0,DATEDIFF(CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE),CAST(IF(fingreso_hosp <= '".$f1."', '".$f1."',a.fingreso_hosp) AS DATE))+1,
               IF(a.fegreso_hosp>CAST('".$f2."' AS DATE),DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),
               CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp))+1,
               DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),
               IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp)))) difer1
               ,IF(fingreso_hosp <= '".$f1."', '".$f1."',fingreso_hosp) fecha_inicio,
               ( IF(a.fegreso_hosp > '".$f2."',CAST('".$f2."' AS DATE),CAST(IFNULL(fegreso_hosp, '".$f2."') AS DATE)) -
               CAST(IF(fingreso_hosp <= '".$f1."', CAST('".$f1."' AS DATE),fingreso_hosp) AS DATE)
               ) dias,clase_dx_hosp,
               e.nom_eps,
               i.nom_sedes,
               max(j.ddxp) ddxp,
               max(k.ddxp_epi) cdx_epi
        FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
                         INNER JOIN eps e on e.id_eps=a.id_eps
                         INNER JOIN sedes_ips i on i.id_sedes_ips=a.id_sedes_ips
                         LEFT JOIN hc_hospitalario j on j.id_adm_hosp=a.id_adm_hosp
                         LEFT JOIN epicrisis k on k.id_adm_hosp=a.id_adm_hosp
        WHERE a.tipo_servicio = 'Hospitalario' and ((fingreso_hosp <= CAST('".$f2."' AS DATE) and fegreso_hosp is null)
              or (fegreso_hosp >= CAST('".$f1."' AS DATE) and fingreso_hosp <='".$f2."'))
              and a.id_sedes_ips in ($sede)
        GROUP BY p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,genero,
                     a.id_adm_hosp,estado_adm_hosp,fegreso_hosp,IFNULL(a.fegreso_hosp, '".$f2."') ,fingreso_hosp,
                     IF(IFNULL(a.fegreso_hosp,0)=0,DATEDIFF(CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE),CAST(IF(fingreso_hosp <= '".$f1."', '".$f1."',a.fingreso_hosp) AS DATE))+1,
                     IF(a.fegreso_hosp>CAST('".$f2."' AS DATE),DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),
                     CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp))+1,
                     DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),
                     IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp))))
                     ,IF(fingreso_hosp <= '".$f1."', '".$f1."',fingreso_hosp) ,
                     ( IF(a.fegreso_hosp > '".$f2."',CAST('".$f2."' AS DATE),CAST(IFNULL(fegreso_hosp, '".$f2."') AS DATE)) -
                     CAST(IF(fingreso_hosp <= '".$f1."', CAST('".$f1."' AS DATE),fingreso_hosp) AS DATE)
                     ) ,clase_dx_hosp,
                     e.nom_eps,
                     i.nom_sedes";

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
							 ->setTitle("INFORME DE ESTANCIA HOSPITALARIA")
							 ->setSubject("INFORME DE ESTANCIA HOSPITALARIA")
							 ->setDescription("INFORME DE ESTANCIA HOSPITALARIA")
							 ->setKeywords("INFORME DE ESTANCIA HOSPITALARIA")
							 ->setCategory("Reporte excel SM");

		$tituloReporte = "DIAS DE ESTANCIA HOPITALARIA";
		$titulosColumnas = array('TIPO DOC','DOCUMENTO','PACIENTE','ADM','CLASE DX', 'INGRESO','EGRESO','ESTANCIA', 'DX INGRESO', 'DX EGRESO', 'EPS','SEDE','GENERO');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:L1');

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
                ->setCellValue('M3',  $titulosColumnas[12]);


		$i = 13;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $fila['tdoc_pac'])
        		    ->setCellValue('B'.$i,  $fila['doc_pac'])
		            ->setCellValue('C'.$i,  utf8_encode($fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2']))
        		    ->setCellValue('D'.$i,  $fila['id_adm_hosp'])
                ->setCellValue('E'.$i,  $fila['clase_dx_hosp'])
                ->setCellValue('F'.$i,  $fila['fingreso_hosp'])
                ->setCellValue('G'.$i,  $fila['fegreso_hosp'])
                ->setCellValue('H'.$i,  $fila['difer1'])
                ->setCellValue('I'.$i,  utf8_encode($fila['ddxp']))
                ->setCellValue('J'.$i,  utf8_encode($fila['cdx_epi']))
                ->setCellValue('K'.$i,  utf8_encode($fila['nom_eps']))
                ->setCellValue('L'.$i,  utf8_encode($fila['nom_sedes']))
                ->setCellValue('M'.$i,  utf8_encode($fila['genero']))
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:M".($i-1));

		for($i = 'A'; $i <= 'M'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('estanciaHosp');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="EstanciaHosp.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
