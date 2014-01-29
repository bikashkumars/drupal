<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<pre>
<?php

require_once (dirname(__FILE__) . "/lib/common.inc");

// Retrieve parameters
$parameters = array("wallet_id", "amount", "height", "width", "ifg_host", "retailer_id", "track", "incentive_type", "locale", "retailer_secret", "Tag");

$array = array();
for ($i = 0; $i < count($parameters) ; $i++) {
    if(isset($_REQUEST[$parameters[$i]]) && $_REQUEST[$parameters[$i]] != "<nil>"){
        $array[$parameters[$i]] = $_REQUEST[$parameters[$i]];
    }
}

// Convert format
$body = json_encode($array);

$transferRefund = request("transfer-ifg", "POST", $body);

if( !isset($transferRefund) || !isset($transferRefund->ID)) {
	print("Error");
	return;
}
?>

</pre>
	</body>
</html>