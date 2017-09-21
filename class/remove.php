<?php 

if(isset($_POST["user_id"])){
	$userId = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_SPECIAL_CHARS);
}
if(isset($splits[1])){
	$split_id = $splits[1];
	$split_id = trim($split_id);
}

//if ($userId == "TestId") {
if (isset($userId) && !empty($split_id)) {
	/*echo "Allowed!";
	echo "	";
	echo "User: ";*/

	$id = $split_id;

	$mysqli = new mysqli("$host", "$user", "$pass", "$database");

    if (!$mysqli->set_charset("utf8")) {
		echo "Error loading character set utf8: " . $mysqli->error;
		exit();
	}

	$sql = "SELECT * FROM questions WHERE id= $id";
	//$sql1 = "SELECT * FROM questions WHERE id= $id";
	$sql1 = "DELETE FROM questions WHERE id= $id";

	$result = $mysqli->query($sql);
	if(mysqli_num_rows($result) > 0)
	{

		//echo $row["fraga"];

	    while ($row = $result->fetch_assoc()) {
	        //echo $row["userid"];
	        $qUserId = $row["userid"];
	        //echo $qUserId;
	    }

	    if ($qUserId == $userId) {
	    	//echo "Removed question with id: " . $id;
	    	$mysqli->query($sql1);
	    	http_response_code(200);
   			echo json_encode("Removed question with id: " . $id, JSON_UNESCAPED_UNICODE);
	    }
	    else{
	    	http_response_code(200);
   			echo json_encode("The question with id " . $id . " wasn't added by you!", JSON_UNESCAPED_UNICODE);
	    }
	}
	else{
	    //echo "No question with that id";
	    http_response_code(200);
   		echo json_encode("No question with id: " . $id, JSON_UNESCAPED_UNICODE);
	}

	$mysqli->close();


}
else {
	if (!isset($userId)) {
		http_response_code(200);
		echo json_encode("User null", JSON_UNESCAPED_UNICODE);
	}
	elseif (empty($split_id)) {
		http_response_code(200);
		echo json_encode("Blank id isn't allowed!", JSON_UNESCAPED_UNICODE);
	}
	else {
		http_response_code(400);
		echo json_encode("Invalid syntax", JSON_UNESCAPED_UNICODE);
	}
}
?>