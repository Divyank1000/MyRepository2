<?php
session_start();
$con="";
$retval="";
$error="";
$oldpwd=$newpwd=$confpwd=$sess_oldpwd="";
if(isset($_SESSION['sess_pwd']))
{
  $sess_oldpwd=$_SESSION['sess_pwd'];
}

include('validateadminchangepass.php');

if(isset($_REQUEST['btnreset']))
 {
     header("Location:loginpage.php");
 }
if(isset($_REQUEST['btnchangepass'])&&$error=="")
{
    $dbserver="localhost:3306";
    $dbuser="root";
    $dbpwd="";
    $con=  mysql_connect($dbserver,$dbuser,$dbpwd);
    if(!$con)
    {
        die("Database could not connect ! Error:".mysql_error());
    }
   
    mysql_select_db('test');
    $sql ="update login set password='$newpwd' where password='$oldpwd'";
    $retval=mysql_query($sql,$con);
    if(!$retval)
    {
         $msg="<p class='error'>Password could not update!</p>";
        die("could not execute query".mysql_error());
    }
    else
    {   
        $msg="<p class='success'>Password changed Successfully</p>";
       
        
     }
     mysql_close($con); 
       header("Location:adminchangepassword.php?&msg=$msg");
}
else 
 {
     $msg=$error;
      header("Location:adminchangepassword.php?&msg=$msg");
 }
 ?>
