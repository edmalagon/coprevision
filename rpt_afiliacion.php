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
        $empresa=$_REQUEST['emp'];
        if ($empresa=='PREVISOCIAL') {
          $image_file = 'images/previsocial.jpg';
          $n1='ASOCIACIÓN MUTUAL DE SERVICIOS';
          $n2='SOCIALES';
          $n3='PARA TRABAJADORES INDEPENDIENTES';
          $titulo='PREVISOCIAL -- NIT 832011119-3';
        }
        if ($empresa=='PREVISION') {
          $image_file = 'images/prevision.jpg';
          $n1='PREVISION DESARROLLO HUMANO SAS';
          $n2='NIT 900854414-5';
          $n3='SOLICITUD DE INGRESO';
          $titulo='';

        }

        $this->multicell(180,10,$this->image($image_file, $this->GetX(), $this->GetY(),20,20),0,'C');
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(180, 5, $n1, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(180, 5, $n2, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(180, 5, $n3, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(180, 5, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
		$this->Ln(30);
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		foreach($data as $row) {
      $empresa=$_REQUEST['emp'];
      if ($empresa=='PREVISOCIAL') {
        $presen='Señores: JUNTA DIRECTIVA';
        $txt1='Comedidamente solicito a ustedes considerar mi ingreso como ASOCIADO MUTUALISTA a PREVISOCIAL ASOCIACION MUTUAL DE SERVICIOS SOCIALES';
        $txt2='';
        $txt3='Manifiesto que conozco los estatutos y reglamento interno de PREVISOCIAL, me acogeré íntegramente a ellos y me comprometo a cancelar el valor de los aportes a contribuciones por razón de los servicios adquiridos el primer día hábil de cada mes,';
        $txt4='PARAGRAFO 01: En caso de retiro me comprometo a reportar a la respectiva EPS por medio de carta a más tardar el día 05 del mes siguiente. En caso de pagar después de la fecha de pago estipulada, la persona debe asumir los intereses por mora generados.';
        $txt5='';
        $firma='PREVISOCIAL';
      }
      if ($empresa=='PREVISION') {
        $presen='Señores: Departamento Administrativo';
        $txt1='Comedidamente solicito la afiliación ante el sistema de Seguridad Social a través de su entidad, como lo consagra el Articulo 48 de la constitución Nacional, debido a que los ingresos que percibo en forma periódica mensual por concepto de mi trabajo como Independiente son insuficientes para realizar la totalidad de los aportes establecidos en la ley para cada uno de los sistemas; y requiero de los subsidios que la norma otorga a través de las empresa.';
        $txt2='Por medio del presente documento autorizo el trámite de mi vinculación a Previsión  y afiliación al Sistema de seguridad social integral.';
        $txt3='PARAGRAFO 01 En el evento de ocurrir un accidente laboral este será informado por el trabajador al Mandante en el transcurso de las 24 horas siguientes al accidente, para efectuar el reporte e investigación del mismo, de lo contrario la ARL no responde por las prestaciones  asistenciales y económicas.';
        $txt4='PARAGRAFO 02: La Función que cumple en el presente Mandato Servicios Y consultorías Sabana MR SAS es de medio y no de resultado, es decir que los servicios asistenciales y económicos serán prestados directamente por las entidades administradoras del sistema para lo que se exige estar al día en el pago de aportes.';
        $txt5='PARAGRAFO 03: En caso de retiro se debe informar dentro del último mes en que se ha realizado pago. En caso de pagar después de la fecha de pago estipulada, la persona debe asumir el  valor del retiro y los intereses por mora generados.';
        $firma='PREVISION SAS';
      }
      $this->SetFont('','B',12);
      $this->Cell(180,0,'SOLICITUD DE INGRESO:',0,0,'L');
      $this->Ln(3);
      $this->SetFont('','',12);
      $this->Ln();
      $this->Cell(180,20,$presen,0,0,'L');
      $this->Ln();
      $this->SetFont('','',10);
      $this->MultiCell(180,5,$txt1,0,'L');
      $this->MultiCell(180,5,$txt2,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(40,0,'Nombre y apellidos:',0,0,'L');
      $this->SetFont('','B',12);
      $this->Cell(180,0,utf8_encode($row['nom_completo']),0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(25,0,'Documento:',0,0,'L');
      $this->SetFont('','B',12);
      $this->Cell(40,5,utf8_encode($row['tdoc_cli'].': '.$row['doc_cli']),0,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(35,0,'Fecha Nacimiento:',0,0,'L');
      $this->Cell(20,0, $row['fnacimiento'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(20,10,'Email:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(100,10, $row['email_cli'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(50,10,'Dirección de residencia:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(100,10, $row['dir_cli'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(50,10,'Contacto telefonico:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(100,10, 'Teléfono fijo: '.$row['fijo'].' -- Teléfono fijo: '.$row['celular'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(30,10,'Ocupacion:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(50,10,$row['nom_ocupacion'],0,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(20,10,'Gremio:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(30,10,$row['gremio'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(10,8,'EPS:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(50,8,$row['eps'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(10,8,'AFP:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(50,8,$row['afp'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(10,8,'ARP:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(150,8,$row['arp'],0,0,'L');
      $this->SetFont('','B',10);
      $this->Cell(20,8,'Clase Riesgo: '.$row['clase_riesgo'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(10,8,'CCF:',0,0,'L');
      $this->SetFont('','',12);
      $this->Cell(50,8,$row['ccf'],0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(10,8,'I.B.C:',0,0,'L');
      $this->SetFont('','',14);
      $this->Cell(50,8,'$ '.$row['salario'],0,0,'L');
      $this->Ln();
      $this->SetFont('','',8);
      $this->MultiCell(180,0,$txt3 ,0,'L');
      $this->Ln(1);
      $this->MultiCell(180,0, $txt4,0,'L');
      $this->Ln(1);
      $this->MultiCell(180,0, $txt5,0,'L');
      $this->Cell(50,8,'Solicitante. ',0,0,'L');
      $this->Ln();
      $this->SetFont('','B',10);
      $this->Cell(80,8,'Firma:_______________________. ',0,0,'L');
      $this->Cell(100,8,'Fecha ingreso:______________________. ',0,0,'L');
      $this->Ln();
      $this->Cell(80,8,'CC:_________________________. ',0,0,'L');
      $this->Cell(100,0,'Fecha Egreso:______________________. ',0,0,'L');
      $this->Ln(14);
      $this->Cell(180,0,$firma.':_______________________________. '.$row['registra'],0,0,'C');
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

$sede=$_REQUEST['ida'];
$sql="SELECT a.tdoc_cli,doc_cli,nom_completo,dir_cli,fijo,fnacimiento,celular,gremio,
             b.nombre eps,
             c.nom_ocupacion,porcen_nivel,
             d.nom_empresa,
             e.nom_convenio,
             f.salario,clase_riesgo,
             g.mes_pago, t_eps, t_afp, t_arp, t_ccf, t_servicio, dias_laborados,
             valor_dias_laborados, dias_mora, porcen_mora,
             h.nombre afp,
             i.nombre ccf,
             j.nombre arp,
             k.nombre registra

      FROM cliente a INNER JOIN afiliacion f on a.id_cliente=f.id_cliente
                     INNER JOIN empresa d on d.id_empresa=f.id_empresa
                     INNER JOIN convenio e on e.id_convenio=f.id_convenio
                     LEFT JOIN obligacion g on f.id_afiliacion=g.id_afiliacion
                     LEFT JOIN ocupacion c on f.ocupacion=c.id_ocupacion
                     LEFT JOIN aseguradora b on b.id_aseguradora=f.eps_afiliacion
                     LEFT JOIN aseguradora h on h.id_aseguradora=f.afp_afiliacion
                     LEFT JOIN aseguradora i on i.id_aseguradora=f.ccf_afiliacion
                     LEFT JOIN aseguradora j on j.id_aseguradora=f.arp_afiliacion
                     LEFT JOIN user k on k.id_user=f.resp_reg
      WHERE f.id_afiliacion=$sede

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
$nombre='ingreso';
// close and output PDF document
$pdf->Output($nombre.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
