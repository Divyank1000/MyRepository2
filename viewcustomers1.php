<?php
$custid=$name=$address=$phone=$gender=0;
  $con="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
}
function fetchCustomer()
{
    connect();
    $sql="select custid,name,address,phone,gender from customer";
    mysql_select_db('test');
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $msg="could not retrieve the customer details";
    }
    else
    {
        return $retval;
    }
}
?>

<html>
    <head>
       
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
         <?php include 'header_link.php'; ?>
    </head>
    <body>
        <?php include 'header.php'; ?>
       <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post">
           
<table align="center" border="1" bgcolor="white" cellspacing="0" width="auto" height="auto"> 
<tr>
       <th bgcolor="white">custid</th>
        <th bgcolor="white">name</th>
        <th bgcolor="white">address</th>
        <th bgcolor="white">phone</th>
        <th bgcolor="white">gender</th>
        
       
</tr>
<tr>
    
    <?php 
      $result=fetchCustomer();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
                 echo "<tr><td><a href='custinvoice.php?custid=".$row['custid']."'>".$row['custid']."</a></td>"
                       . "<td>".$row['name']."</td>"
                       . "<td>".$row['address']."</td>"
                       . "<td>".$row['phone']."</td>"
                          . "<td>".$row['gender']."</td>"
                          . "</tr>";
                
      }
     ?>
</table>
       </form>
        <?php include 'footer.php';?>
</body>
</html>