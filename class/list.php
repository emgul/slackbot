<?php

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
				        echo '\n' . $row["fraga"] . ' Added: ' . $row["tid"] . ' Type: ' . $row["typ"] . '\n';
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

?>