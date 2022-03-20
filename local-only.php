<?php
if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
    header("location: index.html");
    exit;
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel='stylesheet' href='styles.css'>
<div class='content'>
  <h1>You accessed the local-only page!</h1>

  <p>Congrats!</p>
</div>