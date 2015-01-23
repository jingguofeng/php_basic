<!doctype html>
<html>
  <head>
    <title>Your Store</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="jquery.validate.min.js"></script>
    <script type="text/javascript" src="jquery.validate.creditcardtypes.js"></script>
    <script>
      $(document).ready(function(){
        $("#checkout_form").validate();
      });
      </script>
  </head>
  <body>
    <h1>Your Store</h1>
    <h2>Checkout</h2>
	
    <?php
    require_once 'coffee_store_settings.php';
    
    if ($METHOD_TO_USE == "AIM") {
        ?>
		
        <form method="post" action="process_sale.php" id="checkout_form">
        <input type="hidden" name="size" value="<?php echo $size?>">
		
        <?php
    } else {
        ?>
		
        <form method="post" action="<?php echo (AUTHORIZENET_SANDBOX ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL)?>" id="checkout_form">
        <?php
        $time = time();
        $fp_sequence = $time;
        $fp = AuthorizeNetDPM::getFingerprint(AUTHORIZENET_API_LOGIN_ID, AUTHORIZENET_TRANSACTION_KEY, $amount, $fp_sequence, $time);
        $sim = new AuthorizeNetSIM_Form(
            array(
            'x_amount'        => $amount,
            'x_fp_sequence'   => $fp_sequence,
            'x_fp_hash'       => $fp,
            'x_fp_timestamp'  => $time,
            'x_relay_response'=> "TRUE",
            'x_relay_url'     => $coffee_store_relay_url,
            'x_login'         => AUTHORIZENET_API_LOGIN_ID,
            'x_test_request'  => TEST_REQUEST,
            )
        );
        echo $sim->getHiddenFieldString();
    }
		?>
      <fieldset>
        <div>
          <label>Credit Card Number</label>
          <input type="text" class="text required creditcard" size="15" name="x_card_num" value="6011000000000012"></input>
        </div>
        <div>
          <label>Exp.</label>
          <input type="text" class="text required" size="4" name="x_exp_date" value="04/15"></input>
        </div>
        <div>
          <label>CCV</label>
          <input type="text" class="text required" size="4" name="x_card_code" value="782"></input>
        </div>
      </fieldset>
      <fieldset>
        <div>
          <label>First Name</label>
          <input type="text" class="text required" size="15" name="x_first_name" value="John"></input>
        </div>
        <div>
          <label>Last Name</label>
          <input type="text" class="text required" size="14" name="x_last_name" value="Doe"></input>
        </div>
      </fieldset>
      <fieldset>
        <div>
          <label>Address</label>
          <input type="text" class="text required" size="26" name="x_address" value="123 Four Street"></input>
        </div>
        <div>
          <label>City</label>
          <input type="text" class="text required" size="15" name="x_city" value="San Francisco"></input>
        </div>
      </fieldset>
      <fieldset>
        <div>
          <label>State</label>
          <input type="text" class="text required" size="4" name="x_state" value="CA"></input>
        </div>
        <div>
          <label>Zip Code</label>
          <input type="text" class="text required" size="9" name="x_zip" value="94133"></input>
        </div>
        <div>
          <label>Country</label>
          <input type="text" class="text required" size="22" name="x_country" value="US"></input>
        </div>
		<div>
          <label>Company</label>
          <input type="text" class="text required" size="22" name="x_company" value="Axizgroup"></input>
        </div>
      </fieldset>
	  
	  <filedset>
			<label>Billing Email</label>
			<input type="text" class="text required" size="22" name="x_email" value="everjgfeng@gmail.com"></input>
			<label>Invoice</label>
			<input type="text" class="text required" size="22" name="x_invoice" value="1234567890"></input>
			<label>Customer IP</label>
			<input type="text" class="text required" size="22" name="x_ip" value="123.456.789"></input>
			<label>Order Description</label>
			<input type="text" class="text required" size="22" name="x_description" value="Testing my transaction."></input>
			<label>Billing Phone</label>
			<input type="text" class="text required" size="22" name="x_phone" value="646.359.0801"></input>
			<label>Customer IP</label>
			<input type="text" class="text required" size="22" name="x_ip" value="123.456.789"></input>
			<label>Fax</label>
			<input type="text" class="text required" size="22" name="x_fax" value="Test Fax"></input>
			<label>Customer ID</label>
			<input type="text" class="text required" size="22" name="cust_id" value="555555"></input>
			<label>Customer Type</label>
			<input type="text" class="text required" size="22" name="cust_type" value="Yourself"></input>
			<label>Shipping To First Name</label>
			<input type="text" class="text required" size="22" name="ship_first" value="First"></input>
			<label>Shipping To Last Name</label>
			<input type="text" class="text required" size="22" name="ship_last" value="Last"></input>
			<label>Shipping To Last Name</label>
			<input type="text" class="text required" size="22" name="ship_company" value="Promodealer"></input>
			<label>Shipping Company</label>
			<input type="text" class="text required" size="22" name="ship_last" value="Last"></input>
			<label>Shipping Address</label>
			<input type="text" class="text required" size="22" name="ship_address" value="Shipping Address"></input>
			<label>Shipping City</label>
			<input type="text" class="text required" size="22" name="ship_city" value="Chicago"></input>
			<label>Shipping State</label>
			<input type="text" class="text required" size="22" name="ship_state" value="IL"></input>
			<label>Shipping Zip</label>
			<input type="text" class="text required" size="22" name="ship_zip" value="60616"></input>
			<label>Shipping Country</label>
			<input type="text" class="text required" size="22" name="ship_country" value="USA"></input>
			
			
	  </fileset>
      <input type="submit" value="BUY" class="submit buy">
    </form>
	
	
  </body>
</html>
