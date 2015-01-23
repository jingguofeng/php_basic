
<h1>Search result</h1>
<?php


function uncdata($xml)
{
	// States:
	//
	//     'out'
	//     '<'
	//     '<!'
	//     '<!['
	//     '<![C'
	//     '<![CD'
	//     '<![CDAT'
	//     '<![CDATA'
	//     'in'
	//     ']'
	//     ']]'
	//
	// (Yes, the states a represented by strings.)
	//

	$state = 'out';

	$a = str_split($xml);

	$new_xml = '';

	foreach ($a AS $k => $v) {

		// Deal with "state".
		switch ( $state ) {
			case 'out':
				if ( '<' == $v ) {
					$state = $v;
				} else {
					$new_xml .= $v;
				}
				break;

			case '<':
				if ( '!' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<!':
				if ( '[' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<![':
				if ( 'C' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<![C':
				if ( 'D' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<![CD':
				if ( 'A' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<![CDA':
				if ( 'T' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<![CDAT':
				if ( 'A' == $v  ) {
					$state = $state . $v;
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case '<![CDATA':
				if ( '[' == $v  ) {


					$cdata = '';
					$state = 'in';
				} else {
					$new_xml .= $state . $v;
					$state = 'out';
				}
				break;

			case 'in':
				if ( ']' == $v ) {
					$state = $v;
				} else {
					$cdata .= $v;
				}
				break;

			case ']':
				if (  ']' == $v  ) {
					$state = $state . $v;
				} else {
					$cdata .= $state . $v;
					$state = 'in';
				}
				break;

			case ']]':
				if (  '>' == $v  ) {
					$new_xml .= str_replace('>','&gt;',
							str_replace('>','&lt;',
									str_replace('"','&quot;',
											str_replace('&','&amp;',
													$cdata))));
					$state = 'out';
				} else {
					$cdata .= $state . $v;
					$state = 'in';
				}
				break;
		} // switch

	}

	//
	// Return.
	//
	return $new_xml;

}


function get_data(){
	//header("Content-type: application/xml");
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
	$response2 = new DOMDocument();
	$response2->load($kk);
	//echo $kk;
	$testid = 10;
	
	//echo $testid;
	
 	//header('Location: show.php?testid=' . $testid);

?>


<h4>
<?php 

//var_dump($kk);

/*
var_dump($response1);
echo "<br>";
echo "<br>";
echo "<br>";
echo $response1->result->Leads->row[0]->FL[0]->attributes();
echo "<br>";
echo $response1->result->Leads->row[0]->FL[3];
*/

foreach($response1->result->Leads->row as $row){
	echo "---------------------------------------------------------------"."<br>";
	foreach($row->FL as $en){
		echo $en->attributes().": ".$en."<br>";
	}
	echo "<br>";
	
}
?> 

</h4>

<br>
<br>
<h4><?php //print_r($response->result->Leads->row[0]);?></h4>
<br>
<br>
<h4><?php //echo $response->result->Leads->row[0]->FL[3]->value;?></h4>
