<?php
// vaibhav rudani(8810171), niki soni(8806834)
function orderIdGenerator()
{
    return rand(1, 9999);
}
function createOrderDetails($conn, $id)
{
    $user_id = $id;
    $order_id = orderIdGenerator();
    print_r($_SESSION['cart']);

    foreach ($_SESSION['cart'] as &$book) {
        
        $sql_quary = "INSERT INTO order_details (order_id, book_id) value ('" . $order_id . "','" . $book . "')";
        echo $sql_quary;
        $run_q = @mysqli_query($conn, $sql_quary);
    }

    $sql_quary = "INSERT INTO orders (order_id, user_id) value ('" . $order_id . "','" . $user_id . "')";
    $run_q = @mysqli_query($conn, $sql_quary);
    if ($run_q) {
        return true;
    }
}