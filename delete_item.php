<?php
// vaibhav rudani(8810171), niki soni(8806834)

	session_start();
	//remove the id from our cart array
	$key = array_search($_GET['id'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);

	unset($_SESSION['qty_array'][$_GET['index']]);
	//rearrange array after unset
	$_SESSION['qty_array'] = array_values($_SESSION['qty_array']);

	$_SESSION['msg'] = "Product deleted from cart";
	header('location: view_cart.php');
