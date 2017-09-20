<?php



$split_comand = trim($split_comand);

$split_answer = $splits[1];
$split_id = $splits[2];

$split_answer = trim($split_answer);
$split_id = trim($split_id);

//echo $splits[2];

//echo $splits[1];

if(!empty($split_text)){
   	$mysqli = new mysqli("$host", "$user", "$pass", "$database");
    
    
    if (!$mysqli->set_charset("utf8")) {
	    echo "Error loading character set utf8: " . $mysqli->error;
	    exit();
	}
    
    $AS = 1;
    
    if (!($stmt = $mysqli->prepare("UPDATE questions SET answer=?, answer_status=? WHERE id=?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("sii", $split_answer, $AS, $split_id)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

    $mysqli->close();
    
    http_response_code(200);
   	echo json_encode("Added: " . $split_answer . " as an answer", JSON_UNESCAPED_UNICODE);
}
    
    
?>