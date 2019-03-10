<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>LOGIN</title>
  
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>
<style>
      a:link, a:visited {
                background-color: #000000;
                color: white;
                width: 100%;
                min-height: 30px;
                padding: 14px 25px;
                text-align: left; 
                text-decoration: none;
                display: inline-block;
            }

            a:hover, a:active {
                background-color:#003333;
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
    <h2>Sign In</h2>
    <ul class="noBullet">
      <li>
        <label for="email"></label>
        <input type="email" class="inputFields" id="email" name="email" placeholder="Email" value="" required/>
      </li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password" name="password" placeholder="Password" value="" oninput="return passwordValidation(this.value)" required/>
      </li>
      
      <li id="center-btn">
        <input type="submit" id="join-btn" name="join" alt="Join" value="LOGIN">
      </li>
      
    </ul>
  </form><br><br><center>
  <h2>REGISTER</h2><br>
    <form action="/PHP/COMPLIER/REGISTRATION/index.php" method="post">
      <li id="center-btn">
          
          <input type="submit" id="join-btn" name="join" alt="Join" value="REGISTER">
      </li>
      <center>
        <table id="tab"><center>
            <tr>
            <center>
                <td ><p class="outset"><a type="email" class="" href="mailto:contact_us@xmail.com">CONTACT-US</a></p></td></tr><tr>
                    <td><p class="outset"><a href="/PHP/COMPLIER/about_us.php">ABOUT US</a></p></td></tr><tr>
            </center>
        </tr>
            </center> </table>
    </center>
    </form></center>
</div>
  
    <script src="js/index.js"></script>
</body>
</html>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        header ("location: /PHP/COMPLIER/welcome.php");
        echo "adf";
    }
   // session_abort();
  //  print_r($_SESSION['username']);
    $email=filter_input(INPUT_POST,'email');
    $pass=filter_input(INPUT_POST,'password');
    print_r($email);
    print_r($pass);
    if($email!=null && $pass!=null)
    {
        $dbcon=new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
        $sql='select * from login_credential where email=? and password=?';
        $query=$dbcon->prepare($sql);
        $query->execute(array($email,$pass));
        $res=$query->fetch();
        //print_r($res['id']);
        if($res){
             session_start();
            $_SESSION['id']=$res['user_id'];
            $_SESSION['username']=$res['name'];
            //$_SESSION['connection']=$dbcon;
            setcookie("username",$res['name']);
            print_r($_SESSION['id']);
          //  header("location :/PHP/COMPLIER/test.php");
          //  print_r($res);
            $name=$_SESSION['username'];
             exec("cd ../../PROGRAMS && mkdir ".$name."&& cd ".$name ." && mkdir C && mkdir JAVA",$yu);
             print_r($yu);
           if(strcasecmp($res['user_type'],"ADMIN")==0)
           {
               $_SESSION['user_type']="ADMIN";
               header ("location: /PHP/COMPLIER/ADMIN/admin.php");
           }
           else{
          header ("location: /PHP/COMPLIER/welcome.php");
           }
            
        }
        else{
            echo "ENTER VALID CREDENTIAL";
        }
          
            
    }
?>
