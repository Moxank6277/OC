<html>
    <title>SELECT OPTIONS</title>
    <head><link rel="shortcut icon" type="image/x-icon" href="./PACKAGE/LOGO.png" />
</head>
    <style>
           
        #sub{
           top: 0;
        }
        #text{
             table-layout: auto;
             align-self: center;
        }
       
            input[type=submit] {
                 border: 1px solid #0ab4b4;
  background: #007bff;
  font-size: 18px;
  color: white;
  margin-top: 20px;
  padding: 10px 50px;
  cursor: pointer;
  transition: .4s;
            }
            
            input[type=submit]:hover {
                background: #33ffff;
  padding: 10px 80px;
            }
            table.option_table{
                
                width: 100%;
                 padding: 15px;
                text-align: left;
            }
            td.option_td{
                width: 50%;
                 padding: 15px;
                text-align: left;
            }

            div.options {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }
    </style>
    <body background="PACKAGE/b1.jpg" style="background-repeat: no-repeat; background-size: cover;">
        <?php
        
        session_start();
        include 'PACKAGE/header.php';
        $db=new PDO('mysql:host=127.0.0.1;dbname=project_complier','ce1','ce1');
        $sql='select type_des from question_type';
        $query=$db->query($sql);
        $result=$query->fetchAll();
        ?>
        <div class="container">
            <div class="card" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="card-header">
            <h5 class="display-4 text-white">Select a category</h5></div>
                <div class="options card-body" style="background-color: rgba(0.5, 0.5, 0.5, 0.5);">
                    <form action="QUESTIONS.php" method="POST">
                        <table border="0" class="option_table">
                                    <tbody>
                                    <center>
                                  <?php
                                 // print_r($result);
                                          foreach ($result as $key => $value) {
                                              $val=$value['type_des'];
                                      echo "
                                        <tr>
                                        <center>
                                            <td class=\"option_td\">
                                               <center>
                                                  <input type=\"submit\"  name=\"trialopt\"value=\"$val\">
                                               </center>
                                            </td>
                                         </center>
                                        </tr>
                                    "
                                              ;
                                      
                                              
                                  }
                                  ?>
                                    </center>
                                        </tbody>
                                </table>
                    </form>
                </div></div>
        </div>
        <?php  include 'PACKAGE/footer.html';?>
    </body>
</html>