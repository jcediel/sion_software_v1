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
 function valorEnLetras($x)
 		{
 		if ($x<0) { $signo = "menos ";}
 		else      { $signo = "";}
 		$x = abs ($x);
 		$C1 = $x;

 		$G6 = floor($x/(1000000));  // 7 y mas

 		$E7 = floor($x/(100000));
 		$G7 = $E7-$G6*10;   // 6

 		$E8 = floor($x/1000);
 		$G8 = $E8-$E7*100;   // 5 y 4

 		$E9 = floor($x/100);
 		$G9 = $E9-$E8*10;  //  3

 		$E10 = floor($x);
 		$G10 = $E10-$E9*100;  // 2 y 1


 		$G11 = round(($x-$E10)*100,0);  // Decimales
 		//////////////////////

 		$H6 = unidades($G6);

 		if($G7==1 AND $G8==0) { $H7 = "Cien "; }
 		else {    $H7 = decenas($G7); }

 		$H8 = unidades($G8);

 		if($G9==1 AND $G10==0) { $H9 = "Cien "; }
 		else {    $H9 = decenas($G9); }

 		$H10 = unidades($G10);

 		if($G11 < 10) { $H11 = ""; }
 		else { $H11 = $G11; }

 		/////////////////////////////
 		    if($G6==0) { $I6=" "; }
 		elseif($G6==1) { $I6="Millón "; }
 		         else { $I6="Millones "; }

 		if ($G8==0 AND $G7==0) { $I8=" "; }
 		         else { $I8="Mil "; }

 		$I10 = " ";
 		$I11 = " ";

 		$C3 = $signo.$H6.$I6.$H7.$I7.$H8.$I8.$H9.$I9.$H10.$I10.$H11.$I11;

 		return $C3; //Retornar el resultado

 		}

 		function unidades($u)
 		{
 		    if ($u==0)  {$ru = " ";}
 		elseif ($u==1)  {$ru = "Uno ";}
 		elseif ($u==2)  {$ru = "Dos ";}
 		elseif ($u==3)  {$ru = "Tres ";}
 		elseif ($u==4)  {$ru = "Cuatro ";}
 		elseif ($u==5)  {$ru = "Cinco ";}
 		elseif ($u==6)  {$ru = "Seis ";}
 		elseif ($u==7)  {$ru = "Siete ";}
 		elseif ($u==8)  {$ru = "Ocho ";}
 		elseif ($u==9)  {$ru = "Nueve ";}
 		elseif ($u==10) {$ru = "Diez ";}

 		elseif ($u==11) {$ru = "Once ";}
 		elseif ($u==12) {$ru = "Doce ";}
 		elseif ($u==13) {$ru = "Trece ";}
 		elseif ($u==14) {$ru = "Catorce ";}
 		elseif ($u==15) {$ru = "Quince ";}
 		elseif ($u==16) {$ru = "Dieciseis ";}
 		elseif ($u==17) {$ru = "Decisiete ";}
 		elseif ($u==18) {$ru = "Dieciocho ";}
 		elseif ($u==19) {$ru = "Diecinueve ";}
 		elseif ($u==20) {$ru = "Veinte ";}

 		elseif ($u==21) {$ru = "Veintiuno ";}
 		elseif ($u==22) {$ru = "Veintidos ";}
 		elseif ($u==23) {$ru = "Veintitres ";}
 		elseif ($u==24) {$ru = "Veinticuatro ";}
 		elseif ($u==25) {$ru = "Veinticinco ";}
 		elseif ($u==26) {$ru = "Veintiseis ";}
 		elseif ($u==27) {$ru = "Veintisiente ";}
 		elseif ($u==28) {$ru = "Veintiocho ";}
 		elseif ($u==29) {$ru = "Veintinueve ";}
 		elseif ($u==30) {$ru = "Treinta ";}

 		elseif ($u==31) {$ru = "Treinta y uno ";}
 		elseif ($u==32) {$ru = "Treinta y dos ";}
 		elseif ($u==33) {$ru = "Treinta y tres ";}
 		elseif ($u==34) {$ru = "Treinta y cuatro ";}
 		elseif ($u==35) {$ru = "Treinta y cinco ";}
 		elseif ($u==36) {$ru = "Treinta y seis ";}
 		elseif ($u==37) {$ru = "Treinta y siete ";}
 		elseif ($u==38) {$ru = "Treinta y ocho ";}
 		elseif ($u==39) {$ru = "Treinta y nueve ";}
 		elseif ($u==40) {$ru = "Cuarenta ";}

 		elseif ($u==41) {$ru = "Cuarenta y uno ";}
 		elseif ($u==42) {$ru = "Cuarenta y dos ";}
 		elseif ($u==43) {$ru = "Cuarenta y tres ";}
 		elseif ($u==44) {$ru = "Cuarenta y cuatro ";}
 		elseif ($u==45) {$ru = "Cuarenta y cinco ";}
 		elseif ($u==46) {$ru = "Cuarenta y seis ";}
 		elseif ($u==47) {$ru = "Cuarenta y siete ";}
 		elseif ($u==48) {$ru = "Cuarenta y ocho ";}
 		elseif ($u==49) {$ru = "Cuarenta y nueve ";}
 		elseif ($u==50) {$ru = "Cincuenta ";}

 		elseif ($u==51) {$ru = "Cincuenta y uno ";}
 		elseif ($u==52) {$ru = "Cincuenta y dos ";}
 		elseif ($u==53) {$ru = "Cincuenta y tres ";}
 		elseif ($u==54) {$ru = "Cincuenta y cuatro ";}
 		elseif ($u==55) {$ru = "Cincuenta y cinco ";}
 		elseif ($u==56) {$ru = "Cincuenta y seis ";}
 		elseif ($u==57) {$ru = "Cincuenta y siete ";}
 		elseif ($u==58) {$ru = "Cincuenta y ocho ";}
 		elseif ($u==59) {$ru = "Cincuenta y nueve ";}
 		elseif ($u==60) {$ru = "Sesenta ";}

 		elseif ($u==61) {$ru = "Sesenta y uno ";}
 		elseif ($u==62) {$ru = "Sesenta y dos ";}
 		elseif ($u==63) {$ru = "Sesenta y tres ";}
 		elseif ($u==64) {$ru = "Sesenta y cuatro ";}
 		elseif ($u==65) {$ru = "Sesenta y cinco ";}
 		elseif ($u==66) {$ru = "Sesenta y seis ";}
 		elseif ($u==67) {$ru = "Sesenta y siete ";}
 		elseif ($u==68) {$ru = "Sesenta y ocho ";}
 		elseif ($u==69) {$ru = "Sesenta y nueve ";}
 		elseif ($u==70) {$ru = "Setenta ";}

 		elseif ($u==71) {$ru = "Setenta y uno ";}
 		elseif ($u==72) {$ru = "Setenta y dos ";}
 		elseif ($u==73) {$ru = "Setenta y tres ";}
 		elseif ($u==74) {$ru = "Setenta y cuatro ";}
 		elseif ($u==75) {$ru = "Setenta y cinco ";}
 		elseif ($u==76) {$ru = "Setenta y seis ";}
 		elseif ($u==77) {$ru = "Setenta y siete ";}
 		elseif ($u==78) {$ru = "Setenta y ocho ";}
 		elseif ($u==79) {$ru = "Setenta y nueve ";}
 		elseif ($u==80) {$ru = "Ochenta ";}

 		elseif ($u==81) {$ru = "Ochenta y uno ";}
 		elseif ($u==82) {$ru = "Ochenta y dos ";}
 		elseif ($u==83) {$ru = "Ochenta y tres ";}
 		elseif ($u==84) {$ru = "Ochenta y cuatro ";}
 		elseif ($u==85) {$ru = "Ochenta y cinco ";}
 		elseif ($u==86) {$ru = "Ochenta y seis ";}
 		elseif ($u==87) {$ru = "Ochenta y siete ";}
 		elseif ($u==88) {$ru = "Ochenta y ocho ";}
 		elseif ($u==89) {$ru = "Ochenta y nueve ";}
 		elseif ($u==90) {$ru = "Noventa ";}

 		elseif ($u==91) {$ru = "Noventa y uno ";}
 		elseif ($u==92) {$ru = "Noventa y dos ";}
 		elseif ($u==93) {$ru = "Noventa y tres ";}
 		elseif ($u==94) {$ru = "Noventa y cuatro ";}
 		elseif ($u==95) {$ru = "Noventa y cinco ";}
 		elseif ($u==96) {$ru = "Noventa y seis ";}
 		elseif ($u==97) {$ru = "Noventa y siete ";}
 		elseif ($u==98) {$ru = "Noventa y ocho ";}
 		else            {$ru = "Noventa y nueve ";}
 		return $ru; //Retornar el resultado
 		}

 		function decenas($d)
 		{
 		    if ($d==0)  {$rd = "";}
 		elseif ($d==1)  {$rd = "Ciento ";}
 		elseif ($d==2)  {$rd = "Doscientos ";}
 		elseif ($d==3)  {$rd = "Trescientos ";}
 		elseif ($d==4)  {$rd = "Cuatrocientos ";}
 		elseif ($d==5)  {$rd = "Quinientos ";}
 		elseif ($d==6)  {$rd = "Seiscientos ";}
 		elseif ($d==7)  {$rd = "Setecientos ";}
 		elseif ($d==8)  {$rd = "Ochocientos ";}
 		else            {$rd = "Novecientos ";}
 		return $rd; //Retornar el resultado
 		}
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
        $this->Cell(180, 20, 'FORMULA MEDICA', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 5, 'FR-AFAD-010', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 5, 'Fecha de impresion: '.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
		$this->Ln(20);
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
  		$this->Ln();
      $fecha1=$row["fejecucion_inicial"];
      $fecha2=$row["fejecucion_final"];
      $segundos= strtotime($fecha2) - strtotime($fecha1);
      $diferencia_dias=intval($segundos/60/60/24);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(19,5,'Fecha inicial:',1,0,'C',1);
      $this->SetFont('helvetica', 'BI',8);
      $this->Cell(15,5, utf8_encode($row['fejecucion_inicial']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(28,5,'Fecha Vencimiento:',1,0,'C',1);
      $this->SetFont('helvetica', 'BI',8);
      $this->Cell(15,5, utf8_encode($row['fejecucion_final']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(25,5,'# Consecutivo:',1,0,'C',1);
      $this->SetFont('helvetica', 'B',11);
      $this->Cell(39,5, utf8_encode($row['id_d_fmedhosp']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(31,5,'DIAS TRATAMIENTO: ',1,0,'C',1);
      $this->SetFont('helvetica', 'B',11);
      if ($diferencia_dias==31) {
          $this->Cell(8,5,'30',1,0,'C');
      }
      if ($diferencia_dias==0) {
        $this->Cell(8,5,'1',1,0,'C');
      }
      if ($diferencia_dias >0) {
        $this->Cell(8,5, utf8_encode($diferencia_dias),1,0,'C');
      }
      if ($diferencia_dias < 31 && $diferencia_dias >0) {
        $this->Cell(8,5, utf8_encode($diferencia_dias),1,0,'C');
      }
      $this->Ln();
      $this->SetFont('helvetica', 'B', 7);
      $this->Cell(45,5,'MEDICAMENTO:',1,0,'C',1);
      $this->Cell(45,5,'VIA:',1,0,'C',1);
      $this->Cell(45,5,'FRECUENCIA:',1,0,'C',1);
      $this->Cell(45,5,'CANTIDAD:',1,0,'C',1);
      $this->Ln();
      $d1=$row['dosis1'];
      $d2=$row['dosis2'];
      $d3=$row['dosis3'];
      $d4=$row['dosis4'];
      $dt=$d1+$d2+$d3+$d4;
      $fecha1=$row["fejecucion_inicial"];
      $fecha2=$row["fejecucion_final"];
      $segundos= strtotime($fecha2) - strtotime($fecha1);
      $diferencia_dias=intval($segundos/60/60/24);
      $t=$_REQUEST['unidad'];
      $cambio=valorEnLetras($_REQUEST['unidad']);
      $this->SetFont('helvetica', 'B', 7);
      $this->MultiCell(45, 8,utf8_encode($row['medicamento']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 8,utf8_encode('Via '.$row['via']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      if ($row['frecuencia']==1) {
        $this->MultiCell(45, 8,utf8_encode('UNICA DOSIS') .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      }else {
        $this->MultiCell(45, 8,utf8_encode($row['frecuencia'].' Horas') .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      }

      $this->MultiCell(22.5, 8,utf8_encode($t) .$txt , 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(22.5, 8,utf8_encode($cambio) .$txt , 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 7);
      $this->MultiCell(180, 8,utf8_encode($row['obsfmedhosp']) .$txt, 1, 'L', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 7);
      $this->Cell(45,5,'INSTITUCION:',1,0,'C',1);
      $this->Cell(45,5,'DIRECCION:',1,0,'C',1);
      $this->Cell(45,5,'TELEFONO:',1,0,'C',1);
      $this->Cell(45,5,'CIUDAD:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 6);
      $this->MultiCell(45, 5,utf8_encode($row['nom_sedes']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 5,utf8_encode($row['dir_sedes']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 5,utf8_encode($row['telefono']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 5,utf8_encode($row['ciudad']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln(10);
      $this->SetFont('helvetica', 'B',1);
      $this->cell(30,0,$this->image('../'.$row['firma'] , $this->GetX(), $this->GetY(),30,20),0,'J');
      $this->SetFont('helvetica', 'BI',10);
      $this->MultiCell(130, 0,utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['especialidad']) .$txt, 0, 'R', 0, 0, '', '', true, 0, false, true, 80, 'T');

      $this->Ln();
      $this->Ln();
      $this->Cell(26,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'C',0);
      //header 2
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
      $this->Cell(180, 20, 'FORMULA MEDICA ', 1, false, 'R', 0, '', 0, false, 'M', 'M');
      $this->Ln();
      $this->SetFont('helvetica', '', 9);
      $this->Cell(30, 5, 'FR-AFAD-010', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->Cell(30, 5, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->Cell(120, 5, 'Fecha de Emision: 2016-06-12', 1, false, 'C', 0, '', 0, false, 'M', 'M');
      $this->Ln();

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
  		$this->Ln();
      $fecha1=$row["fejecucion_inicial"];
      $fecha2=$row["fejecucion_final"];
      $segundos= strtotime($fecha2) - strtotime($fecha1);
      $diferencia_dias=intval($segundos/60/60/24);
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(19,5,'Fecha inicial:',1,0,'C',1);
      $this->SetFont('helvetica', 'BI',8);
      $this->Cell(15,5, utf8_encode($row['fejecucion_inicial']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(28,5,'Fecha Vencimiento:',1,0,'C',1);
      $this->SetFont('helvetica', 'BI',8);
      $this->Cell(15,5, utf8_encode($row['fejecucion_final']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(25,5,'# Consecutivo:',1,0,'C',1);
      $this->SetFont('helvetica', 'B',11);
      $this->Cell(39,5, utf8_encode($row['id_d_fmedhosp']),1,0,'C');
      $this->SetFont('helvetica', 'B', 8);
      $this->Cell(31,5,'DIAS TRATAMIENTO: ',1,0,'C',1);
      $this->SetFont('helvetica', 'B',11);
      if ($diferencia_dias==31) {
          $this->Cell(8,5,'30',1,0,'C');
      }
      if ($diferencia_dias==0) {
        $this->Cell(8,5,'1',1,0,'C');
      }
      if ($diferencia_dias >0) {
        $this->Cell(8,5, utf8_encode($diferencia_dias),1,0,'C');
      }
      if ($diferencia_dias < 31 && $diferencia_dias >0) {
        $this->Cell(8,5, utf8_encode($diferencia_dias),1,0,'C');
      }
      $this->Ln();
      $this->SetFont('helvetica', 'B', 9);
      $this->Cell(45,5,'MEDICAMENTO:',1,0,'C',1);
      $this->Cell(45,5,'VIA:',1,0,'C',1);
      $this->Cell(45,5,'FRECUENCIA:',1,0,'C',1);
      $this->Cell(45,5,'CANTIDAD:',1,0,'C',1);
      $this->Ln();
      $d1=$row['dosis1'];
      $d2=$row['dosis2'];
      $d3=$row['dosis3'];
      $d4=$row['dosis4'];
      $dt=$d1+$d2+$d3+$d4;
      $fecha1=$row["fejecucion_inicial"];
      $fecha2=$row["fejecucion_final"];
      $segundos= strtotime($fecha2) - strtotime($fecha1);
      $diferencia_dias=intval($segundos/60/60/24);
      $t=$_REQUEST['unidad'];
      $cambio=valorEnLetras($_REQUEST['unidad']);
      $this->SetFont('helvetica', 'B', 7);
      $this->MultiCell(45, 8,utf8_encode($row['medicamento']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 8,utf8_encode('Via '.$row['via']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      if ($row['frecuencia']==1) {
        $this->MultiCell(45, 8,utf8_encode('UNICA DOSIS') .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      }else {
        $this->MultiCell(45, 8,utf8_encode($row['frecuencia'].' Horas') .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      }
      $this->MultiCell(22.5, 8,utf8_encode($t) .$txt , 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(22.5, 8,utf8_encode($cambio) .$txt , 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 7);
      $this->MultiCell(180, 8,utf8_encode($row['obsfmedhosp']) .$txt, 1, 'L', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln();
      $this->SetFont('helvetica', 'B', 7);
      $this->Cell(45,5,'INSTITUCION:',1,0,'C',1);
      $this->Cell(45,5,'DIRECCION:',1,0,'C',1);
      $this->Cell(45,5,'TELEFONO:',1,0,'C',1);
      $this->Cell(45,5,'CIUDAD:',1,0,'C',1);
      $this->Ln();
      $this->SetFont('helvetica', 'B', 6);
      $this->MultiCell(45, 5,utf8_encode($row['nom_sedes']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 5,utf8_encode($row['dir_sedes']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 5,utf8_encode($row['telefono']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->MultiCell(45, 5,utf8_encode($row['ciudad']) .$txt, 1, 'C', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln(10);
      $this->SetFont('helvetica', 'B',1);
      $this->cell(30,0,$this->image('../'.$row['firma'] , $this->GetX(), $this->GetY(),30,20),0,'J');
      $this->SetFont('helvetica', 'BI',10);
      $this->MultiCell(130, 0,utf8_encode('Profesional:'.$row['nombre'].' RM profesional:'.$row['rm_profesional'].' Especialidad:'.$row['especialidad']) .$txt, 0, 'R', 0, 0, '', '', true, 0, false, true, 80, 'T');
      $this->Ln();
      $this->Ln();
      $this->Ln();

		}


	}
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Emmanuel ips');
$pdf->SetTitle('Formula Controlados');
$pdf->SetSubject('');
$pdf->SetKeywords('');

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

$id=$_REQUEST['id'];
$sql="SELECT k.nom_eps,
             a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
             b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
             c.descripestadoc,
             d.descriafiliado,
             e.descritusuario,
             f.descriocu,
             g.descripdep,
             h.descrimuni,
             i.descripuedad,
             o.fejecucion_final,fejecucion_inicial,
             m.medicamento,freg,via,frecuencia,dosis1,dosis2,dosis3,dosis4,id_d_fmedhosp,obsfmedhosp,
             q.nom_sedes,dir_sedes,telefono,ciudad,
             l.nombre,l.rm_profesional,l.especialidad ,firma

      FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                       INNER JOIN eps k on (k.id_eps = b.id_eps)
                       INNER JOIN sedes_ips q on (q.id_sedes_ips = b.id_sedes_ips)
                       left join estado_civil c on (c.codestadoc = a.estadocivil)
                       left join tusuario e on (e.codtusuario=b.tipo_usuario)
                       left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
                       left join ocupacion f on (f.codocu=b.ocupacion)
                       left join departamento g on (g.coddep=b.dep_residencia)
                       left join municipios h on (h.codmuni=b.mun_residencia)
                       left join uedad i on (i.coduedad=a.uedad)
                       INNER JOIN m_fmedhosp o on (b.id_adm_hosp=o.id_adm_hosp)
                       INNER JOIN d_fmedhosp m on (o.id_m_fmedhosp=m.id_m_fmedhosp)
                       LEFT JOIN m_producto n on (n.id_producto = m.cod_med  and n.estado_propio = 2)
                       left join user l on (l.id_user=o.id_user)
      WHERE  n.controlado <> 1 and m.id_d_fmedhosp='".$id."'
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
$nombre='Formula_controlado';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
