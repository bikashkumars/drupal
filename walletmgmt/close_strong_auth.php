<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<pre>
<?php

require_once (dirname(__FILE__) . "/lib/common.inc");

$user_id = isset($_REQUEST["user_id"]) ? $_REQUEST["user_id"] : 0;
$beneficiary_id = isset($_REQUEST["beneficiary_id"]) ? $_REQUEST["beneficiary_id"] : 0;
$Id_object = isset($_REQUEST["user_id"]) ? $_REQUEST["user_id"] : $beneficiary_id;
if ($Id_object == 0 ) {
	print("Error : not parameter id in url");
	return;
}

$body = json_encode(array("IsDocumentsTransmitted" =>  true));
if($beneficiary_id!=0)$strongUserValidation = request("beneficiaries/".$Id_object ."/strongAuthentication", "PUT", $body);
if($user_id!=0)$strongUserValidation = request("users/".$Id_object ."/strongAuthentication", "PUT", $body);

?>

</pre>
	</body>
</html>
