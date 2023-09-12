<?php

// Taking all 5 values from the form data(input)
$txnid = $_POST['txnid'];
$amount = $_REQUEST['amount'];
$firstname = $_REQUEST['firstname'];
$email = $_REQUEST['email'];
$phone1 = $_REQUEST['phone'];
$productinfo = $_REQUEST['productinfo'];
$surl = $_REQUEST['surl'];
$furl = $_REQUEST['furl'];
$service_provider = $_REQUEST['service_provider'];
$total = $amount;
$add1 = $_REQUEST['address1'];
$add2 = $_REQUEST['address2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$country = $_REQUEST['country'];
$zipcode = $_REQUEST['zipcode'];
$txndate = date("Y-m-d H:i:s", time());



$config = array(
    "env" => "sandbox",
    "BusinessShortCode" => "174379",
    "key" => "6ZTfjQGGySUWUxLnB4IUzmZy3AbD8Zkp",
    //Enter your consumer key here
    "secret" => "E2fGPbNy9JzHC93N",
    //Enter your consumer secret here
    "username" => "apitest",
    "TransactionType" => "CustomerPayBillOnline",
    "passkey" => "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919",
    //Enter your passkey here
    "CallBackURL" => "https://f899-41-90-64-220.ngrok.io/mpesa/callback.php",
    //When using Localhost, Use Ngrok to forwardthe response to your Localhost
    "AccountReference" => "Hazina Cosmetics",
    "TransactionDesc" => "Payment of X",
);


$orderNo = $txnid;
$phone = $_REQUEST['phone'];
$phone = (substr($phone, 0, 1) == "+") ? str_replace("+", "", $phone) : $phone;
$phone = (substr($phone, 0, 1) == "0") ? preg_replace("/^0/", "254", $phone) : $phone;
$phone = (substr($phone, 0, 1) == "7") ? "254{$phone}" : $phone;



$access_token = ($config['env'] == "live") ?
    "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" :
    "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$credentials = base64_encode($config['key'] . ':' . $config['secret']);

$ch = curl_init($access_token);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$result = json_decode($response);
$token = isset($result->{'access_token'}) ? $result->{'access_token'} : "N/A";

$timestamp = date("YmdHis");
$password = base64_encode($config['BusinessShortCode'] . "" . $config['passkey'] . "" . $timestamp);

$curl_post_data = array(
    "BusinessShortCode" => $config['BusinessShortCode'],
    "Password" => $password,
    "Timestamp" => $timestamp,
    "TransactionType" => $config['TransactionType'],
    "Amount" => $amount,
    "PartyA" => $phone,
    "PartyB" => $config['BusinessShortCode'],
    "PhoneNumber" => $phone,
    "CallBackURL" => $config['CallBackURL'],
    "AccountReference" => $config['AccountReference'],
    "TransactionDesc" => $config['TransactionDesc'],
);

$data_string = json_encode($curl_post_data);

$endpoint = ($config['env'] == "live") ? "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" :
    "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode(json_encode(json_decode($response)), true);

if (!preg_match('/^[0-9]{10}+$/', $phone) && array_key_exists('errorMessage', $result)) {
    // $errors['phone'] = $result["errorMessage"];
}

if ($result['ResponseCode'] === "0") {
    //STK Push request successful

    $MerchantRequestID = $result['MerchantRequestID'];
    $CheckoutRequestID = $result['CheckoutRequestID'];

    $conn = mysqli_connect("localhost", "root", "", "khadipremium");

    $sql = "INSERT INTO `mpesaorders`(`ID`, `OrderNo`, `Amount`, `Phone`, `CheckoutRequestID`, `MerchantRequestID`) VALUES
('','" . $orderNo . "','" . $amount . "','" . $phone . "','" . $CheckoutRequestID . "','" . $MerchantRequestID . "');";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["MerchantRequestID"] = $MerchantRequestID;
        $_SESSION["CheckoutRequestID"] = $CheckoutRequestID;
        $_SESSION["phone"] = $phone;
        $_SESSION["orderNo"] = $orderNo;

        // header('location: confirm-payment.php');
    } else {
        $errors['database'] = "Unable to initiate your order: " . $conn->error;
        ;
        foreach ($errors as $error) {
            $errmsg .= $error . '<br />';
        }
    }

} else {
    $errors['mpesastk'] = $result['errorMessage'];
    foreach ($errors as $error) {
        $errmsg .= $error . '<br />';
    }
}


// Performing insert query execution
// here our table name is college

$sql = "INSERT INTO `transactions` (`id`, `cart_id`, `fullname`, `email`, `phone`, `address1`, `address2`, `city`,
`state`, `country`, `zipcode`, `total`, `productinfo`, `txn_date`)
VALUES (NULL, '$cart_id', '$firstname','$email','$phone1',
'$add1','$add2','$city','$state','$country','$zipcode','$total','$productinfo', '$txndate')";



