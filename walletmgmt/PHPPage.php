<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    </head>
    <body>
        <pre>
<?php
    
require_once(dirname(__FILE__) . "/lib/common.inc");

$amount = 1000;
$source_account = 493;
$nb_transfer = 500;

$fp = fopen('accounts_set_local.csv', 'w');

//fwrite($fp,account_id.PHP_EOL);


for($i = 0; $i < $nb_transfer; $i++ ){

    $body = json_encode(array("Email"=> "etienne.pierrot@leetchi.com","FirstName"=>"etienne","LastName"=>"pierrot","CanRegisterMeanOfPayment"=>1,"IP"=>"127.0.0.1")	);	
    $user = request("users", "POST", $body); 
    
    $body = json_encode(array(
 "Tag" => "",
 "PayerID" => $source_account, 
 "BeneficiaryID" => $user -> ID, 
 "Amount" => $amount));

 $transfer = request("transfers", "POST", $body); 
 //fwrite($fp,$user->ID.PHP_EOL);

}

fclose($fp);

?>
        </pre>
    </body>
</html>
