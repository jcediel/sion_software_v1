<?php
    $conexion = new mysqli('localhost','root','515t3m45','emmanuelips',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
    $consulta = "SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.fnacimiento, TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,a.genero,
                 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
                    i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
                    DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,b.id_adm_hosp id,m.dxp
          FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
              left join cama g on (g.id_cama = f.id_cama )
              left join habitacion h on (h.id_habitacion = g.id_habitacion )
              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
              left join piso j on (j.id_piso = i.id_piso )
              left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
              left join eps l on (l.id_eps=b.id_eps)
              left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
          WHERE b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 2,10";



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
							 ->setTitle("CENSO FACATATIVA")
							 ->setSubject("CENSO FACATATIVA")
							 ->setDescription("CENSO FACATATIVA")
							 ->setKeywords("CENSO FACATATIVA")
							 ->setCategory("Reporte excel SM");

		$tituloReporte = "CENSO FACATATIVA";
		$titulosColumnas = array('PACIENTE','TDOCUMENTO','DOCUMENTO','GENERO','UBICACION', 'INGRESO','EPS','ESTANCIA','CLASE DX','FECHA NACIMIENTO','EDAD');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:K1');

		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A2',  $titulosColumnas[0])
		            ->setCellValue('B2',  $titulosColumnas[1])
        		    ->setCellValue('C2',  $titulosColumnas[2])
            		->setCellValue('D2',  $titulosColumnas[3])
                ->setCellValue('E2',  $titulosColumnas[4])
                ->setCellValue('F2',  $titulosColumnas[5])
                ->setCellValue('G2',  $titulosColumnas[6])
                ->setCellValue('H2',  $titulosColumnas[7])
                ->setCellValue('I2',  $titulosColumnas[8])
                ->setCellValue('J2',  $titulosColumnas[9])
                ->setCellValue('K2',  $titulosColumnas[10]);


		$i = 5;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['paciente']))
        		    ->setCellValue('B'.$i,  utf8_encode($fila['tdoc_pac']))
		            ->setCellValue('C'.$i,  $fila['doc_pac'])
        		    ->setCellValue('D'.$i,  $fila['genero'])
                ->setCellValue('E'.$i,   utf8_encode($fila['habi']))
                ->setCellValue('F'.$i,   utf8_encode($fila['fingreso_hosp']))
                ->setCellValue('G'.$i,   utf8_encode($fila['nom_eps']))
                ->setCellValue('H'.$i,   utf8_encode($fila['estancia']))
                ->setCellValue('I'.$i,   utf8_encode($fila['clase_dx_hosp']))
                ->setCellValue('J'.$i,   utf8_encode($fila['fnacimiento']))
                ->setCellValue('K'.$i,   utf8_encode($fila['edad']))
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:K".($i-1));

		for($i = 'A'; $i <= 'K'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('CENSOFACA');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,3);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="censofaca.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
