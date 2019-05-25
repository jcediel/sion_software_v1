
    <?php
    ini_set('display_errors', 0);
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);

require_once('conexion.php');



    $result = mysql_query("SELECT * FROM tblbtcmembers order by mname");


    while($row = mysql_fetch_array($result))
      {
       $pid = $row['pid'];
       $mname = $row['mname'];
       $msurname = $row['msurname'];
       $mcontactno = $row['mcontactno'];
       $memail = $row['memail'];
       $mkennelname = $row['mkennelname'];

      }

      // Get UserID
    $userid=$_SESSION['account_id'];
    $username=$_SESSION['login_id'];





    //============================================================+
    // File name   : example_048.php
    // Begin       : 2009-03-20
    // Last Update : 2013-05-14
    //
    // Description : Example 048 for TCPDF class
    //               HTML tables and table headers
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
     * @abstract TCPDF - Example: HTML tables and table headers
     * @author Nicola Asuni
     * @since 2009-03-20
     */

    // Include the main TCPDF library (search for installation path).
    require_once('tcpdf_include_litter_reg.php');

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            // Logo
            $image_file = K_PATH_IMAGES.'tcpdf_logo-bak-20aug-15.jpg';
            $this->Image($image_file, 10, 10, '', '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
             // Set font
            $this->SetFont('helvetica', 'B', 20);
             // Position at 273 mm from bottom
            $this->SetY(-273);
            // Position at 40 mm from left
            $this->SetX(40);
            // Title
           $this->Cell(120, 15, 'Biewer Terrier Club Member List', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'L', 0, '', 0, false, 'T', 'M');


        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('BTCSA');
    $pdf->SetTitle('MemberList');
    $pdf->SetSubject('MemberList');
    $pdf->SetKeywords('MemberList');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);



    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------
