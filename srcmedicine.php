<?php
$con="";
$retval="";
$medid=0;
$medname=$stock=$medtype=$price=$units=$expiry_date="";
include('validatemedicine.php');
function init()
{
   /* $GLOBALS['medname']=$_REQUEST['txtmedname'];*/
    $GLOBALS['stock']=$_REQUEST['txtstock'];
    $GLOBALS['medtype']=$_REQUEST['rdbmedtype'];
   /* $GLOBALS['price']=$_REQUEST['txtprice'];*/
    /*$GLOBALS['units']=$_REQUEST['txtunits'];*/
     /*$GLOBALS['expiry_date']=$_REQUEST['txtexpdate'];*/
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
        $sql="select count(*) ,max(medid) from medicine ";
        $retval=  mysql_query($sql);
        if(!$retval)
        {
            header("Location:medicine.php?msg=Medicine ID could not generate");
        }
        else
        {
            $row=  mysql_fetch_array($retval);
            $count=$row[0];
        
            if($count==0)
            {
                $GLOBALS['medid']=1;
            }
            else
            {
                $GLOBALS['medid']=$row[1];
                $GLOBALS['medid']++;
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
        $sql="insert into medicine values($medid,'$medname','$stock','$medtype','$price','$units','$expiry_date')";
        $retval=  mysql_query($sql);
        mysql_close();
        if(!$retval)
        {
           
           $msg="<p class='error'>Could not add medicine</p>";/*  header("Location:medicine.php?msg=Could not add medicine");*/
        }
        else
        {
            $msg="<p class='success'>Medicine Added Successfully</p>&medid=$medid";/* header("Location:medicine.php?msg=Medicine added Succesfully&medid=$medid");*/
        }
    }
}
else 
 {
     $msg=$error;
 }
 header("Location:medicine.php?msg=$msg");/*name=$name*/
?>

