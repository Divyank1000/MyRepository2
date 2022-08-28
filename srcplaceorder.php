<?php
session_start();
$con="";
$retval="";
$error="";
$qty="";
include('validateplaceorder.php');
if(isset($_REQUEST['btnsubmit'])&&$error=="")
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
    $sql ="update invoicedetails set quantity='$qty' where medid=$medid";
    $retval=mysql_query($sql,$con);
    if(!$retval)
    {
         $msg="<p class='error'>Quantity could not update!</p>";
        die("could not execute query".mysql_error());
    }
    else
    {   
        $msg="<p class='success'>Quantity updated Successfully</p>";
       
        
     }
     mysql_close($con); 
       header("Location:placeorder.php?&msg=$msg");
}
else 
 {
     $msg=$error;
      header("Location:placeorder.php?&msg=$msg");
 }
 
 

?>
