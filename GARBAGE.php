<?php
session_start();
include 'PACKAGE/header.php';
if(isset($_POST['interactive'])){
    echo "selected";
}include 'PACKAGE/footer.html';

//print_r();

echo "<img src=\"image.php\" class=\"rounded float-right\"  height=\"100\" width=\"100\">";
?><script src="JC/bootstrap/js/bootstrap.js"></script>