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
 mysql_select_db("previsocial");
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
	public function Header() {
        // Logo

        $image_file = 'images/previsocial.jpg';

        $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),20,20),0,'L');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 20, 'RECIBO DE PAGO '.$nsede, 1, false, 'R', 0, '', 0, false, 'M', 'M');

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

      $this->SetFont('','B',7);
      $this->Cell(11,0,'Cliente:',1,0,'L');
      $this->SetFont('','',7);
      $this->Cell(50,0, utf8_encode($row['nom_completo']),1,0,'L');
      $this->SetFont('','B',7);
      $this->Cell(5,0,'DI:',1,0,'L');
      $this->SetFont('','',7);
      $this->Cell(25,0, $row['tdoc_cli'].': '.$row['doc_cli'],1,0,'L');
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

$sede=$_REQUEST['ido'];
$sql="SELECT a.tdoc_cli,doc_cli,nom_completo,dir_cli,fijo,celular,
             b.nombre eps,
             c.nom_ocupacion,porcen_nivel,
             d.nom_empresa,
             e.nom_convenio,
             f.salario,clase_riesgo,
             g.mes_pago, t_eps, t_afp, t_arp, t_ccf, t_servicio, dias_laborados, valor_dias_laborados, dias_mora, porcen_mora,
             h.nombre afp,
             i.nombre ccf,
             j.nombre arp

      FROM cliente a INNER JOIN afiliacion f on a.id_cliente=f.id_cliente
                     INNER JOIN empresa d on d.id_empresa=f.id_empresa
                     INNER JOIN convenio e on e.id_convenio=f.id_convenio
                     LEFT JOIN obligacion g on f.id_afiliacion=g.id_afiliacion
                     INNER JOIN ocupacion c on f.ocupacion=c.id_ocupacion
                     INNER JOIN aseguradora b on b.id_aseguradora=f.eps_afiliacion
                     INNER JOIN aseguradora h on h.id_aseguradora=f.afp_afiliacion
                     INNER JOIN aseguradora i on i.id_aseguradora=f.ccf_afiliacion
                     INNER JOIN aseguradora j on j.id_aseguradora=f.arp_afiliacion
      WHERE g.id_obligacion=$sede

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
$nombre='lista dieta';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
