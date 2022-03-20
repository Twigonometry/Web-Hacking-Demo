<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel='stylesheet' href='styles.css'>
<div class='content'>
  <h1>Web Hacking Sandbox</h1>

  <h2>Webpage Viewer</h2>

  <p>View any page on the internet, rendered safely in an iframe!</p>
  
  <form method="get" action="/page-viewer.php">
      <input type="text" name="url" id="url"></input>
      <button type="submit">Submit</button>
  </form>

  <?php
    if (isset($_GET['url'])) {
        echo "<br>";
        if (strpos($_GET['url'], '127.0.0.1') or strpos($_GET['url'], 'localhost')) {
            echo "Local IP addresses not allowed";
        } else {
            echo "<iframe src='" . htmlspecialchars($_GET['url']) . "'>";
        }
    }
  ?>
</div>