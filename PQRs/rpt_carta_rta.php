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
        $image_file = '../images/logo3p.png';
        $date=date('Y-m-d');
        $mes= date('m') ;
        $mes1=date('m');
        $y=date('Y');


        $nom=$_GET["nom"];
        $edad=$_GET["edad"];
        $cie=$_GET["cie"];
        $f1=$_GET["f1"];
        $f2=$_GET["f2"];
        $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'RESPUESTA PQRS', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, '', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, '', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de impresión:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
		$this->Ln(10);
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {

      $this->Ln(20);
      $this->SetFont('helvetica', 'B', 12);
      $this->Cell(50,5,'Respetado(a):',0,0,'L',0);
      $this->SetFont('helvetica', '',12);
      $this->Cell(100,5, utf8_encode($row['nom_completo']),0,0,'C');
      $this->Ln(20);
      $this->SetFont('helvetica', 'B', 12);
      $this->Cell(50,5,utf8_encode('Respuesta a '.$row['tipo_solicitud'].' : '),0,0,'L',0);
      $this->SetFont('helvetica', '',12);
      $this->Cell(100,5, utf8_encode($row['id_pqr'].' - '.$row['eps'].' -- RAD:'.$row['fecha_radicado'] ),0,0,'C');
      $this->Ln(20);
      $this->SetFont('helvetica', '',12);
      $this->Cell(180,5, 'Reciba un cordial saludo.',0,0,'L');
      $this->Ln(10);
      $this->SetFont('helvetica', '',12);
      $this->multiCell(180,0, utf8_encode($row['descripcion_rta_pqr']),0,'J');
      $this->Ln(5);
      $this->SetFont('helvetica', '',12);
      $this->Cell(180,5, 'Cualquier inquietud estamos prestos a solucionarla.',0,0,'L');
      $this->Ln(10);
      $this->SetFont('helvetica', '',12);
      $this->Cell(180,5, 'Cordialmente,',0,0,'L');
      $this->Ln(30);
      $this->SetFont('helvetica', 'B', 1);
      $this->cell(180,30,$this->image('../'.$row['f'] , $this->GetX(), $this->GetY(),40,30),0,'J');
      $this->Ln();
      $this->SetFont('helvetica', 'B',10);
      $this->Cell(100,5, utf8_encode($row['user_reg']),0,0,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B',10);
      $this->Cell(100,5, utf8_encode($row['especialidad']),0,0,'L');
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


$sql="SELECT a.id_pqr, id_user_reg, linea_negocio, medio_registro, tipo_cliente,
                      tipo_solicitud, fecha_radicado, hora_radicado, contacto_cliente,email_rta, descripcion_pqrs, responsable_rta_pqrs,
                      clasificacion, estado_pqrs, soporte_pqr, user_rta, descripcion_rta_pqr, nivel_satisfaccion, atributo_pqrs,
                      obs_clasificacion_pqrs,
                      b.nombre user_reg,b.firma f,especialidad,
                      c.nom_eps eps,
                      d.nom_sedes sede,
                      e.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,nom_completo
               FROM pqr a LEFT JOIN user b on a.user_rta=b.id_user
                          LEFT JOIN eps c on a.id_eps=c.id_eps
                          LEFT JOIN sedes_ips d on a.id_sedes_ips=d.id_sedes_ips
                          LEFT JOIN pacientes e on a.id_paciente=e.id_paciente
               WHERE a.id_pqr ='".$_GET["ipqr"]."' ";
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
$nom=$_REQUEST['nom'];
$nombre='Respuesta PQRS '.$nom;
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
