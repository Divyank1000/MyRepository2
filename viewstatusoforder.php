<?php

    session_start();
    $custid=$_SESSION['sess_custid'];
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
    $sql="select invoicenum,invoicedate,totalpayment,status from invoice where custid=".$GLOBALS['custid']." order by invoicenum desc ";
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
        <?php include 'Custheader_link.php'; ?>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <?php include 'Custheader.php'; ?>
       <form action="viewstatusoforder.php" method="post">
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
                            ."<td><a href='viewinvoiceDetails.php?invoicenum=".$row['invoicenum']."'>".$row['invoicenum']."</a></td>"
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

