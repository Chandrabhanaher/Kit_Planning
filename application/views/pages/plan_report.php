<?php
   
   
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UGC');
$pdf->SetTitle('Kit Report');
$pdf->SetSubject('Tutorials');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Atlas Copco India Limited', PDF_HEADER_STRING);

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
if (file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage('L', 'A4');
foreach($records1 as $value1) {    
    $ar_no = $value1->ARTICLE_NO;
    $ar_desc = $value1->ARTICLE_DEC;   
    $seq = $value1->SEQ_NO;
}
$data = 'Sequence No. : '.$seq
        .'Article No : '.$ar_no
        .' QTY :'.$ar_qry;
$size = '100x100';
$logo = 'https://www.atlascopco.com/etc/designs/accommons/img/png/logo.png';
$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));

$logo = imagecreatefromstring(file_get_contents($logo));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);

$logo_width = imagesx($logo);
$logo_height = imagesy($logo);

// Scale logo to fit in the QR Code
$logo_qr_width = $QR_width/3;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;
imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
header('Content-type: image/png');
imagepng($QR);
imagedestroy($QR);

$style = array(
    'border' => 0,
    'padding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => FALSE
);
$heading = <<<EOD
        <h2>Kit Report</h2>
        <h3>Sequence No.: $seq</h3>
        <P>
            <label>Article No.: $ar_no</label>&nbsp;
            <label>Description: $ar_desc</label>
        </p>
  
EOD;

$pdf->writeHTMLCell(0,0,'','',$heading, 0, 1, 0, true, 'C',true);
$pdf->write2DBarcode($data, 'QRCODE,H', 15,20,20,20, $style, 'N');

$pdf->Ln(8);
$table ='<table style = "border:1px solid black">';
$table .='<tr>
        <th style = "border:1px solid black;font-weight:bold;width:5%;align:center;">No.</th>               
        <th style = "border:1px solid black;font-weight:bold;width:8%;align:center;">Child</th>
        <th style = "border:1px solid black;font-weight:bold;width:15%;align:center;">Desc</th>
        <th style = "border:1px solid black;font-weight:bold;width:6%;align:center;">Plan Qty</th>
        <th style = "border:1px solid black;font-weight:bold;width:5%;align:center;">Bom Qty</th>
        <th style = "border:1px solid black;font-weight:bold;width:4%;align:center;">Req.Qty</th>
        <th style = "border:1px solid black;font-weight:bold;width:6%;align:center;">Stock</th>
        <th style = "border:1px solid black;font-weight:bold;width:6%;align:center;">Virtual Stock</th>
        <th style = "border:1px solid black;font-weight:bold;width:7%;align:center;">WH Location</th>
        <th style = "border:1px solid black;font-weight:bold;width:8%;align:center;">2 Bin</th>
        <th style = "border:1px solid black;font-weight:bold;width:8%;align:center;">Part Status</th>
        <th style = "border:1px solid black;font-weight:bold;width:9%;align:center;">Remark 1</th>
        <th style = "border:1px solid black;font-weight:bold;width:9%;align:center;">Remark 2</th>
        </tr>';
$i = 1;
foreach ($records as $re){
    $table .= '<tr>'
            . '<td style = "border:1px solid black;text-align: right;width:5%;">'.$i++.'</td>'           
            . '<td style = "border:1px solid black;text-align: left;width:8%;">'.$re->child.'</td>'                        
            . '<td style = "border:1px solid black;text-align: left;width:15%;">'.$re->bom_desc.'</td>'
            . '<td style = "border:1px solid black;text-align: right;width:6%;"></td>' 
            . '<td style = "border:1px solid black;text-align: right;width:5%;">'.$re->bom_child_qty.'</td>' 
            . '<td style = "border:1px solid black;text-align: right;width:4%;">'.$re->req_stock.'</td>' 
            . '<td style = "border:1px solid black;text-align: right;width:6%;">'.$re->stock.'</td>' 
            . '<td style = "border:1px solid black;text-align: right;width:6%;">'.$re->avl_stock.'</td>'
            . '<td style = "border:1px solid black;text-align: left;width:7%;">'.$re->WH_loc.'</td>'
            . '<td style = "border:1px solid black;text-align: left;width:8%;">'.$re->line_side_2_bin.'</td>'
            . '<td style = "border:1px solid black;text-align: left;width:8%;">'.$re->part_status.'</td>'
            . '<td style = "border:1px solid black;text-align: left;width:9%;"></td>' 
            . '<td style = "border:1px solid black;text-align: left;width:9%;"></td>' 
            . '</tr>';
}
$table .='</table>';

$pdf->writeHTMLCell(0,0,'','',$table, 0, 1, 0, true, 'C',true);
//Close and output PDF document
ob_clean();
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
