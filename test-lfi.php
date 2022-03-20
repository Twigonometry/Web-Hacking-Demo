<?php
echo file_get_contents("config.php");
echo "include this";

function hash_wrapper($string) {
    echo "LFI";
}
?>