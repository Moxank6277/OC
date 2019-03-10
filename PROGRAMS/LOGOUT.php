<?php
session_start();
$re="http://".$_SERVER['HTTP_HOST']."/PHP/COMPLIER/";
echo "<br>rmdir /s /q ../PROGRAMS/".$_SESSION['username'];
exec("cd ../PROGRAMS | rmdir /s /q ".$_SESSION['username'],$ou);
print_r($ou);
session_destroy();
header("location: ".$re);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

