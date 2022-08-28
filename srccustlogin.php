<?php
session_start();
$con="";
$retval="";
$user=$pwd="";
include('validatecustlogin.php');
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
   /* $user=$_REQUEST['txtuser'];
    $pwd=$_REQUEST['txtpwd'];*/
    mysql_select_db('test');
    $sql ="select custid,name from customer where username='$user' and password='$pwd'";
    $retval=mysql_query($sql);
    if(!$retval)
    {
         $msg="<p class='error'>Could not login Customer</p>";
        die("could not execute query".mysql_error());
    }
    else
    {   
        $msg="<p class='success'>Customer login Successful</p>&custid=$custid";
        $row=  mysql_fetch_array($retval);
        $custid=$row[0];
        $name=$row[1];
        
        if(!$custid)
        {
            header("Location:custlogin.php?msg=invalid username and password");
           
        }
        else
        {
            session_start();
            $_SESSION['sess_custid']=$custid;
            $_SESSION['sess_pwd']=$pwd;
            header("Location:customerhome.php?&custid=$custid&custname=$name");    
        }
    }
}
else 
 {
     $msg=$error;
     header("Location:custlogin.php?msg=$msg");
 }


?>
