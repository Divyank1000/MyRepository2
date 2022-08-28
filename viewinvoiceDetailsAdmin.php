<?php
$invoicenum=$_REQUEST['invoicenum'];
$con="";
$totalpayment=0;
$invoicedate=date("d-m-Y");

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
function fetchInvoiceDet()
{
    connect();
   $sql="select id.medid,medname,medtype,price,quantity,id.units,totalamt from medicine m,invoice , invoicedetails id where m.medid=id.medid and invoice.invoicenum=id.invoicenum and id.invoicenum=".$GLOBALS['invoicenum'];
    
    $retval=mysql_query($sql);
    if(!$retval)
    {
        die("could not retrieve the invoice details ".mysql_error());
    }
    else
    {
        return $retval;
    }
}
?>
<html>
<head>
    <?php include 'header_link.php'; ?>
</head>
<body bgcolor="white">
    <?php include 'header.php'; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <center><h4><p style="color:seagreen;font-size:18px;"><b>INVOICE RECEIPT</b></p></hr></center>
<table align="center" border="1" bgcolor="white" cellspacing="0"  width="auto" height="auto"> 
    <tr>
        <td colspan="4">Invoice Number</td>
        <td><input type="text" name="txtinvoiceno" value="<?php if(isset($invoicenum))echo $invoicenum;?>"></td>
    </tr>
<tr>
	
	<th bgcolor="white">Medicine ID</th>
         <th bgcolor="white">Medicine Name</th>
         <th bgcolor="white">Medicine Type</th>
        <th bgcolor="white">Price</th>
         <th bgcolor="white">Total Amount</th>
        <th bgcolor="white">Quantity</th>
         <th bgcolor="white">Units</th>
         
</tr>
<html>
<head>
</head>
<body>
<p style="color:darkviolet;font-size:18px;"><?php echo "Date:$invoicedate"?></p>
</body>
</html>
     <?php
     $invoicenum=$_REQUEST['invoicenum'];
      $result=fetchInvoiceDet();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
          $totalamt=$row['quantity']*$row['price'];
                 $totalpayment+=$totalamt;
            echo "<tr>"
                . "<td>".$row['medid']."</td>"
                    . "<td>".$row['medname']."</td>"
                    . "<td>".$row['medtype']."</td>"
                    ."<td>".$row['price']."</td>"
                    ."<td>".$row['totalamt']."</td>"
                    . "<td>". $row['quantity']."</td>"
                 ."<td>".$row['units']."</td></tr>";
      }
                        
     ?>
             <tr>
    <td colspan="4">Total Payment</td>
    <td><input type="text" name="txttotpay" value="<?php if(isset($totalpayment))echo $totalpayment;?>" </td>     
                
            </table>
        </form>
      <?php include 'footer.php';?>
    </body>
</html>
