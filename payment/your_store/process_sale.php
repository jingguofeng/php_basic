<?php

require_once 'coffee_store_settings.php';


if ($METHOD_TO_USE == "AIM") {
    $transaction = new AuthorizeNetAIM;
    $transaction->setSandbox(AUTHORIZENET_SANDBOX);
    $transaction->setFields(
        array(
        'amount' => $amount, 
        'card_num' => $_POST['x_card_num'], 
        'exp_date' => $_POST['x_exp_date'],
        'first_name' => $_POST['x_first_name'],
        'last_name' => $_POST['x_last_name'],
        'address' => $_POST['x_address'],
        'city' => $_POST['x_city'],
        'state' => $_POST['x_state'],
        'country' => $_POST['x_country'],
        'zip' => $_POST['x_zip'],
        'email' => $_POST['x_email'],
        'card_code' => $_POST['x_card_code'],
		'company' => $_POST['x_company'],
		'invoice_num' => $_POST['x_invoice'], 
		'customer_ip' => $_POST['x_ip'],
		'description' => $_POST['x_description'],
		'phone' =>$_POST['x_phone'],
		'fax' => $_POST['x_fax'],
		'cust_id' => $_POST['cust_id'],
		'type' => $_POST['cust_type'],
		'ship_to_first_name' => $_POST['ship_first'],
		'ship_to_last_name' => $_POST['ship_last'],
		'ship_to_company' => $_POST['ship_company'],
		'ship_to_address' => $_POST['ship_address'],
		'ship_to_city' => $_POST['ship_city'],
		'ship_to_state' => $_POST['ship_state'],
		'ship_to_zip' => $_POST['ship_zip'],
		'ship_to_country' => $_POST['ship_country'],
		
		
        )
    );
    
    $response = $transaction->authorizeAndCapture();
    if ($response->approved) {
        // Transaction approved! Do your logic here.
        header('Location: thank_you_page.php?transaction_id=' . $response->transaction_id);
    } else {
        header('Location: error_page.php?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text);
    }
} elseif (count($_POST)) {
    $response = new AuthorizeNetSIM;
    if ($response->isAuthorizeNet()) {
        if ($response->approved) {
            // Transaction approved! Do your logic here.
            // Redirect the user back to your site.
            $return_url = $site_root . 'thank_you_page.php?transaction_id=' .$response->transaction_id;
        } else {
            // There was a problem. Do your logic here.
            // Redirect the user back to your site.
            $return_url = $site_root . 'error_page.php?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text;
        }
        echo AuthorizeNetDPM::getRelayResponseSnippet($return_url);
    } else {
        echo "MD5 Hash failed. Check to make sure your MD5 Setting matches the one in config.php";
    }
}



