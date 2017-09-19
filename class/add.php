<?php
	    
if(!empty($split_text)){
   	$mysqli = new mysqli("$host", "$user", "$pass", "$database");

	$fråga = "test";
	$typ = "";

    $filtered = $split_text;
    
	$filtered = trim($filtered);

	if (!$mysqli->set_charset("utf8")) {
	    echo "Error loading character set utf8: " . $mysqli->error;
	    exit();
	}

    if (!($stmt = $mysqli->prepare("INSERT into questions(fraga, typ) values (?,?)"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("si", $filtered, $typ)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$filtered = $mysqli->real_escape_string($filtered);

    $mysqli->close();

    http_response_code(200);
   	echo json_encode("Added: " . $split_text, JSON_UNESCAPED_UNICODE);

}
else{
	http_response_code(200);
	echo json_encode("Blank questions isn't allowed!", JSON_UNESCAPED_UNICODE);
}

?>