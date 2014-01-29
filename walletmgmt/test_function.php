<?php
require_once dirname(__FILE__) . "/lib/common.inc";
define('PAY_DEBUG', 1);
// All details will come from a user form
$options = array(
	'Email' => 'somenath@gmail.com',
	'FirstName' => 'Somenath',
	'LastName' => 'Dey',
	'Password' => '123456789azerty',
	'IP' => '127.0.0.1',
	'Birthday' => '1388859691',
	'Nationality' => 'IN',
	'PersonType' => 'NATURAL_PERSON',
	'Tag' => 'tag',
	'CanRegisterMeanOfPayment' => false,
	'Amount' => 1000,
	'PersonalWalletAmount' => 13500,
	'RaisingGoalAmount' => 12000,
	'ReturnURL' => 'http://localhost/l',
	'BankAccountOwnerName' => 'Mark Zuckerberg',
  'BankAccountOwnerAddress' => '1 bis Cité Paradis, 75010 Paris',
  'BankAccountIBAN' => 'FR3020041010124530725S03383',
  'BankAccountBIC' => 'CRLYFRPP',
);
function pay_send_request($path, $method, $options, $defaults) {
	$debug = false;
	$options = array_intersect_key($options, $defaults);
	$options = array_merge($defaults, $options);
	$body = json_encode($options);
	if (PAY_DEBUG) {
		print "</br></br>==[Request body]---'".$path."'----==</br></br>";
		print_r($body);
	}
	$return = requestwhitoutprint($path, $method, $body);
	if (false == $return) {
		return false;
	}
	else {
		if (isset($return->ID)) {
			return $return;
		}
		else {
			if (PAY_DEBUG) {
				print "\n==[Response]==\n";
				print_r($return);
			}
			return false;
		}
	}
}

//Returns user object
function pay_create_user($options) {
	$defaults = array(
		'Email' => '',
		'FirstName' => '',
		'LastName' => '',
		'Password' => '',
		'IP' => '',
		'Birthday' => '',
		'Nationality' => '',
		'PersonType' => 'NATURAL_PERSON',
		'Tag' => '',
		'CanRegisterMeanOfPayment' => false,
	);
	return pay_send_request('users', 'POST', $options, $defaults);
}

function pay_create_wallet($options) {
	$defaults = array(
		'Name' => '',
		'RaisingGoalAmount' => '',
		'Owners' => array(),
	);
	return pay_send_request('wallets', 'POST', $options, $defaults);
}
function pay_create_contribution($options) {
	$defaults = array(
		'UserID' => '',
		'WalletID' => '',
		'Amount' => '',
		'ReturnURL' => '',
	);
	return pay_send_request('contributions', 'POST', $options, $defaults);
}
function pay_create_benificiary($options) {
	$defaults = array(
		'BankAccountOwnerName' => '',
		'BankAccountOwnerAddress' => '',
		'BankAccountIBAN' => '',
		'BankAccountBIC' => '',
	);
	return pay_send_request('beneficiaries', 'POST', $options, $defaults);
}

function pay_create_transfers($options) {
	$defaults = array(
		'PayerID' => '',
		'PayerWalletID' => '',
		'Amount' => '',
		'BeneficiaryID' => '',
		'BeneficiaryWalletID' => '',
	);
	return pay_send_request('transfers', 'POST', $options, $defaults);
}
function pay_create_withdrawals($options) {
	$defaults = array(
		'UserID' => '',
    'WalletID' => '',
    'BeneficiaryID' => '',
    'Amount' => '',
	);
	return pay_send_request('withdrawals', 'POST', $options, $defaults);
}
function fetch_wallet($wallet_id) {
	return $wallet = requestwhitoutprint("wallets/$wallet_id", "GET");;
}
/*Site Owner test data:
Benificiary created. ID: 1483591
User created. ID: 1483592
Wallet created. ID: 1483594
*/

