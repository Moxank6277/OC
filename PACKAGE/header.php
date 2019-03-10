<?php 
$re="http://".$_SERVER['HTTP_HOST']."/PHP/COMPLIER";
    if(isset($_SESSION['username'])){
    $name= $_SESSION['username'];
    echo " <nav class=\"navbar navbar-light sticky-top sticky\" style=\"background-color: #e3f2fd;\">";
    if(endsWith($_SERVER['REQUEST_URI'],"admin.php")==1 || endsWith($_SERVER['REQUEST_URI'],"LEADERBOARD.php")==1 ||endsWith($_SERVER['REQUEST_URI'],"PRACTISE.php")==1 || endsWith($_SERVER['REQUEST_URI'],"details.php"))
     echo "   <img src=\"../PACKAGE/LOGO.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"\">";
 else {
      echo "   <img src=\"PACKAGE/LOGO.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"\">";
 }
  echo "<a class=\"navbar-brand\" href=\"#\"><h4 class=\"display-4\">Welcome <b>$name</b></h1></a>
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <div class=\"collapse navbar-collapse \" id=\"navbarNav\">
    <hr><ul class=\"navbar-nav\">
      <li class=\"nav-item active\">
      <a class=\"nav-link\" href=\"$re/PACKAGE/details.php\">Account Details<span class=\"sr-only\">(current)</span></a>
      </li><li class=\"nav-item\">
      <a class=\"nav-link\" href=\"$re/PACKAGE/LEADERBOARD.php\">Leader-Board<span class=\"sr-only\">(current)</span></a>
      </li>";
     if (isset($_SESSION['user_type'])) {
    if (strcasecmp($_SESSION['user_type'], "ADMIN") == 0) {
        echo "<li class=\"nav-item\">
      <a class=\"nav-link\" href=\"$re/ADMIN/admin.php\">Admin</a></li>";
    }
}
    echo"<li class=\"nav-item\">
        <a class=\"nav-item\" href=\"$re/PROGRAMS/LOGOUT.php\">Logout</a>
      </li>
    </ul>
  </div>
</nav>
 ";
    }
    else{
         header("location: ".$re);
    }

;

?>
<style>
  
        #text{
             table-layout: auto;
             align-self: center;
        }
        input.solve_input{
            background-color: seagreen;
            border-radius: 15px;
            padding: 5px;
            border-style:double;
            
        }
        input.solve_input:active,input.solve_input:active{
            background-color:  #00ba9d;
            border-style: dashed;
        }
    
 

    .sticky{
      
         position: -webkit-sticky;
  top: 0;
         position:fixed;
 margin-bottom: 20px;
  size: auto;
  width: 100%;
 
  background-repeat: initial;
  padding: 15px;
  font-size: 20px;
  color:white;
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    option.opt{
        border-radius: 15px;
        padding: 2px;
    }
    select.header_select:hover,select.header_select:active{
        backface-visibility:visible;
        font-style:oblique;
        background-color: cornflowerblue;
    }
    select.header_select{
        background-color:#0a1630;
        border-radius: 15px;
        padding: 2px;
        color:whitesmoke;
    }
    div{
        margin: 2px;
    }
        
            button.navbar-toggler {
  border: 1px solid #e3f2fd;
  background:#ADD8E6;
  font-size: 18px;
  color: white;
  margin-top: 20px;
  padding: 10px 20px;
  cursor: pointer;
  transition: .4s;
}
button.navbar-toggler:hover {
  background: rgba(20, 20, 20, 0.8);
  padding: 10px 80px;
}
</style>
<link rel="stylesheet" href="../JC/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="JC/bootstrap/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="JC/bootstrap/js/bootstrap.js">
</script>
<script src="../JC/bootstrap/js/bootstrap.js"></script>
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
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    if ($needle === '') {
        return true;
    }
    $diff = \strlen($haystack) - \strlen($needle);
    return $diff >= 0 && strpos($haystack, $needle, $diff) !== false;
}


?>