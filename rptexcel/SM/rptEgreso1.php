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
	$consulta = "SELECT a.tdoc_pac,genero,doc_pac,nom_completo,TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
               b.id_adm_hosp,fingreso_hosp,fegreso_hosp,estado_adm_hosp,estado_salida,clase_dx_hosp,DATEDIFF(fegreso_hosp,fingreso_hosp) as estancia,
               h.descrimuni,
               e.nom_eps,
               c.dxp dx,c.ddxp ddx,
               d.ddxp
        FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                         INNER JOIN eps e on e.id_eps = b.id_eps
                         LEFT JOIN evolucion_medica c on (b.id_adm_hosp=c.id_adm_hosp and tipo_evo='Epicrisis')
                         LEFT JOIN hc_hospitalario d on b.id_adm_hosp=d.id_adm_hosp
                         LEFT JOIN municipios h on (h.codmuni=b.mun_residencia)
        WHERE b.fegreso_hosp BETWEEN '$f1' and '$f2' and b.id_sedes_ips in ($sede) and b.id_eps in ($eps)
                                                     and estado_adm_hosp<>'Activo' and b.tipo_servicio='Hospitalario'
        ORDER BY b.estado_adm_hosp ASC, e.nom_eps ASC, a.doc_pac ASC";

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
							 ->setTitle("INFORME egresos")
							 ->setSubject("INFORME egresos")
							 ->setDescription("INFORME egresos")
							 ->setKeywords("INFORME egresos")
							 ->setCategory("Reporte excel SM");

		$tituloReporte = "INFORME EGRESOS HOSPITALARIOS";
		$titulosColumnas = array('PACIENTE','TDOC','IDENTIFICACION','EDAD','EPS','INGRESO','EGRESO',
                             'CLASIFICACION DX','DX INGRESO','DX EGRESO','ESTANCIA','GENERO','MUNICIPIO','ESTADO SALIDA');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:N1');

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
                ->setCellValue('N3',  $titulosColumnas[12]);


		$i = 4;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
        		    ->setCellValue('B'.$i,  $fila['tdoc_pac'])
		            ->setCellValue('C'.$i,  utf8_encode($fila['doc_pac']))
        		    ->setCellValue('D'.$i,  $fila['edad'])
                ->setCellValue('E'.$i,  utf8_encode($fila['nom_eps']))
                ->setCellValue('F'.$i,  $fila['fingreso_hosp'])
                ->setCellValue('G'.$i,  $fila['fegreso_hosp'])
                ->setCellValue('H'.$i,  $fila['clase_dx_hosp'])
                ->setCellValue('I'.$i,  $fila['ddxp'])
                ->setCellValue('J'.$i,  $fila['ddx'])
                ->setCellValue('K'.$i,  $fila['estancia'])
                ->setCellValue('L'.$i,  $fila['genero'])
                ->setCellValue('M'.$i,  $fila['descrimuni'])
                ->setCellValue('N'.$i,  $fila['estado_salida']);
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:N".($i-1));

		for($i = 'A'; $i <= 'N'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('egresosHospitalario');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="egresosHospitalario.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
