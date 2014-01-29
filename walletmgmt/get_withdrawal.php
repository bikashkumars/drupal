<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<pre>
<?php

require_once(dirname(__FILE__) . "/lib/common.inc");


$withdrawal_id = isset($_REQUEST["withdrawal_id"]) ? $_REQUEST["withdrawal_id"] : 0;

if ($withdrawal_id == 0) {
	print("Error : not parameter withdrawal_id in url");
	return;
}

$withdrawal = request("withdrawals/".$withdrawal_id, "GET");

?>

</pre>
</body>
</html>