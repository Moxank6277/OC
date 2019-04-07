<html>
    <title>PRACTICE</title>
    <head><link rel="shortcut icon" type="image/x-icon" href="../PACKAGE/LOGO.png" />
    </head>
    <style>
        /*body {background: #F0F0F0;}*/
        #join-btn {
            border: 1px solid #0ab4b4;
            background: rgba(20, 20, 20, 0.6);
            font-size: 18px;
            color: white;
            margin-top: 20px;
            padding: 10px 50px;
            cursor: pointer;
            transition: .4s;
        }


        #join-btn:hover {
            background: rgba(20, 20, 20, 0.8);
            padding: 10px 80px;
        }
        textarea.a {
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 50px;
            width: 500px;
            height: 500px;
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background: none repeat  0 0 rgba(0, 0, 0, 0.07);
            border-color: -moz-use-text-color #FFFFFF #FFFFFF -moz-use-text-color;
            border-image: none;
            border-radius: 6px 6px 6px 6px;
            border-style: none solid solid none;
            border-width: medium 1px 1px medium;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.12) inset;
            color: #555555;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 1em;
            line-height: 1.4em;
            padding: 5px 8px;
            transition: background-color 0.2s ease 0s;
        }


        textarea:focus {
            background: none repeat scroll 0 0 #FFFFFF;
            outline-width: 0;
        }

        input.hidden{
            backface-visibility: visible;
        }
    </style>
    <script>
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
                } else if (o.createTextRange)
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


    <body  background="b1.jpg" style="background-repeat: no-repeat; background-size: cover;">

        <?php
        session_start();
        if (!isset($_SESSION['pr_src'])) {
            // echo "FIRST";
            $_SESSION['pr_src'] = "c";
        }
//include 'PATTERN.html';
        include 'header.php';
        ?> <div class="card" style="opacity: 0.89; padding: 30;">
            <h5 class="display-4">Practice Programming</h5>
            <h5 > Code->Compile->Run</h5>
      
                    <form method="post" >
                        <p><div class="form-check form-check-inline">
                           Select Language &nbsp;&nbsp;   <input type="radio" id="customRadio1" class="form-check-input" name="laan" value="c" onchange="this.form.submit()" class="custom-control-input">
                            <label class=" form-check-label" for="customRadio1">C</label>
                     &nbsp;&nbsp;
                            <input type="radio" id="customRadio2" class="form-check-input" name="laan" onchange="this.form.submit()" value="java"class="custom-control-input">
                            <label class="form-check-label" for="customRadio2">JAVA</label>
                        </div>
                       </p>
                    </form>

                <?php
                echo "<form method=\"post\">";
                $be = "c";
                if (filter_input(INPUT_POST, 'laan') != null) {
                    $be = filter_input(INPUT_POST, 'laan');
                    //echo "CHANGED";
                }
                if (isset($_SESSION['pr_src'])) {
                    $be = $_SESSION['pr_src'];
                }
                $cus = "";
                if (isset($_POST['interactive'])) {
                    $cus = filter_input(INPUT_POST, 'cu_in');
                    //print_r($cus);
                    $nam = $_SESSION['username'];
                    $file_in = fopen("../PROGRAMS/$nam/$be/input", "w+");
                    fwrite($file_in, $cus);
                    fclose($file_in);
                }
                echo "<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    
    <div class=\"custom-control custom-checkbox my-1 mr-sm-2\">
    <input type=\"checkbox\" name=\"interactive\" class=\"custom-control-input\" id=\"customControlInline\">
    <label class=\"custom-control-label\" for=\"customControlInline\">Custom-Input(\"Select Me & Write Input\")</label>
