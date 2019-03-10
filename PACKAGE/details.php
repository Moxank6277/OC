<?php
session_start();
include '../PACKAGE/header.php';
$name=$_SESSION['username'];
$id=$_SESSION['id'];
$dis="disabled";
$dbhandler=new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
$update_score_real = $dbhandler->prepare("select sum(`score`) as score from track_score where user_id=?");
                    $update_score_real->execute(array($_SESSION['id']));
                    $result_update_real = $update_score_real->fetchAll();
                    $u_deatails=$dbhandler->prepare("select * from login_credential where user_id=?");
                    $u_deatails->execute(array($_SESSION['id']));
                    $details=$u_deatails->fetch();
                    $pass=$details['password'];
                    $email=$details['email'];
                    $type=$details['user_type'];
if(strcmp(filter_input(INPUT_POST,'edit'),"edit")==0){
    $dis="";
   // echo "a";
}
    $up_name= filter_input(INPUT_POST,'username');
    $up_pass= filter_input(INPUT_POST,'pass');
    $up_email=filter_input(INPUT_POST,'email');
    
    if((strcmp($up_email,$email)!=0 || strcmp($up_pass,$pass)!=0 || strcmp($up_name,$name)!=0 )&&$up_email!=null)
    {
        try{
    $update_details=$dbhandler->prepare("UPDATE `login_credential` SET `name`=?,`email`=?,`password`=? WHERE user_id=?");
    $update_details->execute(array($up_name,$up_email,$up_pass,$id));
    $update_details->fetch();
        }
 catch (Exception $e){print_r($e);
     
 }
        echo "<div class=\"card-header\"><center><h3 class=\"display-4\">Successfully Updated!!<br>To See Change Login Again</h3></center></div>";  
   // echo $up_name;
    
    }


        ?>
<title>DETAILS</title>
<div class="container">
<div class="card">
  <div class="card-header"><form method="post"> <div class="clearfix">
              <div class="display-4"> Account  Info
        <button type="submit" name="edit" class="btn btn-primary" value="edit">Edit</button>
              </div></div></form>
  </div>
  <form method="post" >
      <br>
      <div class="col-auto">
          <div class="input-group mb-2">
              <div class="input-group-prepend">
                  <div class="input-group-text">Username&nbsp;
                      <input type="text" class="form-control" name="username" required maxlength="150" value="<?php echo $name;?>" <?php echo $dis;?> autofocus>
          </div></div>
              </div>
      </div>
      <div class="col-auto">
          <div class="input-group mb-2">
              <div class="input-group-prepend">
                  <div class="input-group-text">Password&nbsp;
                      <input type="password" class="form-control" name="pass" required maxlength="150" value="<?php echo $pass;?>" <?php echo $dis;?> autofocus>
          </div></div>
              </div>
      </div>

      <div class="col-auto">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Email&nbsp;
                        <input type="text" name="email" required value="<?php echo $email;?>" <?php echo $dis;?> class="form-control" id="inlineFormInputGroup" >
           </div></div>
                </div>
         </div>

           <div class="col-auto">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">User Type&nbsp;
                
                <input type="text" name="type" value="<?php echo $type;?>"  class="form-control" disabled>
           </div></div></div>
         </div>
      <div class="col-auto">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Your Total Score   
&nbsp;              
                <input type="text" name="" value="<?php print_r( $result_update_real[0][0]);?>"  class="form-control" disabled>
                    </div></div>
                    </div>
         </div>
         <?php
  if($dis==null){
         echo "       
<div class=\"col-auto\">
    <div class=\"clearfix\">
        <button type=\"submit\" name=\"uedit\" value=\"edit\" class=\"btn btn-primary\">Update</button>
    </div>
       </div>
  ";}
             ?>
      <br>
  </form>

 </div>
</div>

<style>
    div.col-auto{
        width: 1110%;
    }
</style>
<?php
include '../PACKAGE/footer.html';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

