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
require('assets/plugins/fpdf181/fpdf.php');

class PDF extends FPDF
{

    // Page header
    function Header()
    {
        $this->invClass  = new Inventory();
        // Logo
        if ($this->invClass->setting_data("inventory_logo")!="") { 
            $logo_image = "assets/images/".$this->invClass->setting_data("inventory_logo"); } 
        else {
            $logo_image = "assets/images/logo.png";
        }
        $this->Image($logo_image,10,6,50);
        

        // Arial bold 15
        // Move to the right
        // Title
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,$this->invClass->setting_data("inventory_name"),0,1,'C');

        $this->SetFont('Arial','',12);
        $this->Cell(80);
        $this->Cell(30,5,'Detailed Report',0,0,'C');
        // Line break
        $this->Cell(80);
        $this->Ln(30);

        $this->Line(10,30,200,30);
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
    }
}

// Instanciation of inherited class
$invClass      = new Inventory();
$deviceClass   = new DeviceClass();
$locationClass = new LocationClass();
$pdf           = new PDF('P');

$pdf->SetTitle($invClass->setting_data("inventory_name")." Detailed Report");
$pdf->SetCreator("Permana Cakra");
$pdf->SetAuthor("Permana Cakra");
$pdf->SetSubject($invClass->setting_data("inventory_name")." Detailed Report");
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);

// Get Datas
$criteria = '';
// If criteria is set
if (isset($_GET['criteria']) && $_GET['criteria']!='') {
    $criteria = $_GET['criteria'];
}

$no = 0;
$datas = $deviceClass->show_device_report("type_id", "$criteria");
foreach ($datas as $data) {
    $no++;

    // if location details enabled
    if ($invClass->setting_data("location_details")=="enable") {
        $locationdetail = $data['place_name'].", ".$data['building_name'].", ".$data['floor_name'].", ".$data['location_name'];
    }
    else {
        $locationdetail = $data['location_name'];
    }

    $pdf->AddPage();
    $pdf->Cell(40, 10, "", 0, 0);
    $pdf->Cell(150, 90, $pdf->Image($data['device_photo'],60,50,0, 80), 0, 1);
    $pdf->Cell(40, 8, "Code", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $data['device_code'], 0, 1);
    $pdf->Cell(40, 8, "Device Type", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $data['type_name'], 0, 1);
    $pdf->Cell(40, 8, "Brand", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $data['device_brand'], 0, 1);
    $pdf->Cell(40, 8, "Model", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $data['device_model'], 0, 1);
    $pdf->Cell(40, 8, "Serial Number", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $data['device_serial'], 0, 1);
    $pdf->Cell(40, 8, "Color", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $data['device_color'], 0, 1);
    $pdf->Cell(40, 8, "Status", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, ucfirst($data['device_status']), 0, 1);
    $pdf->Cell(40, 8, "Location", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->Cell(100, 8, $locationdetail, 0, 1);
    $pdf->Cell(40, 8, "Descriptions", 0, 0);
    $pdf->Cell(5, 8, " : ", 0, 0);
    $pdf->MultiCell(0, 8, strip_tags($data['device_description']));
}

$pdf->Output();
?>