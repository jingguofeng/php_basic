
<h1>Search result</h1>
<?php

function get_data(){
	//header("Content-type: application/xml");
    $token="7cc2b781a595585bd242ec1a366b0aa7";
    
    $module = "SalesOrders";
    
    //$method = "getRecords";
    $method = "searchRecords";
    
    $url = "https://crm.zoho.com/crm/private/xml/".$module."/".$method;
    
    
    //$param= "authtoken=".$token."&scope=crmapi";
    
    $param= "authtoken=".$token."&scope=crmapi"."&criteria=(SO No.: 1619041)";
    
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

	$kk = get_data();
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


foreach($response1->result->SalesOrders->row as $row){
	foreach($row->FL as $en){
		echo $en->attributes().": ".$en."<br>";
	}
}

?> 

</h4>

<br>
<br>
<h4><?php //print_r($response->result->Leads->row[0]);?></h4>
<br>
<br>
<h4><?php //echo $response->result->Leads->row[0]->FL[3]->value;?></h4>
