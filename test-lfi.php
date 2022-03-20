<?php
echo show_source("config.php");
echo "include this";

function hash_wrapper($string) {
    echo "LFI";
}
?>