<?php
// vaibhav rudani(8810171), niki soni(8806834)
session_start();
	unset($_SESSION['cart']);
	$_SESSION['msg'] = 'Cart cleared successfully';
	header('location: index.php');
?>