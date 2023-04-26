<?php
// vaibhav rudani(8810171), niki soni(8806834)
session_start();
if (isset($_POST['save'])) {

	foreach ($_POST['indexes'] as $key) {
		$_SESSION['qty_array'][$key] = $_POST['qty_' . $key];
	}

	$_SESSION['msg'] = 'Cart updated successfully';
	
	header('location: view_cart.php');
}
