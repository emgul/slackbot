<?php

$split_comand = trim($split_comand);

$split_answer = $splits[1];
$split_id = $splits[2];

$split_answer = trim($split_answer);
$split_id = trim($split_id);

$mysqli = new mysqli("$host", "$user", "$pass", "$database");

$ids_array = array();
$result = mysqli_query($mysqli, "SELECT id FROM questions");
while($row = mysqli_fetch_array($result))   {
$ids_array[] = $row['id'];
}
    
$ids_length=count($ids_array);


if(in_array($split_id , $ids_array)){

    if(!empty($split_text)){

    
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
}
elseif($split_id == NULL) {
    http_response_code(200);
   	echo json_encode("You didn't specify an id. Type the command like this: /q answer :: [answer] :: [id]", JSON_UNESCAPED_UNICODE);
}
else{
    http_response_code(200);
   	echo json_encode("Id: " . $split_id . " does not exist", JSON_UNESCAPED_UNICODE);
}  
    
?>