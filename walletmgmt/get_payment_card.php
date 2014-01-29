<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<pre>
<?php

require_once(dirname(__FILE__) . "/lib/common.inc");

$paymentcard_id = isset($_REQUEST["paymentcard_id"]) ? $_REQUEST["paymentcard_id"] : 0;

if ($paymentcard_id == 0) {
	print("Error : not parameter paymentcard_id in url");
	return;
}

$card = request("cards/".$paymentcard_id, "GET");

if (!isset($card) || !isset($card -> ID)) {
	print("card");
	return;
}

?>
</pre>
</body>
</html>