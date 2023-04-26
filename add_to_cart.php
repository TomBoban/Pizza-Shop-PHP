<?php
// vaibhav rudani(8810171), niki soni(8806834)
session_start();

//initialize cart if not set or is unset

if (!in_array($_GET['id'], $_SESSION['cart'])) {
	array_push($_SESSION['cart'], $_GET['id']);
	$_SESSION['msg'] = 'Product added to cart';
} else {
	$_SESSION['msg'] = 'Product already added to cart';
}

header('location: index.php');