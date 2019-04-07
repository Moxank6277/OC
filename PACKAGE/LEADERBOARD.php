<?php
session_start();
include 'header.php';
?>
<head><link rel="shortcut icon" type="image/x-icon" href="../PACKAGE/LOGO.png" />
</head>
 <body background="b1.jpg" style="background-repeat: no-repeat; background-size: cover; backface-visibility: visible;"><font color="white">
<?php
$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
$top_10=$dbhandler->prepare("SELECT sum(track_score.score) as score,user_id FROM `track_score` group by user_id order by score desc;");
$top_10->execute();
$top_ans=$top_10->fetchAll();
$user_name=$dbhandler->prepare("SELECT `user_id`, `name` FROM `login_credential` WHERE user_id=? and user_type='NORMAL'");
//print_r($top_ans);
?>
     <div class="container">
<div class="card-header display-4">Top 10</div>
    <table class="table table-hover container">
  <thead>
    <tr>
        <th scope="col"><font color="white">#</font></th>
        <th scope="col" COLspan="2"><font color="white">Name</font></th>
        <th scope="col"><font color="white">Score</font></th>
    </tr>
  </thead>
  <tbody>
    <?php
$i=1;
$id=$_SESSION['id'];
foreach ($top_ans as $key=>$value){
    if($i<11){
        $user_name->execute(array($value['user_id']));
        $details=$user_name->fetch();
        $d_name=$details['name'];
        $d_id=$details['user_id'];
        $d_score=$value['score'];
        $flag="";
        if($d_id==$id){
            $flag="class=\"bg-primary\"";
        }
        if($d_name!=null){
       echo " <tr $flag>
      <th scope=\"row\"><font color=\"white\">$i</font></th>
      <td colspan=\"2\"><font color=\"white\">$d_name</font></td>
      <td><font color=\"white\">$d_score</font></td>
    </tr>
        ";
       $i++;
        }
    }
    //echo "$i";
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
     </tbody>
    </table></div></font>
 </body>
    <?php
include 'footer.html';