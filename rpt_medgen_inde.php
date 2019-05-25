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
        $image_file = 'images/logo_inde-01.png';
        $date=date('Y-m-d');
        $date1=date('m');
        $y=date('Y');
        $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');
        if ($date1==1) {
          $mes='Enero';
          }
          if ($date1==2) {
            $mes='Enero';
            }
            if ($date1==3) {
              $mes='Febrero';
              }
              if ($date1==4) {
                $mes='Abril';
                }
                if ($date1==5) {
                  $mes='Mayo';
                  }
                  if ($date1==6) {
                    $mes='Junio';
                    }
                    if ($date1==7) {
                      $mes='Julio';
                      }
                      if ($date1==8) {
                        $mes='Agosto';
                        }
                        if ($date1==9) {
                          $mes='Septiembre';
                          }
                          if ($date1==10) {
                            $mes='Octubre';
                            }
                            if ($date1==11) {
                              $mes='Noviembre';
                              }
                              if ($date1==12) {
                                $mes='Diciembre';
                                }

        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'MEDICINA GENERAL INDE', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(30, 3, 'F-GC-020', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 3, 'Version:03', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(60, 3, 'Fecha de emisión:2017-05-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(60, 3, 'Fecha de Impresion:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);

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
	public function ColoredTable($header,$data,$data1) {
		// Colors, line width and bold font
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');
		// Header
		$w = array(40, 35, 40, 45);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		foreach($data as $row) {
      $date=date('Y-m-d');
      $mes= date('m') ;
      $mes1=date('m');
      $y=date('Y');

      $this->Cell(30,6,'Nombre Paciente:',1,0,'C',1);
      $this->Cell(80,6, utf8_encode($row['nom1']." ".$row['nom2']." ".$row['ape1']." ".$row['ape2']),1,0,'C');
      $this->Cell(35,6,'Documento Paciente:',1,0,'C',1);
      $this->Cell(35,6, utf8_encode($row['doc_pac']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', '', 9);
      $this->Cell(10,6,'EPS:',1,0,'C',1);
      $this->Cell(50,6, utf8_encode($row['nombre_eps']),1,0,'C');
      $this->Cell(25,6,'Programa:',1,0,'C',1);
      $this->Cell(40,6, utf8_encode('Medicina General INDE'),1,0,'C');
      $this->Cell(40,6,'Edad:',1,0,'C',1);
      $this->Cell(15,6, utf8_encode($row['edad']),1,0,'C');
      $this->Ln();
      $this->Cell(40,6,'Fecha Registro:',1,0,'C',1);
      $this->Cell(50,6, utf8_encode($row['fecha'].' | '.$row['hora']),1,0,'C');
      $this->Ln();
      $this->multiCell(180,0,'CONCEPTO SUBJETIVO :',1,'L');
      $this->multicell(180,0,utf8_encode($row['subjetivo']),1,'L');
      $this->Cell(180,0,'CONCEPTO OBJETIVO:',1,1,'L',1);
      $this->multicell(180,0,utf8_encode($row['objetivo']),1,'L');

      $this->Cell(180,0,'ANALISIS:',1,0,'L',1);
      $this->Ln();
      $this->multicell(180, 0,utf8_encode($row['analisis_evomed']), 1, 'L');

      $this->Cell(180,0,'PLAN TRATAMIENTO:',1,0,'L',1);
      $this->Ln();
      $this->multicell(180, 0,utf8_encode($row['plan_tratamiento']), 1, 'L');
      $this->Ln();
      $this->Cell(180,0,'IMPRESION DIAGNOSTICA:',1,0,'L',1);
      $this->Ln();
      $this->multicell(180,0,utf8_encode('Diagnostico principal: '.$row['ddxp'].' '.$row['tdxp']),1,'L');
      $this->multicell(180,0,utf8_encode('Diagnostico relacionado 1: '.$row['ddx1'].' '.$row['tdx1']),1,'L');
      $this->multicell(180,0,utf8_encode('Diagnostico relacionado 2: '.$row['ddx2'].' '.$row['tdx2']),1,'L');
      $this->Cell(80,0,utf8_encode($row['terapeuta']. '  Registro profesional:' .$row['rm_profesional']),0,'L');
      $this->Ln(10);
      $this->multicell(60,0,$this->image($row['firma_user'] , $this->GetX(), $this->GetY(),60,20),1,'J');
      $this->Ln(200);
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




// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();


$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 ,a.edad,
b.id_adm_hosp  id_adm_hosp,tipo_servicio,
e.freg_evomed	fecha,e.hreg_evomed hora,e.subjetivo subjetivo,e.objetivo objetivo, e.analisis_evomed,e.plan_tratamiento,e.ddxp,e.tdxp,e.ddx1,e.tdx1,e.ddx2,e.tdx2,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,f.rm_profesional,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join evo_medgen_inde e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where  b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_evomed BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
 order by 1,11 ASC
";

//echo $sql;
$rs = mysql_query($sql);
if (mysql_num_rows($rs)>0){
    while($rw = mysql_fetch_array($rs)){
        $data[] = $rw;
    }
}

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('example_011.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
