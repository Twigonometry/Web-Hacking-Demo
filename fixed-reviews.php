<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel='stylesheet' href='styles.css'>
<div class='content'>
    <?php
    require_once "config.php";
    $sql = "SELECT review_text FROM reviews";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo htmlspecialchars("Review: " . $row["review_text"]);
            echo "<br>";
        }
    } else {
        echo "0 results";
    }

    ?>
</div>