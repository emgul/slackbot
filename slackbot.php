<?php

require '../../logins.php';


$cmText = filter_input(INPUT_POST, "text", FILTER_SANITIZE_SPECIAL_CHARS);
//echo $cmText;
//$cmText = $_POST["text"];

$line1 = 'Line 1';
$line2 = 'Line 2';
/*$i = 1;
while ($i <= 10) {
	'\n'.$line1.
	$i = $i + 1;
}*/

/*$data = '
{
    "response_type": "ephemeral",
    "text": "In list:",
    "attachments": [
        {
            "text":"'.'\n'.$line1.'\n'.$line2.'"
        }
    ]
} 
';*/

if(isset($cmText)){
	header('Content-type:application/json;charset=utf-8');
	
	if (substr($cmText, 0, strlen('add ')) === 'add ') {
	    
	    //echo json_encode(" Found add: " . $cmText);
	    
	    $cmText = substr($cmText, strlen('add '));

	    if(!empty($cmText)){
	    	http_response_code(200);
	    	echo json_encode("Added: " . $cmText, JSON_UNESCAPED_UNICODE);


	    	$mysqli = new mysqli("$host", "$user", "$pass", "$database");

			$fråga = "test";
			$typ = "";

		    $filtered = $cmText;
		    //echo $cmText;
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


		}
		else{
			http_response_code(200);
			echo json_encode("Blank", JSON_UNESCAPED_UNICODE);
		}
	} elseif (substr($cmText, 0, strlen('list')) === 'list') {
	    //header('Content-type:application/json;charset=utf-8');
	    
	    //echo json_encode("Found list: " . $cmText);
	    
	    //$cmText = substr($cmText, strlen('list '));
		//http_response_code(200);
		
		/*$json_array = array();
		$i = 1;
		while ($i <= 10) {
			$json_array[] = '\n'.$i;
			$i = $i + 1;
		}*/
		echo '
{
    "response_type": "in_channel",
    "text": "In list:",
    "attachments": [
        {
            "text":"';

            	$mysqli = new mysqli("$host", "$user", "$pass", "$database");

            	if (!$mysqli->set_charset("utf8")) {
				    echo "Error loading character set utf8: " . $mysqli->error;
				    exit();
				}

				$result = $mysqli->query("SELECT * FROM questions");
				if(mysqli_num_rows($result) > 0)
				{
				    while ($row = $result->fetch_assoc()) {
				        echo '\n' . $row["fraga"];
				    }
				}
				else{
				    echo "List is empty";
				}

				$mysqli->close();

            echo'"
        }
    ]
} 
';
    	


		//$json_array[] = $row;



		/*$i = 1;
	    echo '
			{
			    "response_type": "ephemeral",
			    "text": "In list:",
			    "attachments": [
			        {
			            "text":"'. $i = 1;
						while ($i <= 10) { echo '\n'.$i.''; $i = $i + 1; } "".
						 '"
			        }
			    ]
			} 
			';*/

	    /*if(!empty($cmText)){
	    	echo json_encode("Removed list: " . $cmText, JSON_UNESCAPED_UNICODE);
		}
		else{
			echo json_encode("Blank", JSON_UNESCAPED_UNICODE);
		}*/
	} else {
		http_response_code(200);
	    echo json_encode("Non specific command", JSON_UNESCAPED_UNICODE);

	    
	}
} 
else{
	http_response_code(400);
	header('Content-type:application/json;charset=utf-8');
	echo json_encode("Invalid syntax", JSON_UNESCAPED_UNICODE);
}

?>