</div>
</div>
</div><div>
    <textarea class=\"form-control\" name=\"cu_in\" aria-label=\"Text input with checkbox\">$cus</textarea>
    </div>";
                echo " <input type=\"hidden\" name=\'lan\' value=\"$be\"/> ";



                if (filter_input(INPUT_POST, 'laan') != null) {

                    $lann = filter_input(INPUT_POST, 'laan');
                    // echo filter_input(INPUT_POST,'laan');

                    if (strcmp(filter_input(INPUT_POST, 'laan'), "java") == 0) {
                        $v = "//GIVE YOUR CLASS NAME demo TO CLASS WHICH HAS MAIN METHOD
                    class demo
                          {
                              public static void main(String []fsd){
                                  System.out.println(\"HELLO WORLD\");
                              }
                            }";
                        $filepath = '../PROGRAMS/' . $_SESSION['username'] . "/JAVA/";
                        $src = "java";
                        //  print_r($v);
                        // echo "iam";
                    } else {
                        $v = "#include<stdio.h>
            int main()
            {
                printf(\"HELLO WORLD\");
                return 0;
             }";
                        $filepath = '../PROGRAMS/' . $_SESSION['username'] . "/C/";
                        $src = "c";
                    }
                    $_SESSION['pr_src'] = filter_input(INPUT_POST, 'laan');
                } else {

                    $v = "#include<stdio.h>
            int main()
            {
                printf(\"HELLO WORLD\");
                return 0;
             }";
                    $fsrc = strtoupper($be);
                    $filepath = '../PROGRAMS/' . $_SESSION['username'] . "/$fsrc/";
                    $src = $_SESSION['pr_src'];
                }
                if (filter_input(INPUT_POST, 'your_ans') != null) {
                    $v = filter_input(INPUT_POST, 'your_ans');
                }
                // echo "source  says ".$src;
                $src = $_SESSION['pr_src'];
//WRITING TO FILE
                //process your_ans remove system
                $temp_v = $v;
                $v = str_replace("system(", "//system", $v);
                $filename = 'demo_test' . $_SESSION['username'];
                //echo $filename;
                //WRITING FILE
                $file_handle = fopen($filepath . $filename . '.' . $src, 'w+');
                fwrite($file_handle, $v);
                fclose($file_handle);
                $v = $temp_v;

//echo "ZDffzdf";
//EXECUTE C OR JAVA HERE
                $o11 = "";
                if (strcasecmp($src, "java") == 0) {
                    $gcc = "javac " . $filepath . $filename . "." . $src . " 2>" . $filepath . "error_c";
                    //echo $gcc;
                    exec($gcc);
                    //print_t($ooo);
                    $len_error = filesize($filepath . "error_c");
                    if ($len_error != 0) {
                        $file_error = fopen($filepath . "error_c", "r");
                        $o11 = fread($file_error, $len_error);
                    }//print_r($o11);
                    $output = null;
                    if ($cus != null) {
                        exec("cd " . $filepath . '&& ' . 'java demo < input', $output, $re);
                    } else {
                        exec("cd " . $filepath . '&& ' . 'java demo', $output, $re);
                    }
                    exec("cd $filepath && dir && del input && del error_c", $o);
                    //echo "JAVA";
                    // print_r($o);
                } else if (strcasecmp($src, "c") == 0) {
                    $gcc = "gcc -o " . $filepath . $filename . " " . $filepath . $filename . "." . $src . " 2>$filepath" . "error_c";
                    exec($gcc);
                    $len_error = filesize($filepath . "error_c");
                    if ($len_error != 0) {
                        $file_error = fopen($filepath . "error_c", "r");
                        $o11 = fread($file_error, $len_error);
                    }//print_r($o11);
                    $output = null;
                    if ($cus != null) {
                        exec("cd " . $filepath . '&& ' . $filename . '.exe < input', $output, $re);
                    } else {
                        exec("cd " . $filepath . '&& ' . $filename . '.exe', $output, $re);
                    }
                    exec("cd $filepath && del input", $o);
                    // print_r($o);
                } else {
                    $output = "WELCOME " . $_SESSION['username'];
                }
//SIMPLIFY OUTPUT
                $otd = $output;
                $output = "";
                foreach ($otd as $k => $va) {

                    $output = $output . $va . "\n";
                }
                $output = str_replace("//system", "system(", $output);


                echo " 
        <div id=\"text\"><center><table><tr>";
                echo "
        <td> <textarea rows=\"25\" cols=\"50\" class=\"a\" onkeydown=\"insertTab(this, event);\" name=\"your_ans\" />$v</textarea> "
                ?>
                </td>
                <td class="pad"><centeR>
                    <input type="submit" id="join-btn" name="join" alt="Run" value="RunCode">
                </center> </td>       
                <?php
                echo"<td><textarea rows=\"25\" cols=\"50\" class=\"a\"name=\"out\" readonly=\"true\">
        ";
                echo $output;
                echo"
        </textarea>
        </td></tr></table>
        </center></div>
        ";
                if ($o11 != null) {
                    echo "
          
        ";
                }
                if ($o11 != null) {
                    ?>
                <br>
                <div class="card flex text-white bg-danger">
                    <div class="card-header" >
                    Error 
                    </div>
                    
                    <textarea class="card-body text-white bg-danger"readonly rows="8" cols="170"><?php print_r($o11); ?></textarea>
               
                </div>  <?php
                }
                include'footer.html';
                ?>
                <style>
                    .bottomm{
                        background-image:url("BACK2.jpg");
                    }
                </style>
        </div>
    </center>
</div>        <body>
</html>