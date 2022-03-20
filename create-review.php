<html>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel='stylesheet' href='styles.css'>
<div class='content'>
<?php

require_once 'config.php';

if (isset($_POST["review_text"])) {
    //let people submit their own reviews

    $review_string = $_POST["review_text"];
    
    //insert into reviews database
    error_log("Inserting");

    $stmt = $link->prepare("INSERT INTO reviews (review_text) VALUES (?)");

    // execute statement with submitted string

    $stmt->bind_param("s", $review_string);

    $stmt->execute();

    // close statement
    $stmt->close();

    // get ID of last item
    $id = $link->insert_id;

    echo("Thanks for submitting! Your ID: ". $id);
} else {
    //no params given
    echo('Please provide a review text.');
}

?>
</div>