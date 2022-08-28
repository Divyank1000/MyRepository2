<?php
$custid=$name=$address=$phone=$gender=0;
$custid=$_REQUEST['custid'];
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
    $sql="select * from invoice where custid=".$GLOBALS['custid']." and status='Dispatched' order by invoicenum desc limit 1";
    mysql_select_db('test');
    $retval=mysql_query($sql,$GLOBALS['con']);
    if(!$retval)
    {
        die("could not retrieve the invoice details".mysql_error());
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
       <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                 <tr>
                    <td>Customer ID</td>
                    <td><input type="text" name="txtcustid" value="<?php if(isset($custid)){ echo $custid;}?>" readonly="true" ></td>
                </tr>
                <tr>
                    <th>Invoice No.</th>
                    <th>Invoice Date</th>
                    <th>Total Payment</th>
                    <th>Status</th>
                </tr> 
                 <?php 
      $result=fetchInvoice();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
           
               echo "<tr>"
                            ."<td><a href='viewinvoiceDetailsAdmin.php?invoicenum=".$row['invoicenum']."'>".$row['invoicenum']."</a></td>"
                       . "<td>".$row['invoicedate']."</td>"
                       . "<td>".$row['totalpayment']."</td>"
                       . "<td>".$row['status']."</td></tr>";
      }
     ?>
                 
                
            </table>
        </form>
        <?php include 'footer.php';?>
      
    </body>
</html>

