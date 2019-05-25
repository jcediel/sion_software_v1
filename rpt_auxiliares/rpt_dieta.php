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
        $this->Cell(180, 20, 'DIETA CLINICA FACATATIVA', 1, false, 'R', 0, '', 0, false, 'M', 'M');

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
	public function ColoredTable($header,$data,$data1,$data2,$data3,$data_counter,$data_counter1,$data_counter2,$data_counter3) {
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

      foreach($data_counter as $row_counter) {
        $sp=$row_counter['estado_salida'];

        if ($sp=='') {
          $td=$row_counter['td'];
          if ($td=='NORMAL') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'NORMAL' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='HIPOGLUCIDA') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'HIPOGLUCIDA' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='HIPERCALORICA') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(20, 5,'HIPERCALORICA' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='HIPOSODICA') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'HIPOSODICA' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='HIPOGRASA') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'HIPOGRASA' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='ALTA EN FIBRA') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'ALTA EN FIBRA' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='ASTRINGENTE') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'ASTRINGENTE' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
          if ($td=='SIN AZUCAR') {
            $this->SetFont('helvetica', 'B',6);
            $this->cell(18, 5,'SIN AZUCAR' , 1, 'L');
            $this->SetFont('helvetica', 'B',6);
            $this->cell(4, 5,utf8_encode($row_counter['cuantos']) , 1, 'L');
          }
        }
      }
        $this->Ln();
      $this->SetFont('helvetica', 'B',8);
      $this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',8);
      $this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',8);
      $this->cell(30, 10,utf8_encode('TIPO DIETA') , 1, 'L');
      $this->SetFont('helvetica', 'B',8);
      $this->MultiCell(75, 10,utf8_encode('OBSERVACION DIETA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->Ln();


		foreach($data as $row) {
      $sp=$row['estado_salida'];

      if ($sp=='') {
        $this->SetFont('helvetica', 'I',7);
        $this->MultiCell(35, 10,utf8_encode($row['nom1'].' '.$row['nom2'].' '.$row['ape1'].' '.$row['ape2'].' '.$row['tdoc_pac'].': '.$row['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
        $this->SetFont('helvetica', 'B',7);
        $this->MultiCell(40, 10,utf8_encode($row['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
        $this->SetFont('helvetica', 'B',7);
        $this->cell(30, 10,utf8_encode($row['tipo_dieta']) , 1, 'L');
        $this->SetFont('helvetica', 'B',7);
        $this->MultiCell(75, 10,utf8_encode($row['obs_dieta']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
        $this->Ln();
      }

		}

    $this->SetFont('helvetica', 'B',9);
    $this->cell(170, 10,utf8_encode('PRIMER PISO') ,1,1,1, 'C');

    foreach($data_counter1 as $row_counter1) {
      $sp=$row_counter1['estado_salida'];
      if ($sp=='') {
        $td=$row_counter1['td'];
        if ($td=='NORMAL') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'NORMAL' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='HIPOGLUCIDA') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'HIPOGLUCIDA' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='HIPERCALORICA') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(20, 5,'HIPERCALORICA' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='HIPOSODICA') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'HIPOSODICA' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='HIPOGRASA') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'HIPOGRASA' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='ALTA EN FIBRA') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'ALTA EN FIBRA' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='ASTRINGENTE') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'ASTRINGENTE' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
        if ($td=='SIN AZUCAR') {
          $this->SetFont('helvetica', 'B',6);
          $this->cell(18, 5,'SIN AZUCAR' , 1, 'L');
          $this->SetFont('helvetica', 'B',6);
          $this->cell(4, 5,utf8_encode($row_counter1['cuantos']) , 1, 'L');
        }
      }
    }
      $this->Ln();
    $this->SetFont('helvetica', 'B',8);
    $this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',8);
    $this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',8);
    $this->cell(30, 10,utf8_encode('TIPO DIETA') , 1, 'L');
    $this->SetFont('helvetica', 'B',8);
    $this->MultiCell(75, 10,utf8_encode('OBSERVACION DIETA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->Ln();

  foreach($data1 as $row1) {
    $sp=$row1['estado_salida'];

    if ($sp=='') {
      $this->SetFont('helvetica', 'I',7);
      $this->MultiCell(35, 10,utf8_encode($row1['nom1'].' '.$row1['nom2'].' '.$row1['ape1'].' '.$row1['ape2'].' '.$row1['tdoc_pac'].': '.$row1['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',7);
      $this->MultiCell(40, 10,utf8_encode($row1['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->SetFont('helvetica', 'B',7);
      $this->cell(30, 10,utf8_encode($row1['tipo_dieta']) , 1, 'L');
      $this->SetFont('helvetica', 'B',7);
      $this->MultiCell(75, 10,utf8_encode($row1['obs_dieta']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
      $this->Ln();
    }
  }

  $this->SetFont('helvetica', 'B',9);
  $this->cell(170, 10,utf8_encode('SEGUNDO PISO') ,1,1,1, 'C');

  foreach($data_counter2 as $row_counter2) {
    $sp=$row_counter2['estado_salida'];
    if ($sp=='') {
      $td=$row_counter2['td'];
      if ($td=='NORMAL') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'NORMAL' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='HIPOGLUCIDA') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'HIPOGLUCIDA' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='HIPERCALORICA') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(20, 5,'HIPERCALORICA' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='HIPOSODICA') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'HIPOSODICA' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='HIPOGRASA') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'HIPOGRASA' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='ALTA EN FIBRA') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'ALTA EN FIBRA' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='ASTRINGENTE') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'ASTRINGENTE' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
      if ($td=='SIN AZUCAR') {
        $this->SetFont('helvetica', 'B',6);
        $this->cell(18, 5,'SIN AZUCAR' , 1, 'L');
        $this->SetFont('helvetica', 'B',6);
        $this->cell(4, 5,utf8_encode($row_counter2['cuantos']) , 1, 'L');
      }
    }
  }
    $this->Ln();
  $this->SetFont('helvetica', 'B',8);
  $this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->SetFont('helvetica', 'B',8);
  $this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->SetFont('helvetica', 'B',8);
  $this->cell(30, 10,utf8_encode('TIPO DIETA') , 1, 'L');
  $this->SetFont('helvetica', 'B',8);
  $this->MultiCell(75, 10,utf8_encode('OBSERVACION DIETA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
  $this->Ln();

foreach($data2 as $row2) {
  $sp=$row2['estado_salida'];

  if ($sp=='') {
    $this->SetFont('helvetica', 'I',7);
    $this->MultiCell(35, 10,utf8_encode($row2['nom1'].' '.$row2['nom2'].' '.$row2['ape1'].' '.$row2['ape2'].' '.$row2['tdoc_pac'].': '.$row2['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',7);
    $this->MultiCell(40, 10,utf8_encode($row2['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',7);
    $this->cell(30, 10,utf8_encode($row2['tipo_dieta']) , 1, 'L');
    $this->SetFont('helvetica', 'B',7);
    $this->MultiCell(75, 10,utf8_encode($row2['obs_dieta']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->Ln();
  }
}

$this->SetFont('helvetica', 'B',9);
$this->cell(170, 10,utf8_encode('TERCER PISO') ,1,1,1, 'C');

foreach($data_counter3 as $row_counter3) {
  $sp=$row_counter3['estado_salida'];

  if ($sp=='') {
    $td=$row_counter3['td'];

    if ($td=='NORMAL') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'NORMAL' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }

    if ($td=='HIPOGLUCIDA') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'HIPOGLUCIDA' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }
    if ($td=='HIPERCALORICA') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(20, 5,'HIPERCALORICA' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }
    if ($td=='HIPOSODICA') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'HIPOSODICA' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }
    if ($td=='HIPOGRASA') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'HIPOGRASA' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }
    if ($td=='ALTA EN FIBRA') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'ALTA EN FIBRA' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }
    if ($td=='ASTRINGENTE') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'ASTRINGENTE' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }
    if ($td=='SIN AZUCAR') {
      $this->SetFont('helvetica', 'B',6);
      $this->cell(18, 5,'SIN AZUCAR' , 1, 'L');
      $this->SetFont('helvetica', 'B',6);
      $this->cell(4, 5,utf8_encode($row_counter3['cuantos']) , 1, 'L');
    }

  }
}
  $this->Ln();
$this->SetFont('helvetica', 'B',8);
$this->MultiCell(35, 10,utf8_encode('PACIENTE') .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->SetFont('helvetica', 'B',8);
$this->MultiCell(40, 10,utf8_encode('UBICACION').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->SetFont('helvetica', 'B',8);
$this->cell(30, 10,utf8_encode('TIPO DIETA') , 1, 'L');
$this->SetFont('helvetica', 'B',8);
$this->MultiCell(75, 10,utf8_encode('OBSERVACION DIETA').$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
$this->Ln();

foreach($data3 as $row3) {
  $sp=$row3['estado_salida'];

  if ($sp=='') {
    $this->SetFont('helvetica', 'I',7);
    $this->MultiCell(35, 10,utf8_encode($row3['nom1'].' '.$row3['nom2'].' '.$row3['ape1'].' '.$row3['ape2'].' '.$row3['tdoc_pac'].': '.$row3['doc_pac']) .$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',7);
    $this->MultiCell(40, 10,utf8_encode($row3['habi']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->SetFont('helvetica', 'B',7);
    $this->cell(30, 10,utf8_encode($row3['tipo_dieta']) , 1, 'L');
    $this->SetFont('helvetica', 'B',7);
    $this->MultiCell(75, 10,utf8_encode($row3['obs_dieta']).$txt, 1, 'L', 0, 0, '', '', true, 1, false, true, 80, 'T');
    $this->Ln();
  }
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
$sql_counter="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'NORMAL' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='NORMAL'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPOGLUCIDA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPOGLUCIDA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPERCALORICA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPERCALORICA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'LIQUIDA CLARA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='LIQUIDA CLARA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'LIQUIDA COMPLETA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='LIQUIDA COMPLETA'
UNION
SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'ASTRINGENTE' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='ASTRINGENTE
";
//echo $sql;
$rs_counter = mysql_query($sql_counter);
if (mysql_num_rows($rs_counter)>0){
    $i=0;
    while($rw_counter = mysql_fetch_array($rs_counter)){
        $data_counter[] = $rw_counter;
  }
}// counter en UCA
$sql_counter1="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'NORMAL' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='NORMAL'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPOGLUCIDA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPOGLUCIDA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPERCALORICA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPERCALORICA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'LIQUIDA CLARA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='LIQUIDA CLARA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'LIQUIDA COMPLETA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='LIQUIDA COMPLETA'
UNION
SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'ASTRINGENTE' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='ASTRINGENTE
";
//echo $sql;
$rs_counter1 = mysql_query($sql_counter1);
if (mysql_num_rows($rs_counter1)>0){
    $i=0;
    while($rw_counter1 = mysql_fetch_array($rs_counter1)){
        $data_counter1[] = $rw_counter1;
  }
}// counter en primer piso
$sql_counter2="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'NORMAL' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='NORMAL'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPOGLUCIDA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPOGLUCIDA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPERCALORICA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPERCALORICA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'LIQUIDA CLARA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='LIQUIDA CLARA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'LIQUIDA COMPLETA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='LIQUIDA COMPLETA'
UNION
SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'ASTRINGENTE' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='ASTRINGENTE
";
//echo $sql;
$rs_counter2 = mysql_query($sql_counter2);
if (mysql_num_rows($rs_counter2)>0){
    $i=0;
    while($rw_counter2 = mysql_fetch_array($rs_counter2)){
        $data_counter2[] = $rw_counter2;
  }
}// counter en primer piso
$sql_counter3="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'NORMAL' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='NORMAL'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPOGLUCIDA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPOGLUCIDA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPERCALORICA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPERCALORICA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPOSODICA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPOSODICA'
UNION

SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'HIPOGRASA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='HIPOGRASA'
UNION
SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'ALTA EN FIBRA' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='ALTA EN FIBRA'
UNION
SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'ASTRINGENTE' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='ASTRINGENTE'
UNION
SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             count(b.id_adm_hosp) cuantos,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta,'SIN AZUCAR' td

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'
                                 and tipo_dieta='SIN AZUCAR'

";
//echo $sql;
$rs_counter3 = mysql_query($sql_counter3);
if (mysql_num_rows($rs_counter3)>0){
    $i=0;
    while($rw_counter3 = mysql_fetch_array($rs_counter3)){
        $data_counter3[] = $rw_counter3;
  }
}// counter en tercer piso
$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,tel_pac,
             b.id_adm_hosp,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=1
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'

order by 11 ASC,tipo_dieta ASC
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
             b.id_adm_hosp,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=2
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'

order by 11 ASC,tipo_dieta ASC
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
             b.id_adm_hosp,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=3
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'

order by 11 ASC,tipo_dieta ASC
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
             b.id_adm_hosp,clase_dx_hosp,estado_salida,
             concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
             e.nom_eps,
             z.tipo_dieta,obs_dieta

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
                              left join eps e on (e.id_eps = b.id_eps )
                              left join dieta z on (z.id_adm_hosp = b.id_adm_hosp )
     WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
                                 and j.id_piso=4
                                 and b.tipo_servicio='Hospitalario'
                                 and z.estado_dieta='Activa'

order by 11 ASC, 13 ASC
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
$pdf->ColoredTable($header, $data, $data1, $data2, $data3,$data_counter,$data_counter1,$data_counter2,$data_counter3);

// ---------------------------------------------------------
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre='Dietas Facatativá';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
