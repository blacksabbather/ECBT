<?php
include 'getToken.php';
	$amount = $_POST['amount'];
	$nonce = $_POST['payment_method_nonce'];
	$order = $_POST['orderId'];
	$customField = $_POST["customField"];
	$desc = $_POST["description"];

	$result = $gateway->transaction()->sale([
	    "amount" => $amount,
	    "merchantAccountId" => 'USD',//currency should be passed to the server in case there are more than one currency configured in your account
	    "paymentMethodNonce" => $nonce,
	    "orderId" => $order,
	    "descriptor" => [ //company info
	    'name' => 'company*my product',
        'phone' => '3125551212',
        'url' => 'company.com'
	    ],
	    /*"shipping" => [ //optional
	      "firstName" => "Scruff",
	      "lastName" => "McGruff",
	      "company" => "Braintree",
	      "streetAddress" => "1 Main st.",
	      "extendedAddress" => "Suite 403",
	      "locality" => "New York", //City
	      "region" => "NY", //state or province
	      "postalCode" => "12345",
	      "countryCodeAlpha2" => "US"
	    ],*/
	    "options" => [ //Required
	    	"submitForSettlement" => true, //payment is done now
	    	"paypal" => [
	        "customField" => $customField,
	        "description" => $desc
	      ]
	    ]
	]);
	if ($result->success) {
	  print_r("Success ID: " . $result->transaction->id);
	  print_r("<pre>");
  	  print_r($result);
	} else {
	  print_r("Transaction sale Error Message: " . $result);
	}
?>
