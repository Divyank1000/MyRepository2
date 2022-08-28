<?php
/*session_start();
if(isset($_SESSION['sess_username']))
{
    echo "Welcome Admin:".$_SESSION['sess_username'];
}*/
?>
<html>
    <head>
          <?php include 'header_link.php'; ?>
    </head>
    <body>
         <?php include 'header.php'; ?>
        
    <h1><a href="#">
   <?php
   session_start();
    if(isset($_SESSION['sess_username']))
    {
        echo "Welcome Admin:".$_SESSION['sess_username'];
    }
    ?> </a></h1>
             
    
  <?php include 'footer.php';?>
    </body>
</html>