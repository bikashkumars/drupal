<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    </head>
    <body>
        <pre>

<?php

require_once (dirname(__FILE__) . "/lib/common.inc");

// Retrieve parameters
$parameters = array("UserID", "WalletID", "ReturnURL", "Amount", "ReturnURL", "Tag", "ClientFeeAmount", "TemplateURL", "RegisterMeanOfPayment", "PaymentCardID", "Culture", "PaymentMethodType", "Type");

// default return URL
$array = array();
for ($i = 0; $i < count($parameters) ; $i++) {

    if(isset($_REQUEST[$parameters[$i]]) && $parameters[$i] == "RegisterMeanOfPayment"){
        if($_REQUEST[$parameters[$i]] == "Yes"){
            $array[$parameters[$i]] = 1;
        } else if($_REQUEST[$parameters[$i]] == "No"){
            $array[$parameters[$i]] = 0;
        } else if($_REQUEST[$parameters[$i]] == "<nil>"){
            // skip the params
        } else {
            $array[$parameters[$i]] = $_REQUEST[$parameters[$i]];
        }
    } else if(isset($_REQUEST[$parameters[$i]]) && $_REQUEST[$parameters[$i]] != "<nil>" && $_REQUEST[$parameters[$i]] != "<auto>"){
        $array[$parameters[$i]] = $_REQUEST[$parameters[$i]];
    } else if(isset($_REQUEST[$parameters[$i]]) && $parameters[$i] == "ReturnURL" && $_REQUEST[$parameters[$i]] == "<auto>"){
        $array[$parameters[$i]] = "http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . str_replace( "\\", "", dirname($_SERVER["REQUEST_URI"])) . "/return.php";
    }
}

// Convert format
$body = json_encode($array);

print var_dump($body);

$contribution = request("contributions", "POST", $body);

/*
 * Redirect to url of payment
 */

if ($contribution != null) {
    print "<a href=" . $contribution -> PaymentURL . ">Aller au paiement</a>";
} else {
    print "contribution is not create";
}

?>

        </pre>
    </body>
</html>