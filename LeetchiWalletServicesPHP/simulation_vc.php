<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    </head>
    <body>
        <pre>
<?php
    
require_once(dirname(__FILE__) . "/lib/common.inc");
set_time_limit(0);
$nbIteration = isset($_REQUEST["nbIteration"]) ? $_REQUEST["nbIteration"] : 1;

$userB = 58687;
$userA = 58689;

$fp = fopen("time_$nbIteration.csv", 'w');
//fwrite($fp,account_id.PHP_EOL);


for($i = 0; $i < $nbIteration; $i++ ){
    $time=microtime(true);
    $body = json_encode(array("Owners" => array($userA), "Tag" => $i));
    $wallet = request("wallets", "POST", $body);
    
    $body = json_encode(array(
 "Tag" => $i,
 "PayerID" => $userB, 
 "BeneficiaryID" => $userA,
 "BeneficiaryWalletID" => $wallet -> ID , 
 "PayerWalletID" => 0,
 "Amount" => 100));

 $transfer = request("transfers", "POST", $body);

 $body = json_encode(array("Email" => "etienne$i@leetchi.com", "FirstName" => "Etienne", "Lastname" => "PIERROT", "IP" => "127.0.0.1", "Birthday" => 1300186358, "Nationality" => "FR", "PersonType" => "NATURAL_PERSON", "Tag" => $i ));
 $newuser = request("users", "POST", $body); 

     $body = json_encode(array(
 "Tag" => $i,
 "PayerID" => $userA, 
 "BeneficiaryID" => $newuser -> ID,
 "BeneficiaryWalletID" => 0 , 
 "PayerWalletID" => $wallet -> ID,
 "Amount" => 100));

 $transfer = request("transfers", "POST", $body);
 $iterationtime = microtime(true) - $time;
  fwrite($fp,$iterationtime.PHP_EOL);
}

fclose($fp);

?>
        </pre>
    </body>
</html>
