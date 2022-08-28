<?php
$con="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
      if(!$GLOBALS['con'])
      {
          die("could not connect....!".mysql_error());
      }
      else
          mysql_select_db ('test');
}
function fetchMedicine()
{
    connect();
    $sql="select medid,medname from medicine where stock>0";
    
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $msg="could not retrieve the medicine details";
    }
    else
    {
        return $retval;
    }
}

    if(isset($_REQUEST['btnok']))
{
       
        session_start();
        if(isset($_SESSION['sess_custid']))
        {
            $custid=$_SESSION['sess_custid'];
        $checkedmedicine=$_REQUEST['chkselect'];
       
        connect();
        for($i=0;$i<count($checkedmedicine);$i++)
        {
           echo $checkedmedicine[$i]."<br>";
            $sql="insert into temp values($custid,$checkedmedicine[$i])";
            $retval=mysql_query($sql,$con);
            if(!$retval)
            {
                die("could not insert into temp table".mysql_error());
            }
          
        }      
       /* header("Location:placeorder.php");*/
        }
        header("Location:placeorder.php");
} 
?>
<html>
<head>
    <?php include 'Custheader_link.php'; ?>
</head>
<body bgcolor="white">
    <?php include 'Custheader.php'; ?>
    <form action="viewmedicineavailable.php" method="get">
<table align="center" border="1" bgcolor="white" cellspacing="5"  width="auto" height="auto"> 
<tr>
	<th bgcolor="white">Select</th>
	<th bgcolor="white">Medicine ID</th>
        <th bgcolor="white">Medicine name</th>
</tr>

   
        <?php
      $result=fetchMedicine();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
            echo "<tr> <td><input type='checkbox' name='chkselect[]' value=".$row['medid']." ></td><td>".$row['medid']."</td><td>".$row['medname']."</td></tr>";
      }
     ?>
<tr>
    <td><input type="submit" name="btnok" value="OK"></td></tr>
</table>
     </form>
    <?php include 'footer.php';?>
</body>
</html>	