<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<pre>
<?php

require_once(dirname(__FILE__) . "/lib/common.inc");


$wallet_id = isset($_REQUEST["wallet_id"]) ? $_REQUEST["wallet_id"] : 0;
$include = isset($_REQUEST["include"]) ? $_REQUEST["include"] : "NO_INCLUDE";

if ($wallet_id == 0) {
	print("Error : not parameter user_id in url");
	return;
}

if ($include == "NO_INCLUDE") {
    print "Case no include";
    $users = request("wallets/".$wallet_id."/users", "GET");
} else {
    print "Case include ".$include;
    $users = request("wallets/".$wallet_id."/users?include=".$include, "GET");
}


?>

</pre>
</body>
</html>