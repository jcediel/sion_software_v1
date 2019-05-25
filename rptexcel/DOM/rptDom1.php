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
	$consulta = "SELECT month(current_date),h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
                          c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
                          IFNULL(c.id_adm_hosp,0),
                          d.id_m_aut_dom,d.dx_presentacion,
                          IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
                          e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
                          e.temporalidad,
                          h.nom_eps,
                          j.nom_sedes,
                          k.nomclaseusuario,
                          cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
                  FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
                                           INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
                                           INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
                                           INNER JOIN eps h on (h.id_eps = c.id_eps)
                                            INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
                                            INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
                                           LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

                  WHERE c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps)
                                                         and c.id_sedes_ips in ($sede)
                                                          and e.ffinal BETWEEN '$f1' and '$f2'
                                                         and c.estado_adm_hosp = 'Activo'
                                                         and estado_d_aut_dom in (1,2,3)
                  ORDER BY sesiones ASC,cups ASC";

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
							 ->setTitle("INFORME CONSOLIDADO TERAPIAS")
							 ->setSubject("INFORME CONSOLIDADO TERAPIAS")
							 ->setDescription("INFORME CONSOLIDADO TERAPIAS")
							 ->setKeywords("INFORME CONSOLIDADO TERAPIAS")
							 ->setCategory("Reporte excel");

		$tituloReporte = "INFORME CONSOLIDADO TERAPIAS";
		$titulosColumnas = array('NOMBRE', 'TIPO DOC', 'DOCUMENTO','SEDE', 'EPS','INICIAL','FINAL', 'CUPS', 'PROCEDIMIENTO', 'CANTIDAD AUTORIZADA', 'CANTIDAD REALIZADA');

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
                ->setCellValue('K3',  $titulosColumnas[10])
                ;
		$i = 3;

		while ($fila = $resultado->fetch_array()) {

			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
        		    ->setCellValue('B'.$i,  $fila['tdoc_pac'])
		            ->setCellValue('C'.$i,  $fila['doc_pac'])
        		    ->setCellValue('D'.$i,  utf8_encode($fila['nom_sedes']))
                ->setCellValue('E'.$i,  utf8_encode($fila['nom_eps']))
                ->setCellValue('F'.$i,  $fila['finicio'])
            		->setCellValue('G'.$i,  $fila['ffinal'])
                ->setCellValue('H'.$i,  utf8_encode($fila['cups']))
                ->setCellValue('I'.$i,  utf8_encode($fila['procedimiento']))
                ->setCellValue('J'.$i,  utf8_encode($fila['cantidad']))
                ->setCellValue('K'.$i,  $fila['sesiones'])
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
		$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:K".($i-1));

		for($i = 'A'; $i <= 'K'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('consolidadoTerapias');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="consolidadoTerapias.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
