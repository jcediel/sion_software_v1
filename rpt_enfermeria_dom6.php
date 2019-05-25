<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2006-03-04
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
        $nom=$_REQUEST['nom'];
        $dx=$_REQUEST['dx'];
        $doc=$_REQUEST['doc'];


        $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');

        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'NOTAS DE ENFERMERIA', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, 'F-SD-GDC-007', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de Emision: 2017-06-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 9);
        $this->Ln();
        $this->Cell(30,6,'Nombre Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 9);
        $this->Cell(80,6, utf8_encode($nom), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(35,6,'Documento Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 9);
        $this->Cell(35,6, utf8_encode($doc), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
    		$this->Ln();
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,6,'Diagnostico:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 7);
        $this->Cell(160,6, utf8_encode($dx), 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
	public function ColoredTable($header,$data,$data1,$data2,$data3,$data4) {
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

      $this->SetFont('','B',10);
      $this->Cell(60,0, utf8_encode('Turno: 6 Horas'),1,0,'C',1);
        $this->SetFont('','B',12);
      $this->Cell(120,0, utf8_encode('Fecha de realizacion: '.$row['freg6']),1,0,'C',1);
      $this->SetFont('','B',9);
      $this->Ln();
      $this->SetFont('','B',7);
      $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota1']) ,1,0,'C',0);
      $this->Cell(20,0, 'Hora final:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota2']) ,1,0,'C',0);
      $this->SetFont('','',7);
      $this->multiCell(110,0, utf8_encode($row['nota1']),1,'L');
      $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota2']) ,1,0,'C',0);
      $this->Cell(20,0, 'Hora final:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota3']) ,1,0,'C',0);
      $this->SetFont('','',7);
      $this->multiCell(110,0, utf8_encode($row['nota2']),1,'L');
      $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota3']) ,1,0,'C',0);
      $this->Cell(20,0, 'Hora final:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota4']) ,1,0,'C',0);
      $this->SetFont('','',7);
      $this->multiCell(110,0, utf8_encode($row['nota3']),1,'L');
      $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota4']) ,1,0,'C',0);
      $this->Cell(20,0, 'Hora final:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota5']) ,1,0,'C',0);
      $this->SetFont('','',7);
      $this->multiCell(110,0, utf8_encode($row['nota4']),1,'L');
      $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota5']) ,1,0,'C',0);
      $this->Cell(20,0, 'Hora final:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota6']) ,1,0,'C',0);
      $this->SetFont('','',7);
      $this->multiCell(110,0, utf8_encode($row['nota5']),1,'L');
      $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
      $this->Cell(15,0,utf8_encode($row['hnota6']) ,1,0,'C',0);
      $this->Cell(20,0, 'Hora final:',1,0,'C',1);
      $hnotaf = strtotime ( '+60 minute' , strtotime ( $row['hnota6'] ) ) ;
      $hnotaft=date('H:i', $hnotaf);
      $this->Cell(15,0,utf8_encode($hnotaft.':00') ,1,0,'C',0);
      $this->SetFont('','',7);
      $this->multiCell(110,0, utf8_encode($row['nota6']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row['nombre']. ' Identificacion: ' .$row['doc']. ' Registro Profesional: ' .$row['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');

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

$turno=$_REQUEST['turno'];
$adm=$_REQUEST['idadmhosp'];
$idd=$_REQUEST['idd'];
$f1=$_REQUEST['f1'];
$f2=$_REQUEST['f2'];
if ($turno==6) {
  if ($f1!='') {
    $sql="SELECT a.id_enf_dom6, id_adm_hosp,  freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
                   hnota5, nota5, hnota6, nota6, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom6 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm and id_d_aut_dom=$idd AND estado_nota='Realizada' and a.freg6 BETWEEN '$f1' and '$f2'
          ORDER BY freg6 ASC

    ";

  }else {
    $sql="SELECT a.id_enf_dom6, id_adm_hosp,  freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
                   hnota5, nota5, hnota6, nota6, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom6 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada' and id_d_aut_dom=$idd
          ORDER BY freg6 ASC
    ";
  }

  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
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
