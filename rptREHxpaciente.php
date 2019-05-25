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
 mysql_connect("localhost","root","515t3m45emmanuel");
 mysql_select_db("emmanuelips");
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {



	public function Header($data) {
        // Logo
        foreach($data as $row) {
          $this->Cell(190,6, utf8_encode($row['tipo_terapia']),1,0,'C',1);
          $this->Ln();
          $this->MultiCell(190,5, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo']. ' Profesional: ' .$row['nombre_usuario']. ' Registro Profesional: ' .$row['docu']),1,0,'L');
          $this->Cell(80,6,'Evolucion:',1,0,'L',1);
          $this->Ln();
          $this->multicell(140,5, utf8_encode($row['evolucion']),1  ,'L');
          $this->Ln();
          $this->cell(40,0,$this->image($row['firmat'] , $this->GetX(), $this->GetY(),20,15),0,'J');
      		$this->Ln(20);
        }

        $sql="
        select
        a.tdoc_pac tipo_docu,a.doc_pac documento,a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,
        b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
        e.id_evofisio_reh id, e.freg_evofisio_reh fecha_evo,hreg_evofisio_reh hora_evo,e.evolucionfisio_reh evolucion,e.id_user id_user,
        f.nombre nombre_usuario,f.rm_profesional docu,f.especialidad especialidad, f.firma firmat
        from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
        right join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
        right join user f on (f.id_user = e.id_user)
        where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp = 1216 order by 1,2,3,4,5

        ";

        $rs = mysql_query($sql);
        if (mysql_num_rows($rs)>0){
            while($rw = mysql_fetch_array($rs)){
                $data[] = $rw;
            }
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
	public function ColoredTable($header,$data) {
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
      $this->Cell(190,6, utf8_encode($row['tipo_terapia']),1,0,'C',1);
      $this->Ln();
      $this->MultiCell(190,5, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo']. ' Profesional: ' .$row['nombre_usuario']. ' Registro Profesional: ' .$row['docu']),1,0,'L');
      $this->Cell(80,6,'Evolucion:',1,0,'L',1);
      $this->Ln();
      $this->multicell(140,5, utf8_encode($row['evolucion']),1  ,'L');
      $this->Ln();
      $this->cell(40,0,$this->image($row['firmat'] , $this->GetX(), $this->GetY(),20,15),0,'J');
  		$this->Ln(20);
    }
		$this->Cell(array_sum($w), 0, '', 'T');
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


$sql="
select
a.tdoc_pac tipo_docu,a.doc_pac documento,a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,
b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
e.id_evofisio_reh id, e.freg_evofisio_reh fecha_evo,hreg_evofisio_reh hora_evo,e.evolucionfisio_reh evolucion,e.id_user id_user,
f.nombre nombre_usuario,f.rm_profesional docu,f.especialidad especialidad, f.firma firmat
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp = 1216 order by 1,2,3,4,5

";

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
