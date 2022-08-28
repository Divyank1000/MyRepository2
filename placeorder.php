<?php
$md=$medname=$qty=$units=$medtype="";
$totalpayment=0;
$invoicenum="";
  $con="";
  $msg="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
      if(!$GLOBALS['con'])
      {
          die("Database could not connect!".mysql_error());
      }
      else 
      {
         mysql_select_db('test');
      }
}
function fetchMedicineQty()
{
    connect();
    $sql="select m.medid,m.medname,m.medtype,m.price,m.units from medicine m,temp t where m.medid=t.medid";
  
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $GLOBALS['msg']="could not retrieve the medicine details";
    }
    else
    {
        return $retval;
    }
}
function autogen()
{
    connect();
    
     
        $sql="select count(*) ,max(invoicenum) from invoice ";
        $retval=  mysql_query($sql);
        if(!$retval)
        {
           $msg="Invoice No. could not generate";
        }
        else
        {
            $row=  mysql_fetch_array($retval);
            $count=$row[0];
        
            if($count==0)
            {
                $GLOBALS['invoicenum']=1;
            }
            else
            {
                $GLOBALS['invoicenum']=$row[1];
                $GLOBALS['invoicenum']++;
            }
           
            mysql_close();
        }
         
  }
  
 
 if(isset($_REQUEST['btnsubmit']))
{
      
         autogen();
        connect();
        session_start();
        if(isset($_SESSION['sess_custid']))
        {
            $custid=$_SESSION['sess_custid'];
        }
        $qty=$_REQUEST['txtqty'];
        $md=$_REQUEST['txtmedid'];
       $units=$_REQUEST['txtunits'];
        $invoicedate=date("Y-m-d");
        
            $sql="insert into invoice(invoicenum,custid,invoicedate,status) values($invoicenum,$custid,'$invoicedate','Pending')";
            $retval=mysql_query($sql,$con);
            if(!$retval)
            {
                die("could not insert into invoice table".mysql_error());
            }
               
           for($i=0;$i<count($md);$i++)
           {
            $sql="insert into invoicedetails(invoicenum,medid,quantity,units) values($invoicenum,$md[$i],'$qty[$i]','$units[$i]')";
            $retval=mysql_query($sql,$con);
            if(!$retval)
            {
                die("could not insert into invoice details table".mysql_error());
            }
          }
        $sql="delete from temp";
        $retval=mysql_query($sql,$con);
        if(!$retval)
         {
            die("could not delete".mysql_error());
         }
         $msg="Invoice Generated";
            
} 
?>

 
<html>
<head>
    <style>
            p.error
            {
                color:red;
            }
            p.success
            {
                color:green;
            }
            </style>
    <?php include 'Custheader_link.php'; ?>
</head>
<body bgcolor="white">
    <?php include 'Custheader.php'; ?>
    <p style="color:red;">*:Required field</p>
     <form action="placeorder.php" method="get">
         
<table align="center" border="1" bgcolor="white" cellspacing="0"  width="auto" height="auto"> 
<tr>
	<th bgcolor="white">Medicine ID</th>
        <th bgcolor="white">Medicine Name</th>
        <th bgcolor="white">Medicine Type</th>
        <th bgcolor="white">Price</th>
        <th bgcolor="white">Units</th>
        <th bgcolor="white">Quantity</th>
       </tr>
       <?php 
      $result=fetchMedicineQty();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
            echo "<tr ><td><input type='text' name='txtmedid[]' value=".$row['medid']." readonly ></td>"
                . "<td>".$row['medname']."</td>" 
                    ."<td>".$row['medtype']."</td>" 
                   ." <td>".$row['price']."</td>"
                     ." <td><input type='text' name='txtunits[]' value=".$row['units']." readonly ></td>"
                     . "<td><input type='text' name='txtqty[]' required pattern='^[0-9]+$' title='Enter correct quantity in digits'><span style='color:red;'>*</span></td></tr>";
                    
      }
     
      ?>
<tr>
    <td><input type="submit" name="btnsubmit" value="Submit"></td></tr>
</table>
     </form>
    
    <?php
        if(isset($_REQUEST['msg']))
              echo $_REQUEST['msg']; 
        ?>
           <?php
                if(isset($msg))
                {
                    echo $msg;
                }
        ?>
    <?php include 'footer.php';?>
   
</body>
</html>	
