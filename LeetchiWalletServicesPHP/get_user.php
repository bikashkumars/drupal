<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<pre>
<?php

require_once(dirname(__FILE__) . "/lib/common.inc");


$user_id = isset($_REQUEST["user_id"]) ? $_REQUEST["user_id"] : 0;

if ($user_id == 0) {
	print("Error : not parameter user_id in url");
	return;
}

$user = request("users/".$user_id, "GET");

?>

</pre>
</body>
</html>