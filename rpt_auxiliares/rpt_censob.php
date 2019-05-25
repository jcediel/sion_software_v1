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
        $this->SetFont('helvetica', 'I',1);
        $image_file = '../images/logo3p.png';

        $sede=$_GET["sede"];
        if ($sede==2) {
          $nsede='FACATATIVA';
        }
        if ($sede==8) {
          $nsede='BOGOTA';
        }
        $date=date('Y-m-d H:m');
        $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'CENSO CLINICA BOGOTA', 1, false, 'R', 0, '', 0, false, 'M', 'M');

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
	public function ColoredTable($header,$data,$data1,$data2,$data3) {
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
		$this->Ln(10);
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
      $this->SetFont('helvetica', 'B',9);
      $this->cell(170, 10,utf8_encode('UCA') ,1,1,1, 'C');

      $this->SetFont('helvetica', 'B',8);
      $this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->MultiCell(25, 10,utf8_encode('TELEFONO') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',8);
      $this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',8);
      $this->cell(30, 10,utf8_encode('EPS') , 1, 'L');
      $this->SetFont('helvetica', 'B',8);
      $this->MultiCell(40, 10,utf8_encode('CLASIFICACION DIAGNOSTICA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->Ln();
		foreach($data as $row) {
      $this->SetFont('helvetica', 'I',7);
      $this->MultiCell(35, 10,utf8_encode($row['nom1'].' '.$row['nom2'].' '.$row['ape1'].' '.$row['ape2'].' '.$row['tdoc_pac'].': '.$row['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->MultiCell(25, 10,utf8_encode('TEL:'.$row['tel_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',7);
      $this->MultiCell(40, 10,utf8_encode($row['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',7);
      $this->cell(30, 10,utf8_encode($row['nom_eps']) , 1, 'L');
      $this->SetFont('helvetica', 'B',7);
      $this->MultiCell(40, 10,utf8_encode($row['clase_dx_hosp']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->Ln();
		}
    $this->SetFont('helvetica', 'B',9);
    $this->cell(170, 10,utf8_encode('PRIMER PISO') ,1,1,1, 'C');

    $this->SetFont('helvetica', 'B',8);
    $this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->MultiCell(25, 10,utf8_encode('TELEFONO') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',8);
    $this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',8);
    $this->cell(30, 10,utf8_encode('EPS') , 1, 'L');
    $this->SetFont('helvetica', 'B',8);
    $this->MultiCell(40, 10,utf8_encode('CLASIFICACION DIAGNOSTICA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->Ln();
  foreach($data1 as $row1) {
    $this->SetFont('helvetica', 'I',7);
    $this->MultiCell(35, 10,utf8_encode($row1['nom1'].' '.$row1['nom2'].' '.$row1['ape1'].' '.$row1['ape2'].' '.$row1['tdoc_pac'].': '.$row1['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->MultiCell(25, 10,utf8_encode('TEL:'.$row1['tel_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',7);
    $this->MultiCell(40, 10,utf8_encode($row1['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',7);
    $this->cell(30, 10,utf8_encode($row1['nom_eps']) , 1, 'L');
    $this->SetFont('helvetica', 'B',7);
    $this->MultiCell(40, 10,utf8_encode($row1['clase_dx_hosp']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->Ln();
  }
  $this->SetFont('helvetica', 'B',9);
  $this->cell(170, 10,utf8_encode('SEGUNDO PISO') ,1,1,1, 'C');

  $this->SetFont('helvetica', 'B',8);
  $this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->MultiCell(25, 10,utf8_encode('TELEFONO') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->SetFont('helvetica', 'B',8);
  $this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->SetFont('helvetica', 'B',8);
  $this->cell(30, 10,utf8_encode('EPS') , 1, 'L');
  $this->SetFont('helvetica', 'B',8);
  $this->MultiCell(40, 10,utf8_encode('CLASIFICACION DIAGNOSTICA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->Ln();
foreach($data2 as $row2) {
  $this->SetFont('helvetica', 'I',7);
  $this->MultiCell(35, 10,utf8_encode($row2['nom1'].' '.$row2['nom2'].' '.$row2['ape1'].' '.$row2['ape2'].' '.$row2['tdoc_pac'].': '.$row2['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->MultiCell(25, 10,utf8_encode('TEL:'.$row2['tel_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->SetFont('helvetica', 'B',7);
  $this->MultiCell(40, 10,utf8_encode($row2['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->SetFont('helvetica', 'B',7);
  $this->cell(30, 10,utf8_encode($row2['nom_eps']) , 1, 'L');
  $this->SetFont('helvetica', 'B',7);
  $this->MultiCell(40, 10,utf8_encode($row2['clase_dx_hosp']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->Ln();
}
$this->SetFont('helvetica', 'B',9);
$this->cell(170, 10,utf8_encode('TERCER PISO') ,1,1,1, 'C');
$this->SetFont('helvetica', 'B',8);
$this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->MultiCell(25, 10,utf8_encode('TELEFONO') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->SetFont('helvetica', 'B',8);
$this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->SetFont('helvetica', 'B',8);
$this->cell(30, 10,utf8_encode('EPS') , 1, 'L');
$this->SetFont('helvetica', 'B',8);
$this->MultiCell(40, 10,utf8_encode('CLASIFICACION DIAGNOSTICA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->Ln();
foreach($data3 as $row3) {
$this->SetFont('helvetica', 'I',7);
$this->MultiCell(35, 10,utf8_encode($row3['nom1'].' '.$row3['nom2'].' '.$row3['ape1'].' '.$row3['ape2'].' '.$row3['tdoc_pac'].': '.$row3['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->MultiCell(25, 10,utf8_encode('TEL:'.$row3['tel_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->SetFont('helvetica', 'B',7);
$this->MultiCell(40, 10,utf8_encode($row3['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->SetFont('helvetica', 'B',7);
$this->cell(30, 10,utf8_encode($row3['nom_eps']) , 1, 'L');
$this->SetFont('helvetica', 'B',7);
$this->MultiCell(40, 10,utf8_encode($row3['clase_dx_hosp']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
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

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page
$pdf->AddPage();

$sede=$_REQUEST['sede'];
$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             b.id_adm_hosp,clase_dx_hosp,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
     WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo' and j.id_piso=8  and b.tipo_servicio='Hospitalario'

order by 10 ASC
";
//echo $sql;
$rs = mysql_query($sql);
if (mysql_num_rows($rs)>0){
    $i=0;
    while($rw = mysql_fetch_array($rs)){
        $data[] = $rw;
  }
}
$sql1="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             b.id_adm_hosp,clase_dx_hosp,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
     WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo' and j.id_piso=5  and b.tipo_servicio='Hospitalario'

order by 10 ASC
";
//echo $sql;
$rs1 = mysql_query($sql1);
if (mysql_num_rows($rs1)>0){
    $i=0;
    while($rw1 = mysql_fetch_array($rs1)){
        $data1[] = $rw1;
  }
}

$sql2="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             b.id_adm_hosp,clase_dx_hosp,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
     WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo' and j.id_piso=6  and b.tipo_servicio='Hospitalario'

order by 10 ASC
";
//echo $sql;
$rs2 = mysql_query($sql2);
if (mysql_num_rows($rs2)>0){
    $i=0;
    while($rw2 = mysql_fetch_array($rs2)){
        $data2[] = $rw2;
  }
}

$sql3="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             b.id_adm_hosp,clase_dx_hosp,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
     WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo' and j.id_piso=7  and b.tipo_servicio='Hospitalario'

order by 10 ASC
";
//echo $sql;
$rs3 = mysql_query($sql3);
if (mysql_num_rows($rs3)>0){
    $i=0;
    while($rw3 = mysql_fetch_array($rs3)){
        $data3[] = $rw3;
  }
}
// print colored table
$pdf->ColoredTable($header, $data, $data1, $data2, $data3);

// ---------------------------------------------------------
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre='censo Bogota';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
