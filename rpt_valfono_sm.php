<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */
 mysql_connect("localhost","root","515t3m45");
 mysql_select_db("emmanuelips");
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        $image_file = 'images/logoP.png';
        $date=date('Y-m-d');
        $mes= date('m') ;
        $mes1=date('m');
        $y=date('Y');
        if ($mes==1) {
          $mes1='Enero';
          }
          if ($mes==2) {
            $mes1='Febrero';
            }
            if ($mes==3) {
              $mes1='Marzo';
              }
              if ($mes==4) {
                $mes1='Abril';
                }
                if ($mes==5) {
                  $mes1='Mayo';
                  }
                  if ($mes==6) {
                    $mes1='Junio';
                    }
                    if ($mes==7) {
                      $mes1='Julio';
                      }
                      if ($mes==8) {
                        $mes1='Agosto';
                        }
                        if ($mes==9) {
                          $mes1='Septiembre';
                          }
                          if ($mes==10) {
                            $mes1='Octubre';
                            }
                            if ($mes==11) {
                              $mes1='Noviembre';
                              }
                              if ($mes==12) {
                                $mes1='Noviembre';
                                }

        $nom=$_GET["nom"];
        $edad=$_GET["edad"];
        $cie=$_GET["cie"];
        $f1=$_GET["f1"];
        $f2=$_GET["f2"];
        $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),40,20),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'VALORACION INICIAL FONOAUDIOLOGIA', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, 'F-SD-028', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de Emision: 2015-05-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
    }
	// Load table data from file
	public function LoadData($file) {
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
	}


	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');
		// Header
		$w = array(40, 49, 40, 45);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 8, $header[$i], 1, 0, 'C', 0);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {

      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,5,'Datos Generales:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(26,5,'Nombre Paciente:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(84,5, utf8_encode($row['nom1']." ".$row['nom2']." ".$row['ape1']." ".$row['ape2']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(35,5,'Documento Paciente:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(35,5, utf8_encode($row['tdoc_pac'].': '.$row['doc_pac']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->Cell(26,5,'F. Naciemiento:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(18,5, utf8_encode($row['fnacimiento']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(12,5,'Edad:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(15,5, utf8_encode($row['edad'].' '.$row['descripuedad']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(7,5,'RH:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(7,5, utf8_encode($row['rh']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(12,5,'Genero:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(17,5, utf8_encode($row['genero']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(7,5,'Tel:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(59,5, utf8_encode($row['tel_pac']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(15,5,'Direccion:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(80,5, utf8_encode($row['dir_pac']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(15,5,'Email:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(70,5, utf8_encode($row['email_pac']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->Cell(22,5,'Fecha Ingreso:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(32,5, utf8_encode($row['fingreso_hosp'].' | '.$row['hingreso_hosp']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(22,5,'Fecha Egreso:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(32,5, utf8_encode($row['fegreso_hosp'].' | '.$row['hegreso_hosp']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(8,5,'EPS:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(64,5, utf8_encode($row['nom_eps']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(15,5,'T.Usuario:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(25,5, utf8_encode($row['descritusuario']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(17,5,'T.Afiliacion:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(25,5, utf8_encode($row['descriafiliado']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(22,5,'Departamento:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(30,5, utf8_encode($row['descripdep']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(16,5,'Municipio:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(30,5, utf8_encode($row['descrimuni']),1,0,'C');
  		$this->Ln(10);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(22,5,'Fecha Registro:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(32,5, utf8_encode($row['freg_valini_reh'].' | '.$row['hreg_valini_reh']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'EXPLORACION DE ORGANOS FONOARTICULADORES',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Tono Muscular:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['tmuscular_i']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Sensibilidad:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['sencibilidad_i']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Simetria Facial:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['sfacial_i']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Labios:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['labios_i']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Lengua:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['lengua_i']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'PRAXIAS OROFACIALES',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Sacar y meter la lengua:',1,0,'L',1);
      $this->Cell(60,0,'Mover la lengua de derecha a izquierda:',1,0,'L',1);
      $this->Cell(60,0,'Mover la lengua de arriba abajo:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['praxia1']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia2']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Protruir labios:',1,0,'L',1);
      $this->Cell(60,0,'Extender labios:',1,0,'L',1);
      $this->Cell(60,0,'Chupar carrillos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['praxia4']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia5']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia6']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Inflar o desinflar mejillas:',1,0,'L',1);
      $this->Cell(60,0,'Abrir y cerrar la boca:',1,0,'L',1);
      $this->Cell(60,0,'Mover maxilar de derecha a izquierda:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['praxia7']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia8']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia9']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Movimientos circulares de la lengua:',1,0,'L',1);
      $this->Cell(60,0,'Chasquear la lengua:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['praxia10']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['praxia11']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'DESARROLLO LINGUISTICO, TEST DE ARTICULACION Y FUNCIONES ALIMENTICIAS',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Desarrollo Lingui­stico (reflejos primitivos, pre requisitos de lenguaje):',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['desa_lingue']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Test de articulacion:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['test_arti']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Funciones Alimenticias:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['f_alimenticias']),1,'L');
      $this->Ln();
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'NIVEL SEMANTICO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Reconoce categori­as semanticas:',1,0,'L',1);
      $this->Cell(60,0,'Ejecuta tareas verbales simples:',1,0,'L',1);
      $this->Cell(60,0,'Ejecuta tareas verbales complejas :',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nseman1']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nseman2']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nseman3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Reconoce conceptos espaciales:',1,0,'L',1);
      $this->Cell(60,0,'Reconoce conceptos temporales:',1,0,'L',1);
      $this->Cell(60,0,'Reconoce conceptos de cantidad:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nseman4']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nseman5']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nseman6']),1,0,'L',0);
      $this->Ln();
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'NIVEL SINTACTICO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Emplea pronombres personales:',1,0,'L',1);
      $this->Cell(60,0,'Emplea sustantivos masculino y femenino:',1,0,'L',1);
      $this->Cell(60,0,'Emplea y conjuga verbos en forma correcta:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nsintac1']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nsintac2']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nsintac3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Emplea Adjetivos:',1,0,'L',1);
      $this->Cell(60,0,'Emplea Adverbios:',1,0,'L',1);
      $this->Cell(60,0,'Estructura frases con sentido gramatical:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nsintac4']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nsintac5']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nsintac6']),1,0,'L',0);
      $this->Ln();
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'NIVEL PRAGMATICO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Expresa deseos:',1,0,'L',1);
      $this->Cell(60,0,'Expresa emociones:',1,0,'L',1);
      $this->Cell(60,0,'Realiza preguntas:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nprag1']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nprag2']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nprag3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Realiza descripciones:',1,0,'L',1);
      $this->Cell(60,0,'Realiza narraciones:',1,0,'L',1);
      $this->Cell(60,0,'Considera al oyente en la comunicacion:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nprag4']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nprag5']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nprag6']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Tolera contacto visual:',1,0,'L',1);
      $this->Cell(60,0,'Realiza contacto visual con intencion:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['nprag7']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['nprag8']),1,0,'L',0);
      $this->Ln();
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'SENSOPERCEPCION',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Reporta perdida auditiva:',1,0,'L',1);
      $this->Cell(60,0,'Reporta perdida visual:',1,0,'L',1);
      $this->Cell(60,0,'Tolera esti­mulos auditivos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['senso1']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['senso2']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['senso3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Tolera esti­mulos visuales:',1,0,'L',1);
      $this->Cell(60,0,'Percepcion de sonido:',1,0,'L',1);
      $this->Cell(60,0,'Ubicacion de fuente sonora:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['senso4']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['senso5']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['senso6']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(60,0,'Memoria auditiva:',1,0,'L',1);
      $this->Cell(60,0,'Memoria visual:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(60,0, utf8_encode($row['senso7']),1,0,'L',0);
      $this->Cell(60,0, utf8_encode($row['senso8']),1,0,'L',0);
      $this->Ln();
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Codigo Lecto - Escrito:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['tmuscular_i']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Diagnostico Comunicativo:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['sencibilidad_i']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Plan manejo:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['sfacial_i']),1,'L');
      $this->cell(35,0,$this->image($row['firma'] , $this->GetX(), $this->GetY(),40,30),'J');
      $this->SetFont('helvetica', 'BI',10);
      $this->MultiCell(130,0,utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['espec_user']) .$txt, 0, 'R', 0, 0, '', '', true, 0, false, true, 80, 'T');
		}
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetfooterMargin(PDF_MARGIN_HEADER);




// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();


$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
c.descripestadoc,
d.descriafiliado,
e.descritusuario,
f.descriocu,
g.descripdep,
h.descrimuni,
i.descripuedad,
j.nom_eps,
k.id_valini_reh, freg_valini_reh, hreg_valini_reh, tmuscular_i, sencibilidad_i, sfacial_i, labios_i, lengua_i, maxilar_i, paladar_i, sialorrea_i, resp_i, toclusion_i, praxia1, praxia2, praxia3, praxia4, praxia5, praxia6, praxia7, praxia8, praxia9, praxia10, praxia11, desa_lingue, test_arti, f_alimenticias, nseman1, nseman2, nseman3, nseman4, nseman5, nseman6, nsintac1, nsintac2, nsintac3, nsintac4, nsintac5, nsintac6, nprag1, nprag2, nprag3, nprag4, nprag5, nprag6, nprag7, nprag8, senso1, senso2, senso3, senso4, senso5, senso6, senso7, senso8, codlectoescrito, dxcomunicativo, estado_valini_fono,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      inner join val_inifono_dom k on (k.id_adm_hosp=b.id_adm_hosp)
      inner join user l on (l.id_user=k.id_user)
where b.id_adm_hosp ='".$_GET["idadmhosp"]."' ";
//echo $sql;
$rs = mysql_query($sql);
if (mysql_num_rows($rs)>0){
    $i=0;
    while($rw = mysql_fetch_array($rs)){

        $data[] = $rw;
  }
}



// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre='HC clinica';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
