<?php require_once (dirname(__FILE__) . "/lib/common.inc");?>
<html>
    <head>
        <!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
        <script type="text/javascript">
            $(document).ready(function(){
            
                $('.enter').click(function(){
            
                    $(this).next('.content').slideToggle('fast');
            
                });
            });
        </script>
        <style type="text/css">
            <!--
                  .enter {
                      max-width: 960px;
                      background-color:#99c8ab;
                      padding-left:20px;
                      margin-left:10px;
                      }
                  .content {
                      max-width: 960px;
                      background-color:#E7F6EC;
                      margin-bottom:10px;
                      margin-left:10px;
                      padding:5px;
                      padding-left:40px;
                      }
                   .heading {
                      max-width: 960px;
                      background-color:#666;
                      padding-left:20px;
                   }
                   .heading2 {
                      max-width: 960px;
                      background-color:#666;
                      padding-left:20px;
                      margin: 40px 0 0 0;
                   }
            nput[type=submit] {
                  text-transform: uppercase;
                  background-color: rgb(16, 165, 74);
                  text-decoration: none;
                  color: white;
                  display: inline-block;
                  width: 50px;
                  font-size: 0.7em;
                  text-align: center;
                  padding: 7px 0px 4px;
                  border-radius: 2px 2px 2px 2px;
            }
              -->
        </style>

    </head>
    <body>
        <!--<p>Environment : <?php //echo $leetchiBaseURL;?></p>
        <p>Partner : <?php //echo $partnerID;?></p>
        <p>PrivateKeyFile : <?php //echo $privateKeyFile;?></p>
        <p>privateKeyPassword : <?php //echo $privateKeyPassword;?></p>
        
        <p>
      params with * can be create if they are missing<br>
            params in <i>italic</i> are optional<br>
            4970100000000170<br>
        </p>-->
        <div class="enter">User Management:</div>
        <div class="content">
            <div class="heading">Create User</div>
            <!-- Create User -->
            <form name="input" action="create_user.php" method="get">
				Tag: <input type="text" size="12" maxlength="150" name="Tag" value="DefaultTag"/>
				Email: <input type="text" size="12" maxlength="150" name="Email" value="DefaultMail@unknow.com"/>
				FirstName: <input type="text" size="12" maxlength="150" name="FirstName" value="DefaultFirstName"/>
				LastName: <input type="text" size="12" maxlength="150" name="LastName" value="DefaultLastName"/>
				CanRegisterMeanOfPayment: <input type="text" size="12" maxlength="150" name="CanRegisterMeanOfPayment" value="true"/>
				IP: <input type="text" size="12" maxlength="150" name="IP" value="127.0.0.1"/>
				Birthday: <input type="text" size="12" maxlength="150" name="Birthday" value="1357002061"/>
				Password: <input type="text" size="12" maxlength="150" name="Password" value="123456789azerty"/>
				Nationality: <input type="text" size="12" maxlength="150" name="Nationality" value="French" />
				PersonType :
				<select name="PersonType">
					<option value="NATURAL_PERSON">natural</option>
					<option value="LEGAL_PERSONALITY">legal</option>
				</select></br>
                <input type="submit" value="CREATE" />
            </form>
            <div class="heading2">Update User</div>
            <!-- Update User -->
            <form name="input" action="update_user.php" method="put">
                
				user_id: <input type="text" size="12" maxlength="150" name="user_id" />
				Nationality : <input type="text" size="12" maxlength="150" name="Nationality" value="French" />
				PersonType :
                <select name="PersonType">
                    <option value="natural">NATURAL_PERSON</option>
                    <option value="legal">LEGAL_PERSONALITY</option>
                </select></br>
                <input type="submit" value="UPDATE" />
            </form>
            <div class="heading2">Get User</div>
            <!-- Get User -->
            <form name="input" action="get_user.php" method="get">        
				user_id: <input type="text" size="12" maxlength="150" name="user_id" /></br>
                <input type="submit" value="GET" />
            </form>
            <div class="heading2">List wallet for a user</div>

                <!-- list wallet fir a user  -->
                <form name="input" action="get_wallets.php" method="get">
			        user_id* : <input type="text" size="12" maxlength="50" name="user_id"></br>
                    <input type="submit" value="GET" />
                </form>

           
       
        </div>
        <div class="enter">Split Payment Management:</div>
        <div class="content">
            <div class="heading">Get contribution by id</div>
            <!-- get contribution by id-->
            <form name="input" action="get_contribution.php" method="get">
             	contribution_id: <input type="text" size="12" maxlength="150" name="contribution_id" /></br>
                 <input type="submit" value="GET" />
            </form>
            <div class="heading2">Create contribution</div>
            <!-- Create contribution -->
            <form name="input" action="contribute.php" method="get">
                
                UserID (required) : <input type="text" size="12" maxlength="150" name="UserID" value ="0"/>
                WalletID (required) : <input type="text" size="12" maxlength="150" name="WalletID" value ="0"/>
                Amount (required) : <input type="text" size="12" maxlength="150" name="Amount" value="1000"/>
                ReturnURL (required) : <input type="text" size="12" maxlength="150" name="ReturnURL" value="<auto>" />
                Tag (optional) : <input type="text" size="12" maxlength="150" name="Tag" value="<nil>"/>
                ClientFeeAmount (optional) : <input type="text" size="12" maxlength="150" name="ClientFeeAmount" value="<nil>"/>
                TemplateURL (optional) : <input type="text" size="12" maxlength="150" name="TemplateURL" value="<nil>"/>
                RegisterMeanOfPayment (optional) : 
                 <select name="RegisterMeanOfPayment">
                    <option value="<nil>">NO_VALUE</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="ERROR_VALUE">ERROR_VALUE</option>
                </select>
                PaymentCardID (optional) : <input type="text" size="12" maxlength="150" name="PaymentCardID" value="<nil>"/>
                Culture (optional) : <input type="text" size="12" maxlength="150" name="Culture" value="<nil>"/>
                PaymentMethodType (optional) : 
                <select name="PaymentMethodType">
                    <option value="<nil>">NO_VALUE</option>
                    <option value="cb_visa_mastercard">cb_visa_mastercard</option>
                    <option value="elv">elv</option>
                    <option value="amex">amex</option>
                    <option value="giropay">giropay</option>
                    <option value="sofort">sofort</option>
                </select>
                Type (optional) :
                <select name="Type">
                    <option value="<nil>">NO_VALUE</option>
                    <option value="Payline">Payline</option>
                    <option value="Ogone">Ogone</option>
                </select></br>
                <input type="submit" value="CREATE" />
            </form>
            <div class="heading2">Create User & start a payment-</div>
            <!-- Create User & start a payment-->
            <form name="input" action="contribute_personal_account.php" method="get">
				user_id*: <input type="text" size="12" maxlength="150" name="user_id" />
				amount : <input type="text" size="12" maxlength="150" name="amount" value="1000" />
                Tag: <input type="text" size="12" maxlength="150" name="tag" value="DefaultTag"/></br>
                <input type="submit" value="CREATE" />
            </form>
            <div class="heading2">Contribute on a wallet-</div>
            <!-- Contribu on a wallet-->
            <form name="input" action="contribute_wallet.php" method="get">
               
				user_id* : <input type="text" size="12" maxlength="50" name="user_id">
				wallet_id* : <input type="text" size="12" maxlength="50" name="wallet_id">
				Register* : <input type="checkbox" name="registercard" />
				PaymentCardID : <input type="text" size="12" maxlength="50" name="PaymentCardID" />
				Method :
                <select name="methodType">
                    <option value="cb_visa_mastercard">cb_visa_mastercard</option>
                    <option value="elv">elv</option>
                    <option value="amex">amex</option>
                </select>
                Tag: <input type="text" size="12" maxlength="150" name="tag" value="DefaultTag"/></br>
                 <input type="submit" value="CREATE" />
            </form>
        </div>
        <div class="enter">Wallet Management:</div>
        <div class="content">
            <div class="heading">Create wallet</div>
            <!-- Create wallet -->
            <form name="input" action="create_wallet.php" method="get">
                
				user_id*: <input type="text" size="12" maxlength="150" name="user_id" />
                Tag: <input type="text" size="12" maxlength="150" name="tag" value="DefaultTag"/></br>
                <input type="submit" value="CREATE" />
            </form>
             <div class="heading2">Get wallet</div>
                <!-- get operations on wallet  -->
                <form name="input" action="get_wallet.php" method="get">
		        wallet_id : <input type="text" size="12" maxlength="50" name="wallet_id"></br>
                <input type="submit" value="GET" />
                </form>
                <div class="heading2">Update wallet</div>
                <!-- pu wallet  -->
                <form name="input" action="put_wallet.php" method="put">
                    
		            ID : <input type="text" size="12" maxlength="50" name="ID">
                    <i>Tag : </i><input type="text" size="12" maxlength="50" name="Tag" value="Tag">
                    <i>Name : </i><input type="text" size="12" maxlength="50" name="Name" value="Name">
                    <i>Description : </i><input type="text" size="12" maxlength="50" name="Description" value="Description">
                    <i>RaisingGoalAmount : </i><input type="text" size="12" maxlength="50" name="RaisingGoalAmount" value="100100">
                    <i>ContributionLimitDate : </i><input type="text" size="12" maxlength="50" name="ContributionLimitDate" value="1451314781"></br>
                    <input type="submit" value="UPDATE" />
                </form>
        
        </div>
        <div class="enter">Beneficiaries</div>
        <div class="content">
            <!-- Post beneficiaries -->
            <form name="input" action="create_beneficiary.php" method="get">
                BankAccountBIC : <input type="text" size="12" maxlength="50" name="BankAccountBIC" value="CRLYFRPP">
          BankAccountIBAN : <input type="text" size="12" maxlength="34" name="BankAccountIBAN" value="FR3020041010124530725S03383">
                BankAccountOwnerName : <input type="text" size="12" maxlength="100" name="BankAccountOwnerName" value="Nom par defaut">
                BankAccountOwnerAddress : <input type="text" size="12" maxlength="100" name="BankAccountOwnerAddress" value="Adresse par defaut">
                Tag: <input type="text" size="12" maxlength="150" name="tag" value="DefaultTag"/></br>
                <input type="submit" value="CREATE" />
            </form>
            <!-- Get beneficiaries -->
            <form name="input" action="get_beneficiary.php" method="get">
                <input type="submit" value="GET" />
                beneficiary_id : <input type="text" size="12" maxlength="50" name="beneficiary_id">
            </form>
        </div>

        <div class="enter">Transfers Management:</div>
        <div class="content">
            <div class="heading">Create Transfer</div>
            <!-- create transfer -->
            <form name="input" action="create_transfer.php" method="get"> 
			payer_id : <input type="text" size="12" maxlength="50" name="payer_id">
			beneficiary_id : <input type="text" size="12" maxlength="50" name="beneficiary_id">
			wallet_beneficiary_id : <input type="text" size="12" maxlength="50" name="wallet_beneficiary_id">
            wallet_payer_id : <input type="text" size="12" maxlength="50" name="wallet_payer_id">
			amount : <input type="text" size="12" maxlength="50" name="amount" value="1000">
            fees : <input type="text" size="12" maxlength="50" name="fees" value="0">
            Tag: <input type="text" size="12" maxlength="150" name="tag" value="DefaultTag"/></br>
            <input type="submit" value="CREATE" />
            </form>
            <div class="heading2">Get Transfer</div>
            <!-- get transfer -->
            <form name="input" action="get_transfer.php" method="get">
                
			    transfer_id* : <input type="text" size="12" maxlength="50" name="transfer_id"></br>
                <input type="submit" value="GET" />
            </form>
            <div class="heading2">Create transfer to personal account</div>
            <form name="input" action="create_transfer_to_personal_account.php" method="get">   
			    payer_id : <input type="text" size="12" maxlength="50" name="payer_id">
			    beneficiary_id : <input type="text" size="12" maxlength="50" name="beneficiary_id">
			    amount : <input type="text" size="12" maxlength="50" name="amount" value="1000"></br>
                <input type="submit" value="CREATE" />
            </form>
        </div>	

        <div class="enter">Withdrawals Management:</div>
        <div class="content">
             <div class="heading">Create withdrawal</div>
            <!-- create withdrawal -->
            <form name="input" action="create_withdrawal.php" method="get">
                
			    user_id* : <input type="text" size="12" maxlength="50" name="user_id">
			    wallet_id* : <input type="text" size="12" maxlength="50" name="wallet_id">
			    amount : <input type="text" size="12" maxlength="50" name="amount" value="1000">
				clientfeeamount : <input type="text" size="12" maxlength="50" name="ClientFeeAmount" value="0">
                amountWithoutFees : <input type="text" size="12" maxlength="50" name="AmountWithoutFees"></br>
                <input type="submit" value="CREATE" />
            </form>
            <div class="heading">Get withdrawal</div>
            <!-- get withdrawal -->
            <form name="input" action="get_withdrawal.php" method="get">
               
			    withdrawal_id : <input type="text" size="12" maxlength="50" name="withdrawal_id"></br>
                 <input type="submit" value="GET" />
            </form>
        </div>


	</body>
</html>