<?php
require_once "config.php";
$sql = "SELECT review_text FROM reviews";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Review Comment: " . $row["review_text"];
    }
} else {
    echo "0 results";
}

?>