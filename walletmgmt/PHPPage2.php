<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    </head>
    <body>
        <pre>
<?php
    
require_once(dirname(__FILE__) . "/lib/common.inc");



$fp = fopen('accounts_set_local.csv', 'r');

//fwrite($fp,account_id.PHP_EOL);

while (!feof($fp)){
//On lit les 4096 caractères de la ligne
$ligne = fgets($fp,4096);
  $body = json_encode(array(
 "Tag" => "",
 "PayerID" => $ligne, 
 "BeneficiaryWalletID" => 46130, 
 "BeneficiaryID" => 46129, 
 "Amount" => 100));

$transfer = request("transfers", "POST", $body); 
}
//On ferme le fichier et la balise de tableau
fclose($fp);


//for($i = 0; $i < 2500; $i++ ){

//    $body = json_encode(array("Email"=> "etienne.pierrot@leetchi.com","FirstName"=>"etienne","LastName"=>"pierrot","CanRegisterMeanOfPayment"=>1,"IP"=>"127.0.0.1")	);	
//    $user = request("users", "POST", $body); 
//    
//    $body = json_encode(array(
// "Tag" => "",
// "PayerID" => $source_account, 
// "BeneficiaryID" => $user -> ID, 
// "Amount" => $amount));

// $transfer = request("transfers", "POST", $body); 
// //fwrite($fp,$user->ID.PHP_EOL);

//}

//fclose($fp);

?>
        </pre>
    </body>
</html>
