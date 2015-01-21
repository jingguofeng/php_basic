<?php

function get_data(){
	header("Content-type: application/xml");
    $token="7cc2b781a595585bd242ec1a366b0aa7";
    
    $module = "Leads";
    
    $method = "getRecords";
    //$method = "searchRecords";
    
    $url = "https://crm.zoho.com/crm/private/xml/".$module."/".$method;
    
    
    $param= "authtoken=".$token."&scope=crmapi";
    
    //$param= "authtoken=".$token."&scope=crmapi"."&criteria=(SO No.: 1619041)";
    
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
    
    //var_dump($result);
    return $result;
}

$kk = get_data();

?>