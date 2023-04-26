<?php
// vaibhav rudani(8810171), niki soni(8806834)

session_start();
include 'header.php';
?>

<h1 class="page-header text-center my-5">Cart</h1>
<div class="row row-cart-details alert-row">
    <div class="col-sm-8 col-sm-offset-2">
        <?php

		if (isset($_SESSION['msg'])) {
		?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['msg']; ?>
        </div>
        <?php
			unset($_SESSION['msg']);
		}
		?>

        <table class="table table-bordered">
            <thead>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </thead>
            <tbody>

                <?php
				//initialize total
				$total = 0;
				if (!empty($_SESSION['cart'])) {
					//connection
					require('mysqli_connect.php'); // Connect to the db.
					//create array of initail qty which is 1
					$index = 0;
					if (!isset($_SESSION['qty_array'])) {
						$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
					}
					$sql_quary = "SELECT * FROM products WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
					$query = $conn->query($sql_quary);
					while ($row = $query->fetch_assoc()) {
				?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo number_format($row['price'], 2); ?></td>

                    <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">

                    <td class="text-center">1</td>
                    <td><?php echo number_format($_SESSION['qty_array'][$index] * $row['price'], 2); ?></td>
                    <td>
                        <a href="delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>"
                            class="btn btn-danger btn-sm">Remove</a>
                    </td>

                    <?php $total += $_SESSION['qty_array'][$index] * $row['price']; ?>
                </tr>
                <?php
						$index++;
					}
				} else {
					?>
                <tr>
                    <td colspan="4" class="text-center">No Item in Cart</td>
                </tr>

                <?php
				}

				?>
                <tr>
                    <td colspan="4" class="text-end"><b>Total</b></td>
                    <td><b><?php echo number_format($total, 2); ?></b></td>
                </tr>
            </tbody>
        </table>
        <div class="row mt-5">
            <div class="col-4 text-left"><a href="index.php" class="btn btn-primary">Back To Product</a></div>
            <div class="col-4 text-center"><a href="clear_cart.php" class="btn btn-danger">Empty Cart</a></div>
            <div class="col-4 text-end"><a href="checkout_page.php" class="btn btn-success">Procced To Checkout</a>
            </div>
        </div>
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