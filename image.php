<?php

  $dbhandler=new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
$image_query=$dbhandler->prepare("select * from files where id=121");
$image_query->execute();
$anss=$image_query->fetch();
$image=$anss['data'];
  header("Content-type: image/jpeg");
  echo $image;
?>