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

        $id=$_REQUEST["idadmhosp"];
        $nom=$_REQUEST["nom"];
        $doc=$_REQUEST["edad"];
        $cie=$_REQUEST["cie"];
        $f1=$_REQUEST["f1"];
        $f2=$_REQUEST["f2"];
        $nomeps=$_REQUEST["nomeps"];
        $regimen=$_REQUEST["regimen"];
        $fnacimiento=$_REQUEST["fnacimiento"];
        $afiliacion=$_REQUEST["afiliacion"];
        $estadocivil=$_REQUEST["estadocivil"];
        $ocupacion=$_REQUEST["ocupacion"];
        $genero=$_REQUEST["genero"];
        $dir_pac=$_REQUEST["dir_pac"];
        $tel_pac=$_REQUEST["tel_pac"];
        $dep=$_REQUEST["dep"];
        $mun=$_REQUEST["mun"];
        $zona=$_REQUEST["zona"];
        $nombre_acu=$_REQUEST["nombre_acu"];
        $dir_acu=$_REQUEST["dir_acu"];
        $tel_acu=$_REQUEST["tel_acu"];
        $parentesco_acu=$_REQUEST["parentesco_acu"];
        $fecha=$_REQUEST["fnacimiento"];
				$segundos= strtotime('now') - strtotime($fecha);
				$diferencia_dias=intval($segundos /60/60/24);
				$dias=ceil($diferencia_dias/365);
        $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');

        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'EVOLUCION PACIENTES', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 7);
        $this->Cell(30, 4, 'F-GC-035', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 4, 'Version:04', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 4, 'Fecha de Emision:2017-05-02', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Ln();
        $this->Cell(15,4,'Nombre:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 7);
        $this->Cell(70,4, utf8_encode($nom), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Identificación:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 7);
        $this->Cell(20,4, utf8_encode($doc), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Genero:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 7);
        $this->Cell(20,4, utf8_encode($genero), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Fnacimiento:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 7);
        $this->Cell(20,4, $fnacimiento, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(10,4,'Edad:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(10,4, $dias, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Estado Civil:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(20,4, utf8_decode($estadocivil), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Regimen:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(20,4, utf8_encode($regimen), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(15,4,'Afiliación:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(25,4, utf8_encode($afiliacion), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(15,4,'Ocupación:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(100,4, utf8_encode($ocupacion), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(15,4,'EPS:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(50,4, utf8_encode($nomeps), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Departamento:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(30,4, utf8_encode($dep), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Municipio:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(30,4, utf8_encode($mun), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(10,4,'Zona:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(10,4, utf8_encode($zona), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Teléfono:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(40,4, utf8_encode($tel_pac), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Dirección:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(30,4, utf8_encode($dir_pac), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Acudiente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(50,4, utf8_encode($nombre_acu), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(20,4,'Parentesco:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(40,4, utf8_encode($parentesco_acu), 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 7);
        $this->Cell(15,4,'Contacto:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 6);
        $this->Cell(165,4, utf8_encode($dir_acu.' '.$tel_acu), 1, false, 'C', 0, '', 0, false, 'M', 'M');
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

      $this->SetFont('','B',10);
      $this->Cell(180,0, utf8_encode($row['tipo_terapia']),1,0,'C',1);
      $this->SetFont('','',9);
      $this->Ln();
      $this->MultiCell(180,0, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo']. ' Profesional: ' .$row['nombre_usuario']. ' Registro Profesional: ' .$row['docu']),1,0,'L');
      $this->SetFont('','',7);
      $this->MultiCell(180,0, utf8_encode($row['evolucion']),1,'L');
      $this->SetFont('','',1);
      $this->cell(35,20,$this->image(utf8_encode($row['firmat']) , $this->GetX(), $this->GetY(),35,20),0,'J');
  		$this->Ln();
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

$terapia=$_REQUEST["tterapia"];
$f1=$_REQUEST["f1"];
$f2=$_REQUEST["f2"];
if ($terapia=='TODAS') {

  $sql="SELECT
  a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
  e.id_evofisio id, e.freg_evofisio fecha_evo,e.hreg_evofisio hora_evo,e.evolucionfisio evolucion,e.estado_evofisio estado,e.id_user id_user,
  f.nombre nombre_usuario, f.firma firmat,
  g.nom_eps eps,
  h.nom_sedes sedes

  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evofisio='Realizada' and e.freg_evofisio BETWEEN '".$f1."' and '".$f2."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
   e.id_evoto id, e.freg_evoto fecha_evo,e.hreg_evoto hora_evo,e.evolucionto evolucion,e.estado_evoto estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evoto='Realizada' and e.freg_evoto BETWEEN '".$f1."' and '".$f2."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
   e.id_evofono id, e.freg_evofono fecha_evo,e.hreg_evofono hora_evo,e.evolucionfono evolucion,e.estado_evofono estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evofono='Realizada' and e.freg_evofono BETWEEN '".$f1."' and '".$f2."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
   e.id_evopsico id, e.freg_evopsico fecha_evo,e.hreg_evopsico hora_evo,e.evolucionpsico evolucion,e.estado_evopsico estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evopsico='Realizada' and e.freg_evopsico BETWEEN '".$f1."' and '".$f2."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'NEUROPSICOLOGIA' tipo_terapia,
   e.id_evonpsico id, e.freg_evonpsico fecha_evo,e.hreg_evonpsico hora_evo,e.evolucionnpsico evolucion,e.estado_evonpsico estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evonpsico='Realizada' and e.freg_evonpsico BETWEEN '".$f1."' and '".$f2."'

  UNION

  select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
  e.id_evomusico id, e.freg_evomusico fecha_evo,e.hreg_evomusico hora_evo,e.evolucionmusico evolucion,e.estado_evomusico estado,e.id_user id_user,
  f.nombre nombre_usuario, f.firma firmat ,
  g.nom_eps eps,
  h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evomusico='Realizada' and e.freg_evomusico BETWEEN '".$f1."' and '".$f2."'


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

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
  e.id_evofisio id, e.freg_evofisio fecha_evo,e.hreg_evofisio hora_evo,e.evolucionfisio evolucion,e.estado_evofisio estado,e.id_user id_user,
  f.nombre nombre_usuario, f.firma firmat,
  g.nom_eps eps,
  h.nom_sedes sedes

  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evofisio='Realizada' and e.freg_evofisio BETWEEN '".$f1."' and '".$f2."'

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
if ($terapia=='ENFERMERIA') {

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'ENFERMERIA' tipo_terapia,
    e.id_notaenfermeria id, e.freg_nota fecha_evo,e.hreg_nota hora_evo,e.descripnota evolucion,e.estado_nota estado,e.id_user id_user,
    f.nombre nombre_usuario, f.firma firmat ,
    g.nom_eps eps,
    h.nom_sedes sedes
    from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
    right join nota_enfermeria e on (e.id_adm_hosp = b.id_adm_hosp)
    right join user f on (f.id_user = e.id_user)
    right join eps g on (g.id_eps = b.id_eps)
    right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

    where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_nota='Realizada' and e.freg_nota BETWEEN '".$f1."' and '".$f2."'
    ORDER BY fecha_evo ASC,hora_evo ASC, tipo_terapia ASC
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

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
   e.id_evoto id, e.freg_evoto fecha_evo,e.hreg_evoto hora_evo,e.evolucionto evolucion,e.estado_evoto estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evoto='Realizada' and e.freg_evoto BETWEEN '".$f1."' and '".$f2."'

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

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
   e.id_evofono id, e.freg_evofono fecha_evo,e.hreg_evofono hora_evo,e.evolucionfono evolucion,e.estado_evofono estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat ,
   g.nom_eps eps,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."'and e.estado_evofono='Realizada' and e.freg_evofono BETWEEN '".$f1."' and '".$f2."'
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

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
   e.id_evopsico id, e.freg_evopsico fecha_evo,e.hreg_evopsico hora_evo,e.evolucionpsico evolucion,e.estado_evopsico estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evopsico='Realizada' and e.freg_evopsico BETWEEN '".$f1."' and '".$f2."'

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

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia,
   e.id_evomusico id, e.freg_evomusico fecha_evo,e.hreg_evomusico hora_evo,e.evolucionmusico evolucion,e.estado_evomusico estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evomusico='Realizada' and e.freg_evomusico BETWEEN '".$f1."' and '".$f2."'

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

  $sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'NEUROPSICOLOGIA' tipo_terapia,
   e.id_evonpsico id, e.freg_evonpsico fecha_evo,e.hreg_evonpsico hora_evo,e.evolucionnpsico evolucion,e.estado_evonpsico estado,e.id_user id_user,
   f.nombre nombre_usuario, f.firma firmat,
   g.nom_eps eps ,
   h.nom_sedes sedes
  from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
  right join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
  right join user f on (f.id_user = e.id_user)
  right join eps g on (g.id_eps = b.id_eps)
  right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

  where b.tipo_servicio in ('Demencias','AVD') and b.id_adm_hosp ='".$_REQUEST["idadmhosp"]."' and e.estado_evonpsico='Realizada' and e.freg_evonpsico BETWEEN '".$f1."' and '".$f2."'

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
$nombre=$_REQUEST["nom"];
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
