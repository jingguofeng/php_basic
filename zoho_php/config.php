<?php
/**
 * This file contains config info for the sample app.
 */
ini_set('display_errors','0');			// Best practise on production sites
ini_set('log_errors','1');			// We need to log them otherwise this script will be pointless!
ini_set('error_log','flashwholesaler.com/fakeweb/error_log');	// Full path to a writable file - include the file name
error_reporting(E_ALL ^ E_NOTICE);		// What errors to log - see: http://www.php.net/error_reporting



// Adjust this to point to the Authorize.Net PHP SDK
require_once 'authorize_php_sdk/AuthorizeNet.php';


$METHOD_TO_USE = "AIM";
// $METHOD_TO_USE = "DIRECT_POST";         // Uncomment this line to test DPM


//define("AUTHORIZENET_API_LOGIN_ID","8qf2HE63");    // Add your API LOGIN ID: Flashwholesaler

define("AUTHORIZENET_API_LOGIN_ID","7tWh64ZH4ufR");    // Add your API LOGIN ID: Test
define("AUTHORIZENET_TRANSACTION_KEY","4D2UHtZ3jYk3664R"); // Add your API transaction key: Test
//define("AUTHORIZENET_TRANSACTION_KEY","5Xq5e6zzMMu58G2f"); // Add your API transaction key: Flashwholesaler
define("AUTHORIZENET_SANDBOX",true);       // Set to false to test against production
define("TEST_REQUEST", "true");           // You may want to set to true if testing against production


// You only need to adjust the two variables below if testing DPM
define("AUTHORIZENET_MD5_SETTING","");                // Add your MD5 Setting.
//$site_root = "http://flashwholesaler.com/fakeweb/flashwholesaler/"; // Add the URL to your site: Flashwholesaler

$site_root = "localhost/flashwholesaler/"; // Add the URL to your site: Test

if (AUTHORIZENET_API_LOGIN_ID == "") {
    die('Enter your merchant credentials in config.php before running the sample app.');
}
