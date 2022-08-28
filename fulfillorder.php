<?php
$invoicenum=$custid=$invoicedate=$totalpayment=$status=0;
  $con="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
}
function fetchInvoice()
{
    connect();
    $sql="select * from invoice";
    mysql_select_db('test');
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $msg="could not retrieve the invoice details";
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
	<th bgcolor="white">Invoice Number</th>
       <th bgcolor="white">Customer ID</th>
        <th bgcolor="white">Invoice Date</th>
        <th bgcolor="white">Total Payment</th>
        <th bgcolor="white">Status</th>
       
</tr>

    
    <?php 
      $result=fetchInvoice();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
           
               echo "<tr><td><a href='next2.php?invoicenum=".$row['invoicenum']."'>".$row['invoicenum']."</a></td>"
                       . "<td>".$row['custid']."</td>"
                       . "<td>".$row['invoicedate']."</td>"
                       . "<td>".$row['totalpayment']."</td>"
                       . "<td>".$row['status']."</td>"
                          . "</tr>";
                
      }
     ?>
  

</table>
       </form>
        <?php include 'footer.php';?>
</body>
</html>
   