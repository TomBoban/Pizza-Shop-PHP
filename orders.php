<?php
// vaibhav rudani(8810171), niki soni(8806834)
session_start();
include 'header.php';
?>

<h1 class="page-header text-center my-5">Invoices</h1>
<div class="row row-cart-details alert-row">
    <div class="col-sm-10 col-sm-offset-2">    
        <table class="table table-bordered table-striped">
            <thead>
                <th class="text-center">ID</th>
                <th class="text-center">Order_Id</th>
                <th class="text-center">Date & Time</th>
                <th class="text-center">Print </th>
                <th class="text-center">Download </th>
            </thead>
            <tbody>

                <?php
                require('mysqli_connect.php');
                $sql_quary = "SELECT * FROM orders";
                $query = $conn->query($sql_quary);
                while ($row = $query->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center" width="5%"><?php echo $row['id']; ?></td>
                        <td class="text-center" width="10%"><?php echo $row['order_id']; ?></td>
                        <td class="text-center" width="10%"><?php echo $row['created_on']; ?></td>
                        <td class="text-center" width="10%">
                            <a href="view_bill.php?id=<?php echo $row['order_id']; ?>" class="btn btn-success btn-md">View Invoice</a>
                            
                        </td>    
                        <td  class="text-center" width="10%">
                        <a href="bill.php?id=<?php echo $row['order_id']; ?>" class="btn btn-info btn-md">Download Invoice</a>
                        </td>                 
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
</div>
<footer class="mt-2 mb-0 bg-orange footer-2">
    <h6 class="text-white text-center p-3">
        <span>PIZZA SHOP</span> <br>
        vaibhav rudani(8810171),niki soni(8806834)
    </h6>
</footer>

</body>

</html>