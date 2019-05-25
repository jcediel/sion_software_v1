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
	$consulta = "SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
               b.id_adm_hosp,
               c.freg_hchosp,dxp,tdxp,dx1,tdx1,dx2,tdx2,dx3,tdx3,
               d.nombre,
               h.nom_sedes,
               g.nom_eps
        FROM pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                         left join hcini_dom c on c.id_adm_hosp=b.id_adm_hosp
                         left join user d on d.id_user=c.id_user
                         left join sedes_ips h on h.id_sedes_ips=b.id_sedes_ips
                         left join eps g on g.id_eps=b.id_eps

        WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede)
                                 and c.freg_hchosp BETWEEN '$f1' and '$f2'
                                 and b.estado_adm_hosp='Activo'
                                 and b.tipo_servicio='Domiciliarios'";

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
							 ->setTitle("INFORME CONSOLIDADO VALORACIONES MEDICAS")
							 ->setSubject("INFORME CONSOLIDADO VALORACIONES MEDICAS")
							 ->setDescription("INFORME CONSOLIDADO VALORACIONES MEDICAS")
							 ->setKeywords("INFORME CONSOLIDADO VALORACIONES MEDICAS")
							 ->setCategory("Reporte excel");

		$tituloReporte = "INFORME CONSOLIDADO VALORACIONES MEDICAS";
		$titulosColumnas = array('NOMBRE', 'TIPO DOC', 'DOCUMENTO','SEDE', 'EPS','MEDICO','DXP', 'DX1', 'DX2', 'DX3','FECHA HC');

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
		$i = 4;

		while ($fila = $resultado->fetch_array()) {

			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['nom_completo']))
        		    ->setCellValue('B'.$i,  $fila['tdoc_pac'])
		            ->setCellValue('C'.$i,  $fila['doc_pac'])
        		    ->setCellValue('D'.$i,  utf8_encode($fila['nom_sedes']))
                ->setCellValue('E'.$i,  utf8_encode($fila['nom_eps']))
                ->setCellValue('F'.$i,  utf8_encode($fila['nombre']))
            		->setCellValue('G'.$i,  utf8_encode($fila['dxp']))
                ->setCellValue('H'.$i,  utf8_encode($fila['dx1']))
                ->setCellValue('I'.$i,  utf8_encode($fila['dx2']))
                ->setCellValue('J'.$i,  utf8_encode($fila['dx3']))
                ->setCellValue('K'.$i,  utf8_encode($fila['freg_hchosp']))
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
		$objPHPExcel->getActiveSheet()->setTitle('consolidadoValMedicas');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="consolidadoValMedicas.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
