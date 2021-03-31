<?php
session_start();

/**
*   Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
require_once(__DIR__ . '/class/user.class.php');
require_once(__DIR__ . '/class/inventory.class.php');
require_once(__DIR__ . '/class/location.class.php');
require_once(__DIR__ . '/class/device.class.php');
require_once(__DIR__ . '/class/bpp.class.php');
require('assets/plugins/fpdf181/fpdf.php');

class PDF extends FPDF
{

    // Page header
    function Header()
    {
        $this->invClass  = new Inventory();
        $report_name = ucwords(str_replace("_", " ", $_GET['name']));
        // Logo
        if ($this->invClass->setting_data("inventory_logo")!="") { 
            $logo_image = "assets/images/".$this->invClass->setting_data("inventory_logo"); } 
        else {
            $logo_image = "assets/images/logo.png";
        }
        $this->Image($logo_image,10,6,40);

        // Arial bold 15
        // Move to the right
        // Title
        $this->SetFont('Arial','B',15);
        $this->Cell(120);
        $this->Cell(30,10,$this->invClass->setting_data("inventory_name"),0,1,'C');

        $this->SetFont('Arial','',12);
        $this->Cell(120);
        $this->Cell(30,5,'Report '.$report_name,0,1,'C');

        $this->SetFont('Arial','',12);
        $this->Cell(120);
        $this->Cell(30,10,'Perumda Tirta Albantani',0,1,'C');
        
        // Line break
        $this->Ln(10);
        
        // $this->Line(10,30,290,30);

        // Table header
        
        $this->SetFont('Arial','B',9);
        $this->Cell(12, 10, "No", 1, 0);
        $this->Cell(20, 10, "Req Banyak", 1, 0);
        $this->Cell(20, 10, "Satuan", 1, 0);
        $this->Cell(60, 10, "Kode", 1, 0);
        $this->Cell(30, 10, "Uraian", 1, 0);
        $this->Cell(20, 10, "Out Banyak", 1, 0);
        $this->Cell(20, 10, "Satuan", 1, 0);
        $this->Cell(60, 10, "Kode", 1, 0);
        //$this->Cell(20, 10, "device_id", 1, 0);
        $this->Cell(20, 10, "Total", 1, 0);
        $this->Cell(15, 10, "tanggal", 1, 1); 

    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

        $this->Cell(0,10,$this->invClass->setting_data("inventory_users"),0,0,'C');


    }

    function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
        $this->Cell(40,7,$col,1)->invClass->setting_data("inventory_users");
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

    function SetCol($col)
    {
    // Set position at a given column
    $this->col(0,0,$this->invClass->setting_data("inventory_users"),10,5);
    $this->col = $col;
    $x = 10+$col*65;
    //$this->SetLeftMargin($x);
    //$this->Cell(0,0,$this->invClass->setting_data("inventory_users"),10,5)->SetX($x);
    
    }

    // function Print($dt_bpp)
    // {
    // $this->bppClass  = new BppClass();
    // $bpp = $bppClass->add_bpp_history();
    // }    
    function _checkoutput()
    {
        //  $this->bppClass  = new BppClass();
        // $bpp = $bppClass->add_bpp_history();
    }
    function _dochecks()
    {

    }
}

// Instanciation of inherited class
$invClass      = new Inventory();
//$deviceClass   = new DeviceClass();
$bppClass   	= new BppClass();
$locationClass = new LocationClass();
$pdf           = new PDF('L');
//$report_name   = ucwords(str_replace("_", " ", $_GET['name']));
$pdf->AliasNbPages();
//$pdf->SetTitle($invClass->setting_data("inventory_name")." Report " . $report_name);
$pdf->SetCreator("Permana Cakra");
$pdf->SetAuthor("Permana Cakra");
//$pdf->SetSubject($invClass->setting_data("inventory_name")." Report " . $report_name);
$pdf->AddPage();
$pdf->SetFont('Times','',8);
// $bppClass->add_bpp_history();
// Get Datas
$by       = $_GET['by'];
$criteria = '';

// If criteria is set
if (isset($_GET['criteria']) && $_GET['criteria']!='') {
    $criteria = $_GET['criteria'];
}
 
$no = 0;
 

 $datas = $bppClass->show_bpp_report($by, $criteria); 
 //$datax = $bppClass->show_bpp_report_users($by);



                

foreach ($datas as $data) {
    $no++;




    
    // // if location details enabled
    // if ($invClass->setting_data("location_details")=="enable") {
    //     $locationdetail = $data['place_name'].", ".$data['building_name'].", ".$data['floor_name'].", ".$data['location_name'];
    // }
    // else {
    //     $locationdetail = $data['location_name'];
    

    $pdf->Cell(12, 10, $no, 1, 0);
    $pdf->Cell(20, 10, $data['request_quantity'], 1, 0);
    $pdf->Cell(20, 10, $data['request_unit'], 1, 0);
    $pdf->Cell(60, 10, $data['request_code'], 1, 0);
    $pdf->Cell(30, 10, $data['request_description'], 1, 0);
    $pdf->Cell(20, 10, $data['out_quantity'], 1, 0);
    $pdf->Cell(20, 10, $data['out_unit'], 1, 0);
    $pdf->Cell(60, 10, $data['out_code'], 1, 0);
    //$pdf->Cell(20, 10, $data['device_id'], 1, 0);
    $pdf->Cell(20, 10, $data['out_total'], 1, 0);


    
    $pdf->Cell(15, 10, $data['tanggal'], 1, 1);
    // $pdf->MultiCell(0, 50, strip_tags($data['request_description']));
}


// foreach ($datax as $data1) {


// $pdf->Cell(30, 10, $data1['inventory_users'],  5, 10);

// }

$pdf->Output();
?>