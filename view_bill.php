<?php
session_start();
// vaibhav rudani(8810171), niki soni(8806834)

require("mysqli_connect.php");
require('fpdf184/fpdf.php');


if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql_quary = "SELECT GROUP_CONCAT(book_id) FROM `order_details` where order_id = $id;";

    $query = $conn->query($sql_quary);

    $product = $query->fetch_array()[0];

    $q = "SELECT * FROM `products` where id in ($product)";

    $product_data = $conn->query($q);

    $q = "SELECT * from users where user_id = (SELECT user_id FROM `orders` where order_id = $id)";

    $user_data_obj = $conn->query($q);

    $user_data = $user_data_obj->fetch_object();
}


class PDF extends FPDF
{
    function Header()
    {
        $this->Image('images/logo.jpg', 12, 5, 30);

        $this->Ln(30);
    }
}


$pdf = new PDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(130, 5, 'PIZZA SHOP', 0, 0);
$pdf->Cell(59, 5, 'INVOICE', 0, 1); 
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(130, 5, '10 AUSTRINE DRIVE NORTH', 0, 0);
$pdf->Cell(59, 5, '', 0, 1); 
$pdf->Cell(130, 5, 'WATERLOO N2L 3Y1', 0, 0);
$pdf->Cell(25, 5, 'Date', 0, 0);
$pdf->Cell(34, 5, date("Y-m-d"), 0, 1); 
$pdf->Cell(130, 5, 'Phone: +1 519 781 4396', 0, 0);
$pdf->Cell(25, 5, 'Invoice #', 0, 0);
$pdf->Cell(34, 5, $id, 0, 1); 
$pdf->Cell(130, 5, 'Fax: 519 781 4396', 0, 0);
$pdf->Cell(25, 5, 'Customer ID', 0, 0);
$pdf->Cell(34, 5, $user_data->user_id, 0, 1); 
$pdf->Cell(189, 10, '', 0, 1); 
$pdf->Cell(100, 5, 'Bill to', 0, 1); 
$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $user_data->firstname . " " . $user_data->lastname, 0, 1);

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $user_data->email, 0, 1);

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $user_data->address, 0, 1);

$pdf->Cell(10, 5, '', 0, 0);
$pdf->Cell(90, 5, $user_data->country . " " . $user_data->state . " " . $user_data->zip, 0, 1);

$pdf->Cell(189, 10, '', 0, 1); 
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(130, 5, 'Description', 1, 0);
$pdf->Cell(25, 5, 'Quantity', 1, 0);
$pdf->Cell(34, 5, 'Amount', 1, 1); 
$pdf->SetFont('Arial', '', 8);


$subtotal = 0;
while ($single = $product_data->fetch_object()) {
    $pdf->Cell(130, 5, $single->name . " - " . $single->model_number, 1, 0);
    $pdf->Cell(25, 5, 1, 1, 0);
    $pdf->Cell(4, 5, '$', 1, 0);
    $pdf->Cell(30, 5, $single->price, 1, 1, 'R'); 
    $subtotal += $single->price;
}

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Subtotal', 0, 0);
$pdf->Cell(4, 5, '$', 1, 0);
$pdf->Cell(30, 5, $subtotal, 1, 1, 'R'); 

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Tax Rate', 0, 0);
$pdf->Cell(34, 5, '13%', 1, 1, 'R'); 
$tax = $subtotal * 0.13;

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Tax Amount', 0, 0);
$pdf->Cell(4, 5, '$', 1, 0);
$pdf->Cell(30, 5, $tax, 1, 1, 'R'); 
$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Total Due', 0, 0);
$pdf->Cell(4, 5, '$', 1, 0);
$pdf->Cell(30, 5, $subtotal + $tax, 1, 1, 'R'); 

$pdf->Ln(50);
$pdf->Cell(25);
$pdf->Cell(250, 0, "Signature", 0, 0, 'C');

$pdf->Output();