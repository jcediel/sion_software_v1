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
        $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'INFORME DE EVOLUCION MENSUAL', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(30, 3, 'IF-GDC-025', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 3, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      if ($mes==1) {
        $mes1='Enero';
        }
        if ($mes==2) {
          $mes1='Febrero';
          }
          if ($mes==3) {
            $mes1='Marzo';
            }
            if ($mes==4) {
              $mes1='Abril';
              }
              if ($mes==5) {
                $mes1='Mayo';
                }
                if ($mes==6) {
                  $mes1='Junio';
                  }
                  if ($mes==7) {
                    $mes1='Julio';
                    }
                    if ($mes==8) {
                      $mes1='Agosto';
                      }
                      if ($mes==9) {
                        $mes1='Septiembre';
                        }
                        if ($mes==10) {
                          $mes1='Octubre';
                          }
                          if ($mes==11) {
                            $mes1='Noviembre';
                            }
                            if ($mes==12) {
                              $mes1='Diciembre';
                              }
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
      $this->Cell(40,6, utf8_encode('Rehabilitacion Infantil'),1,0,'C');
      $this->Cell(40,6,'Edad:',1,0,'C',1);
      $this->Cell(15,6, utf8_encode($row['edad']),1,0,'C');
      $this->Ln();
      $this->Cell(40,6,'Mes:',1,0,'C',1);
      $this->Cell(50,6,$mes1 ,1,0,'C');
      $this->Cell(40,6,'Año:',1,0,'C',1);
      $this->Cell(50,6,$y ,1,0,'C');
      $this->Ln();
      $this->Cell(180,6,$row['tipo_servicio'],1,0,'C',1);
      $this->Ln(10);
      $this->multiCell(180,0,'Objetivo del mes :',1,0,'C',1);
      $this->Ln();
      $this->multicell(180,0,utf8_encode($row['Objetivo']),1,'J');
      $this->Ln();
      $this->Cell(180,0,'Actividades y/o tecnicas aplicadas:',1,1,'C',1);
      $this->Ln();
      $this->multicell(180,0,utf8_encode($row['Actividades_realizadas']),1,'J');
      $this->Cell(180,0,'Logros y/o novedades:',1,0,'C',1);
      $this->Ln();
      $this->multicell(180, 0,utf8_encode($row['Logors']), 1, 'J');
      $this->Cell(180,0,'Plan tratamiento a seguir:',1,0,'C',1);
      $this->Ln();
      $this->multicell(180, 0,utf8_encode($row['Plan_tratamiento']), 1, 'J');
      $this->Ln();
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


$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'FISIOTERAPIA' tipo_servicio,
e.freg_imfisio_reh fecha_Informe,e.objetivo_imfisio_reh Objetivo,e.actrealizada_imfisio_reh Actividades_realizadas,e.logros_imfisio_reh Logors,e.plant_imfisio_reh Plan_tratamiento,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_imfisio_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'FONOAUDIOLOGIA' tipo_servicio,
e.freg_imfono_reh fecha_Informe,e.objetivo_imfono_reh Objetivo,e.actrealizada_imfono_reh Actividades_realizadas,e.logros_imfono_reh Logors,e.plant_imfono_reh Plan_tratamiento,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_fono_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)


where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."'  and h.nom_sedes='".$_GET["sede"]."' and b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_imfono_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie,a.edad,
b.id_adm_hosp  id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_servicio,
e.freg_imto_reh fecha_Informe,e.objetivo_imto_reh Objetivo,e.actrealizada_imto_reh Actividades_realizadas,e.logros_imto_reh Logors,e.plant_imto_reh Plan_tratamiento,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_to_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)


where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_imto_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'PSICOLOGIA' tipo_servicio,
e.freg_impsico_reh fecha_Informe,e.objetivo_impsico_reh Objetivo,e.actrealizada_impsico_reh Actividades_realizadas,e.logros_impsico_reh Logors,e.plant_impsico_reh Plan_tratamienpsico,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_psico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and  b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_impsico_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'EQUINOTERAPIA' tipo_servicio,
e.freg_imequino_reh fecha_Informe,e.objetivo_imequino_reh Objetivo,e.actrealizada_imequino_reh Actividades_realizadas,e.logros_imequino_reh Logors,e.plant_imequino_reh Plan_tratamienequino,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_equino_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and  b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_imequino_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'HIDROTERAPIA' tipo_servicio,
e.freg_imhidro_reh fecha_Informe,e.objetivo_imhidro_reh Objetivo,e.actrealizada_imhidro_reh Actividades_realizadas,e.logros_imhidro_reh Logors,e.plant_imhidro_reh Plan_tratamienhidro,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_hidro_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and  b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_imhidro_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'PSICOLOGIA COGNITIVA' tipo_servicio,
e.freg_impsicocog_reh fecha_Informe,e.objetivo_impsicocog_reh Objetivo,e.actrealizada_impsicocog_reh Actividades_realizadas,e.logros_impsicocog_reh Logors,e.plant_impsicocog_reh Plan_tratamienpsicocog,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_psicocog_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and  b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_impsicocog_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'TAP ' tipo_servicio,
e.freg_imtap_reh fecha_Informe,e.objetivo_imtap_reh Objetivo,e.actrealizada_imtap_reh Actividades_realizadas,e.logros_imtap_reh Logors,e.plant_imtap_reh Plan_tratamientap,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_tap_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and  b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_imtap_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION

select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,descricie ,a.edad,
b.id_adm_hosp  id_adm_hosp,'MUSICOTERAPIA' tipo_servicio,
e.freg_immusico_reh fecha_Informe,e.objetivo_immusico_reh Objetivo,e.actrealizada_immusico_reh Actividades_realizadas,e.logros_immusico_reh Logors,e.plant_immusico_reh Plan_tratamienmusico,e.id_user usuario,
f.nombre terapeuta,f.firma firma_user,
g.nom_eps nombre_eps,
h.nom_sedes sede

from

pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		    inner join im_musico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
            inner join user f on (e.id_user = f.id_user)
            inner join eps g on (b.id_eps = g.id_eps)
            inner join sedes_ips h on (b.id_sedes_ips = h.id_sedes_ips)

where b.tipo_servicio='Rehabilitacion' and g.nom_eps='".$_GET["eps"]."' and h.nom_sedes='".$_GET["sede"]."' and  b.id_adm_hosp BETWEEN 1 and 10000000 and e.freg_immusico_reh BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
Order by 1,9 ASC ";
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
