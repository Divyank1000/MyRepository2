<?php
session_start();
$con="";
$retval="";
$custid="";
$error="";
$oldpwd=$newpwd=$confpwd=$sess_oldpwd="";
if(isset($_SESSION['sess_pwd']))
{
    $custid=$_SESSION['sess_custid'];
    $sess_oldpwd=$_SESSION['sess_pwd'];
}
include('validatecustchangepass.php');
if(isset($_REQUEST['btnreset']))
 {
     header("Location:custlogin.php");
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
    $sql ="update customer set password='$newpwd' where custid=$custid";
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
       header("Location:custchangepassword.php?&msg=$msg");
}
else 
 {
     $msg=$error;
      header("Location:custchangepassword.php?&msg=$msg");
 }
 
 

?>
