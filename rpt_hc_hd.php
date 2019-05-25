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
        $image_file = 'images/logo3p.png';
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
        $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'HISTORIA CLINICA HOSPITAL DÍA', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      $this->Cell(32,5, utf8_encode($row['freg_hcsm_pv'].' | '.$row['hreg_hcsm_pv ']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'ANAMNESIS',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Motivo de Consulta:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['motivo_consulta']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Enfermedad Actual:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['enfer_actual']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Historia Personal:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['his_personal']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Historia Familiar:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['his_familiar']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Personalidad Premorbida:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['perso_premorbida']),1,'L');
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'ANTECEDENTES PERSONALES',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Alergicos:',1,0,'L',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['ant_alergicos']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Patologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_patologico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Quirurgicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_quirurgico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Toxicologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_toxicologico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Farmacologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_farmaco']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Gineco-obstetricos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_gineco']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Psiquiatricos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_psiquiatrico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Psiquiatricos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_psiquiatrico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Hospitalarios:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_hospitalario']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes traumatologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_traumatologico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Familiares:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_familiar']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Otros Antecedentes:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['otros_ant']),1,'L');
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'EXAMEN FISICO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20  ,0,'TAS(mm/Hg):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['tas'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'TAD(mm/Hg):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['tad'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'TAM(mm/Hg):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['tam'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'FR(x min):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['fr'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'FC(x min):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['fc'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'SpO2(satO2):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['so'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'Peso(Kg):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['peso'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'Talla(Mts):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['talla'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'IMC:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['imc'],1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(20,0,'Temp(C°):',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['temperatura'],1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'EXPLORACION GENERAL Y REGIONAL',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Estado General:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['estado_general']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Cabeza y cuello:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['cabcuello']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Torax:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['torax']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Abdomen:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['abdomen']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Genitourinario:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['genitourinario']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Extremidades:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ext']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Neurologico:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['neurologico']),1,'L');
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'EXAMEN MENTAL',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['examen_mental']),1,'L');
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'ANALISIS',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['analisis']),1,'L');
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'DIAGNOSTICOS',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico principal:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['dxp'].' - '.$row['ddxp'].' --- '.$row['tdxp']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico Relacionado 1:',1,0,'C',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['dx1'].' - '.$row['ddx1'].' --- '.$row['tdx1']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico Relacionado 2:',1,0,'C',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['dx2'].' - '.$row['ddx2'].' --- '.$row['tdx2']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico Relacionado 3:',1,0,'C',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['dx3'].' - '.$row['ddx3'].' --- '.$row['tdx3']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(180,0,'FINALIDAD DE CONSULTA',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['finalidad']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(180,0,'CAUSA EXTERNA',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['causa_externa']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(180,0,'PLAN DE TRATAMIENTO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['plantratamiento']),1,'L');
      $this->cell(35,0,$this->image($row['firma'] , $this->GetX(), $this->GetY(),40,30),0,'J');
      $this->SetFont('helvetica', 'BI',10);
      $this->MultiCell(130, 0,utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['espec_user']) .$txt, 0, 'R', 0, 0, '', '', true, 0, false, true, 80, 'T');

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
k.id_hchospdia, freg_hchosp, hreg_hchosp, motivo_consulta, enfer_actual, his_personal, his_familiar, perso_premorbida, ant_alergicos, ant_patologico, ant_quirurgico, ant_toxicologico, ant_farmaco, ant_gineco, ant_psiquiatrico, ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant, estado_general, tad, tas, tam, fr, fc, so, peso, talla, temperatura, imc, cabcuello, torax, ext, abdomen, neurologico, genitourinario, examen_mental, analisis, finalidad, causa_externa, dxp, ddxp, tdxp, dx1, ddx1, tdx1, dx2, ddx2, tdx2, dx3, ddx3, tdx3, plantratamiento, tipo_atencion, estado_hchosp,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)
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