$beneficiary_wallet_id = 1483594;
$beneficiary_id = 1483591;
$beneficiary_user_id = 1483592;
$contribution_ammount = 1000;
$transfers_ammount = 1;
$withdrawals_ammount = 1;

/*Existing user details*/
$wallet_id = 1483594;
$user_id = 1483592;
$wallet_flag = 1;



if (isset($_POST['wallet']) && $_POST['wallet'] == 1) {
  //$user_id = fetch_wallet($wallet_id);
  //print $user_id ->Owners[0];
  $options['UserID'] = $user_id;
  $options['WalletID'] = $wallet_id;
  $options['Amount'] = $contribution_ammount;
  $contribution = pay_create_contribution($options);
	if ($contribution) {
		if (PAY_DEBUG) {
			echo "Contribution created. ID: {$contribution->ID}\n";
		}
	}
  $options['PayerID'] = $user_id;
  $options['PayerWalletID'] = 0;
  $options['Amount'] = $transfers_ammount;
  $options['BeneficiaryWalletID'] = $beneficiary_wallet_id;
  $options['BeneficiaryID'] = $beneficiary_id;
  $transfers = pay_create_transfers($options);
		if ($transfers) {
			if (PAY_DEBUG) {
				echo "Transfers created. ID: {$transfers->ID}\n";
			}
		}
}
else if (isset($_POST['wallet']) && $_POST['wallet'] == 0) {
$user = pay_create_user($options);
if ($user) {
	if (PAY_DEBUG) {
		echo "User created. ID: {$user->ID}\n";
	}
	if (!isset($options['Name'])) {
		$options['Name'] = $user->FirstName;
	}
	$options['Owners'] = array($user->ID);
	$wallet = pay_create_wallet($options);
	if ($wallet) {
		if (PAY_DEBUG) {
			echo "Wallet created. ID: {$wallet->ID}\n";
		}
		$options['UserID'] = $user->ID;
		$options['WalletID'] = $wallet->ID;
		$options['Amount'] = $contribution_ammount;
		$contribution = pay_create_contribution($options);
		if ($contribution) {
			if (PAY_DEBUG) {
				echo "Contribution created. ID: {$contribution->ID}\n";
			}
		}
		$options['PayerID'] = $user->ID;
		$options['PayerWalletID'] = 0;
		$options['Amount'] = $transfers_ammount;
		$options['BeneficiaryWalletID'] = $beneficiary_wallet_id;
		$options['BeneficiaryID'] = $beneficiary_id;
		$transfers = pay_create_transfers($options);
		if ($transfers) {
			if (PAY_DEBUG) {
				echo "Transfers created. ID: {$transfers->ID}\n";
			}
		}
		$options['UserID'] = $beneficiary_user_id;
		$options['WalletID'] = $beneficiary_wallet_id;
		$options['BeneficiaryID'] = $beneficiary_id;
		$options['Amount'] = $withdrawals_ammount;
		$withdrawals = pay_create_withdrawals($options);
		if($withdrawals) {
			if (PAY_DEBUG) {
				echo "Withdrawals created. ID: {$withdrawals->ID}\n";
			}
		}
		else {
		    //throw new Exception('Error');
			return false;
		}

	}
	else {
		// throw new Exception('Wallet not created');
		return false;
	}
}
else {
	// throw new Exception('User not created');
	return false;
}

}

/*$benificiary = pay_create_benificiary($options);
if ($benificiary) {requestwhitoutprint
		if (PAY_DEBUG) {
			echo "Benificiary created. ID: {$benificiary->ID}\n";
		}
}*/
?>
<html>
    <head>
         <title>test fc</title>
    </head>
    <body>
      <form action="" method="POST">
        <lablel>Choose if walllet is existing or not</lablel>
        <select name="wallet">
        <option value="1">Yes</option>
        <option value="0">No</option>
        </select>
        <input type="submit" name="mangopay_submit" value="Submit">
      </form>
    </body>
</html>
