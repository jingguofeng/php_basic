<?php 
	include "zohocrm.php";
	//echo $_GET['order_id'];
	$zoho_handler = new zohocrm("7cc2b781a595585bd242ec1a366b0aa7");
	
	$item = "SO No.: 1660352";
	//echo $item;
	$kk = $zoho_handler->searchRecords_xml("Sales Orders", $item);
	var_dump($kk);
	
	if($kk){
		$products = $kk->xpath('//FL[@val="Product Details"]/product');
		$products_num = count($products);
		
		$order_grand_total = $kk->xpath('//FL[@val="Grand Total"]'); //always return an array.
		$grand_total = $order_grand_total[0];
		$mysale_id = $zoho_handler->find_record_id($kk, "Sales Orders");
	}
	
	echo $mysale_id;
	
	if($mysale_id){
		$xml_data = "<SalesOrders><row no=\"1\">".
				"<FL val=\"Billing Street\">Test</FL>".
				"</row></SalesOrders>";
	
		$update_now = $zoho_handler->updateRecordsByID("Sales Orders", $mysale_id,$xml_data);
	}
	
	echo $update_now;
?>