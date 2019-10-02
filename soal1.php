<?php
$data = array(
	"itemId"      				=> "12341822",
	"itemName"   				=> "basic t-shirt ehek",
	"price"       				=> 70000,
	"availableColorAndSize"		=> array (array("color" => "Red", "size"=>"S","M","L"), array("color" => "solid black", "size"=>"M","L")),
	"freeShiping" 				=> false,
);
function formatJson($data){
	return json_encode($data);
}
echo formatJson($data);