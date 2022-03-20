<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel='stylesheet' href='styles.css'>
<div class='content'>
  <h1>Hash Your Recipes Here!</h1>
  <p>This keeps them secret :)</p>
  <form method="get" action="/recipe-hash.php">
    <textarea id="text" name="hash_input"></textarea>
    <br>
    <input type="radio" id="md5" name="hash" value="md5">
    <label for="md5">MD5</label><br>
    <input type="radio" id="sha1" name="hash" value="sha1">
    <label for="sha1">SHA1</label><br>
    <button type="submit">Submit</button>
  </form>

  <?php
    if (isset($_GET['hash_input']) and isset($_GET['hash'])) {
        $hash_file = "hash_functions/" . $_GET['hash'] . ".php";
        include $hash_file;

        if (function_exists("hash_wrapper")) {
            echo "<br>";
            hash_wrapper($_GET['hash_input']);
            echo "<br>";
        }
    }
  ?>
</div>