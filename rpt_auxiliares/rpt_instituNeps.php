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

        $sede=$_GET["sede"];
        if ($sede==2) {
          $nsede='FACATATIVA';
        }
        if ($sede==8) {
          $nsede='BOGOTA';
        }
        $this->multicell(180,15,$this->image($image_file, $this->GetX(), $this->GetY(),70,40),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'INSTITUCIONALIZADOS NUEVA EPS '.$nsede, 1, false, 'R', 0, '', 0, false, 'M', 'M');

        $this->Ln();
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
		$this->Ln(10);
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {

      $this->SetFont('','B',8);
      $this->Cell(80,0, utf8_encode($row['paciente']),1,0,'L');
      $this->SetFont('','B',8);
      $this->Cell(25,0, utf8_encode($row['tdoc_pac'].' '.$row['doc_pac']),1,0,'L');
      $this->SetFont('','B',8);
      $this->Cell(20,0, utf8_encode($row['habi']),1,0,'L');
      $this->SetFont('','B',8);
      $this->Cell(55,7, '',1,0,'L');
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

$sede=$_REQUEST['sede'];
$sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
             b.id_adm_hosp,clase_dx_hosp,
             concat(j.nom_piso,'--',h.nom_hab,'-',g.nom_cama) habi

      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                              left join cama g on (g.id_cama = f.id_cama )
                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                              left join piso j on (j.id_piso = i.id_piso )
     WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
                                 and b.clase_dx_hosp='Institucionalizado'
                                 and b.id_eps=21
                                 and b.tipo_servicio='Hospitalario' order by 6

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
