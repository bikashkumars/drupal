<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="/jquery/jquery-1.7.2.js"></script>
		<script type="text/javascript" src="/jquery/jquery.form.js"></script>
	</head>
	<body>
		<pre>
<?php


require_once (dirname(__FILE__) . "/lib/common.inc");

$beneficiary_id = isset($_REQUEST["beneficiary_id"]) ? $_REQUEST["beneficiary_id"] : 0;
$tag = isset($_REQUEST["Tag"]) ? $_REQUEST["Tag"] : "Custom";
$IsDocumentsTransmitted = -1;


if(isset($_REQUEST["IsDocumentsTransmitted"])){
    if($_REQUEST["IsDocumentsTransmitted"] == "Yes"){
        $IsDocumentsTransmitted = 1;
    } else if($_REQUEST["IsDocumentsTransmitted"] == "No"){
        $IsDocumentsTransmitted = 0;
    } else if($_REQUEST["IsDocumentsTransmitted"] == "<nil>"){
        // skip the params
    } else {
        $IsDocumentsTransmitted = $_REQUEST["IsDocumentsTransmitted"];
    }
}

if ($beneficiary_id == 0) {
	echo "Error : no beneficiary_id in parameter";
	return;
} else {
    $array = array();
    $array["tag"] = $tag;
    if($IsDocumentsTransmitted != -1){
        $array["IsDocumentsTransmitted"] = $IsDocumentsTransmitted;
    }
    print var_dump($array);
	$body = json_encode($array);
	$request = request("beneficiaries/" . $beneficiary_id . "/strongAuthentication", "PUT", $body);
}

if (!isset($request) || !isset($request -> ID)) {
	print("Error");
	return;
}
?>

</pre>
	</body>
</html>