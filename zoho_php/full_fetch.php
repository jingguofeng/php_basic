
<h1>Search result</h1>
<?php

include "config.php";
$module = "SalesOrders";
$method = "searchRecords";

$errors = array();



function record_not_found($errno, $errstr, $errfile, $errline, $errcontext){
	$errors[] = "<b>Error: </b>[$erron] $errstr <br>";
	echo "<b>Error: </b>[$erron] $errstr <br>";
	echo "Ending Script";
	$errors[] = "<b>Error File: </b> $errfile <br>";
	$errors[] = "<b>Error Line: </b> $errline <br>";
	$errors[] = "<b>Error Context: </b> $errcontext <br>";
	$error_msg = "<h1>An error occurred, Please Fix Me!</h1><br>".
			"<b>Error: </b>[$erron] $errstr <br>".
			"<b>Error File: </b> $errfile <br>".
			"<b>Error Line: </b> $errline <br>".
			"<b>Error Context: </b> $errcontext <br>";
	$type = 1;
	$destination = "everjgfeng@gmail.com";
	// mime type to display message in HTML
	$headers = "From: error-noreply@promodealer.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	error_log($error_msg,$type,$destination,$headers);
	header('Location: error_page.php?error_code='.$errno);
}

set_error_handler("record_not_found");

//convert a xmlobject to an array
function _xml2array ( $xmlObject, $out = array () ){
	foreach ( (array) $xmlObject as $index => $node )
		$out[$index] = ( is_object ( $node ) ) ? _xml2array ( $node ) : $node;

	return $out;
}

function get_data($module,$method,$cond1){   //return the simple xml object of zoho crm result
	//header("Content-type: application/xml");
	$token="7cc2b781a595585bd242ec1a366b0aa7";

	//$module = "SalesOrders";

	//$method = "getRecords";
	//$method = "searchRecords";

	$url = "https://crm.zoho.com/crm/private/xml/".$module."/".$method;


	//$param= "authtoken=".$token."&scope=crmapi";

	$param= "authtoken=".$token."&scope=crmapi"."&criteria=(SO No.: ".$cond1.")";

	//use php curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	$result = curl_exec($ch);
	curl_close($ch);
	//var_dump($result);
	//echo $result;

	//$myfile = fopen("result.txt", "w") or die("Unable to open file!");
	//$txt = "jingguo feng \n";
	//fwrite($myfile, $result);
	//fclose($myfile);

	//var_dump($result);
	
	/*
	$response1 = simplexml_load_string($result,'SimpleXMLElement',LIBXML_NOCDATA);


	if($response1->children()->getName() == "result"){
		 
		//Get all the row value
		switch($module){
			 
			case "Leads":
				$result_xml = $response1->result->Leads->row;
				break;
			case "SalesOrders":
				$result_xml = $response1->result->SalesOrders->row;
				break;
			default:
				echo "Error: Can't find module.";
		}
		 
		return $result_xml;    //return simple xml object

	}elseif($response1->children()->getName() == "nodata"){
		return 0;
	}else{
		trigger_error("An error",E_USER_WARNING);
	}

	*/
	
	$response1 = simplexml_load_string($result,'SimpleXMLElement',LIBXML_NOCDATA);

	return $response1;
}


$kk = get_data($module,$method,"1666404");



var_dump($kk);

echo "<br>";

var_dump( $products = $kk->xpath('/response/result/SalesOrders/row/FL[@val="Product Details"]/product'));

echo "<br>";
echo "<br>";
echo "<br>";
$n = 1;

echo count($products);

echo "<br>";
foreach($products as $product){
	echo "<h3>Product No.".$n."</h3>";
	$abc = $product->xpath('//FL[@val="Product Details"]/product[@no="1"]/FL[@val="Product Id"]');
	var_dump($abc);
	echo($abc[0]->attributes());
	echo($abc[0]);
	echo $product->FL[1]->attributes().": ".$product->FL[1];
	
	//$name = $product->xpath('/FL[@val="Product Name"]');
	
	//var_dump($name);
	/*
	foreach($product as $en){
		echo $en->attributes().": ".$en."<br>";
	}
	*/
	$n++;
}

echo "<br>";
echo "<br>";
echo "<br>";

$a = $kk->xpath('/response/result/SalesOrders/row/FL[@val="SO Number"]');

var_dump($a);


echo "<br>";
echo "<br>";
echo "<br>";

$xmlarray = _xml2array($kk);

var_dump($xmlarray);


echo $xmlarray['result']['SalesOrders']['row']['FL'][0];
?>



<h4>
<?php 

//var_dump($kk);

//var_dump($response1);
//echo "<br>";
// $response1->children()->getName();
//echo "<br>";

/*

echo "<br>";
echo "<br>";
echo "<br>";
echo $response1->result->Leads->row[0]->FL[0]->attributes();
echo "<br>";
echo $response1->result->Leads->row[0]->FL[3];
*/

/*

if($kk){
	

	foreach($kk as $row){
		foreach($row->FL as $en){
			echo $en->attributes().": ".$en."<br>";
		}
	}

}else{
	echo "Can't find your account! Try again.";
}


*/


?> 

</h4>

<br>
<br>
<h4><?php //print_r($response->result->Leads->row[0]);?></h4>
<br>
<br>
<h4><?php //echo $response->result->Leads->row[0]->FL[3]->value;?></h4>
