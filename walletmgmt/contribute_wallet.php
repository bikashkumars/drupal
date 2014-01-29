<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<pre>
<?php

require_once (dirname(__FILE__) . "/lib/common.inc");

$user_id = isset($_REQUEST["user_id"]) ? $_REQUEST["user_id"] : null;
$tag = isset($_REQUEST["tag"])? $_REQUEST["tag"] : "DefaultTag";
$amount = isset($_REQUEST["amount"])? $_REQUEST["amount"] : 1000;
$fees = isset($_REQUEST["fees"])? $_REQUEST["fees"] : 10;
$wallet_id = isset($_REQUEST["wallet_id"]) ? $_REQUEST["wallet_id"] : null;
$registercard = isset($_REQUEST["registercard"]) ? ($_REQUEST["registercard"] == "on" ? true : false) : false;
$PaymentMethodType = isset($_REQUEST["methodType"]) ? $_REQUEST["methodType"] : "cb_visa_mastercard";

/* we fetch the user with the user_id in the URL
 * else we create the user
 */

if ($user_id == null) {
	/*
	 * POST request to create a user
	 */
	$body = json_encode(array("FirstName" => "John", "LastName" => "Doe", "Email" => "john.doe@unknow.com", "IP" => "127.0.0.1", "CanRegisterMeanOfPayment" => "true"));

	$user = request("users", "POST", $body);

} else {
	/*
	 * GET to fetch the user
	 */
	$user = request("users/" . $user_id, "GET");
}

if (!isset($user) || !isset($user -> ID)) {
	print("Error");
	return;
}

/* we fetch the wallet with the wallet_id in the URL
 * else we create the wallet
 */
if ($wallet_id == null) {
	/*
	 * POST request to create a wallet
	 */
	$body = json_encode(array("Owners" => array($user -> ID)));
	$wallet = request("wallets", "POST", $body);
    $wallet_id = $wallet -> ID;
} else if($wallet_id != 0) {
	/*
	 * GET to fetch the wallet
	 */
 	$wallet = request("wallets/" . $wallet_id, "GET");
	if (!isset($wallet) || !isset($wallet -> ID)) {
		print("Error");
		return;
	}
}

$type = "Payline";
if($PaymentMethodType == "sofort" || $PaymentMethodType == "giropay"){
	$type = "Ogone";
}

/*
 * POST request to create a contribution on a wallet
 */

$body = json_encode(array("UserID" => $user -> ID,
                          "WalletID" => $wallet_id,
                          "Amount" => $amount,
                          "ClientFeeAmount" => $fees,
                          "Tag" => $tag,
                          "RegisterMeanOfPayment" => $registercard, 
                          "ReturnURL" => "http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . str_replace( "\\", "", dirname($_SERVER["REQUEST_URI"])) . "/return.php",
                          "PaymentMethodType" => $PaymentMethodType,
                          "Type" => $type));


$contribution = request("contributions", "POST", $body);

 if ($contribution != null) {
        //header("Location: " . $contribution -> PaymentURL);
       echo "<a href=\"$contribution->PaymentURL\">$$contribution->PaymentURL</a>";
        exit();
 }

?>

</pre>
	</body>
</html>