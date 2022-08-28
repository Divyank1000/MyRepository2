<?php
  $con="";
  $error="";
  $expiry_date=0;
  $medid=$medtype=$qty=$price="";
  
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
}
function fetchMedicineName()
{
    connect();
    $sql="select medid,medname from medicine";
    mysql_select_db('test');
    $retval=mysql_query($sql);
    if(!$retval)
    {
        $msg="could not retrieve the medicine name details";
    }
    else
    {
        return $retval;
    }
}

function fetchMedicineType()
{
    connect();
    $sql="select medtype from medicine where medid=".$GLOBALS['medid'];
    mysql_select_db('test');
    $retval=mysql_query($sql,$GLOBALS['con']);
    if(!$retval)
    {
        echo "could not retrieve the medicine type details";
    }
    else
    {
        $row=  mysql_fetch_array($retval);
        $GLOBALS['medtype']=$row[0];
    }
}
function updateMedicine()
{
    connect();
    mysql_select_db('test');
     $sql="update medicine set expiry_date='$expiry_date',price= ".$GLOBALS['price'].",stock=stock+".$GLOBALS['qty']." where medid=".$GLOBALS['medid'];
    $retval=mysql_query($sql,$GLOBALS['con']);
    if(!$retval)
    {
        
        $msg="<p class='error'>Could not update Stock of Medicine".mysql_error()."</p>";
    }
    else
    {
       $msg="<p class='success'>Stock of Medicines updated Successfully</p>";
       
    }
    return $msg;
}
function testinput($data)
{
    $data=trim($data);
    $data=htmlspecialchars($data);
    $data=stripslashes($data);
    return $data;
}

if(isset($_REQUEST['btnfetch']))
{
    $medid=$_REQUEST['ddlmedname'];
     fetchMedicineType();
     
}
include('validatestockofmedicine.php');
if(isset($error))
{
    $msg=$error;
  
}
if(isset($_REQUEST['btnupdate']) && $error=="")
{
    
    $medid=$_REQUEST['ddlmedname'];
    
    $msg=updateMedicine();
}
?>
<html>
    <head>
       
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
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
             <?php include 'header_link.php'; ?>
    </head>
    <body>
         <?php include 'header.php'; ?>
        <p style="color:red;">*:Required field</p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                 <tr>
                    <td>Select A Medicine</td>
                    <td>
                        <select name="ddlmedname">
                                <?php
                                $result=fetchMedicineName();
                                while($row=mysql_fetch_array($result,MYSQL_ASSOC))
                                {
                                    echo "<option value=".$row['medid'].">".$row['medname']."</option>";
                                }
                                ?>
                                </select>
                         <td><input type="submit" name="btnfetch" value="Fetch"></td>    
                 </tr>
                     <tr>
                    <td>Medicine Type</td>
                    <td><input type="text" name="txtmedtype" disabled="true" value="<?php if(isset($medtype)){echo $medtype;}?>"></td>
                     </tr> 
                   <tr>
                      <td>Quantity</td>
                      <td><input type="text" name="txtqty"><span style="color:red;">*</span></td>
                  </tr>
                  <tr>
                      <td>Price</td>
                      <td><input type="text" name="txtprice"><span style="color:red;">*</span></td>
                  </tr>
                  <tr>
                     <td>Expiry Date</td>
                    <td><input type="date" name="txtexpdate"><span style="color:red;">*</span></td>
                </tr>
              
                <td><input type="submit" name="btnupdate" value="Update"></td>
                  </tr>
            </table>
    </form>
        <?php
        if(isset ($msg))
              echo $msg;
            
        ?>
         <?php include 'footer.php';?>
    </body>
</html>       