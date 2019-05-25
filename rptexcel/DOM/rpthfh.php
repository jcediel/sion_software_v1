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
	$consulta = "SELECT h.nom_eps,b.doc_pac,b.nom_completo,b.tel_pac,b.dir_pac,l.nom_barrio,i.descrimuni,k.descripdep,o.nom_localidad,p.nombre jefe_zona,
                      m.descritusuario,n.descriafiliado,b.genero,b.rh,b.fnacimiento,b.edad,c.estado_salida estado,j.nomclaseusuario tipo_paciente,
                      d.id_m_aut_dom,e.freg,d.nom_paquete,e.cups,e.procedimiento,e.cantidad,e.finicio,e.ffinal,e.num_aut_externa,e.estado_d_aut_dom,
                      e.intervalo,e.temporalidad,g.doc,g.nombre profesional,f.estado_profesional,g.tel_user,
                      sesiones_dom(e.cups,e.id_d_aut_dom,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones,
                      sesiones_dom_det(e.id_d_aut_dom,e.cups,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE),f.profesional) sesiones_det

               FROM adm_hospitalario c INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
                                       INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom and cast('2019-03-01' as date ) BETWEEN CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
                                       INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
                                       INNER JOIN eps h on (h.id_eps = c.id_eps)
                                       LEFT  JOIN profesional_d_dom f on (f.id_d_aut_dom = e.id_d_aut_dom)
                                       LEFT  JOIN user g on (g.id_user = f.profesional)
                                       LEFT  JOIN user p on (p.id_user = b.jefe_zona)
                                       LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
                                       LEFT  JOIN clase_usuario j on (j.id_cusuario = d.tipo_paciente)
                                       LEFT  JOIN departamento k on (k.coddep = c.dep_residencia)
                                       LEFT  JOIN barrio l on (l.id_barrio = b.zonificacion)
                                       LEFT  JOIN tusuario m on (m.codtusuario = c.tipo_usuario)
                                       LEFT  JOIN tafiliado n on (n.codafiliado = c.tipo_afiliacion)
                                       LEFT  JOIN barrio r on (r.id_barrio = b.zonificacion)
                                       LEFT  JOIN upz q on (q.id_upz = r.id_upz )
                                       LEFT  JOIN localidades o on (o.id_localidad = q.id_localidad)

                WHERE c.tipo_servicio = 'Domiciliarios' and c.estado_adm_hosp   = 'Activo'";

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
							 ->setTitle("INFORME HAGA FELIZ A HUGO")
							 ->setSubject("INFORME HAGA FELIZ A HUGO")
							 ->setDescription("INFORME HAGA FELIZ A HUGO")
							 ->setKeywords("INFORME HAGA FELIZ A HUGO")
							 ->setCategory("Reporte excel");

		$tituloReporte = "HAGA FELIZ A HUGO";
		$titulosColumnas = array('EPS','IDENTIFICACION','PACIENTE','TELEFONO','DIRECCION','BARRIO','MUNICIPIO','DEPARTAMENTO','JEFE ZONA', 'TIPO USUARIO','TIPO AFILIADO','GENERO','RH','NACIMIENTO','EDAD', 'TIPO PACIENTE','NOMBRE PAQUETE','CUPS', 'PROCEDIMIENTO','CANTIDAD','FINICIO', 'FFINAL',
    'ESTADOPROCEDIMIENTO','INTERVALO', 'TEMPORALIDAD','DOCPROFESIONAL','PROFESIONAL','TELPROFESIONAL','SESIONES','SESIONESDET');

		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:AD1');

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
                ->setCellValue('Y3',  $titulosColumnas[24])
                ->setCellValue('Z3',  $titulosColumnas[25])
                ->setCellValue('AA3',  $titulosColumnas[26])
                ->setCellValue('AB3',  $titulosColumnas[27])
                ->setCellValue('AC3',  $titulosColumnas[29])
                ->setCellValue('AD3',  $titulosColumnas[30])
                ;
		$i = 4;

		while ($fila = $resultado->fetch_array()) {

			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  utf8_encode($fila['nom_eps']))
        		    ->setCellValue('B'.$i,  $fila['doc_pac'])
		            ->setCellValue('C'.$i,  utf8_encode($fila['nom_completo']))
        		    ->setCellValue('D'.$i,  $fila['tel_pac'])
                ->setCellValue('E'.$i,  $fila['dir_pac'])
                ->setCellValue('F'.$i,  utf8_encode($fila['nom_barrio']))
                ->setCellValue('G'.$i,  utf8_encode($fila['descrimuni']))
                ->setCellValue('H'.$i,  utf8_encode($fila['descripdep']))
                ->setCellValue('I'.$i,  utf8_encode($fila['jefe_zona']))
                ->setCellValue('J'.$i,  utf8_encode($fila['descritusuario']))
                ->setCellValue('K'.$i,  utf8_encode($fila['descriafiliado']))
                ->setCellValue('L'.$i,  $fila['genero'])
                ->setCellValue('M'.$i,  utf8_encode($fila['rh']))
                ->setCellValue('N'.$i,  $fila['fnacimiento'])
                ->setCellValue('O'.$i,  $fila['edad'])
                ->setCellValue('P'.$i,  utf8_encode($fila['tipo_paciente']))
                ->setCellValue('Q'.$i,  utf8_encode($fila['nom_paquete']))
                ->setCellValue('R'.$i,  utf8_encode($fila['cups']))
                ->setCellValue('S'.$i,  utf8_encode($fila['procedimiento']))
                ->setCellValue('T'.$i,  utf8_encode($fila['cantidad']))
                ->setCellValue('U'.$i,  utf8_encode($fila['finicio']))
                ->setCellValue('V'.$i,  utf8_encode($fila['ffinal']))
                ->setCellValue('W'.$i,  utf8_encode($fila['estado_profesional']))
                ->setCellValue('X'.$i,  utf8_encode($fila['intervalo']))
                ->setCellValue('Y'.$i,  utf8_encode($fila['temporalidad']))
                ->setCellValue('Z'.$i,  utf8_encode($fila['doc']))
                ->setCellValue('AA'.$i,  utf8_encode($fila['profesional']))
                ->setCellValue('AB'.$i,  utf8_encode($fila['tel_user']))
                ->setCellValue('AC'.$i,  utf8_encode($fila['sesiones']))
                ->setCellValue('AD'.$i,  utf8_encode($fila['sesiones_det']))

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

		$objPHPExcel->getActiveSheet()->getStyle('A1:AD1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:AD".($i-1));

		for($i = 'A'; $i <= 'AD'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('rptHagaFeliz');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="rptHagaFeliz.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>
