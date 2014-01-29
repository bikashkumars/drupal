<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<pre>
<?php

require_once(dirname(__FILE__) . "/lib/common.inc");


$refund_id = isset($_REQUEST["refund_id"]) ? $_REQUEST["refund_id"] : 0;

if ($refund_id == 0) {
	print("Error : not parameter refund_id in url");
	return;
}

$refund = request("refunds/".$refund_id, "GET");

?>

</pre>
</body>
</html>