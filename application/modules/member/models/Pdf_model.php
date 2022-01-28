<?php 
require_once APPPATH.'third_party/TCPDF/tcpdf.php';

class Pdf_model extends MY_Model {
	function print_out($data){
		$w=55;
		$h=10;
		$txt='';
		$border=0;
		$ln=1;
		$align='';
		$fill=0;
		$link='';
		$stretch=0;
		$ignore_min_height='';
		$calign='';
		$valign='';

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('P',  array('166','230'));
        // set style for barcode
        $style = array(
            'border' => false,
            'padding' => 0,
            'fgcolor' => array(0,0,0),
            'bgcolor' => false
        );

         $pdf->write2DBarcode('http://localhost', 'QRCODE', 100, 30, 50, 50, $style);

        //$pdf->SetFont('cid0ct', '', 20);
        $pdf->Cell($w, $h, 'Title: '.$data['title'], $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign); 

        $pdf->Output('QRCODE.pdf', 'I');

	}
}