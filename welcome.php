<html>
    <title>WELCOME</title>
    <style>
        div.quote{
            padding: 20px;
            background: element;
             box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
             margin: 10px;
        }
        div.quote:hover{
            background: #AAAAAA;
        }
        p.quote{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-size-adjust: 15;
            size: 15px;
            font-style: oblique;
        }
    </style>
<link rel="stylesheet" href="JC/LOADER.css">
    <?php
    session_start();
 include 'PACKAGE/header.php';
    if(isset($_SESSION['username']))
  {
     
    echo"<style>#sub{
           top: 0;
        }
        #text{
             table-layout: auto;
             align-self: center;
        }
        
        </style><center>
        <a class=\"badge badge-light\" href=\"options.php\"><b><center><h3 class\"display-4\">SOLVE QUESTIONS</h3></center></b></a>
        <div class=\"quote\">
        <p classs=\"quote\"><font size=\"5\">One of my most productive days<br> was throwing away <br>1000 lines of code.</font></p>
        </div>
        <a class=\"badge badge-light\" href=\"PACKAGE/PRACTISE.php\"><b><center><h3 class\"display-4\">PRACTICE</h3></center></b></a>        
        <div class=\"quote\">
        <p classs=\"quote\"><font size=\"5\">Impossible only means that you haven’t found the solution yet.</font></p>
         </div>
        
    </center>
";
    include 'PACKAGE/footer.html';
     
    echo "</div></body>
</html>";
  }
   else{
       echo "dsf";
   }
   