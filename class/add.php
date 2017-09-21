<?php
	    
if(!empty($split_text) && isset($_POST["user_id"])){

	$userId = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_SPECIAL_CHARS);

   	$mysqli = new mysqli("$host", "$user", "$pass", "$database");

	$typ = "all";
	$typText = " as type all";

	if(isset($splits[2])){
		$split_typ = $splits[2];
		$split_typ = trim($split_typ);

		switch ($split_typ) {
			case 'teacher':
			case 't':
				$typ = "teacher";
				$typText = " as type teacher";
				break;

			case 'group':
			case 'g':
				$typ = "group";
				$typText = " as type group";
				break;

			case 'all':
			case 'a':
				$typ = "all";
				$typText = " as type all";
				break;
			
			default:
				$typ = "all";
				$typText = " as type all";
				break;
		}
	}

    $filtered = $split_text;
    
	$filtered = trim($filtered);

	if (!$mysqli->set_charset("utf8")) {
	    echo "Error loading character set utf8: " . $mysqli->error;
	    exit();
	}

    if (!($stmt = $mysqli->prepare("INSERT into questions(fraga, typ, userid) values (?,?,?)"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("sss", $filtered, $typ, $userId)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$filtered = $mysqli->real_escape_string($filtered);

    $mysqli->close();

    http_response_code(200);
   	echo json_encode("Added: " . $split_text . $typText, JSON_UNESCAPED_UNICODE);

}
else{
	http_response_code(200);
	echo json_encode("Blank questions isn't allowed!", JSON_UNESCAPED_UNICODE);
}

?>