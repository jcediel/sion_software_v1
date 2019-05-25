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
        $mes= date('m') ;
        $mes1=date('m');
        $y=date('Y');


        $nom=$_GET["nom"];
        $eps=$_GET['eps'];
        $edad=$_GET["edad"];
        $cie=$_GET["cie"];
        $f1=$_GET["f1"];
        $f2=$_GET["f2"];
        if ($eps==21) {
          $image_file = 'images/logo3p.png';
          $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
          // Set font
          $this->SetFont('helvetica', 'B', 10);
          // Title
          $this->Cell(0, 15, 'EVOLUCION PACIENTES', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln();
          $this->SetFont('helvetica', '', 9);
          $this->Cell(30, 5, 'RS-F-GC-007', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(120, 5, 'Fecha de Emision:2017-07-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->SetFont('helvetica', 'B', 9);
          $this->Ln();
          $this->Cell(30,6,'Nombre Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->SetFont('helvetica', '', 9);
          $this->Cell(80,6, utf8_encode($nom), 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->SetFont('helvetica', 'B', 9);
          $this->Cell(35,6,'Documento Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->SetFont('helvetica', '', 9);
          $this->Cell(35,6, utf8_encode($edad), 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->SetFont('helvetica', 'B', 7);
          $this->Ln();
          $this->Cell(30,6,'Diagnostico:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(40,6,'Fecha de atención:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(70,6,$f1. ' - '.$f2 , 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln();
          $this->SetFont('helvetica', '', 7);
          $this->Cell(180,6, utf8_encode($cie), 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln();
        }else {
            $image_file = 'images/rs.png';
            $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            // Title
            $this->Cell(0, 15, 'EVOLUCION PACIENTES', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln();
            $this->SetFont('helvetica', '', 9);
            $this->Cell(30, 5, 'RS-F-GC-002', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Cell(120, 5, 'Fecha de Emision:2014-10-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 9);
            $this->Ln();
            $this->Cell(30,6,'Nombre Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', '', 9);
            $this->Cell(80,6, utf8_encode($nom), 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 9);
            $this->Cell(35,6,'Documento Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', '', 9);
            $this->Cell(35,6, utf8_encode($edad), 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 7);
            $this->Ln();
            $this->Cell(30,6,'Diagnostico:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Cell(40,6,'Fecha de atención:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Cell(70,6,$f1. ' - '.$f2 , 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln();
            $this->SetFont('helvetica', '', 7);
            $this->Cell(180,6, utf8_encode($cie), 1, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln();
        }


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


      $i=1;
      $this->SetFont('','B',10);
      $this->Cell(180,5, utf8_encode($row['tipo_terapia']),1,0,'C',1);
      $this->SetFont('','',9);
      $this->Ln();
      $this->MultiCell(180,5, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo']. ' Profesional: ' .$row['nombre_usuario']. ' Registro Profesional: ' .$row['docu']),1,0,'L');

      $this->SetFont('','',7);
      $this->MultiCell(145, 30,utf8_encode($row['evolucion']) .$txt, 1, 'J', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->cell(35,30,$this->image(utf8_encode($row['firmat']) , $this->GetX(), $this->GetY(),35,20),0,'J');
  		$this->Ln(35);
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

$terapia=$_GET["tterapia"];

if ($terapia=='TODAS') {

  $sql="select
  a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
  e.id_evofisio id, e.freg_evofisio fecha_evo,e.hreg_evofisio hora_evo,e.evolucionfisio evolucion,e.id_user id_user,
  f.nombre nombre_usuario, f.firma firmat,
  g.nom_eps eps,
  h.nom_sedes sedes

  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evofisio='Realizada' and e.freg_evofisio BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
   e.id_evoto id, e.freg_evoto fecha_evo,e.hreg_evoto hora_evo,e.evolucionto evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evoto='Realizada' and e.freg_evoto BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
   e.id_evofono id, e.freg_evofono fecha_evo,e.hreg_evofono hora_evo,e.evolucionfono evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evofono='Realizada' and e.freg_evofono BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
   e.id_evopsico id, e.freg_evopsico fecha_evo,e.hreg_evopsico hora_evo,e.evolucionpsico evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evopsico='Realizada' and e.freg_evopsico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'NEUROPSICOLOGIA' tipo_terapia,
   e.id_evonpsico id, e.freg_evonpsico fecha_evo,e.hreg_evonpsico hora_evo,e.evolucionnpsico evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evonpsico='Realizada' and e.freg_evonpsico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
  e.id_evomusico id, e.freg_evomusico fecha_evo,e.hreg_evomusico hora_evo,e.evolucionmusico evolucion,e.id_user id_user,
  f.nombre nombre_usuario, f.firma firmat ,
  g.nom_eps eps,
  h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evomusico='Realizada' and e.freg_evomusico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC, tipo_terapia ASC

  ";
  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }

}
if ($terapia=='FISIOTERAPIA') {

  $sql="select
  a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
  e.id_evofisio id, e.freg_evofisio fecha_evo,e.hreg_evofisio hora_evo,e.evolucionfisio evolucion,e.id_user id_user,
  f.nombre nombre_usuario, f.firma firmat,
  g.nom_eps eps,
  h.nom_sedes sedes

  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evofisio='Realizada' and e.freg_evofisio BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC

  ";
  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }

}
if ($terapia=='TERAPIA OCUPACIONAL') {

  $sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
   e.id_evoto id, e.freg_evoto fecha_evo,e.hreg_evoto hora_evo,e.evolucionto evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evoto='Realizada' and e.freg_evoto BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC

  ";
  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
        }
  }
}
if ($terapia=='FONOAUDIOLOGIA') {

  $sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
   e.id_evofono id, e.freg_evofono fecha_evo,e.hreg_evofono hora_evo,e.evolucionfono evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evofono='Realizada' and e.freg_evofono BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC

  ";
  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }

}
if ($terapia=='PSICOLOGIA') {

  $sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
   e.id_evopsico id, e.freg_evopsico fecha_evo,e.hreg_evopsico hora_evo,e.evolucionpsico evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evopsico='Realizada' and e.freg_evopsico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC

  ";
  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }

}
if ($terapia=='PSICOLOGIA') {

  $sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia,
   e.id_evomusico id, e.freg_evomusico fecha_evo,e.hreg_evomusico hora_evo,e.evolucionmusico evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evomusico='Realizada' and e.freg_evomusico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC

  ";
  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }

}
if ($terapia=='NEUROPSICOLOGIA') {

  $sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'NEUROPSICOLOGIA' tipo_terapia,
   e.id_evonpsico id, e.freg_evonpsico fecha_evo,e.hreg_evonpsico hora_evo,e.evolucionnpsico evolucion,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_GET["idadmhosp"]."' and e.estado_evonpsico='Realizada' and e.freg_evonpsico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC,hora_evo ASC, tipo_terapia ASC

  ";
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
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre=$_GET["nom"];
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
