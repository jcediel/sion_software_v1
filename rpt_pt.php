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
        $date1=date('m');
        $y=date('Y');
        $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'INFORME PLANES TRIMESTRALES', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(30, 3, '', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 3, '', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 3, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      $this->Cell(40,6, utf8_encode('Rehabilitacion Infantil'),1,0,'C');
      $this->Cell(40,6,'Edad:',1,0,'C',1);
      $this->Cell(15,6, utf8_encode($row['edad']),1,0,'C');
      $this->Ln();
      $this->Cell(40,6,'Fecha Realizacion:',1,0,'C',1);
      $this->Cell(140,6,utf8_encode($row['fecha_evo']) ,1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 10);
      $this->Cell(180,6,$row['tipo_terapia'],1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Objetivo General :',1,1,'C',1);
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180,0,utf8_encode($row['obgen']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Objetivo Especifico 1:',1,1,'C',1);
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180,0,utf8_encode($row['obespec1']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Objetivo Especifico 2:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180, 0,utf8_encode($row['obespec2']), 1, 'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Objetivo Especifico 3:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->multicell(180, 0,utf8_encode($row['obespec3']), 1, 'L');
      $this->Ln();
      $this->multicell(60,0,$this->image($row['firmat'] , $this->GetX(), $this->GetY(),60,20),1,'J');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(80,40,utf8_encode($row['terapeuta']),0,'L');
      $this->Ln(20);
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


$sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'EQUINOTERAPIA' tipo_terapia,
e.id_ptequino_reh id, e.freg_ptequino_reh fecha_evo,e.hreg_ptequino_reh hora_evo,e.obgen_equino_reh obgen,e.obespec1_equino_reh obespec1,e.obespec2_equino_reh obespec2,e.obespec3_equino_reh obespec3,e.val1_equino_reh val1,e.val2_equino_reh val2,e.val3_equino_reh val3,e.valgen_equino_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_equino_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptequino_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
e.id_ptfisio_reh id, e.freg_ptfisio_reh fecha_evo,e.hreg_ptfisio_reh hora_evo,e.obgen_fisio_reh obgen,e.obespec1_fisio_reh obespec1,e.obespec2_fisio_reh obespec2,e.obespec3_fisio_reh obespec3,e.val1_fisio_reh val1,e.val2_fisio_reh val2,e.val3_fisio_reh val3,e.valgen_fisio_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptfisio_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
e.id_ptfono_reh id, e.freg_ptfono_reh fecha_evo,e.hreg_ptfono_reh hora_evo,e.obgen_fono_reh obgen,e.obespec1_fono_reh obespec1,e.obespec2_fono_reh obespec2,e.obespec3_fono_reh obespec3,e.val1_fono_reh val1,e.val2_fono_reh val2,e.val3_fono_reh val3,e.valgen_fono_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_fono_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptfono_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'


UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'HIDROTERAPIA' tipo_terapia,
e.id_pthidro_reh id, e.freg_pthidro_reh fecha_evo,e.hreg_pthidro_reh hora_evo,e.obgen_hidro_reh obgen,e.obespec1_hidro_reh obespec1,e.obespec2_hidro_reh obespec2,e.obespec3_hidro_reh obespec3,e.val1_hidro_reh val1,e.val2_hidro_reh val2,e.val3_hidro_reh val3,e.valgen_hidro_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_hidro_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_pthidro_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia,
e.id_ptmusico_reh id, e.freg_ptmusico_reh fecha_evo,e.hreg_ptmusico_reh hora_evo,e.obgen_musico_reh obgen,e.obespec1_musico_reh obespec1,e.obespec2_musico_reh obespec2,e.obespec3_musico_reh obespec3,e.val1_musico_reh val1,e.val2_musico_reh val2,e.val3_musico_reh val3,e.valgen_musico_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_musico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptmusico_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA COGNITIVA' tipo_terapia,
e.id_ptpsicocog_reh id, e.freg_ptpsicocog_reh fecha_evo,e.hreg_ptpsicocog_reh hora_evo,e.obgen_psicocog_reh obgen,e.obespec1_psicocog_reh obespec1,e.obespec2_psicocog_reh obespec2,e.obespec3_psicocog_reh obespec3,e.val1_psicocog_reh val1,e.val2_psicocog_reh val2,e.val3_psicocog_reh val3,e.valgen_psicocog_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_psicocog_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptpsicocog_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
e.id_ptpsico_reh id, e.freg_ptpsico_reh fecha_evo,e.hreg_ptpsico_reh hora_evo,e.obgen_psico_reh obgen,e.obespec1_psico_reh obespec1,e.obespec2_psico_reh obespec2,e.obespec3_psico_reh obespec3,e.val1_psico_reh val1,e.val2_psico_reh val2,e.val3_psico_reh val3,e.valgen_psico_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_psico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptpsico_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'TERAPIA ASISTIDA POR PERROS' tipo_terapia,
e.id_pttap_reh id, e.freg_pttap_reh fecha_evo,e.hreg_pttap_reh hora_evo,e.obgen_tap_reh obgen,e.obespec1_tap_reh obespec1,e.obespec2_tap_reh obespec2,e.obespec3_tap_reh obespec3,e.val1_tap_reh val1,e.val2_tap_reh val2,e.val3_tap_reh val3,e.valgen_tap_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_tap_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_pttap_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,a.edad edad, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
e.id_ptto_reh id, e.freg_ptto_reh fecha_evo,e.hreg_ptto_reh hora_evo,e.obgen_to_reh obgen,e.obespec1_to_reh obespec1,e.obespec2_to_reh obespec2,e.obespec3_to_reh obespec3,e.val1_to_reh val1,e.val2_to_reh val2,e.val3_to_reh val3,e.valgen_to_reh valgen,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat ,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join plantrimestral_to_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

where b.tipo_servicio = 'Rehabilitacion' and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.freg_ptto_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

order by fecha_evo ASC, hora_evo ASC
";
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
$nombre=$_GET["nom"];
// close and output PDF document
$pdf->Output($nombre, 'I');

//============================================================+
// END OF FILE
//============================================================+
