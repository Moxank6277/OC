<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>REGISTER</title>
  <link rel="shortcut icon" type="image/x-icon" href="../PACKAGE/LOGO.png" />
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>
<style>
      a:link, a:visited {
                background-color: #000000;
                color: white;
                width: 10%;
                min-height: 15px;
                padding: 14px 25px;
                text-align: left; 
                text-decoration: none;
                display: inline-block;
            }

            a:hover, a:active {
                background-color: #003333;
            }
</style>
<body>
  <div class="signupSection">
  <div class="info">
    <h2>Mission CODE</h2>
    <i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
    <p>The Future Is Here</p>
  </div>
  <form action="#" method="POST" class="signupForm" name="signupform">
    <h2>Sign Up</h2>
    <ul class="noBullet">
      <li>
        <label for="username"></label>
        <input type="text" class="inputFields" id="username" name="username" placeholder="Username" value="" oninput="return userNameValidation(this.value)" required/>
      </li>
      <li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password" name="password" placeholder="Password" value="" oninput="return passwordValidation(this.value)" required/>
      </li>
      <li>
        <label for="email"></label>
        <input type="email" class="inputFields" id="email" name="email" placeholder="Email" value="" required/>
      </li>
      <li id="center-btn">
        <input type="submit" id="join-btn" name="join" alt="Join" value="Join">
      </li><br>
      <a href="/PHP/COMPILER">LOGIN<a>
    </ul>
  </form>
</div>
  
    <script src="js/index.js"></script>

</body>
</html>
<?php
     $name=filter_input(INPUT_POST,'username');
     $password=filter_input(INPUT_POST,'password');
     $email=filter_input(INPUT_POST,'email');
     if($name!=null && $password!=null && $email!=null)
     {
         $db_here=new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
         $query_here_insert=$db_here->prepare("INSERT INTO `login_credential`(
             `name`,
             `email`,
             `password`
                )VALUES(?,?,?)");
         $query_here_insert->execute(array($name,$email,$password));
       // exec("cd ../PROGRAMS && mkdir ".$name."&& cd ".$name ." && mkdir C && mkdir JAVA",$yu);
       // exec("dir",$ofd);
       // print_r($yu);
         $command="mkdir ".$name;
         //exec($command);
         $re="location: http://".$_SERVER['HTTP_HOST']."/PHP/COMPILER/LOGIN/LOGIN/index.php";
        header($re);
     }
     ?>