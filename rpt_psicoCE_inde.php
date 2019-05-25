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
        $edad=$_GET["edad"];
        $cie=$_GET["cie"];
        $f1=$_GET["f1"];
        $f2=$_GET["f2"];
        $servicio=$_REQUEST['servicio'];
        if ($servicio=='REDSERVICIO') {
          $image_file = 'images/rs.png';
          $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),40,20),0,'L');
          // Set font
          $this->SetFont('helvetica', 'B', 12);
          // Title
          $this->Cell(180, 20, 'Valoracion por Psicologia Consulta externa', 1, false, 'R', 0, '', 0, false, 'M', 'M');
          $this->Ln();
          $this->SetFont('helvetica', '', 9);
          $this->Cell(30, 5, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(120, 5, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln();
        }
        if ($servicio=='INDE') {
          $image_file = 'images/logo_inde-01.png';
          $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),40,20),0,'L');
          // Set font
          $this->SetFont('helvetica', 'B', 12);
          // Title
          $this->Cell(180, 20, 'Valoracion por Psicologia Consulta externa', 1, false, 'R', 0, '', 0, false, 'M', 'M');
          $this->Ln();
          $this->SetFont('helvetica', '', 9);
          $this->Cell(30, 5, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(120, 5, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln();
        }
        if ($servicio=='CONSORCIO') {
          $image_file = 'images/logo3p.png';
          $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),40,20),0,'L');
          // Set font
          $this->SetFont('helvetica', 'B', 12);
          // Title
          $this->Cell(180, 20, 'Valoracion por Psicologia Consulta externa', 1, false, 'R', 0, '', 0, false, 'M', 'M');
          $this->Ln();
          $this->SetFont('helvetica', '', 9);
          $this->Cell(30, 5, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Cell(120, 5, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
          $this->Ln();
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

      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,5,'Datos Generales:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(26,5,'Nombre Paciente:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(84,5, utf8_encode($row['nom1']." ".$row['nom2']." ".$row['ape1']." ".$row['ape2']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(35,5,'Documento Paciente:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(35,5, utf8_encode($row['tdoc_pac'].': '.$row['doc_pac']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->Cell(26,5,'F. Naciemiento:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(18,5, utf8_encode($row['fnacimiento']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(12,5,'Edad:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(15,5, utf8_encode($row['edad'].' '.$row['descripuedad']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(7,5,'RH:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(7,5, utf8_encode($row['rh']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(12,5,'Genero:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(17,5, utf8_encode($row['genero']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(7,5,'Tel:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(59,5, utf8_encode($row['tel_pac']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(15,5,'Direccion:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(80,5, utf8_encode($row['dir_pac']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(15,5,'Email:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(70,5, utf8_encode($row['email_pac']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->Cell(22,5,'Fecha Ingreso:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(32,5, utf8_encode($row['fingreso_hosp'].' | '.$row['hingreso_hosp']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(22,5,'Fecha Egreso:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(32,5, utf8_encode($row['fegreso_hosp'].' | '.$row['hegreso_hosp']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(8,5,'EPS:',1,0,'C',1);
      $this->SetFont('helvetica', '',6);
      $this->Cell(64,5, utf8_encode($row['nom_eps']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(15,5,'T.Usuario:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(25,5, utf8_encode($row['descritusuario']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(17,5,'T.Afiliacion:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(25,5, utf8_encode($row['descriafiliado']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(22,5,'Departamento:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(30,5, utf8_encode($row['descripdep']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(16,5,'Municipio:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(30,5, utf8_encode($row['descrimuni']),1,0,'C');
  		$this->Ln(10);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(22,5,'Fecha Registro:',1,0,'C',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(32,5, utf8_encode($row['freg_psicoce_sm'].' | '.$row['hreg_psicoce_sm']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'Valoracion inicial Psicologia',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Motivo consulta:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['m_consulta']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Historia familiar y personal:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['h_personal_familiar']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Evaluacion psicologica:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['evaluacion_psicologica']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Analisis del caso:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['analisis_caso']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Recomendaciones:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['recomendaciones']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['espec_user']),1,'L');
      $this->Ln(10);
		}
    foreach($data1 as $row1) {

      $this->SetFont('','B',10);
      $this->Cell(180,0, utf8_encode($row1['tipo_evo']),1,0,'C',1);
      $this->SetFont('','B',8);
      $this->Ln();
      $this->MultiCell(180,0, utf8_encode($row1['fecha_evo'] .' | '.$row1['hora_evo']. ' Profesional: ' .$row1['nombre']. ' Registro Profesional: ' .$row1['rm_profesional']. ' Especialidad: ' .$row1['espec_user']),1,0,'L');
      $this->SetFont('','',7);
      $this->multiCell(180,0, utf8_encode($row1['evolucion']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['espec_user']),1,'L');
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
k.id_psicoce_sm,freg_psicoce_sm, hreg_psicoce_sm, m_consulta,h_personal_familiar,evaluacion_psicologica,analisis_caso,recomendaciones,estado_psicoce_sm,
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
      left join psico_ce_sm k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)
where b.id_adm_hosp ='".$_GET["idadmhosp"]."' ";
//echo $sql;
$rs = mysql_query($sql);
if (mysql_num_rows($rs)>0){
    $i=0;
    while($rw = mysql_fetch_array($rs)){

        $data[] = $rw;
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$sql1="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
j.nom_eps,
k.id_evopsico,'EVOLUCION DE CONTROL' tipo_evo, k.freg_evopsico fecha_evo, k.hreg_evopsico hora_evo, k.evolucionpsico evolucion,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
      inner join eps j on (j.id_eps=b.id_eps)
      inner join evo_psico_dem k on (k.id_adm_hosp=b.id_adm_hosp)
      inner join user l on (l.id_user=k.id_user)

where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evopsico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'";
//echo $sql1;
$rs1 = mysql_query($sql1);
if (mysql_num_rows($rs1)>0){
    $i=0;
    while($rw1 = mysql_fetch_array($rs1)){
        $data1[] = $rw1;
  }
}



// print colored table
$pdf->ColoredTable($header, $data,$data1);

// ---------------------------------------------------------
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre='Valoracion_Psicologia';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
