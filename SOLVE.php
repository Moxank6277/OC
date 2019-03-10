<html><head>
    <title>QUESTIONS</title>
    <link rel="stylesheet" href="JC/SOLVE.css">
    </head>
        <?php
            session_start();
        include'PACKAGE/header.php';
        if($_SESSION['q_type']!=null){
          
            if(filter_input(INPUT_POST,'q_id')!=null){
            $q_idd=filter_input(INPUT_POST,'q_id');
            $_SESSION['q_id']=null;
            $_SESSION['q_id']=$q_idd;
            //print_r($_SESSION['q_id']);
            }
         $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
	//echo "Connection is established...<br/>";
       // $_SESSION['con']=$dbhandler;
         $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$query=$dbhandler->prepare('select * from questions where q_id=?');
        $query->execute(array($_SESSION['q_id']));
        $r=$query->fetch();
        $score=$r['point'];
        $query_testcase=$dbhandler->prepare('select * from test_case where q_id=?');
        $query_testcase->execute(array($_SESSION['q_id']));
        $r_test=$query_testcase->fetchAll();
	//echo '<pre>', print_r($r),'</br>';
        
        echo "<div class=\"card-header\">QUESTION: ".$r['q_details']."</div><br><form method=\"post\">";
       /* foreach($r_test as $key=>$value_test)        {
         echo "<input type=\"radio\" required=\"true\" name=\"test_case\" value=\"".$value_test['case_id']."\">".$value_test['case_id'];
        echo $value_test['case']."<br>";
         
        }*/
       $v=$r['pre_defined'];
       $last=null;
       if (filter_input(INPUT_POST, 'your_ans') != null) {
            $v = filter_input(INPUT_POST, 'your_ans');
        }
        $filepath='PROGRAMS/'.$_SESSION['username']."/C/";
        $filename='demo'.$_SESSION['username'].$_SESSION['q_id'];
        //echo $filename;
        //WRITING FILE
        $file= fopen($filepath.$filename.'.c','w+');
        fwrite($file, $v);
        fclose($file);
        //EXECUTE C OR JAVA HERE
        $gcc="gcc -o ".$filepath.$filename." ".$filepath.$filename.".c";
        exec($gcc);
        $output=null;
        
        echo "
        <div id=\"text\"><center><table><tr>";
        echo "
        <td>
        <textarea class=\"input\"rows=\"25\"  onkeydown=\"insertTab(this, event);\" cols=\"50\" name=\"your_ans\" />$v</textarea> "?>
        </td>
        </tr>
        <tr>
            <td><center>
   
        <input type="submit" id="join-btn" name="join" alt="Submit" value="Submit">
     <br>
        </center> </td>
        </tr>
        <?php
        echo"
        </td></tr></table>
        </center></div>
        </form>
        ";
       $solve_flag=1;
         $icase=0;
         if(strcasecmp($v,$r['pre_defined'])!=0){
        foreach ($r_test as $key=>$value)
        {
            $case_flag="";
            $icase++;
            $file_temp='temp'.$value['case_id'];
            $temp_hand= fopen($filepath.$file_temp,'w+');
            fwrite($temp_hand,$value['case_input']);
        //echo "<br>CASE INPUT".$value['case_input']."<Br>";
            fclose($temp_hand);
            exec("cd ".$filepath.'&& '.$filename.'.exe <'.$file_temp,$output,$re);
        //print_r($output);
             $str=$value['e_ans'];
            $cmpans= explode("\n",$str);
             if(count($cmpans)!= count($output)){
                  $solve_flag=0;
                   $case_flag=0;
             }
             else
              {
                   for($i=0;$i<count($output) && count($cmpans);$i++)
                    {
                       if (strcmp($output[$i], $cmpans[$i]) != 0) {
                        $solve_flag = 0;
                        $case_flag="alert-danger";
                    }
                }
              }
        //     echo "YOUR SOLVE FLAG".$solve_flag; 
            $last=$output;
             $ou="";
            if($last!=null)
            {
                            foreach($last as $keyl=>$valuel)
                                {
                                    $ou=$ou.$valuel."\n";
                                }
                                //OLD COLLASPE
        /*
       echo "
<button class=\"collapsible\"><center>TEST-CASE $icase</center></button>
<div class=\"content\">"
  ;
        echo "<center><br>";
        echo "<textarea class=\"res\" rows=\"5\" cols=\"50\" readonly >"
        . "OUTPUT:\n";
        print_r($ou);
        echo "</textarea>";
        echo "</center><br></div></div>";
       */
        
        echo "<center>
            <button class=\"join-btn\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseeExample$icase\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
                 Test Case $icase
             </button>
             </center>
            </p>
             <div class=\"collapse\" id=\"collapseeExample$icase\">
            <div class=\"card card-body $case_flag\">";
   
     echo "<center>";
        echo "<textarea class=\"res\" rows=\"5\" cols=\"50\" readonly >"
        . "OUTPUT:\n";
        print_r($ou);
        echo "</textarea>";
        echo "</center>
        </div>
</div>";
    $output=null;
        }
    }
         }
        $output=$last;
        
        
        
        
     //RADIO LOGIC MANUAL
        /*   $sqltest='select e_ans from test_case where q_id=? and case_id=?';
        $querytest = $dbhandler->prepare($sqltest);
        $querytest->execute(array($_SESSION['q_id'],filter_input(INPUT_POST,'test_case')));
        $rtest=$querytest->fetch();
       */ if ($output != null) 
         {
            
            //IF ANSWER GENERATED IS CORRECT THAN UPDATE SCORE TABLE
            //echo $solve_flag;
           echo ""
           . "<br><br><br><div class=\"card-item card-header card \">";
                if ($solve_flag==1) {
                    echo"<div class=\"alert-success\">YOUR ANSWER IS CORRECT <br>";
                 
                  $test_query = $dbhandler->prepare("select * from track_score where q_id=? and user_id=?");
                    $test_query->execute(array($_SESSION['q_id'],$_SESSION['id']));
                    $result_test_query = $test_query->fetchAll();
                    if ($result_test_query == null) {
                        $query_update_score = $dbhandler->prepare("INSERT INTO `track_score` (`user_id`, `score`, `your_ans`, `case_status`, `q_id`)"
                                . " VALUES (?, ?, ?,?,?)");
                        $query_update_score->execute(array($_SESSION['id'], $score, $_POST['your_ans'], "true", $_SESSION['q_id']));
                    }
                    $update_score_real = $dbhandler->prepare("select sum(`score`) as score from track_score where user_id=?");
                    $update_score_real->execute(array($_SESSION['id']));
                    $result_update_real = $update_score_real->fetchAll();
                    //$sum=0;
                    /* foreach ($result_update_real as $key=>$value_real)
                      $sum=$sum+$value_real['score'];
                     */
                    echo "YOUR SCORE IS: ";
                    echo $result_update_real[0]['score']."</div>";
                } else {
                    echo "<div class=\"alert-danger\">";
                    echo "YOUR ANSWER IS INCORRECT</div>";
                }
                echo "</div>";
            }
           // echo "<br>EXTRA".$_SESSION['id'];
     
          
        }
        else{
            $re="http://".$_SERVER['HTTP_HOST']."/PHP/COMPLIER/";
           header("location:".$re."QUESTIONS.php");
        }
       
       include 'PACKAGE/footer.html';
       ?>
<!--        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="JC/bootstrap/js/bootstrap.js">
</script>    -->
<script>
//
//var coll = document.getElementsByClassName("collapsible");
//var i;
//
//for (i = 0; i < coll.length; i++) {
//  coll[i].addEventListener("click", function() {
//    this.classList.toggle("active");
//    var content = this.nextElementSibling;
//    if (content.style.display === "block") {
//      content.style.display = "none";
//    } else {
//      content.style.display = "block";
//    }
//  });
//}
//
//

function insertTab(o, e)
{		
	var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;
	if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey)
	{
		var oS = o.scrollTop;
		if (o.setSelectionRange)
		{
			var sS = o.selectionStart;	
			var sE = o.selectionEnd;
			o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
			o.setSelectionRange(sS + 1, sS + 1);
			o.focus();
		}
		else if (o.createTextRange)
		{
			document.selection.createRange().text = "\t";
			e.returnValue = false;
		}
		o.scrollTop = oS;
		if (e.preventDefault)
		{
			e.preventDefault();
		}
		return false;
	}
	return true;
}
</script>
</html>
