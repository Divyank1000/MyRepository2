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
function deleteMedicine()
{
    connect();
    mysql_select_db('test');
    $sql="delete from medicine where medid=".intval($_REQUEST['txtmedid']);
    $retval=mysql_query($sql,$GLOBALS['con']);
    if(!$retval)
    {
        
        $msg="<p class='error'>Could not delete medid='".$_REQUEST['txtmedid']."' from Stock of Medicine".mysql_error()."</p>";
    }
    else
    {
       $msg="<p class='success'>Stock of Medicine of medid:".$_REQUEST['txtmedid']." deleted Successfully</p>";
       
    }
    return $msg;
}

if(isset($_REQUEST['btndelete']))
{
    
    $msg=deleteMedicine();
    header("Location:viewmedicine.php?msg=$msg");
}

?>

