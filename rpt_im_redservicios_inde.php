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

        $date=date('Y-m-d');
        $date1=date('m');
        $y=date('Y');
            $eps=$_GET['eps'];
        if ($eps==21) {
          $image_file = 'images/logo3p.png';
          $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
          // Set font
          $this->SetFont('helvetica', 'B', 10);
          // Title
          $this->Cell(0, 15, 'INFORME DE EVOLUCION MENSUAL', 1, false, 'R', 0, '', 0, false, 'M', 'M');
          $this->Ln();
          $this->Cell(30, 3, 'RS-F-GC-008', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(30, 3, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(120, 3, 'Fecha de Emision:2017-07-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln(10);

        }else {
            $image_file = 'images/rs.png';
            $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            // Title
            $this->Cell(0, 15, 'INFORME DE EVOLUCION MENSUAL', 1, false, 'R', 0, '', 0, false, 'M', 'M');
            $this->Ln();
            $this->Cell(30, 3, 'RS-F-GC-003', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Cell(30, 3, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Cell(120, 3, 'Fecha de Emision:2014-10-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(10);

        }

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
      $f1=$_GET['f1'];
      $f2=$_GET['f2'];

      $this->Cell(30,6,'Nombre Paciente:',1,0,'C',1);
      $this->Cell(80,6, utf8_encode($row['nom1']." ".$row['nom2']." ".$row['ape1']." ".$row['ape2']),1,0,'C');
      $this->Cell(35,6,'Documento Paciente:',1,0,'C',1);
      $this->Cell(35,6, utf8_encode($row['doc_pac']),1,0,'C');
      $this->Ln();
      $this->Cell(40,6,'Diagnostico:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->multiCell(180,6, utf8_encode($row['descricie']),1,0,'C');
      $this->SetFont('helvetica', '', 9);
      $this->Cell(10,6,'EPS:',1,0,'C',1);
      $this->Cell(50,6, utf8_encode($row['nombre_eps']),1,0,'C');
      $this->Cell(25,6,'Programa:',1,0,'C',1);
      $this->Cell(40,6, utf8_encode($row['tipo_servicio']),1,0,'C');
      $this->Cell(40,6,'Edad:',1,0,'C',1);
      $this->Cell(15,6, utf8_encode($row['edad']),1,0,'C');
      $this->Ln();
      $this->Cell(10,6,'Mes:',1,0,'C',1);
      $this->Cell(50,6,$f1 .' - '. $f2 ,1,0,'C');
      $this->Cell(40,6,'Fecha de atención:',1,0,'C',1);
      $this->Cell(50,6,$row['fecha_Informe'] ,1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 10);
      $this->Cell(180,6,$row['espec'],1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Objetivo del mes :',1,1,'C',1);
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180,0,utf8_encode($row['Objetivo']),1,'J');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Actividades y/o tecnicas aplicadas:',1,1,'C',1);
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180,0,utf8_encode($row['Actividades_realizadas']),1,'J');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Logros y/o novedades:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180, 0,utf8_encode($row['Logors']), 1, 'J');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Plan tratamiento a seguir:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180, 0,utf8_encode($row['Plan_tratamiento']), 1, 'J');
      $this->multicell(60,0,$this->image(utf8_encode($row['firma_user']) , $this->GetX(), $this->GetY(),60,20),1,'J');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(80,40,utf8_encode($row['terapeuta']),0,'L');
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


$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,tipo_servicio,
e.id_im_dem,freg_im_dem fecha_Informe,e.objetivo_im_dem Objetivo,e.actrealizada_im_dem Actividades_realizadas,e.logros_im_dem Logors,e.plant_im_dem	 Plan_tratamiento,servicio,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,f.especialidad espec,
g.nom_eps nombre_eps,
h.nom_sedes sede

FROM pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		             inner join im_demencias_inde e on (e.id_adm_hosp = b.id_adm_hosp)
                 inner join user f on (e.id_user = f.id_user)
                 inner join eps g on (b.id_eps = g.id_eps)
                 inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

WHERE b.tipo_servicio in ('Demencias','AVD')  and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_im_dem BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

Order by 1,3,5 ASC";

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
$nombre='IM.pdf';
// close and output PDF document
$pdf->Output($nombre, 'I');

//============================================================+
// END OF FILE
//============================================================+
