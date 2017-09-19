<?php

require '../../logins.php';

$cmText = filter_input(INPUT_POST, "text", FILTER_SANITIZE_SPECIAL_CHARS);

if(isset($cmText)){
	header('Content-type:application/json;charset=utf-8');
	
	$splits = explode("::", $cmText);

	$split_comand = $splits[0];
	$split_comand = trim($split_comand);

	$split_text = "";
	if(isset($splits[1])){
		$split_text = $splits[1];
		$split_text = trim($split_text);
	}


	switch ($split_comand) {
		case 'add':
			require 'class/add.php';
			break;

		case 'list':
			require 'class/list.php';
			break;

		case 'clear':
			echo json_encode("The clear command is under construction", JSON_UNESCAPED_UNICODE);
			break;
		
		default:
			echo json_encode("Invalid command", JSON_UNESCAPED_UNICODE);
			break;
	}
	
} 
else{
	http_response_code(400);
	header('Content-type:application/json;charset=utf-8');
	echo json_encode("Invalid syntax", JSON_UNESCAPED_UNICODE);
}

?>