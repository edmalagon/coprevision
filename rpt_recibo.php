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
        $n1='ASOCIACIÓN MUTUAL DE SERVICIOS';
        $n2=' SOCIALES';
        $n3='PARA TRABAJADORES INDEPENDIENTES';
        $titulo='PREVISOCIAL -- NIT 832011119-3';

        $this->cell(25,0,$this->image($image_file , $this->GetX(), $this->GetY(),20,20),0,'L');
        $this->SetFont('','B',9);
        $this->multiCell(60,0,$n1.$n2.$n3,0,'C');

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

      $this->SetFont('','B',10);
      $this->Cell(30,0,'Beneficiario:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(150,0, utf8_encode($row['nom_completo']),1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(8,0,'DI:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(30,0, $row['tdoc_cli'].': '.$row['doc_cli'],1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(142,0,'Pago Seguridad social '.$row['mes_pago'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'Dirección:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(50,0, $row['dir_cli'],1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(15,0,'Fijo:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(30,0, $row['fijo'],1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(15,0,'Celular:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(30,0, $row['celular'],1,0,'C');
      $this->Ln();
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'EPS:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['eps'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_eps'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'AFP:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['afp'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_afp'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'ARP:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['arp'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_arp'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'CCF:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['ccf'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_ccf'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'T admin:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, 'Tarifa Administrativa',1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['tadm'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'Total:',1,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(100,0, 'Total servicio ',1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(60,0, '$ '.$row['t_servicio'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(60,0,'Firma y cedula del beneficiario:',1,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(120,30, '___________________________________',1,0,'C');
      $this->Ln();
      $this->Ln();
      $this->Ln();

      $image_file = 'images/previsocial.jpg';
      $n1='ASOCIACIÓN MUTUAL DE SERVICIOS';
      $n2=' SOCIALES';
      $n3='PARA TRABAJADORES INDEPENDIENTES';
      $titulo='PREVISOCIAL -- NIT 832011119-3';

      $this->cell(25,0,$this->image($image_file , $this->GetX(), $this->GetY(),20,20),0,'L');
      $this->SetFont('','B',9);
      $this->multiCell(60,0,$n1.$n2.$n3,0,'C');
      $this->Ln(10);
      $this->SetFont('','B',10);
      $this->Cell(30,0,'Beneficiario:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(150,0, utf8_encode($row['nom_completo']),1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(8,0,'DI:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(30,0, $row['tdoc_cli'].': '.$row['doc_cli'],1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(142,0,'Pago Seguridad social '.$row['mes_pago'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'Dirección:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(50,0, $row['dir_cli'],1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(15,0,'Fijo:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(30,0, $row['fijo'],1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(15,0,'Celular:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(30,0, $row['celular'],1,0,'C');
      $this->Ln();
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'EPS:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['eps'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_eps'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'AFP:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['afp'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_afp'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'ARP:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['arp'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_arp'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'CCF:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, $row['ccf'],1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['t_ccf'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'T admin:',1,0,'L');
      $this->SetFont('','',10);
      $this->Cell(100,0, 'Tarifa Administrativa',1,0,'C');
      $this->SetFont('','',10);
      $this->Cell(60,0, '$ '.$row['tadm'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,0,'Total:',1,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(100,0, 'Total servicio ',1,0,'C');
      $this->SetFont('','B',10);
      $this->Cell(60,0, '$ '.$row['t_servicio'],1,0,'C');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(60,0,'Firma y cedula del beneficiario:',1,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(120,30, '___________________________________',1,0,'C');
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
             e.nom_convenio,tadm,
             f.salario,clase_riesgo,
             g.mes_pago, t_eps, t_afp, t_arp, t_ccf, t_servicio, dias_laborados, valor_dias_laborados, dias_mora, porcen_mora,
             h.nombre afp,
             i.nombre ccf,
             j.nombre arp

      FROM cliente a INNER JOIN afiliacion f on a.id_cliente=f.id_cliente
                     INNER JOIN empresa d on d.id_empresa=f.id_empresa
                     INNER JOIN convenio e on e.id_convenio=f.id_convenio
                     LEFT JOIN obligacion g on f.id_afiliacion=g.id_afiliacion
                     LEFT JOIN ocupacion c on f.ocupacion=c.id_ocupacion
                     LEFT JOIN aseguradora b on b.id_aseguradora=f.eps_afiliacion
                     LEFT JOIN aseguradora h on h.id_aseguradora=f.afp_afiliacion
                     LEFT JOIN aseguradora i on i.id_aseguradora=f.ccf_afiliacion
                     LEFT JOIN aseguradora j on j.id_aseguradora=f.arp_afiliacion
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
