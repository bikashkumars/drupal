<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<pre>
<?php

require_once (dirname(__FILE__) . "/lib/common.inc");

// Retrieve parameters
$parameters = array("Tag", "Name", "Description", "RaisingGoalAmount", "ContributionLimitDate");
$id = isset($_REQUEST["ID"]) ? $_REQUEST["ID"] : 0;

$array = array();
for ($i = 0; $i < count($parameters) ; $i++) {
    if(isset($_REQUEST[$parameters[$i]]) && $_REQUEST[$parameters[$i]] != "<nil>"){
        $array[$parameters[$i]] = $_REQUEST[$parameters[$i]];
    }
}

// Convert format
$body = json_encode($array);



$wallet = request("wallets/".$id, "PUT", $body);

if( !isset($wallet) || !isset($wallet->ID)) {
	print("Error");
	return;
}

?>

</pre>
	</body>
</html>