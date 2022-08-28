<?php
  $con="";
  $medid="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
}
function updateMedicine()
{
    connect();
    mysql_select_db('test');
    $sql="update medicine where medid=".intval($_REQUEST['txtmedid']);
    $retval=mysql_query($sql,$GLOBALS['con']);
    if(!$retval)
    {
        
        $msg="<p class='error'>Could not update medid='".$_REQUEST['txtmedid']."' from Stock of Medicine".mysql_error()."</p>";
    }
    else
    {
       $msg="<p class='success'>Stock of Medicine of medid:".$_REQUEST['txtmedid']." updated Successfully</p>";
       
    }
    return $msg;
}

if(isset($_REQUEST['btnupdate']))
{
    
    $msg=Medicine();
    header("Location:viewmedicine.php?msg=$msg");
}

?>

