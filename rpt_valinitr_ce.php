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
        $mes= date('m') ;
        $mes1=date('m');
        $y=date('Y');

        $nom=$_GET["nom"];
        $edad=$_GET["edad"];
        $cie=$_GET["cie"];
        $f1=$_GET["f1"];
        $f2=$_GET["f2"];
        $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),40,20),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'VALORACION INICIAL TERAPIA RESPIRATORIAR', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, 'F-SD-028', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de Emision: 2015-05-01', 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      $this->SetFont('helvetica', '',8);
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
      $this->Cell(32,5, utf8_encode($row['freg'].' | '.$row['hreg']),1,0,'C');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'ANAMNESIS',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Motivo de Consulta:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['m_consulta']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Enfermedad Actual:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['e_actual']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'ANTECEDENTES PERSONALES',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Patologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_patologico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Quirurgicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_quirurgico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Toxicologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_toxicologico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes traumatologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_traumatologico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Familiares:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_familiar']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Farmacologico:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_farmaco']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Ginecologico:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_gineco']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Psiquiatrico:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_psiquiatrico']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Hospitalario:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_hospitalario']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Otros Antecedentes:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['otros_ant']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'VALORACION FISIOTERAPEUTICA',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['valoracion']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'DIAGNOSTICO FISIOTERAPEUTICO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['dxp'].' --- '.$row['tdxp']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico Relacionado 1:',1,0,'C',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['dx1'].' --- '.$row['tdx1']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico Relacionado 2:',1,0,'C',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['dx2'].' --- '.$row['tdx2']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Diagnostico Relacionado 3:',1,0,'C',1);
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row['dx3'].' --- '.$row['tdx3']),1,'L');
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(180,0,'TERAPIA',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['tterapia']),1,'L');
      $this->SetFont('helvetica', 'B',9);
      $this->Cell(180,0,'RECOMENDACIONES',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['recomendaciones']),1,'L');
      $this->SetFont('helvetica', 'B',9);
      $this->Cell(180,0,'PLAN DE INTERVENCION',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['plan_tratamiento']),1,'L');
      $this->cell(35,0,$this->image($row['firma'] , $this->GetX(), $this->GetY(),40,30),0,'J');
      $this->SetFont('helvetica', 'BI',10);
      $this->MultiCell(130,0,utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['espec_user']) .$txt, 0, 'R', 0, 0, '', '', true, 0, false, true, 80, 'T');
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
k.freg, hreg, m_consulta, e_actual, ant_alergicos, ant_patologico,
ant_quirurgico, ant_toxicologico, ant_farmaco, ant_gineco, ant_psiquiatrico,
ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant, valoracion,
dxp, tdxp, dx1, tdx1, dx2, tdx2, dx3, tdx3, tterapia, recomendaciones,
plan_tratamiento, estado_valini,
l.nombre,rm_profesional,l.especialidad espec_user,firma
from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
      left join estado_civil c on (c.codestadoc = a.estadocivil)
      left join tusuario e on (e.codtusuario=b.tipo_usuario)
      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
      left join ocupacion f on (f.codocu=b.ocupacion)
      left join departamento g on (g.coddep=b.dep_residencia)
      left join municipios h on (h.codmuni=b.mun_residencia)
      left join uedad i on (i.coduedad=a.uedad)
      left join eps j on (j.id_eps=b.id_eps)
      inner join val_ini_ce k on (k.id_adm_hosp=b.id_adm_hosp)
      inner join user l on (l.id_user=k.id_user)
where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.tterapia='TERAPIA RESPIRATORIA'";
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
$nombre='HC clinica';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
