<html>
    <head>
    <title>WELCOME</title>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </head>
    <body background="PACKAGE/b1.jpg" style="background-repeat: no-repeat; background-size: cover; ">
    <link rel="stylesheet" href="JC/LOADER.css">
    <?php
    session_start();
    include 'PACKAGE/header.php';
    if (isset($_SESSION['username'])) {
        ?>
        <style>#sub{
                top: 0;
            }
            #text{
                table-layout: auto;
                align-self: center;
            }

        </style>
        
        <div class="container-fluid container"  ><font color="white">
            <center><h1 class="display-4">Hello, world!</h1></center>
            <center><p class="lead">One of my most productive days<br> was throwing away <br>1000 lines of code.</p></center>
            <hr class="my-4">
            <br>
            <center><a class="btn btn-primary btn-lg" href="options.php" role="button">SOLVE QUESTIONS</a></cenetr>
                <br>
                <br>
                <hr class="my-4">
                <br>
                <center>
                    <a class=" btn btn-primary btn-lg" href="PACKAGE/PRACTISE.php">PRACTICE</a>        
                    <br>
                    <br>
                    <p classs="quote"><font size="5">Impossible only means that you haven’t found the solution yet.</font></p>


                </center>
        </div>
        <footer class="footer">
            <div class="container-fluid">
          
        <?php
        include 'PACKAGE/footer.html';
        ?></font>
            </div>
            </footer>
    </body>
    </html>
    <?php
} else {
    echo "dsf";
}
   