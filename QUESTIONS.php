<html>
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="./PACKAGE/LOGO.png" />
        <link rel="stylesheet" href="JC/QUESTIONS.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body background="PACKAGE/b1.jpg" style="background-repeat: no-repeat; background-size: cover;">

        <?php
        session_start();
        include 'PACKAGE/header.php';
        try {
            $queType = filter_input(INPUT_POST, 'trialopt');
            if($queType!=null || $_SESSION['q_type']!=null){
           // $_SESSION['q_type']=null;
           if ($queType != null) {
            $_SESSION['q_type'] = $queType;
        }
        //echo $_SESSION['q_type'];
        $queType=$_SESSION['q_type'];
        $dbhandler =new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
        echo "<div class=\"container\" style=\"background-color: rgba(0, 0, 0, 0.5); opacity:0.8;\">"
        . "<div style=\"background-color: rgba(0, 0, 0, 0.7);\">"
                . "<font size=\"5\"class=\"display text-white\">";   
        echo "YOU HAVE SELECTED ".$queType;
        echo "</div></font>";
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'select q_id,name from questions where q_type=?';
            $query = $dbhandler->prepare($sql);
            $query->execute(array($queType));
            //$query->execute();
            //   echo "<ol type='1'>";
            $sql_solved='select case_status from track_score where user_id=? and q_id=?';
            while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                ?>
        <div style="background-color: rgba(0, 0, 0, 0.4);" >
                    <form action="SOLVE.php" method="POST" >
                       <input type="hidden" name="q_id" value="<?php echo $r['q_id'] ?>"/>
                       <table border="0" class="question_table table ">
                                    <tbody>
                                        <tr>
                                            <td class="td_q"><font class="f text-white" size="5"><?php echo strtoupper($r['name']); ?></font></td>
                                            <td class="td_q"><input class="buu" type="submit" value="Solve.."/><br></td>
                                          <?php
                                          
                                            $query_solved = $dbhandler->prepare($sql_solved);
                                            $query_solved->execute(array($_SESSION['id'],$r['q_id']));
                                            //print_r($query_solved->fetch());
                                            if(strcasecmp($query_solved->fetch()[0], "true")==0)
                                            echo " <td><div class=\"alert alert-success\">SOLVED</div></td>";
                                        else {
                                            echo " <td><div class=\"alert alert-danger\">UNSOLVED</div></td>";
                                        }
                                           ?>
                                            
                                        </tr>
                                    </tbody>
                                </table>          
                    </form>
        </div>
                <?php
            }
               echo "</div>";
            // put your code here
            }
            else{
                
                $re="http://".$_SERVER['HTTP_HOST']."/PHP/COMPILER/";
                header("location: ".$re."OPTIONS.php");
            }
            
            } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
       include 'PACKAGE/footer.html';
        ?>

    </body>
</html>