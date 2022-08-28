<?php
$con="";
$retval="";
$custid=0;
$name=$gender=$address=$phone=$email=$user=$pwd="";
include('validateregform.php');
function init()
{
   /* $GLOBALS['name']=$_REQUEST['txtname'];*/
   $GLOBALS['gender']=$_REQUEST['rdbgender'];
   /* $GLOBALS['address']=$_REQUEST['txtaddr'];*/
   /* $GLOBALS['phone']=$_REQUEST['txtphone'];*/
   /*$GLOBALS['email']=$_REQUEST['txtemail'];*/
   /* $GLOBALS['user']=$_REQUEST['txtuser'];*/
   /* $GLOBALS['pwd']=$_REQUEST['txtpwd'];*/
}
function connect()
{
    $dbserver="localhost:3306";
    $dbuser="root";
    $dbpwd="";
    $con=  mysql_connect($dbserver,$dbuser,$dbpwd);
    return $con;
}
function autogen()
{
    $con=connect();
    if(!$con)
    {
        die("Database could not connect! ".mysql_error());
    }
    else
    {
        mysql_select_db('test');
        $sql="select count(*) ,max(custid) from customer ";
        $retval=  mysql_query($sql);
        if(!$retval)
        {
            header("Location:registerpage.php?msg=Customer ID could not generate");
        }
        else
        {
            $row=  mysql_fetch_array($retval);
            $count=$row[0];
        
            if($count==0)
            {
                     
                $GLOBALS['custid']=1;
            }
            else
            {
                $GLOBALS['custid']=$row[1];
                $GLOBALS['custid']++;
            }
           
            mysql_close();
        }
       
    }
}
if(isset($_REQUEST['btnsubmit'])&&$error=="")
{
    init();
    autogen();
  
    $con=connect();
    if(!$con)
    {
        die("Database could not connect! ".mysql_error());
    }
    else
    {
        mysql_select_db('test');
        $sql="insert into customer values($custid,'$name','$address','$phone','$user','$pwd','$gender','$email')";
        $retval=  mysql_query($sql);
        mysql_close();
        if(!$retval)
        {
           
           $msg="<p class='error'>Could not register customer</p>"; /* header("Location:registerpage.php?msg=Could not register customer");*/
        }
        else
        {
           $msg="<p class='success'>Your Registration was successful. Click Here to <a href='custlogin.php'>Login</a></p>&custid=$custid"; /*header("Location:registerpage.php?msg=Customer Registered Succesfully&custid=$custid");*/
        }
    }
}
 else 
 {
     $msg=$error;
 }
 header("Location:registerpage.php?msg=$msg");
 /*name=$name*/
?>
