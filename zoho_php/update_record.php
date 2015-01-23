
<h1>Search result</h1>
<?php

$module = "SalesOrders";
$method = "searchRecords";



function get_data($module,$method){
	//header("Content-type: application/xml");
    $token="7cc2b781a595585bd242ec1a366b0aa7";
    
    //$module = "SalesOrders";
    
    //$method = "getRecords";
    //$method = "searchRecords";
    
    $url = "https://crm.zoho.com/crm/private/xml/".$module."/".$method;
    
    
    //$param= "authtoken=".$token."&scope=crmapi";
    
    $param= "authtoken=".$token."&scope=crmapi"."&criteria=(SO No.: 1640057)";
    
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
    return $result;
}


function update_field($module, $record_id, $xml_data){

	$token="7cc2b781a595585bd242ec1a366b0aa7";
	
	//$module = "SalesOrders";
	
	$method = "updateRecords";
	//$method = "searchRecords";
	
	$url = "https://crm.zoho.com/crm/private/xml/".$module."/".$method;
	
	
	//$param= "authtoken=".$token."&scope=crmapi";
	
	$param= "newFormat=1&authtoken=".$token."&scope=crmapi"."&id=".$record_id."&xmlData=".$xml_data;
	
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
	return $result;
	
}


	$kk = get_data($module,$method);
	//$xml_data = uncdata($kk);
	$response1 = simplexml_load_string($kk,'SimpleXMLElement',LIBXML_NOCDATA);

?>


<h4>
<?php 

//var_dump($kk);

//var_dump($response1);
/*

echo "<br>";
echo "<br>";
echo "<br>";
echo $response1->result->Leads->row[0]->FL[0]->attributes();
echo "<br>";
echo $response1->result->Leads->row[0]->FL[3];
*/

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

foreach($result_xml as $row){
	foreach($row->FL as $en){
		echo $en->attributes().": ".$en."<br>";
	}
}

echo "<br>";

$find = 1;

while($find){
foreach($result_xml as $row){
	foreach($row->FL as $en){
		 if($en->attributes() == "SALESORDERID"){
		 	$find = 0;
		 	$id = $en;
		 }
	}
}
}

echo "<br>";
echo "id: ".$id;

echo "<br>";

$xml_data = "<SalesOrders><row no=\"1\"><FL val=\"Transaction Number\">1234567890</FL><FL val=\"Shipping Country\">test JIngguo feng</FL><FL val=\"Description\">Test By Jingguo Feng</FL></row></SalesOrders>";

$update_now = update_field($module, $id, $xml_data);

echo $update_now;
?> 

</h4>

<br>
<br>
<h4><?php //print_r($response->result->Leads->row[0]);?></h4>
<br>
<br>
<h4><?php //echo $response->result->Leads->row[0]->FL[3]->value;?></h4>
