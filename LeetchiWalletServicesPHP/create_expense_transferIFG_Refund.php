<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<pre>
<?php

require_once (dirname(__FILE__) . "/lib/common.inc");

// Retrieve parameters
$parameters = array("Tag");
$transactionId = isset($_REQUEST["transactionId"]) ? $_REQUEST["transactionId"] : 0;

$array = array();
for ($i = 0; $i < count($parameters) ; $i++) {
    if(isset($_REQUEST[$parameters[$i]]) && $_REQUEST[$parameters[$i]] != "<nil>"){
        $array[$parameters[$i]] = $_REQUEST[$parameters[$i]];
    }
}

// Convert format
$body = json_encode($array);

$result = request("refund-ifg/".$transactionId, "POST", $body);

?>

</pre>
	</body>
</html>