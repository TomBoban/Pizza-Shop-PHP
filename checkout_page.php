<?php
// vaibhav rudani(8810171), niki soni(8806834)
session_start();
include 'header.php';

if (isset($_SESSION['msg'])) {
?>
<div class="row alert-row">
    <div class="col-sm-6 col-sm-offset-6">
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['msg']; ?>
        </div>
    </div>
</div>
<?php
    unset($_SESSION['msg']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $lastname = $username = $email = $address = $country = $state = $zip = '';
    $payment_method = $card_holder_name = $card_no = $card_exp_date = $card_cvv = '';
    $errors = [];

    require('mysqli_connect.php');

    if (empty($_POST['firstName'])) {
        $errors[] = 'Please Enter First Name';
    } else {
        $firstName = $conn->real_escape_string(trim($_POST['firstName']));
    }

    if (empty($_POST['lastname'])) {
        $errors[] = 'Please Enter Last Name';
    } else {
        $lastname = $conn->real_escape_string(trim($_POST['lastname']));
    }

    if (empty($_POST['username'])) {
        $errors[] = 'Please Enter Username';
    } else {
        $username = $conn->real_escape_string(trim($_POST['username']));
    }

    if (empty($_POST['email'])) {
        $errors[] = 'Please Enter Email';
    } else {
        $email = $conn->real_escape_string(trim($_POST['email']));
    }

    if (empty($_POST['address'])) {
        $errors[] = 'Please Enter Address';
    } else {
        $address = $conn->real_escape_string(trim($_POST['address']));
    }

    if (empty($_POST['country'])) {
        $errors[] = 'Please Enter Country';
    } else {
        $country = $conn->real_escape_string(trim($_POST['country']));
    }

    if (empty($_POST['state'])) {
        $errors[] = 'Please Enter State';
    } else {
        $state = $conn->real_escape_string(trim($_POST['state']));
    }

    if (empty($_POST['zip'])) {
        $errors[] = 'Please Enter Zip';
    } else {
        $zip = $conn->real_escape_string(trim($_POST['zip']));
    }
    if (empty($_POST['payment_method'])) {
        $errors[] = 'Please Enter Payment Method';
    } else {
        $payment_method = $conn->real_escape_string(trim($_POST['payment_method']));
    }

    if (empty($_POST['card_holder_name'])) {
        $errors[] = 'Please Enter Card Holder Name';
    } else {
        $card_holder_name = $conn->real_escape_string(trim($_POST['card_holder_name']));
    }
    if (empty($_POST['card_no'])) {
        $errors[] = 'Please Enter Card Number';
    } else {
        $card_no = $conn->real_escape_string(trim($_POST['card_no']));
    }
    if (empty($_POST['card_exp_date'])) {
        $errors[] = 'Please Enter Card Expiry Date';
    } else {
        $card_exp_date = $conn->real_escape_string(trim($_POST['card_exp_date']));
    }

    if (empty($_POST['card_cvv'])) {
        $errors[] = 'Please Enter Card CVV';
    } else {
        $card_cvv = $conn->real_escape_string(trim($_POST['card_cvv']));
    }

    if (empty($errors)) {
        $user_details = array(
            "firstName" => $firstName,
            "lastname" => $lastname,
            "username" => $username,
            "email" => $email,
            "address" => $address,
            "country" => $country,
            "state" => $state,
            "zip" => $zip,
            "payment_method" => $payment_method,
            "card_holder_name" => $card_holder_name,
            "card_no" => $card_no,
            "card_exp_date" => $card_exp_date,
            "card_cvv" => $card_cvv
        );

        $sql_quary = "INSERT INTO users (firstName, lastname, username, email, address, country, state, zip, payment_method, card_holder_name, card_no, card_exp_date, card_cvv) VALUES ('" . $user_details['firstName'] . "', '" . $user_details['lastname'] . "', '" . $user_details['username'] . "', '" . $user_details['email'] . "', '" . $user_details['address'] . "', '" . $user_details['country'] . "', '" . $user_details['state'] . "', '" . $user_details['zip'] . "', '" . $user_details['payment_method'] . "', '" . $user_details['card_holder_name'] . "', '" . $user_details['card_no'] . "', '" . $user_details['card_exp_date'] . "', '" . $user_details['card_cvv'] . "')";
        $run_q = @mysqli_query($conn, $sql_quary);
        $last_id = $conn->insert_id;
        echo $last_id;
        if ($run_q) {
            require 'create_order.php';
            if (createOrderDetails($conn, $last_id)) {
                $_SESSION['msg'] = 'Order Placed Successfully';
                unset($_SESSION['cart']);
                header("location: index.php");
            };
        } else {
            $_SESSION['msg'] = 'Error in placing order';
        }
    } else {
        echo "<h1>Error</h1>";
        $conn->close();

        unset($conn);
    }
}
?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout Form</h2>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h4 class="mb-3">Customer Address</h4>
            <form class="needs-validation" method="POST" action="checkout_page.php" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value=""
                            required="">
                        <div class="invalid-feedback">Please Enter First Name </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="" value=""
                            required="">
                        <div class="invalid-feedback">Please Enter Last Name</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            required="">
                        <div class="invalid-feedback" style="width: 100%;"> Please Enter username. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="user@test.com"
                        required="">
                    <div class="invalid-feedback"> Please enter a valid email address. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address<span class="text-muted"></span></label>
                    <input type="text" class="form-control" class="address" id="address" name="address"
                        placeholder="Apartment or suite" required="">
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="State" required="">
                        <div class="invalid-feedback"> Please Enter a valid state. </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country"
                            required="">
                        <div class="invalid-feedback"> Please Enter valid country. </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" minlength="6" maxlength="6"
                            placeholder="" required="">
                        <div class="invalid-feedback"> Zip code is required. </div>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Select Payment Method</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="payment_method" type="radio" class="custom-control-input"
                            value="credit_card" checked="" required="">
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="payment_method" type="radio" class="custom-control-input"
                            value="debit_card" required="">
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Card holder name</label>
                        <input type="text" class="form-control" id="cc-name" name="card_holder_name" placeholder=""
                            required="">
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback"> Please enter card holder name.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Card number</label>
                        <input type="text" class="form-control" id="cc-number" name="card_no" minlength="" 16
                            maxlength="16" placeholder="" required="">
                        <div class="invalid-feedback"> Please Enter Card Number. </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="date" class="form-control" id="cc-expiration" name="card_exp_date" placeholder=""
                            required="">
                        <div class="invalid-feedback"> Expiration date required </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" name="card_cvv" minlength="3" maxlength="3"
                            placeholder="" required="">
                        <div class="invalid-feedback"> CVV code required </div>
                    </div>
                </div>
                <hr class="mb-4 ">
                <button class="btn btn-success btn-block" type="submit">Confirm Payment</button>
            </form>
        </div>
    </div>
</div>
<footer class="mt-5 mb-0 bg-orange">
    <h6 class="text-white text-center p-3">
        <span>PIZZA SHOP</span> <br>
        vaibhav rudani(8810171), niki soni(8806834)
    </h6>
</footer>
<br>
<br>
<script>
(function() {
    'use strict'

    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation')

        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    }, false)
}())
</script>