<div class="container">
    <?php
// vaibhav rudani(8810171), niki soni(8806834)
session_start();
//initialize cart if not set or is unset
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}

//unset qunatity
unset($_SESSION['qty_array']);

// including header
include 'header.php';

//info message
if (isset($_SESSION['msg'])) {
?>
    <div class="row alert-row my-2">
        <div class="col-sm-6 col-sm-offset-6">
            <div class="alert alert-success text-center">
                <?php echo $_SESSION['msg']; ?>
            </div>
        </div>
    </div>
    <?php
	unset($_SESSION['msg']);
}

//fetch products

// Connect to db
require('mysqli_connect.php');

$sql_quary = "SELECT * FROM products";
$query = $conn->query($sql_quary);

$enddiv = 4;
while ($row = $query->fetch_assoc()) {
	$enddiv = ($enddiv == 4) ? 1 : $enddiv + 1;
	if ($enddiv == 1)
		echo "<div class='row text-center'>";
?>

    <div class="col-md-3" style="padding: 10px;">
        <div class="card" style="width: 100%;">
            <img class="card-img-top" height="290px" src="<?php echo $row['photo'] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title py-3">
                    <?php echo $row['name']; ?>
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">Price :
                            $<?php echo $row['price']; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <span class="pull-right"><a href="add_to_cart.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-plus">
                                </span>Add to Cart</a></span>
                    </div>
                    <div class="col-12">
                        <p class="description">
                            <?php echo $row['description']; ?>
                        </p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>


    <?php
}
if ($enddiv == 1)
	echo "<div></div><div></div><div></div></div>";
if ($enddiv == 2)
	echo "<div></div><div></div></div>";
if ($enddiv == 3)
	echo "<div></div></div>";

// end row section
?>
</div>

<footer class="mt-2 bg-orange">
    <h6 class="text-white text-center p-3">
        <span>PIZZA SHOP</span> <br>
         vaibhav rudani(8810171), niki soni(8806834)
    </h6>
</footer>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


</html>