if (mysqli_query($conn, $sql)) {
    echo "<h3>data stored in a database successfully.</h3>";


} else {
    echo "ERROR: Hush! Sorry "
        . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);


?>



<form action="#" method="post" name=" ">
    <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>" />
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <div class="row">
        <div class="col-md-6">
            <div class="md-form">
                <?php
                foreach ($items as $item) {
                    $product_id = $item['id'];
                    $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                    $product = mysqli_fetch_assoc($productQ);
                    ?>
                    <?php
                    $i++;
                    $item_count += $item['quantity'];
                    $sub_total += ($product['price'] * $item['quantity']);

                    /*$tax = TAXRATE * $sub_total;
                    $tax = number_format($tax,2);*/
                    $grand_total = $sub_total;
                    ?>
                <?php } ?>
                <input type="text" readonly id="inputIconEx1" class="form-control" name="amount"
                    value="<?= intval($grand_total); ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx1">Amount<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="text" required id="inputIconEx2" class="form-control" name="firstname" id="firstname"
                    value="<?php if (isset($_SESSION['email'])) {
                        echo $cus_name;
                    } else {
                        echo (empty($posted['firstname'])) ? '' : $posted['firstname'];
                    } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx2">Full Name<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form" style="display: none">
                <input type="text" id="inputIconEx3" class="form-control" name="lastname" id="lastname"
                    value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>"
                    style="border-color: #1c2a48" />
                <label for="inputIconEx3">Last Name<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="email" id="inputIconEx10" class="form-control" name="email" id="email" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_email;
                } else {
                    echo (empty($posted['email'])) ? '' : $posted['email'];
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx10">Email<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input required type="text" id="inputIconEx11" class="form-control" max="10" min="10" name="phone"
                    value="<?php if (isset($_SESSION['email'])) {
                        echo $cus_phone;
                    } else {
                        echo (empty($posted['phone'])) ? '' : $posted['phone'];
                    } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx11">Phone<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <textarea readonly id="textarea-char-counter" class="form-control md-textarea" name="productinfo"
                    cols="40" style="border-color: #1c2a48"><?php foreach ($items as $item) {
                        $product_id = $item['id'];
                        $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                        $product = mysqli_fetch_assoc($productQ); ?><?php $i++;
                           $item_count += $item['quantity'];
                           $sub_total += ($product['price'] * $item['quantity']);
                           $grand_total = $sub_total; ?><?= $product['title']; ?> (x<?= $item['quantity']; ?>) <?php echo "\r\n";
                    } ?></textarea>
                <label for="textarea-char-counter">Product Info<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form" style="display: none;">
                <input name="surl" type="hidden" value="http://localhost/hazina/success.php" size="64" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="furl" type="hidden" value="http://localhost/hazina/failure.php" size="64" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="curl" value="http://localhost/hazina/products.php" />
            </div>
            <div class="md-form" style="display: none;">
                <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="md-form">
                <input type="text" required id="inputIconEx4" class="form-control" name="address1" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_address1;
                } else {
                    echo (empty($posted['address1'])) ? '' : $posted['address1'];
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx4">Address1<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="text" required id="inputIconEx5" class="form-control" name="address2" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_address2;
                } else {
                    echo (empty($posted['address2'])) ? '' : $posted['address2'];
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx5">Address2<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="text" required id="inputIconEx6" class="form-control" name="city" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_city;
                } else {
                    echo (empty($posted['city'])) ? '' : $posted['city'];
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx6">City<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="text" required id="inputIconEx7" class="form-control" name="state" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_state;
                } else {
                    echo (empty($posted['state'])) ? '' : $posted['state'];
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx7">State<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="text" required id="inputIconEx8" class="form-control" name="zipcode" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_zipcode;
                } else {
                    echo (empty($posted['zipcode'])) ? '' : $posted['zipcode'];
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx8">Zipcode<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form">
                <input type="text" required id="inputIconEx9" class="form-control" name="country" value="<?php if (isset($_SESSION['email'])) {
                    echo $cus_country;
                } else {
                    echo 'Kenya';
                } ?>" style="border-color: #1c2a48" />
                <label for="inputIconEx9">Country<span class="text-danger"> *</span></label>
            </div>
            <div class="md-form" style="display: none;">
                <input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
            </div>
            <div class="md-form" style="display: none;">
                <input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
            </div>
        </div>
    </div>
    <div>
        <!-- <?php if (!$hash) { ?> -->
            <!-- <button type="submit" name="submit" class="btn" style="background: #6b5523;border-radius: 10em">Submit</button> -->
            <input type="submit" name="submit" value="Submit" style="background: #6b5523;border-radius: 10em" />
            <!-- <?php } ?> -->
    </div>
</form>
</div>
<?php include 'includes/footer.php'; ?>