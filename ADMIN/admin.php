<?php
     session_start();
     $re="location: http://".$_SERVER['HTTP_HOST']."/PHP/COMPLIER/";
     if(strcasecmp($_SESSION['user_type'],"ADMIN")!=0){
header($re);
     }
     include '../PACKAGE/header.php';


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
.collapsible {
  color: white;
  cursor: pointer;
  padding: 18px;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
div.sticky{
      background-image:url("../PACKAGE/BACK.jpg");
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>
</head>
<body>
    <title>ADMIN-PAGE</title>
<h2></h2>

<p></p>
<div>
<center>
<button class="btn btn-primary collapsible">INSERT QUESTION</button>
<div class="content">
    <form method="post">
  <table class="admin_table table-hover">
      <input type="hidden" name="option" value="IQUE"/>
        <tr><td>  ENTER QUESTION DEFINITION</td><td><textarea  name="q_details" rows="2" cols="50" required="true"></textarea></td></tr>
        <tr><td> ENTER SOURCE CODE</td><td><textarea name="src_code" cols="50" rows="10" required="true" ></textarea></td></tr>
        <tr><td>ENTER SCORE</td><td><input type="number" name="point" required="true"/></td></tr>
        <tr><td>ENTER QUESTION CATEGORY </td><td><input type="text" name="q_type" required="true"></td></tr>
        <tr><td>ENTER PRE-DEFINED CODE</td><td><textarea cols="50" rows="10" required="true" name="pre_def" ></textarea></td></tr>
        <tr><td>ENTER QUESTION NAME</td><td><input type="text" name="q_name" required="true"/></td></tr>
        <tr><td><input type="submit" value="INSERT"/></td></tr>
    </table>
    </form>
</div>
<br><hr>
<button class="btn btn-primary collapsible">INSERT CASE</button>
<div class="content">
    <form method="post">
  <table class="admin_table">
       <input type="hidden" name="option"  value="ICAS"/>
       <tr><td>ENTER QUESTION ID</td><td><input class="inputFields" type="text" name="q_id"/></td></tr>
       <tr><td>ENTER EXPECTED ANSWER</td><td><textarea name="e_ans"  rows="10" cols="50"></textarea></td></tr>
       <tr><td>ENTER CASE DETAILS</td><td><textarea name="case"rows="10" cols="50" ></textarea></td></tr>
       <tr><td>ENTER SCANF/CASE INPUT</td><td><textarea name="case_input" rows="10" cols="50"></textarea></td></tr>
        <tr><td><input type="submit" value="INSERT"/></td></tr>
    </table>
    </form>
</div>
<br><hr>
<button class="btn btn-primary collapsible">ADD NEW TYPE</button>
<div class="content">
    <form method="post">
  <table class="admin_table">
       <input type="hidden" name="option" value="NEWTY"/>
       ENTER NEW TYPE<input type="text" name="type"/>
        <tr><td><input type="submit" value="INSERT"/></td></tr>
    </table>
    </form>
</div><br><hr>
<button class="collapsible btn btn-primary">DELETE USER</button>
<div class="content">
    <form method="post">
  <table class="admin_table">
       <input type="hidden" name="option" value="BUSER"/>
       ENTER USER ID<input type="text" name="id" required/>
        <tr><td><input type="submit" value="INSERT"/></td></tr>
    </table>
    </form>
</div><br><hr>
<button class="collapsible btn btn-primary">RETRIEVE ALL QUESTIONS</button>
<div class="content">
    <form method="post">
  <table class="admin_table">
       <input type="hidden" name="option" value="ALL"/>
        <tr><td><input type="submit" class="btn btn-primary" value="SELECT-ALL"/></td></tr>
    </table>
    </form>
</div><br><hr>
<button class="collapsible btn btn-primary">DELETE QUESTION</button>
<div class="content">
    <form method="post">
  <table class="admin_table">
       <input type="hidden" name="option" value="DQ"/>
        <tr><td><input type="text" name="q_id"/></td></tr>
        <tr><td><input type="submit" value="DELETE"/></td></tr>
    </table>
    </form>
</div>
<br><hr></centeR></div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<?php
$opt= filter_input(INPUT_POST,'option');
if($opt!=null){
echo "YOU HAVE CHOOSE TO ".$opt;
}
if($opt!=null){
$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
if(strcasecmp($opt,"BUSER")==0)
{
    echo filter_input(INPUT_POST,'id');
             
    if(filter_input(INPUT_POST,'id')!=null){
        $query=$dbhandler->prepare("select * FROM `login_credential` WHERE user_id=?");
             $query->execute(array(filter_input(INPUT_POST,'id')));
             $result=$query->fetch();
             if(strcasecmp($result['user_type'],"ADMIN")!=0){
         $query=$dbhandler->prepare("DELETE FROM `login_credential` WHERE user_id=?");
             $query->execute(array(filter_input(INPUT_POST,'id')));
             $query->fetch();
             }
             else{
                 echo "CANNOT DELETE ADMIN";
             }
    }
    
            
}
else if(strcasecmp($opt,"NEWTY")==0)
{
    $query=$dbhandler->prepare("INSERT INTO `question_type`(`type_des`) VALUES (?)");
             $query->execute(array(filter_input(INPUT_POST,'type')));
             $result=$query->fetch();
}
else if(strcasecmp($opt,"ICAS")==0)
{
    $test_q=$dbhandler->prepare("SELECT * FROM `test_case` WHERE "
            . "q_id = ? AND e_ans =? AND test_case.case =? AND case_input =?");
             $test_q->execute(array(filter_input(INPUT_POST,'q_id'),
                 filter_input(INPUT_POST,'e_ans'),
                 filter_input(INPUT_POST,'case'),
                 filter_input(INPUT_POST,'case_input')
                 ));
             $result0=$test_q->fetchAll();
             if($result0==null){
    $query=$dbhandler->prepare("INSERT INTO `test_case`(`q_id`, `e_ans`, `case`, `case_input`) VALUES (?,?,?,?)");
             $query->execute(array(filter_input(INPUT_POST,'q_id'),filter_input(INPUT_POST,'e_ans'),filter_input(INPUT_POST,'case'),filter_input(INPUT_POST,'case_input')));
             $result=$query->fetch();
             echo "<br>INSERTED SUCCESFULLY";
             }
             else{
                 echo "<br>CAN INSERT ONLY ONCE";
             }
}
else if(strcasecmp($opt,"IQUE")==0)
{

            $query=$dbhandler->prepare("    INSERT INTO `questions`( `q_details`, `src_code`, `point`, `q_type`, `pre_defined`, `name`)"
                    . " VALUES (?,?,?,?,?,?)");
             $query->execute(array(filter_input(INPUT_POST,'q_details'),
                                    filter_input(INPUT_POST,'src_code'),
                                    filter_input(INPUT_POST,'point'),
                                    filter_input(INPUT_POST,'q_type'),
                                    filter_input(INPUT_POST,'pre_def'),
                                    filter_input(INPUT_POST,'q_name')
                                    )
                                    );
             $query->fetch();
                         $query1=$dbhandler->prepare("select q_id as id from `questions` where name=?");
                          $query1->execute(array(filter_input(INPUT_POST,'q_name')));
                          $result=$query1->fetch();
                          echo "<br>INSERTED QUESTIONS WITH ID <br>";
             print_r($result['id']);
             
           
}
else if(strcasecmp($opt,"ALL")==0){
    $query1=$dbhandler->prepare("select * from `questions`");
    $query1->execute();
    $result=$query1->fetchAll();
   // print_r($result);
    $i=0;
    echo "<table border=\"2\" class=\"table table-hover\"><tr><td>ID</td><td>DETAILS</td><td>SOURCE-CODE</td><td>POINT</td><td>QUESTIONS-TYPE</td><td>LEVEL</td><td>PRE-DEFINED</td><td>NAME</td></tr>";
    foreach ($result as $key=>$row)
    {
       echo "<tr>";
        foreach ($row as $col=>$value)
        {
            if(is_int($col))
            echo "<td>".$value."</td>"; 
        }
        echo "</tr>";
    }
    echo "</table>";
}
else if(strcasecmp($opt,"DQ")==0){
    $query1=$dbhandler->prepare("delete from `questions` where q_id=?");
    $query1->execute(array(filter_input(INPUT_POST,'q_id')));
    $result=$query1->fetchAll();
    $query_track=$dbhandler->prepare("delete from `track_score` where q_id=?");
    $query_track->execute(array(filter_input(INPUT_POST,'q_id')));
    $query_case=$dbhandler->prepare("delete from `test_case` where q_id=?");
    $query_case->execute(array(filter_input(INPUT_POST,'q_id')));
    echo "SUCCESFULLY DELETED";
}
}






include '../PACKAGE/footer.html';
?>
<style>
    .bottomm{
      background-image:url("../PACKAGE/BACK2.jpg");
    } </style>
