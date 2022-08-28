<?php
$invoicenum=0;
$medid=array();
$qty=array();
$totalamt=0;
$totalamtarr=array();
$totalpayment=0;
$msg="";
$con="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
}
function fetchMedicine()
{
    connect();
    $sql="select m.medid,m.medname,m.medtype,m.price,q.quantity,q.totalamt from medicine m,invoicedetails q where m.medid = q.medid and q.invoicenum=".$GLOBALS['invoicenum']." and m.stock>q.quantity";/*join tables*/
    mysql_select_db('test');
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $msg="could not retrieve the medicine and invoice details or stock is less than quantity demanded";
    }
    else
    {
        
        return $retval;
    }
}
if(isset($_REQUEST['txtinvoicenum']))
{
    $invoicenum=$_REQUEST['txtinvoicenum'];
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
           <?php
           if(!isset($_REQUEST['btnfulfill']))
    {
      $invoicenum=$_REQUEST['invoicenum'];
    }
    ?>
<table align="center" border="1" bgcolor="white" cellspacing="0" width="auto" height="auto"> 
    <tr>
        <td colspan="4">Invoice Number</td>
        <td><input type="text" name="txtinvoicenum" value="<?php if(isset($invoicenum))echo $invoicenum; ?>"</td>
        <td></td>
    </tr>
<tr>
	<th bgcolor="white">Medicine ID</th>
       <th bgcolor="white">Medicine Name</th>
       <th bgcolor="white">Medicine Type</th>
        <th bgcolor="white">Quantity</th>
        <th bgcolor="white">Amount</th>
        <th bgcolor="white">Price</th>
        
       
</tr>
<tr>
    
    <?php 
    if(!isset($_REQUEST['btnfulfill']))
    {
      $invoicenum=$_REQUEST['invoicenum'];
      $result=fetchMedicine();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
          $totalamt=$row['quantity']*$row['price'];
          $totalpayment+=$totalamt;
         
                echo "<tr>"."<td>".$row['medid']."</td>"
                . "<td>".$row['medname']."</td>"
                        . "<td>".$row['medtype']."</td>"
                    . "<td>". $row['quantity']."</td>"
                        ."<td>".$totalamt."</td>"
                 ."<td>".$row['price']."</td>";
                        
     }
    }
    if(isset($_REQUEST['btnfulfill']))
    {
        $totalpayment=$_REQUEST['txttotpay'];
      $result=fetchMedicine();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
          $totalamt=$row['quantity']*$row['price'];
          
          array_push($totalamtarr,$totalamt);
          array_push($medid,$row['medid']);
          array_push($qty,$row['quantity']);
                echo "<tr>"."<td>".$row['medid']."</td>"
                . "<td>".$row['medname']."</td>"
                        . "<td>".$row['medtype']."</td>"
                    . "<td>". $row['quantity']."</td>"
                         ."<td>".$totalamt."</td>"
                 ."<td>".$row['price']."</td>";
     }
   
    
    mysql_select_db('test');
    
   $invoicenum=$_REQUEST['txtinvoicenum'];
   $totalpayment=$_REQUEST['txttotpay'];
   for($i=0;$i<count($medid);$i++)
   {
       
       $sql= "update invoicedetails set totalamt=".$totalamtarr[$i]." where medid=".$medid[$i]." and invoicenum=".$invoicenum;  
     $retval=mysql_query($sql,$con);
    if(!$retval)
    {
        
        die("could not update invoice details".  mysql_error());
    }
    $sql="update medicine set stock=stock-".$qty[$i]." where medid=".$medid[$i];
    $retval=mysql_query($sql,$con);
    if(!$retval)
    {
        
        die("could not update medicine".  mysql_error());
    }
   }
   $sql="update invoice set status='Dispatched', totalpayment=".$totalpayment." where invoicenum=".$invoicenum;
    $retval=mysql_query($sql);
    if(!$retval)
    {
        
        die("could not update invoice".mysql_error());
    }
   $msg="Updated , Order Fulfilled";
   
}
?>
<tr>
    <td colspan="4">Total Payment(Rupees)</td>
    <td><input type="text"  name="txttotpay" value="<?php if(isset($totalpayment))echo $totalpayment;?>" </td>
</tr>
    <tr>
        
    <td><input type="submit" name="btnfulfill" value="Fulfill"></td></tr>
</table>
       </form>
        <?php
                if(isset($msg))
                {
                    echo $msg;
                }
        ?>
        <?php include 'footer.php';?>
</body>
</html>
   