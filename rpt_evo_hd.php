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
        $image_file = 'images/logo3p.png';
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
                                $mes1='Noviembre';
                                }

        $nom=$_GET["nom"];
        $edad=$_GET["edad"];
        $cie=$_GET["cie"];
        $f1=$_GET["f1"];
        $f2=$_GET["f2"];
        $eps=$_GET["eps"];
        $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'REPORTE DE EVOLUCIONES HOSPITAL DÍA', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 0, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 0, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 0, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      $this->SetFont('', 'B', 8);
      $this->Cell(25, 0, 'Nombre Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->SetFont('', 'I', 8);
      $this->Cell(90, 0, utf8_encode($row['nom1'].' '.$row['nom2'].' '.$row['ape1'].' '.$row['ape2']), 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->SetFont('', 'B', 8);
      $this->Cell(20, 0, 'Identificacion:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->SetFont('', 'I', 8);
      $this->Cell(20, 0, utf8_encode($row['doc_pac']), 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->SetFont('', 'B', 8);
      $this->Cell(15, 0, 'Edad:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->SetFont('', 'I', 8);
      $this->Cell(10, 0, utf8_encode($row['edad']), 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->Ln();
      $this->SetFont('', 'B', 8);
      $this->Cell(10, 0, 'EPS:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->SetFont('', 'BI', 8);
      $this->Cell(170, 0, utf8_encode($row['nom_eps']), 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(180,0, utf8_encode($row['tipo_evo']),1,0,'C',1);
      $this->SetFont('','B',8);
      $this->Ln();
      $this->MultiCell(180,0, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo']. ' Profesional: ' .$row['nombre']. ' Registro Profesional: ' .$row['rm_profesional']. ' Especialidad: ' .$row['espec_user']),1,0,'L');
      $this->SetFont('','',7);
      $this->multiCell(180,0,'EVOLUCION:',1,'C');
      $this->multicell(180,0,utf8_encode($row['evolucion']),1,'J');
      $this->cell(35,20,$this->image($row['firma'] , $this->GetX(), $this->GetY(),35,20),0,'J');
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


$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
c.descripestadoc,
d.descriafiliado,
e.descritusuario,
f.descriocu,
g.descripdep,
h.descrimuni,
i.descripuedad,
j.nom_eps,
k.id_evomed,'EVOLUCION MEDICA' tipo_evo,k.freg_evomed fecha_evo,k.hreg_evomed hora_evo, concat('OBJETIVO:',k.objetivo, 'SUBJETIVO:',k.subjetivo, 'ANALISIS:',k.analisis_evomed,'PLAN:',k.plan_tratamiento) evolucion,
l.nombre,rm_profesional,l.especialidad espec_user,firma
FROM pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      left join evo_medhd k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)

WHERE b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evomed BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION
SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
c.descripestadoc,
d.descriafiliado,
e.descritusuario,
f.descriocu,
g.descripdep,
h.descrimuni,
i.descripuedad,
j.nom_eps,
k.id_evohd,'EVOLUCION PSICOLOGIA' tipo_evo,k.freg_evohd fecha_evo, k.hreg_evohd hora_evo, k.evolucion_hd evolucion,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      left join evo_psicohd_sm k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)

where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evohd BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

UNION
SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
c.descripestadoc,
d.descriafiliado,
e.descritusuario,
f.descriocu,
g.descripdep,
h.descrimuni,
i.descripuedad,
j.nom_eps,
k.id_evo_psico,'EVOLUCION PSICOLOGIA' tipo_evo,k.freg_evo_psico fecha_evo, k.hreg_evo_psico hora_evo, concat('TIPO SESION: ',k.tipo_sesion,' \nOBJETIVO SESION: ', k.obj_sesion,' \nACTIVIDADES: ', k.actividades,' \nRESULTADO:', k.resultado,' \nOBSERVACION: ', k.obs_evo_psico) evolucion,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      left join evo_psicologia k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)

where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evo_psico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION
SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
c.descripestadoc,
d.descriafiliado,
e.descritusuario,
f.descriocu,
g.descripdep,
h.descrimuni,
i.descripuedad,
j.nom_eps,
k.id_evoto,'EVOLUCION TERAPIA OCUPACIONAL' tipo_evo, k.freg_evoto fecha_evo, k.hreg_evoto hora_evo, k.evolucion_to evolucion,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      left join evo_to k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)

where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evoto BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
UNION
SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
c.descripestadoc,
d.descriafiliado,
e.descritusuario,
f.descriocu,
g.descripdep,
h.descrimuni,
i.descripuedad,
j.nom_eps,
k.id_evoto,'EVOLUCION TERAPIA OCUPACIONAL' tipo_evo, k.freg_evoto fecha_evo, k.hreg_evoto hora_evo, k.evolucion_to evolucion,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      left join evo_tohd_sm k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)

where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evoto BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

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
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre=$_GET["nom"];
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
