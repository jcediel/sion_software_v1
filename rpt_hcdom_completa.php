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
    $nom=$_GET["nom"];
    $doc=$_GET["edad"];
    $dir=$_GET["dir"];
    $genero=$_GET["genero"];
    $fnacimiento=$_GET["fnacimiento"];
    $afiliacion=$_GET["afiliacion"];
    $estadocivil=$_GET["estadocivil"];
    $ocupacion=$_GET["ocupacion"];
    $fecha=$_GET["fnacimiento"];
    $dir_pac=$_GET["dir_pac"];
    $tel_pac=$_GET["tel_pac"];
    $dep=$_GET["dep"];
    $mun=$_GET["mun"];
    $zona=$_GET["zona"];
    $nombre_acu=$_GET["nombre_acu"];
    $dir_acu=$_GET["dir_acu"];
    $tel_acu=$_GET["tel_acu"];
    $parentesco_acu=$_GET["parentesco_acu"];
    $segundos= strtotime('now') - strtotime($fecha);
    $diferencia_dias=intval($segundos /60/60/24);
    $dias=ceil($diferencia_dias/365);

    $this->multicell(40,0,$this->image($image_file, $this->GetX(), $this->GetY(),45,10),0,'J');
    // Set font
    $this->SetFont('helvetica', 'B', 10);
    // Title
    $this->Cell(0, 15, 'HISTORIA CLINICA SERVICIO DOMICILIARIO', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', '', 7);
    $this->Cell(30, 0, 'F-GC-035', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Cell(30, 0, 'Version:04', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Cell(120, 0, 'Fecha de Emision:2017-05-02', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Ln();
    $this->Cell(15,0,'Nombre:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(85,0, utf8_encode($nom), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Identificación:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(20,0, utf8_encode($doc), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Genero:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(20,0, utf8_encode($genero), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Fnacimiento:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(20,0, utf8_encode($fnacimiento), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(10,0,'Edad:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(10,0, utf8_encode($dias), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Estado Civil:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(20,0, utf8_encode($estadocivil), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Regimen:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(20,0, utf8_encode($regimen), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(15,0,'Afiliación:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(25,0, utf8_encode($afiliacion), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(15,0,'Ocupación:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(100,0, utf8_encode($ocupacion), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(15,0,'EPS:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(50,0, utf8_encode($nomeps), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Departamento:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(30,0, utf8_encode($dep), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Municipio:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(30,0, utf8_encode($mun), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(10,0,'Zona:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(10,0, utf8_encode($zona), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Teléfono:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(40,0, utf8_encode($tel_pac), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Dirección:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(160,0, $dir, 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Acudiente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(50,0, utf8_encode($nombre_acu), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(20,0,'Parentesco:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(40,0, utf8_encode($parentesco_acu), 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln();
    $this->SetFont('helvetica', 'B', 7);
    $this->Cell(15,0,'Contacto:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->SetFont('helvetica', '', 7);
    $this->Cell(165,0, $dir.' '.$tel_acu, 1, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(5);
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
	public function ColoredTable($header,$data,$data1,$data2,$data3,$data4,$data5,$data6,$data7) {
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
		$this->SetFillColor(220, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {
      $i=1;
      $this->SetFont('','B',10);
      $this->Cell(180,0, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo'].' '.$row['tipo_evo']),1,0,'C',1);
      $this->SetFont('','',9);
      $this->Ln();
      $this->SetFont('','',7);
      $this->MultiCell(180,0, utf8_encode($row['evolucion']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row['nombre']. ' Identificacion: ' .$row['doc']. ' Registro Profesional: ' .$row['rm_profesional']. ' Especialidad: '.$row['espec_user']),1,'L');
		}
    foreach($data1 as $row1) {
        $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Turno: 3 Horas'),1,0,'C',1);
          $this->SetFont('','B',12);
        $this->Cell(120,0, utf8_encode('Fecha de realizacion: '.$row1['freg3']),1,0,'C',1);
        $this->SetFont('','B',9);
        $this->Ln();
        $this->SetFont('','B',7);
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row1['hnota1']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row1['hnota2']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row1['nota1']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row1['hnota2']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row1['hnota3']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row1['nota2']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row1['hnota3']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $hnotaf = strtotime ( '+60 minute' , strtotime ( $row1['hnota3'] ) ) ;
        $hnotaft=date('H:i', $hnotaf);
        $this->Cell(15,0,utf8_encode($hnotaft.':00') ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row1['nota3']),1,'L');
        $this->SetFont('','',1);
        $this->cell(70,20,$this->image(utf8_encode($row1['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
        $this->SetFont('','B',9);
        $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row1['nombre']. ' Identificacion: ' .$row1['doc']. ' Registro Profesional: ' .$row1['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');
        $this->Ln();
    }
    foreach($data2 as $row2) {
        $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Turno: 6 Horas'),1,0,'C',1);
          $this->SetFont('','B',12);
        $this->Cell(120,0, utf8_encode('Fecha de realizacion: '.$row2['freg6']),1,0,'C',1);
        $this->SetFont('','B',9);
        $this->Ln();
        $this->SetFont('','B',7);
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota1']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota2']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row2['nota1']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota2']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota3']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row2['nota2']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota3']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota4']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row2['nota3']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota4']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota5']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row2['nota4']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota5']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota6']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row2['nota5']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row2['hnota6']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $hnotaf = strtotime ( '+60 minute' , strtotime ( $row2['hnota6'] ) ) ;
        $hnotaft=date('H:i', $hnotaf);
        $this->Cell(15,0,utf8_encode($hnotaft.':00') ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row2['nota6']),1,'L');
        $this->SetFont('','',1);
        $this->cell(70,20,$this->image(utf8_encode($row2['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
        $this->SetFont('','B',9);
        $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row2['nombre']. ' Identificacion: ' .$row2['doc']. ' Registro Profesional: ' .$row2['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');
      }
      foreach($data5 as $row5) {
        $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Turno: 8 Horas'),1,0,'C',1);
          $this->SetFont('','B',12);
        $this->Cell(120,0, utf8_encode('Fecha de realizacion: '.$row5['freg8']),1,0,'C',1);
        $this->Ln();
        $this->SetFont('','B',7);
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota1']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota2']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota1']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota2']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota3']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota2']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota3']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota4']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota3']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota4']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota5']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota4']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota5']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota6']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota5']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota6']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota7']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota6']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota7']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota8']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota7']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row5['hnota8']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $hnotaf = strtotime ( '+60 minute' , strtotime ( $row5['hnota8'] ) ) ;
        $hnotaft=date('H:i', $hnotaf);
        $this->Cell(15,0,utf8_encode($hnotaft.':00') ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row5['nota8']),1,'L');
        $this->SetFont('','',1);
        $this->cell(70,20,$this->image(utf8_encode($row5['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
        $this->SetFont('','B',9);
        $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row5['nombre']. ' Identificacion: ' .$row5['doc']. ' Registro Profesional: ' .$row5['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');

      }
      foreach($data3 as $row3) {
        $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Turno: 12 Horas'),1,0,'C',1);
        $this->SetFont('','B',12);
        $this->Cell(120,0, utf8_encode('Fecha de realizacion: '.$row3['freg12']),1,0,'C',1);
        $this->SetFont('','B',9);
        $this->Ln();
        $this->SetFont('','B',7);
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota1']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota2']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota1']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota2']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota3']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota2']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota3']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota4']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota3']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota4']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota5']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota4']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota5']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota6']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota5']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota6']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota7']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota6']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota7']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota8']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota7']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota8']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota9']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota8']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota9']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota10']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota9']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota10']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota11']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota10']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota11']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota12']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota11']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row3['hnota12']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $hnotaf = strtotime ( '+60 minute' , strtotime ( $row3['hnota12'] ) ) ;
        $hnotaft=date('H:i', $hnotaf);
        $this->Cell(15,0,utf8_encode($hnotaft.':00') ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row3['nota12']),1,'L');
        $this->SetFont('','',1);
        $this->cell(70,20,$this->image(utf8_encode($row3['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
        $this->SetFont('','B',9);
        $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row3['nombre']. ' Identificacion: ' .$row3['doc']. ' Registro Profesional: ' .$row3['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');
      }
      foreach($data4 as $row4) {

        $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Turno: '.$row4['intervalo_nota'].' Horas'),1,0,'C',1);
          $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Fecha de realizacion: '.$row4['freg12']),1,0,'C',1);
          $this->SetFont('','B',10);
        $this->Cell(60,0, utf8_encode('Temporalidad: '.$row4['tipo_nota']),1,0,'C',1);
        $this->SetFont('','B',9);
        $this->Ln();
        $this->SetFont('','B',7);
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota1']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota2']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota1']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota2']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota3']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota2']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota3']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota4']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota3']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota4']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota5']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota4']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota5']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota6']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota5']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota6']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota7']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota6']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota7']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota8']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota7']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota8']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota9']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota8']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota9']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota10']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota9']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota10']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota11']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota10']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota11']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota12']) ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota11']),1,'L');
        $this->Cell(20,0, 'Hora inicial:',1,0,'C',1);
        $this->Cell(15,0,utf8_encode($row4['hnota12']) ,1,0,'C',0);
        $this->Cell(20,0, 'Hora final:',1,0,'C',1);
        $hnotaf = strtotime ( '+60 minute' , strtotime ( $row4['hnota12'] ) ) ;
        $hnotaft=date('H:i', $hnotaf);
        $this->Cell(15,0,utf8_encode($hnotaft.':00') ,1,0,'C',0);
        $this->SetFont('','',7);
        $this->multiCell(110,0, utf8_encode($row4['nota12']),1,'L');
        $this->SetFont('','',1);
        $this->cell(70,20,$this->image(utf8_encode($row4['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
        $this->SetFont('','B',9);
        $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row4['nombre']. ' Identificacion: ' .$row4['doc']. ' Registro Profesional: ' .$row4['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');
  		}
      foreach($data6 as $row6) {
          $this->SetFont('','B',10);
          $this->Cell(90,0, utf8_encode('SIGNOS VITALES'),1,0,'C',1);
            $this->SetFont('','B',8);
          $this->Cell(90,0, utf8_encode('Fecha: '.$row6['freg_sv']. ' Hora: '.$row6['hreg_sv']),1,0,'C',1);
          $this->SetFont('','B',9);
          $this->Ln();
          $this->SetFont('','B',7);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20  ,0,'TAS(mm/Hg):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['tas_s'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'TAD(mm/Hg):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['tad_s'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'TAM(mm/Hg):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['tm_s'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'FR(x min):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['fc_s'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'FC(x min):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['fc_s'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'SpO2(satO2):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['spo_s'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Ln();
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'Glucometria:',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['glucometria'],1,0,'L',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'Temp(C°):',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(10,0,$row6['temp_s'],1,0,'L',1);
          $this->Ln();
          $this->SetFont('','',7);
          $this->multiCell(180,0, utf8_encode($row6['obs_signos']),1,'L');
          $this->SetFont('','',1);
          $this->cell(70,20,$this->image(utf8_encode($row6['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
          $this->SetFont('','B',9);
          $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row6['nombre']. ' Identificacion: ' .$row6['doc']. ' Registro Profesional: ' .$row6['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');

      }
      foreach($data7 as $row7) {
          $this->SetFont('','B',10);
          $this->Cell(90,0, utf8_encode('ADMINISTRACION MEDICAMENTOS'),1,0,'C',1);
            $this->SetFont('','B',8);
          $this->Cell(90,0, utf8_encode('Fecha: '.$row7['freg']. ' Hora: '.$row7['hreg']),1,0,'C',1);
          $this->SetFont('','B',9);
          $this->Ln();
          $this->SetFont('','B',7);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(40  ,0,'MEDICAMENTO:',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(140,0,$row7['medicamento'],1,0,'L',1);
          $this->Ln();
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'VIA:',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(40,0,$row7['via'],1,0,'C',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'FRECUENCIA:',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(40,0,$row7['frecuencia'].' Horas',1,0,'C',1);
          $this->SetFont('helvetica', 'B', 7);
          $this->Cell(20,0,'DOSIS:',1,0,'L',1);
          $this->SetFont('helvetica', '',7);
          $this->Cell(40,0,$row7['dosis'],1,0,'C',1);
          $this->Ln();
          $this->SetFont('','',7);
          $this->multiCell(180,0, utf8_encode($row7['obs_medicamento']),1,'L');
          $this->SetFont('','',1);
          $this->cell(70,20,$this->image(utf8_encode($row7['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
          $this->SetFont('','B',9);
          $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row7['nombre']. ' Identificacion: ' .$row7['doc']. ' Registro Profesional: ' .$row7['rm_profesional']. ' Especialidad: ENFERMERIA'),1,'L');

      }
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Clinica Consorcio Emmanuel');
$pdf->SetTitle('Reporte de evoluciones');
$pdf->SetSubject('Reporte de evoluciones');
$pdf->SetKeywords('Reporte de evoluciones');

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
$adm=$_GET["idadmhosp"];
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];

if ($f1=='') {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_hchosp,'VALORACION MEDICA' tipo_evo,k.freg_hchosp fecha_evo,k.hreg_hchosp hora_evo,
  concat('TIPO HISTORIA: ',k.tipo_hc, '\nMOTIVO CONSULTA: ',k.motivo_consulta, '\nENFERMEDAD ACTUAL: ',k.enfer_actual, '\nANTECEDENTES ALERGICOS: ',k.ant_alergicos,
         '\nANTECEDENTES PATOLOGICOS: ',k.ant_patologico, '\nANTECEDENTES QUIRURGICOS: ',k.ant_quirurgico,
         '\nANTECEDENTES TOXICOLOGICOS: ',k.ant_toxicologico, '\nANTECEDENTES FARMACOLOGICO: ',k.ant_farmaco, '\nANTECEDENTES GINECOLOGICO: ',k.ant_gineco, '\nANTECEDENTES PSIQUIATRICO: ',k.ant_psiquiatrico, '\nANTECEDENTES HOSPITALARIOS: ',k.ant_hospitalario,
         '\nANTECEDENTES TRAUMATOLOGICOS: ',k.ant_traumatologico, '\nANTECEDENTES FAMILIAR: ',k.ant_familiar, '\nOTROS ANTECEDENTES: ',k.otros_ant, '\nTENSION ARTERIAL SISTOLICA: ',k.tas, '\nTENSION ARTERIAL DIASTOLICA: ',k.tad, '\nFRECUENCIA CARDIACA: ',k.fc,
         '\nFRECUENCIA RESPIRATORIA: ',k.fr, '\nSATURACION: ',k.so2, '\nPESO: ',k.peso, '\nTALLA: ',k.talla,'\nGLASGOW: ',k. glasgow,'\nGLUCOMETRIA: ',k. gucometria, '\nIMC: ',k.imc, '\nREVISION POR SISTEMAS: ',k.rxs, '\nCABEZA CUELLO: ',k.cabcuello, '\nTORAX ',k.torax,
         '\nEXTREMIDADES: ',k.ext, '\nABDOMEN: ',k.abdomen, '\nNEUROLOGICO: ',k.neurologico, '\nGENITOURINARIO: ',k.genitourinario, '\nBARTHEL: ',k.barthel, '\nWEEFIM: ',k.weefim, '\nCRUZ ROJA: ',k.cruzroja, '\nRAISBERG: ',k.raisberg, '\nKARNELL: ',k.karnell,
         '\nGROSS MOTOR: ',k.grossmotor, '\nNORTON: ',k.norton, '\nHONENYAHR: ',k.honenyahr, '\nFAC: ',k.fac, '\nANALISIS: ',k.analisis, '\nFINALIDAD: ',k.finalidad, '\nCAUSA EXTERNA: ',k.causa_externa, '\nDIAGNOSTICO PRINCIPAL: ',k.dxp, tdxp,
         '\nDIAGNOSTICO RELACIONADO1: ',k.dx1, k.tdx1, '\nDIAGNOSTICO RELACIONADO 2: ',k.dx2, k.tdx2, '\nDIAGNOSTICO RELACIONADO3: ',k.dx3, k.tdx3, '\nPLAN DE MANEJO: ',k.plan_manejo) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join hcini_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)
  where b.id_adm_hosp =$adm

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evofisio_dom id,'EVOLUCION FISIOTERAPIA' tipo_evo,k.freg_evofisio_dom fecha_evo, k.hreg_evofisio_dom hora_evo,
  concat(evolucionfisio_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_fisio_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evofono_dom id,'EVOLUCION FONOAUDIOLOGIA' tipo_evo,k.freg_evofono_dom fecha_evo, k.hreg_evofono_dom hora_evo,
  concat(evolucionfono_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_fono_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evoto_dom id,'EVOLUCION OCUPACIONAL' tipo_evo,k.freg_evoto_dom fecha_evo, k.hreg_evoto_dom hora_evo,
  concat(evolucionto_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_to_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evopsico_dom id,'EVOLUCION PSICOLOGIA' tipo_evo,k.freg_evopsico_dom fecha_evo, k.hreg_evopsico_dom hora_evo,
  concat(evolucionpsico_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_psico_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm

  order by fecha_evo ASC, hora_evo ASC

  ";
}else {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_hchosp,'VALORACION MEDICA' tipo_evo,k.freg_hchosp fecha_evo,k.hreg_hchosp hora_evo,
  concat('TIPO HISTORIA: ',k.tipo_hc, '\nMOTIVO CONSULTA: ',k.motivo_consulta, '\nENFERMEDAD ACTUAL: ',k.enfer_actual, '\nANTECEDENTES ALERGICOS: ',k.ant_alergicos,
         '\nANTECEDENTES PATOLOGICOS: ',k.ant_patologico, '\nANTECEDENTES QUIRURGICOS: ',k.ant_quirurgico,
         '\nANTECEDENTES TOXICOLOGICOS: ',k.ant_toxicologico, '\nANTECEDENTES FARMACOLOGICO: ',k.ant_farmaco, '\nANTECEDENTES GINECOLOGICO: ',k.ant_gineco, '\nANTECEDENTES PSIQUIATRICO: ',k.ant_psiquiatrico, '\nANTECEDENTES HOSPITALARIOS: ',k.ant_hospitalario,
         '\nANTECEDENTES TRAUMATOLOGICOS: ',k.ant_traumatologico, '\nANTECEDENTES FAMILIAR: ',k.ant_familiar, '\nOTROS ANTECEDENTES: ',k.otros_ant, '\nTENSION ARTERIAL SISTOLICA: ',k.tas, '\nTENSION ARTERIAL DIASTOLICA: ',k.tad, '\nFRECUENCIA CARDIACA: ',k.fc,
         '\nFRECUENCIA RESPIRATORIA: ',k.fr, '\nSATURACION: ',k.so2, '\nPESO: ',k.peso, '\nTALLA: ',k.talla,'\nGLASGOW: ',k. glasgow,'\nGLUCOMETRIA: ',k. gucometria, '\nIMC: ',k.imc, '\nREVISION POR SISTEMAS: ',k.rxs, '\nCABEZA CUELLO: ',k.cabcuello, '\nTORAX ',k.torax,
         '\nEXTREMIDADES: ',k.ext, '\nABDOMEN: ',k.abdomen, '\nNEUROLOGICO: ',k.neurologico, '\nGENITOURINARIO: ',k.genitourinario, '\nBARTHEL: ',k.barthel, '\nWEEFIM: ',k.weefim, '\nCRUZ ROJA: ',k.cruzroja, '\nRAISBERG: ',k.raisberg, '\nKARNELL: ',k.karnell,
         '\nGROSS MOTOR: ',k.grossmotor, '\nNORTON: ',k.norton, '\nHONENYAHR: ',k.honenyahr, '\nFAC: ',k.fac, '\nANALISIS: ',k.analisis, '\nFINALIDAD: ',k.finalidad, '\nCAUSA EXTERNA: ',k.causa_externa, '\nDIAGNOSTICO PRINCIPAL: ',k.dxp, tdxp,
         '\nDIAGNOSTICO RELACIONADO1: ',k.dx1, k.tdx1, '\nDIAGNOSTICO RELACIONADO 2: ',k.dx2, k.tdx2, '\nDIAGNOSTICO RELACIONADO3: ',k.dx3, k.tdx3, '\nPLAN DE MANEJO: ',k.plan_manejo) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join hcini_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)
  where b.id_adm_hosp =$adm and k.freg_hchosp BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evofisio_dom id,'EVOLUCION FISIOTERAPIA' tipo_evo,k.freg_evofisio_dom fecha_evo, k.hreg_evofisio_dom hora_evo,
  concat(evolucionfisio_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_fisio_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm and k.freg_evofisio_dom BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evofono_dom id,'EVOLUCION FONOAUDIOLOGIA' tipo_evo,k.freg_evofono_dom fecha_evo, k.hreg_evofono_dom hora_evo,
  concat(evolucionfono_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_fono_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm and k.freg_evofono_dom BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evoto_dom id,'EVOLUCION OCUPACIONAL' tipo_evo,k.freg_evoto_dom fecha_evo, k.hreg_evoto_dom hora_evo,
  concat(evolucionto_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_to_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm and k.freg_evoto_dom BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evopsico_dom id,'EVOLUCION PSICOLOGIA' tipo_evo,k.freg_evopsico_dom fecha_evo, k.hreg_evopsico_dom hora_evo,
  concat(evolucionpsico_dom) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_psico_dom k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp =$adm and k.freg_evopsico_dom BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  order by fecha_evo ASC, hora_evo ASC

  ";
}

  //echo $sql;
  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  } //FIN terapias + medicina general
  $turno=$_REQUEST['turno'];
  $adm=$_REQUEST['idadmhosp'];
  $idd=$_REQUEST['idd'];
  $f1=$_REQUEST['f1'];
  $f2=$_REQUEST['f2'];
  if ($f1!='') {
    $sql5="SELECT a.id_enf_dom8, id_adm_hosp,  freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
                   hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom8 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm  AND estado_nota='Realizada' and a.freg8 BETWEEN '$f1' and '$f2'
          ORDER BY freg8 ASC

    ";

  }else {
    $sql5="SELECT a.id_enf_dom8, id_adm_hosp,  freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
                   hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom8 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada'
          ORDER BY freg8 ASC
    ";
  }


  //echo $sql;
  $rs5 = mysql_query($sql5);
  if (mysql_num_rows($rs5)>0){
      $i=0;
      while($rw5 = mysql_fetch_array($rs5)){

          $data5[] = $rw5;
    }
  }



  if ($f1!='') {
    $sql1="SELECT a.id_enf_dom3, id_adm_hosp,  freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom3 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada'  and a.freg3 BETWEEN '$f1' and '$f2'
          ORDER BY freg3 ASC
    ";

  }else {
    $sql1="SELECT a.id_enf_dom3, id_adm_hosp,  freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom3 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada'
          ORDER BY freg3 ASC
    ";
  }

  //echo $sql;
  $rs1 = mysql_query($sql1);
  if (mysql_num_rows($rs1)>0){
      $i=0;
      while($rw1 = mysql_fetch_array($rs1)){

          $data1[] = $rw1;
    }
  }



  if ($f1!='') {
    $sql2="SELECT a.id_enf_dom6, id_adm_hosp,  freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
                   hnota5, nota5, hnota6, nota6, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom6 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm  AND estado_nota='Realizada' and a.freg6 BETWEEN '$f1' and '$f2'
          ORDER BY freg6 ASC

    ";

  }else {
    $sql2="SELECT a.id_enf_dom6, id_adm_hosp,  freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
                   hnota5, nota5, hnota6, nota6, estado_nota, f_cancela, resp_cancela,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom6 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada'
          ORDER BY freg6 ASC
    ";
  }

  //echo $sql;
  $rs2 = mysql_query($sql2);
  if (mysql_num_rows($rs2)>0){
      $i=0;
      while($rw2 = mysql_fetch_array($rs2)){

          $data2[] = $rw2;
    }
  }



  if ($f1!='') {
    $sql3="SELECT a.id_enf_dom12, id_adm_hosp,  freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, hnota9, nota9,
                 hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota, f_cancela, resp_cancela, tipo_nota, intervalo_nota,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom12 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm  AND estado_nota='Realizada' and a.freg12 BETWEEN '$f1' and '$f2' and intervalo_nota is null
          ORDER BY freg12 ASC

    ";

  }else {
    $sql3="SELECT a.id_enf_dom12, id_adm_hosp,  freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, hnota9, nota9,
                 hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota, f_cancela, resp_cancela, tipo_nota, intervalo_nota,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom12 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada' and intervalo_nota is null
          ORDER BY freg12 ASC
    ";
  }

  //echo $sql;
  $rs3 = mysql_query($sql3);
  if (mysql_num_rows($rs3)>0){
      $i=0;
      while($rw3 = mysql_fetch_array($rs3)){

          $data3[] = $rw3;
    }
  }



  if ($f1!='') {
    $sql4="SELECT a.id_enf_dom12, id_adm_hosp,  freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, hnota9, nota9,
                 hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota, f_cancela, resp_cancela, tipo_nota, intervalo_nota,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom12 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm  AND estado_nota='Realizada' and a.freg12 BETWEEN '$f1' and '$f2' and intervalo_nota=24
          ORDER BY freg12 ASC

    ";

  }else {
    $sql4="SELECT a.id_enf_dom12, id_adm_hosp,  freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, hnota9, nota9,
                 hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota, f_cancela, resp_cancela, tipo_nota, intervalo_nota,
                 b.nombre,rm_profesional,firma,doc
          FROM enferdom12 a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_nota='Realizada' and intervalo_nota=24
          ORDER BY freg12 ASC
    ";
  }

  //echo $sql;
  $rs4 = mysql_query($sql4);
  if (mysql_num_rows($rs4)>0){
      $i=0;
      while($rw4 = mysql_fetch_array($rs4)){

          $data4[] = $rw4;
    }
  }

  if ($f1!='') {
    $sql6="SELECT a.id_signos_vitales, id_adm_hosp,  id_d_aut_dom, freg_sv, hreg_sv, tas_s, tad_s,
    tm_s, fc_s, fr_s, temp_s, spo_s, glucometria, estado_sv, resp_sv, obs_signos,
                  b.nombre,rm_profesional,firma,doc
          FROM signos_vitales a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm  AND estado_sv='Realizada' and a.freg_sv BETWEEN '$f1' and '$f2'
          ORDER BY freg_sv ASC, hreg_sv ASC

    ";

  }else {
    $sql6="SELECT a.id_signos_vitales, id_adm_hosp, id_d_aut_dom, freg_sv, hreg_sv, tas_s, tad_s,
    tm_s, fc_s, fr_s, temp_s, spo_s, glucometria, estado_sv, resp_sv, obs_signos,
                  b.nombre,rm_profesional,firma,doc
          FROM signos_vitales a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_sv='Realizada'
          ORDER BY freg_sv ASC, hreg_sv ASC
    ";
  }

  //echo $sql;
  $rs6 = mysql_query($sql6);
  if (mysql_num_rows($rs6)>0){
      $i=0;
      while($rw6 = mysql_fetch_array($rs6)){

          $data6[] = $rw6;
    }
  }

  if ($f1!='') {
    $sql7="SELECT a.id_adm_med_dom, id_adm_hosp, id_d_aut_dom, freg, hreg, medicamento, via, frecuencia,
    dosis, obs_medicamento, estado_adm_med,
                  b.nombre,rm_profesional,firma,doc
          FROM administracion_med_dom a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm  AND estado_adm_med='Realizada' and a.freg BETWEEN '$f1' and '$f2'
          ORDER BY freg ASC, hreg ASC

    ";

  }else {
    $sql7="SELECT a.id_adm_med_dom, id_adm_hosp,  id_d_aut_dom, freg, hreg, medicamento, via, frecuencia,
    dosis, obs_medicamento, estado_adm_med,
                 b.nombre,rm_profesional,firma,doc
          FROM administracion_med_dom a inner join user b on a.id_user=b.id_user
          WHERE a.id_adm_hosp=$adm AND estado_adm_med='Realizada'
          ORDER BY freg12 ASC, hreg ASC
    ";
  }

  //echo $sql;
  $rs7 = mysql_query($sql7);
  if (mysql_num_rows($rs7)>0){
      $i=0;
      while($rw7 = mysql_fetch_array($rs7)){

          $data7[] = $rw7;
    }
  }
// print colored table
$pdf->ColoredTable($header,$data,$data1,$data2,$data3,$data4,$data5,$data6,$data7);

// ---------------------------------------------------------
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre=$_GET["nom"];
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
