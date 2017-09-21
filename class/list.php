<?php

$split_listType = "";
if(isset($splits[1])){
	$split_listType = $splits[1];
	$split_listType = trim($split_listType);
}

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

				switch ($split_listType) {
					case 'answer':
					case 'answers':
						$result = $mysqli->query("SELECT * FROM questions where answer_status=1");
						if(mysqli_num_rows($result) > 0)
						{

						    while ($row = $result->fetch_assoc()) {
						        echo '\n' . $row["fraga"] . ' Answer: ' . $row["answer"] . ' Id: ' .$row["id"] . ' Type: ' . $row["typ"] . ' Added: ' . $row["tid"] . '\n';
						    }
						}
						else{
						    echo "List is empty";
						}
						break;
					
					case 'all':
						$result = $mysqli->query("SELECT * FROM questions");
						if(mysqli_num_rows($result) > 0)
						{

						    while ($row = $result->fetch_assoc()) {
						        echo '\n' . $row["fraga"];
						        if ($row["answer_status"] == 1) {
						        	echo' Answer: ' . $row["answer"];
						        }
						        echo' Id: ' .$row["id"] . ' Type: ' . $row["typ"] . ' Added: ' . $row["tid"] . '\n';
						    }
						}
						else{
						    echo "List is empty";
						}
						break;

					case 'type all':
					case 'type a':
					case 'typ all':
					case 'typ a':
						$result = $mysqli->query("SELECT * FROM questions where typ = 'all'");
						if(mysqli_num_rows($result) > 0)
						{

						    while ($row = $result->fetch_assoc()) {
						        echo '\n' . $row["fraga"];
						        if ($row["answer_status"] == 1) {
						        	echo' Answer: ' . $row["answer"];
						        }
						        echo' Id: ' .$row["id"] . ' Type: ' . $row["typ"] . ' Added: ' . $row["tid"] . '\n';
						    }
						}
						else{
						    echo "List is empty";
						}
						break;

					case 'type teacher':
					case 'type t':
					case 'typ teacher':
					case 'typ t':
						$result = $mysqli->query("SELECT * FROM questions where typ = 'teacher'");
						if(mysqli_num_rows($result) > 0)
						{

						    while ($row = $result->fetch_assoc()) {
						        echo '\n' . $row["fraga"];
						        if ($row["answer_status"] == 1) {
						        	echo' Answer: ' . $row["answer"];
						        }
						        echo' Id: ' .$row["id"] . ' Type: ' . $row["typ"] . ' Added: ' . $row["tid"] . '\n';
						    }
						}
						else{
						    echo "List is empty";
						}
						break;

					case 'type group':
					case 'type g':
					case 'typ group':
					case 'typ g':
						$result = $mysqli->query("SELECT * FROM questions where typ = 'group'");
						if(mysqli_num_rows($result) > 0)
						{

						    while ($row = $result->fetch_assoc()) {
						        echo '\n' . $row["fraga"];
						        if ($row["answer_status"] == 1) {
						        	echo' Answer: ' . $row["answer"];
						        }
						        echo' Id: ' .$row["id"] . ' Type: ' . $row["typ"] . ' Added: ' . $row["tid"] . '\n';
						    }
						}
						else{
						    echo "List is empty";
						}
						break;

					case 'question':
					case 'questions':
					default:
						$result = $mysqli->query("SELECT * FROM questions where answer_status=0");
						if(mysqli_num_rows($result) > 0)
						{

						    while ($row = $result->fetch_assoc()) {
						        echo '\n' . $row["fraga"] . ' Id: ' . $row["id"] . ' Type: ' . $row["typ"] . ' Added: ' . $row["tid"] . '\n';
						    }
						}
						else{
						    echo "List is empty";
						}
						break;
				}
				

				$mysqli->close();

            echo'"
        }
    ]
} 
';

?>