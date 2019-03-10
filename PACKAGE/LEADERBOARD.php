<?php
session_start();
include 'header.php';
?>

<?php
$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
$top_10=$dbhandler->prepare("SELECT sum(track_score.score) as score,user_id FROM `track_score` group by user_id order by score desc;");
$top_10->execute();
$top_ans=$top_10->fetchAll();
$user_name=$dbhandler->prepare("SELECT `user_id`, `name` FROM `login_credential` WHERE user_id=? and user_type='NORMAL'");
//print_r($top_ans);
?>
<div class="card-header display-4">Top 10</div>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col" COLspan="2">Name</th>
      <th scope="col">Score</th>
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
      <th scope=\"row\">$i</th>
      <td colspan=\"2\">$d_name</td>
      <td>$d_score</td>
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
</table>
    <?php
include 'footer.html';