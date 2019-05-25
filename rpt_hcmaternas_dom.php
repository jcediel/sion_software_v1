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
        $this->Cell(180, 20, 'SEGUIMIENTO DOMICILIARIO MME GESTANTE', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
      $this->Cell(180,5,'Datos del paciente:',1,0,'C',1);
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
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(110,0,'MOTIVO DE CONSULTA Y ENFERMEDAD ACTUAL:',1,0,'C',1);
      $this->Cell(70,0,'FACTORES DE RIESGO PSICOSOCIAL:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(100,0,'Adolescentes menores de 15 años:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc1']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(60,0,'Pareja estable:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['fr1']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(100,0,'Adolescentes entre 15 y 19 años con 2 o más gestaciones:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc2']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(60,0,'Misma pareja de eventos obstetricos anteriores:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['fr2']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(100,0,'Mujeres mayores de 35 años:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc3']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(60,0,'Embarazo planeado:',1,0,'L',0);
      $this->SetFont('helvetica', '',9);
      $this->Cell(10,0,utf8_encode($row['fr3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(100,0,'Mujeres con insuficiente control prenatal (Según edad gestional):',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc4']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(60,0,'Embarazo deseado:',1,0,'L',0);
      $this->SetFont('helvetica', '',9);
      $this->Cell(10,0,utf8_encode($row['fr4']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',6);
      $this->Cell(100,0,'Mujeres con enfermedades pre-existente como cardiopatidas, diabetes, hipertensión, entre otros:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc5']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(60,0,'Embarazo aceptado:',1,0,'L',0);
      $this->SetFont('helvetica', '',9);
      $this->Cell(10,0,utf8_encode($row['fr5']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(100,0,'Mujeres con 3 o más criterios de inclusión para morbilidad materna extrema:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc6']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(60,0,'Red de apoyo familiar:',1,0,'L',0);
      $this->SetFont('helvetica', '',9);
      $this->Cell(10,0,utf8_encode($row['fr6']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(100,0,'Mujeres con secuelas o discapacidades secundarias al evento obstétrico:',1,0,'L',0);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,utf8_encode($row['mc7']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Ln();
      $this->Cell(180,0,'ANTECEDENTES PARA EL EMBARAZO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,'Menarquia:',1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,utf8_encode($row['menarquia']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,utf8_encode('Ciclos:'),1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,utf8_encode($row['ciclos']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(10,0,utf8_encode('FUM:'),1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,utf8_encode($row['fum']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,utf8_encode('PF previa:'),1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(5,0,utf8_encode($row['pfprevia']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(35,0,utf8_encode('Consulta Preconcepcional:'),1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(5,0,utf8_encode($row['cpreconcepcional']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(30,0,utf8_encode('Edad gestacional:'),1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(5,0,utf8_encode($row['egestacional']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',7);
      $this->Cell(10,0,'FPP:',1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(15,0,utf8_encode($row['fpp']),1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(35,0,'Antecedentes Transfusionales:',1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(5,0,utf8_encode($row['ant_transfucionales']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(41,0,'Deseo de PF posterior al embarazo:',1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(5,0,utf8_encode($row['pfposterior']),1,0,'L',0);
      $this->SetFont('helvetica', '',7);
      $this->Cell(25,0,'Metodo seleccionado:',1,0,'L',1);
      $this->SetFont('helvetica', '',7);
      $this->Cell(44,0,utf8_encode($row['metodopf']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_patologicos']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Quirurgicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_quirurgicos']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Toxicologicos:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_toxicologicos']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Antecedentes Familiares:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['ant_familiares']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'FORMULA OBSTETRICA:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'G:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['g'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'P:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['p'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'A:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['a'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'C:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['c'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'E:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['e'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'V:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['v'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(10,0,'M:',1,0,'L',1);
      $this->SetFont('helvetica', '',8);
      $this->Cell(10,0,$row['m'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'GESTACIONES:',1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'PARTOS:',1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'ABORTOS:',1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'CESAREAS:',1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'ECTOPICOS:',1,0,'L',1);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'MUERTOS:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['g1'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['p1'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['a1'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['c1'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['e1'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['m1'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['g2'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['p2'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['a2'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['c2'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['e2'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['m2'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['g3'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['p3'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['a3'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['c3'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['e3'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['m3'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['g4'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['p4'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['a4'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['c4'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['e4'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['m4'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['g5'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['p5'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['a5'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['c5'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['e5'],1,0,'L',0);
      $this->SetFont('helvetica', '', 7);
      $this->Cell(30,0,$row['m5'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'REVISION POR SISTEMAS',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Mov. Fetales',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['movfetal'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Actividad uterina',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['actuterina'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Amniorrea',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['amniorrea'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Sangrado vaginal',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['sangvaginal'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Sintomas urinarios',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['sinturinarios'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Flujo vaginal',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['fvaginal'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Sint. respiratorios',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['sintrespiratorios'],1,0,'L',0);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(30,0,'Fiebre',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['fiebre'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'Sintomas de sangrado anormal(coagulopatias)',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['sanganormal'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['cual']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Sintomas de vaso espasmo',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Cefalea',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['cefalea'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Fosfenos',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['fosfenos'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Acufenos',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['acufenos'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Edemas',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['edemas'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Epigastralgia',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['epigastralgia'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'observaciones de la revision por sistemas',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['obs_rxs']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'RESULTADOS DE LABORATORIO',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'LABORATORIOS',1,0,'C',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,'1 TRIMESTRE',1,0,'C',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,'2 TRIMESTRE',1,0,'C',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,'3 TRIMESTRE',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Hemoclasificacion',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hemoclasi1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hemoclasi2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hemoclasi3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Toxoplasma',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['toxoplasma1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['toxoplasma2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['toxoplasma3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Serologia',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['serologia1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['serologia2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['serologia3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'VIH',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['vih1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['vih2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['vih3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Rubeola',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['rubeola1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['rubeola2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['rubeola3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'P.O/urocultivo',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['urocultivo1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['urocultivo2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['urocultivo3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Frotis flujo vaginal',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['frotis1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['frotis2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['frotis3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Glicemia/curva glicemia',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['glicemia1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['glicemia2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['glicemia3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Hemoglobina',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hemoglobina1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hemoglobina2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hemoglobina3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Hepatitis B',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hepatitisb1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hepatitisb2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['hepatitisb3']),1,0,'L',0);
      $this->Ln();
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'ECOGRAFIAS',1,0,'C',1);
      $this->Cell(30,0,'1 TRIMESTRE',1,0,'C',1);
      $this->Cell(30,0,'2 TRIMESTRE',1,0,'C',1);
      $this->Cell(30,0,'3 TRIMESTRE',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Fecha',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['fecha1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['fecha2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['fecha3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Edad Gestacional',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['egesta1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['egesta2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['egesta3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Bienestar fetal',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['bfetal1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['bfetal2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['bfetal3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(70,0,'Placenta',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['placenta1']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['placenta2']),1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(30,0,utf8_encode($row['placenta3']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'EXAMEN FISICO',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(15,0,'Talla',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['talla'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(40,0,'Peso inicial del embarazo',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(5,0,$row['pesoinicio'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'IMC inicial',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(5,0,$row['imcinicio'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Peso actual',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(5,0,$row['pesoactual'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(35,0,'Clasificacion del peso',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(25,0,utf8_encode($row['clasipeso']),1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(40,0,'Ganacia de peso en embarazo',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['gananciapeso'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,'TA',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['ta'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,'FC',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['fc'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,'FR',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['fr'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,'Temp',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['t'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Glucometria',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['guclometria'],1,0,'L',0);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'Cardiopulmonar',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['cardiopulmonar']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'ABDOMEN',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'AU:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['au']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Presentacion del feto:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['presentacionfeto']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Situacion fetal:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['situacionfetal']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'FCF:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['fcf']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(180,0,'Observaciones:',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['fcf']),1,'L');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'MIEMBROS INFERIORES',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Edemas',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['edemasvaso'],1,0,'L',0);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(20,0,'Varices',1,0,'L',1);
      $this->SetFont('helvetica', '', 8);
      $this->Cell(10,0,$row['varices'],1,0,'L',0);
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
      $this->Ln();
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Patologias asociadas (Al egreso):',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['patoasociada']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Patologias Identificadas (En la visita):',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['patoidentificada']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(70,0,'PLAN DE MANEJO',1,0,'L',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Verificacion y cumplimiento de plan de manejo de egreso hospitalario:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['pm1']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'plan de manejo de situaciones evidenciadas durante la visita:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['pm2']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Barreras de acceso evidenciadas:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['pm3']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Entrega de numero telefonicos de contacto con la EPS:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->Cell(100,0,utf8_encode($row['pm4']),1,'L');
      $this->Ln();
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Educacion en signos de alarma:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['pm5']),1,'L');
      $this->SetFont('helvetica', 'B',8);
      $this->Cell(100,0,'Observaciones generales de la visita:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', '',8);
      $this->multiCell(180,0, utf8_encode($row['pm5']),1,'L');
      $this->Ln();
      $this->cell(35,0,$this->image($row['firma'] , $this->GetX(), $this->GetY(),40,30),0,'J');
      $this->SetFont('helvetica', 'BI',10);
      $this->MultiCell(130, 0,utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['espec_user']) .$txt, 0, 'R', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln(160);
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
k.id_maternapv,freg_reg, freg, hreg, mc1, mc4, mc5, mc6, mc7, fr1, fr2, fr3, fr4, fr5, fr6,
menarquia, ciclos, fum, pfprevia, cpreconcepcional, egestacional, fpp, ant_patologicos,
ant_quirurgicos, ant_familiares, ant_toxicologicos, ant_transfucionales, pfposterior, metodopf,
g, p, a, c, e, v, m, g1, g2, g3, g4, g5, p1, p2, p3, p4, p5, a1, a2, a3, a4, a5, c1, c2, c3, c4,
c5, e1, e2, e3, e4, e5, v1, v2, v3, v4, v5, m1, m2, m3, movfetal, actuterina, amniorrea,
sangvaginal, sinturinarios, fvaginal, sintrespiratorios, fiebre, sanganormal, cual, cefalea,
fosfenos, acufenos, edemas, epigastralgia, obs_rxs, hemoclasi1, toxoplasma1, serologia1, vih1,
rubeola1, urocultivo1, frotis1, glicemia1, hemoglobina1, hepatitisb1, hemoclasi2, toxoplasma2,
serologia2, vih2, rubeola2, urocultivo2, frotis2, glicemia2, hemoglobina2, hepatitisb2,
hemoclasi3, toxoplasma3, serologia3, vih3, rubeola3, urocultivo3, frotis3, glicemia3,
hemoglobina3, hepatitisb3, fecha1, fecha2, fecha3, egesta1, egesta2, egesta3, bfetal1,
bfetal2, bfetal3, placenta1, placenta2, placenta3, talla, pesoinicio, imcinicio, pesoactual,
clasipeso, ganaciapeso, ta, fc, fr, t, glucometria, cardiopulmonar, au, presentacionfeto,
situacionfetal, fcf, obs_abdomen, edemasvaso, varices, dxp, tdxp, dx1, tdx1, dx2, tdx2, dx3,
tdx3, patoasociada, patoidentificada, pm1, pm2, pm3, pm4, pm5, obsgeneral, vrp, vro,
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
      left join hc_maternas_pv k on (k.id_adm_hosp=b.id_adm_hosp)
      left join user l on (l.id_user=k.id_user)
where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and freg between '".$_GET["f1"]."' and '".$_GET["f2"]."'";
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
