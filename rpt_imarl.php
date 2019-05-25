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
        $this->Cell(0, 15, 'INFORME DE EVOLUCION MENSUAL', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(30, 3, 'IF-GDC-025', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 3, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 3, 'Fecha de Impresion:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      $this->Cell(10,6,'ARL:',1,0,'C',1);
      $this->Cell(50,6, utf8_encode($row['nombre_eps']),1,0,'C');
      $this->Cell(25,6,'Programa:',1,0,'C',1);
      $this->Cell(40,6, utf8_encode('Consulta externa ARL'),1,0,'C');
      $this->Cell(40,6,'Edad:',1,0,'C',1);
      $this->Cell(15,6, utf8_encode($row['edad']),1,0,'C');
      $this->Ln();
      $this->Cell(40,6,'Fecha Registro:',1,0,'C',1);
      $this->Cell(50,6, utf8_encode($row['fecha_Informe']),1,0,'C');
      $this->Ln(5);
      $this->Cell(180,6,$row['tipo_servicio'],1,0,'C',1);
      $this->Ln(10);
      $this->multiCell(180,0,'Codigo Diagnostico :',1,0,'C',1);
      $this->multicell(180,0,utf8_encode($row['coddx']),1,'J');
      $this->Ln();
      $this->Cell(180,0,'Descripcion Diagnostico:',1,1,'C',1);
      $this->multicell(180,0,utf8_encode($row['descripciondx']),1,'J');
      $this->Cell(180,0,'Contenido informe:',1,0,'C',1);
      $this->Ln();
      $this->multicell(180, 0,utf8_encode($row['informe_arl']), 1, 'J');
      $this->Cell(80,0,utf8_encode($row['terapeuta']),1,'L');
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


$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 ,a.edad,
b.id_adm_hosp  id_adm_hosp,e.especialidad_arl tipo_servicio,
e.freg_im_arl fecha_Informe,e.coddx_arl coddx,e.descridx_arl descripciondx, e.informe_arl,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_arl e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='ARL'  and b.id_adm_hosp ='".$_GET["idadmhosp"]."'
and e.freg_im_arl BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
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
