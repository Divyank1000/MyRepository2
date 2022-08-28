<?php
session_start();
$con="";
$retval="";
$user=$pwd="";
include('validatelogin.php');
if(isset($_REQUEST['btnlogin'])&&$error=="")
{
    $dbserver="localhost:3306";
    $dbuser="root";
    $dbpwd="";
    $con=  mysql_connect($dbserver,$dbuser,$dbpwd);
    if(!$con)
    {
        die("Database could not connect ! Error:".mysql_error());
    }
   /* $user=$_REQUEST['txtusername'];
    $pwd=$_REQUEST['txtpwd'];*/
    mysql_select_db('test');
    $sql ="select count(*) from loginpage where username='$user' and password='$pwd'";
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $msg="<p class='error'>Could not login User</p>";
       /* header("Location:loginpage.php?msg=invalid username and password");   */ 
	   }
    else
    {
         $msg="<p class='success'>User login Successful</p>";
        $row=  mysql_fetch_array($retval);
        $count=$row[0];
        session_start();
        $_SESSION['sess_pwd']=$pwd;
        header("Location:Adminhome.php?password=$pwd");  
        
        if($count==1)
        {
            //$msg="<p class='success'>User login Successful count:$count</p>";
            $_SESSION['sess_username']=$user;
            header("Location:Adminhome.php");    
        }
        else
        {
           header("Location:loginpage.php?msg=invalid username and password");
        }
    }
}
else 
 {
     $msg=$error;
     header("Location:loginpage.php?msg=$msg");
 }
 ?>
