<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<pre>
<?php

require_once(dirname(__FILE__) . "/lib/common.inc");


$beneficiary_id = isset($_REQUEST["beneficiary_id"]) ? $_REQUEST["beneficiary_id"] : 0;

if ($beneficiary_id == 0) {
	print("Error : not parameter beneficiary_id in url");
	return;
}

$beneficiarie = request("beneficiaries/".$beneficiary_id."/strongAuthentication", "GET");

?>

</pre>
</body>
</html>