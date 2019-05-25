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
        $this->Cell(180, 20, 'REPORTE DE EVOLUCIONES', 1, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', '', 9);
        $this->Cell(30, 0, 'IF-GDC-009', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(30, 0, 'Version:00', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(120, 0, 'Fecha de Emision:'.$date, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('', 'B', 8);
        $this->Cell(25, 0, 'Nombre Paciente:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('', 'I', 8);
        $this->Cell(90, 0, $nom, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('', 'B', 8);
        $this->Cell(20, 0, 'Identificacion:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('', 'I', 8);
        $this->Cell(20, 0, $edad, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('', 'B', 8);
        $this->Cell(15, 0, 'Edad:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('', 'I', 8);
        $this->Cell(10, 0, $cie, 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('', 'B', 8);
        $this->Cell(10, 0, 'EPS:', 1, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('', 'BI', 8);
        $this->Cell(170, 0, $eps, 1, false, 'C', 0, '', 0, false, 'M', 'M');
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
	public function ColoredTable($header,$data,$data1,$data2,$data3) {
		// Colors, line width and bold font
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(25,140,25);
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
		$this->SetFillColor(178,216,178);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {

      $this->SetFont('','B',10);
      $this->Cell(90,0, utf8_encode($row['tipo_evo']),1,0,'C',1);
      $this->Cell(90,0, utf8_encode($row['fecha_evo'] .' | '.$row['hora_evo']),1,0,'C',1);
      $this->SetFont('','B',8);
      $this->Ln();
      $this->SetFont('','',7);
      $this->multiCell(180,0, utf8_encode($row['evolucion']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row['nombre']. ' Identificacion: ' .$row['doc']. ' Registro Profesional: ' .$row['rm_profesional']. ' Especialidad: '.$row['espec_user']),1,'L');
		}

    foreach($data1 as $row1) {
      $this->SetFont('','B',9);
      $this->Cell(180,0, $row1['fadmin'].' Administrado por: '.utf8_encode($row1['administrado'].' '.$row1['especialidad']),1,0,'L',1);
      $this->Ln();
      $this->SetFont('','',9);
      $this->Cell(140,0,utf8_encode($row1['medicamento'].' | Via '.$row1['via'].' | '.$row1['frecuencia'].' Horas'),1,0,'C');
      $this->Cell(10,0,utf8_encode($row1['cant']),1,0,'C');
      $this->Cell(30,0,utf8_encode($row1['estado_admin']),1,0,'C');
      $this->Ln();
      $this->multiCell(180,0, utf8_encode($row1['obs_admin']),1,'L');

		}
    foreach($data2 as $row2) {
      $this->SetFont('','B',9);
      $this->Cell(180,0,'INTERPRETACION DE AYUDAS DIAGNOSTICAS',1,0,'C',1);
      $this->Ln();
      $this->SetFont('','B',8);
      $this->multiCell(180,0, utf8_encode('Fecha orden: '.$row2['fecha_orden'].' Diagnostico:'.$row2['dx'].' | '.$row2['tdx']),1,'L',1);
      $this->SetFont('','',9);
      $this->multiCell(180,0, utf8_encode($row2['cod_cups'].' | '.$row2['procedimiento']),1,'L');
      $this->multiCell(180,0, utf8_encode('Interpretacion: '.$row2['freg_inter'].' '.$row2['nota_inter']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row2['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row2['nombre']. ' Identificacion: ' .$row2['doc']. ' Registro Profesional: ' .$row2['rm_profesional']. ' Especialidad: '.$row2['espec_user']),1,'L');

    }
    foreach($data3 as $row3) {

      $this->SetFont('','B',10);
      $this->Cell(180,0, 'POST HOSPITALIZACION',1,0,'C',1);
      $this->SetFont('','B',8);
      $this->Ln();
      $this->MultiCell(180,0, utf8_encode($row3['freg'] .' |  Profesional: ' .$row3['nombre']. ' Registro Profesional: ' .$row3['rm_profesional']. ' Especialidad: ' .$row3['espec_user']),1,0,'L');
      $this->SetFont('','',7);
      $this->multiCell(180,0, utf8_encode($row3['obs_posthosp']),1,'L');
      $this->SetFont('','',1);
      $this->cell(70,20,$this->image(utf8_encode($row3['firma']) , $this->GetX(), $this->GetY(),30,20),1,'C');
      $this->SetFont('','B',9);
      $this->MultiCell(110,20, utf8_encode(' Profesional: ' .$row3['nombre']. ' Identificacion: ' .$row3['doc']. ' Registro Profesional: ' .$row3['rm_profesional']. ' Especialidad: '.$row3['espec_user']),1,'L');

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

$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==7) {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evomed,'EVOLUCION MEDICA' tipo_evo,k.freg_evomed fecha_evo,k.hreg_evomed hora_evo,
  concat('SUBJETIVO: ',k.subjetivo, '\nOBJETIVO: ',k.objetivo, ' \nANALISIS: ' ,k.analisis_evomed, ' \nPLAN TRATAMIENTO: ' ,k.plan_tratamiento,'\nJustificación de hospitalización: ' ,k.justificacion_hosp,
         '\nDiagnostico Principal: ', k.dxp,' ', k.ddxp,' ', k.tdxp,
         '\nDiagnostico Relacionado 1: ', k.dx1,' ', k.ddx1,' ', k.tdx1,
         '\nDiagnostico Relacionado 2: ', k.dx2,' ', k.ddx2,' ', k.tdx2) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evolucion_medica k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)
  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evomed BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evo_psico,'EVOLUCION PSICOLOGIA' tipo_evo,k.freg_evo_psico fecha_evo, k.hreg_evo_psico hora_evo,
  concat('TIPO SESION: ',k.tipo_sesion,' \nOBJETIVO SESION: ', k.obj_sesion,' \nACTIVIDADES: ', k.actividades,' \nRESULTADO:', k.resultado,' \nOBSERVACION: ', k.obs_evo_psico) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_psicologia k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evo_psico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evoto,'EVOLUCION TERAPIA OCUPACIONAL' tipo_evo, k.freg_evoto fecha_evo, k.hreg_evoto hora_evo,
  concat('OBJETIVO: ',k.obj_sesion,' \nACTIVIDADES: ', k.actividades,' \nRESULTADO: ', k.resultado) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_to k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evoto BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_notaenfermeria,'NOTA DE ENFERMERIA' tipo_evo, k.freg_nota fecha_evo, k.hreg_nota hora_evo, k.descripnota evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join nota_enfermeria k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_nota BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,

  j.nom_eps,
  k.id_evots,'TRABAJO SOCIAL' tipo_evo, k.freg_evots fecha_evo, k.hreg_evots hora_evo, k.evolucion_ts evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_ts k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evots BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,

  j.nom_eps,
  k.id_tsce_sm,'VALORACION TRABAJO SOCIAL' tipo_evo, k.freg_tsce_sm fecha_evo, k.hreg_tsce_sm hora_evo,
  concat('Historia familiar: ',k.h_familiar,' \nEstudio socioeconomico: ',k.estudio_socio,' \nConcepto: ',k.concepto_ts,' \nRecomendaciones: ',k.recomendaciones) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join tsce_sm k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_tsce_sm BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_val_nutri,'NUTRICION Y DIETETICA' tipo_evo, k.freg_nutri fecha_evo, k.hreg_nutri hora_evo, concat('Motivo Consulta: ',k.motivo_nutri,'\nValoración Nutricional: ', k.val_nutricional,'\nDiagnostico: ', k.dx_nutricional,'\nPlan Nutricional: ', k.plan_nutricional )evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente

        inner join eps j on (j.id_eps=b.id_eps)
        inner join val_nutricion k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_nutri BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evonutri,'NUTRICION Y DIETETICA' tipo_evo, k.freg_nutrice_sm fecha_evo, k.hreg_nutrice_sm hora_evo,k.evolucion_nutri evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente

        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_nutrism k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_nutrice_sm BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  UNION

  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evotera idter, k.tterapia tipo_evo, k.freg_evotera fecha_evo, k.hreg_evotera hora_evo, k.evoluciontera evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_terapeutica_sm k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evotera BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'



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
  $f1=$_GET["f1"];
  $f2=$_GET["f2"];
  $sql1="SELECT d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
               e.id_dosi_med, freg_farmacia,obs_dosi, fadmin, nom_admin, sum(cant_admin) cant, estado_admin,
               obs_admin,
               f.nombre administrado,especialidad
        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                         LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
                         LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                         LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                         LEFT JOIN user f on f.id_user=e.resp_adm

        WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and  nom_dosi in ('6am-8am','12m-2pm','6pm-8pm','10pm-12pm')
                                                         and freg_farmacia BETWEEN '".$f1."' and '".$f2."'
                                                         and e.estado_admin in ('Administrado','Devuelto')

        GROUP BY d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,freg_farmacia
        ORDER by fadmin ASC";
  //echo $sql1;
  $rs1 = mysql_query($sql1);
  if (mysql_num_rows($rs1)>0){
      $i=0;
      while($rw1 = mysql_fetch_array($rs1)){
          $data1[] = $rw1;
    }
  }
}

$f1=$_GET["f1"];
$f2=$_GET["f2"];
  $sql2="SELECT a.doc_pac,nom_completo,
               b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
               c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
               d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion,
               estado_prod, freg_muestra, resp_muestra, obs_muestra,freg_procesa, resp_procesa, obs_procesa,
               freg_inter, nota_inter, resp_inter,
               e.nom_eps,
               f.nombre interpretado,especialidad,firma
        FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                         LEFT JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
                         LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
                         LEFT JOIN eps e on e.id_eps = b.id_eps
                         LEFT JOIN user f on f.id_user=d.resp_inter
        WHERE d.freg BETWEEN '$f1' and '$f2' and  b.id_adm_hosp='".$_REQUEST['idadmhosp']."'
        and estado_prod in ('Interpretado')
        ORDER BY freg_inter ASC";

  $rs2 = mysql_query($sql2);
  if (mysql_num_rows($rs2)>0){
      $i=0;
      while($rw2 = mysql_fetch_array($rs2)){

          $data2[] = $rw2;
    }
  }
  $f1=$_GET["f1"];
  $f2=$_GET["f2"];
    $sql3="SELECT a.doc_pac,nom_completo,
                 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
                 c.idphosp,freg,obs_posthosp,
                 e.nom_eps,
                 f.nombre,rm_profesional,f.especialidad espec_user,firma
          FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                           LEFT JOIN post_hospitalizado c on c.id_adm_hosp=b.id_adm_hosp
                           LEFT JOIN eps e on e.id_eps = b.id_eps
                           LEFT JOIN user f on f.id_user=c.id_user
          WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."'
          ORDER BY freg ASC";

    $rs3 = mysql_query($sql3);
    if (mysql_num_rows($rs3)>0){
        $i=0;
        while($rw3 = mysql_fetch_array($rs3)){

            $data3[] = $rw3;
      }
    }
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==1) {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evomed,'EVOLUCION MEDICA' tipo_evo,k.freg_evomed fecha_evo,k.hreg_evomed hora_evo,
  concat('SUBJETIVO: ',k.subjetivo, '\nOBJETIVO: ',k.objetivo, ' \nANALISIS: ' ,k.analisis_evomed, ' \nPLAN TRATAMIENTO: ' ,k.plan_tratamiento,' \nJustificación de hospitalización: ' ,k.justificacion_hosp,
         '\nDiagnostico Principal: ', k.dxp,' ', k.ddxp,' ', k.tdxp) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evolucion_medica k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)
  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evomed BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
  ORDER BY fecha_evo ASC, hora_evo ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==2) {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_notaenfermeria,'NOTA DE ENFERMERIA' tipo_evo, k.freg_nota fecha_evo, k.hreg_nota hora_evo, k.descripnota evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join nota_enfermeria k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_nota BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
  ORDER BY fecha_evo ASC, hora_evo ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==3) {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evoto,'EVOLUCION TERAPIA OCUPACIONAL' tipo_evo, k.freg_evoto fecha_evo, k.hreg_evoto hora_evo,
  concat('OBJETIVO: ',k.obj_sesion,' \nACTIVIDADES: ', k.actividades,' \nRESULTADO: ', k.resultado) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_to k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evoto BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
  ORDER BY fecha_evo ASC, hora_evo ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}

$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==4) {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evo_psico,'EVOLUCION PSICOLOGIA' tipo_evo,k.freg_evo_psico fecha_evo, k.hreg_evo_psico hora_evo,
  concat('TIPO SESION: ',k.tipo_sesion,' \nOBJETIVO SESION: ', k.obj_sesion,' \nACTIVIDADES: ', k.actividades,' \nRESULTADO:', k.resultado,' \nOBSERVACION: ', k.obs_evo_psico) evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_psicologia k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_evo_psico BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
  ORDER BY fecha_evo ASC, hora_evo ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==5) {
  $sql1="SELECT d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
               e.id_dosi_med, freg_farmacia,obs_dosi, fadmin, nom_admin, sum(cant_admin) cant, estado_admin,
               obs_admin,
               f.nombre administrado,especialidad
        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                         LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
                         LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                         LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                         LEFT JOIN user f on f.id_user=e.resp_adm

        WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and  nom_dosi in ('6am-8am','12m-2pm','6pm-8pm','10pm-12pm')
                                                         and freg_farmacia BETWEEN '".$f1."' and '".$f2."'
                                                         and e.estado_admin in ('Administrado','Devuelto')

        GROUP BY d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,freg_farmacia
        ORDER by fadmin ASC";
  //echo $sql1;
  $rs1 = mysql_query($sql1);
  if (mysql_num_rows($rs1)>0){
      $i=0;
      while($rw1 = mysql_fetch_array($rs1)){
          $data1[] = $rw1;
    }
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==6) {
  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_val_nutri,'VALORACIÓN NUTRICIONAL' tipo_evo, k.freg_nutri fecha_evo, k.hreg_nutri hora_evo, concat('Motivo Consulta: ',k.motivo_nutri,'\nValoración Nutricional: ',
     k.val_nutricional,'\nDiagnostico: ', k.dx_nutricional,'\nPlan Nutricional: ', k.plan_nutricional )evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente

        inner join eps j on (j.id_eps=b.id_eps)
        inner join val_nutricion k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_nutri BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'
  UNION
  SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
  j.nom_eps,
  k.id_evonutri,'NUTRICION Y DIETETICA' tipo_evo, k.freg_nutrice_sm fecha_evo, k.hreg_nutrice_sm hora_evo,k.evolucion_nutri evolucion,
  l.nombre,rm_profesional,l.especialidad espec_user,firma
  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente

        inner join eps j on (j.id_eps=b.id_eps)
        inner join evo_nutrism k on (k.id_adm_hosp=b.id_adm_hosp)
        inner join user l on (l.id_user=k.id_user)

  where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and k.freg_nutrice_sm BETWEEN '".$_GET["f1"]."' and '".$_GET["f2"]."'

  ORDER BY fecha_evo ASC, hora_evo ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==8) {
  $sql2="SELECT a.doc_pac,nom_completo,
               b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
               c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
               d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion,
               estado_prod, freg_muestra, resp_muestra, obs_muestra,freg_procesa, resp_procesa, obs_procesa,
               freg_inter, nota_inter, resp_inter,
               e.nom_eps
        FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                         LEFT JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
                         LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
                         LEFT JOIN eps e on e.id_eps = b.id_eps
        WHERE d.freg BETWEEN '$f1' and '$f2' and  b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and estado_prod in ('Interpretado','Procesada')
        ORDER BY freg_inter ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}
$f1=$_GET["f1"];
$f2=$_GET["f2"];
$tipoterapia=$_REQUEST['tipo_terapia'];
if ($tipoterapia==9) {
  $sql2="SELECT a.doc_pac,nom_completo,
               b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
               c.idphosp,freg,obs_posthosp,
               e.nom_eps,
               f.nombre,rm_profesional,f.especialidad espec_user,firma
        FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                         LEFT JOIN post_hospitalizado c on c.id_adm_hosp=b.id_adm_hosp
                         LEFT JOIN eps e on e.id_eps = b.id_eps
                         LEFT JOIN user f on f.id_user=c.id_user
        WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."'
        ORDER BY freg ASC";

  $rs = mysql_query($sql);
  if (mysql_num_rows($rs)>0){
      $i=0;
      while($rw = mysql_fetch_array($rs)){

          $data[] = $rw;
    }
  }
}
// print colored table
$pdf->ColoredTable($header, $data, $data1, $data2, $data3);

// ---------------------------------------------------------
// Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
$nombre=$_GET["nom"];
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
