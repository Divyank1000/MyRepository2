<?php
$medid=$medname=$medtype=$stock=$expiry_date=$price=$units=0;
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
    $sql="select medid,medname,stock,medtype,price,units,expiry_date from medicine";
    mysql_select_db('test');
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
        <?php
        if(isset($_REQUEST['msg']))
        {
            echo $_REQUEST['msg'];
        }
        ?>
       <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post">
           
<table align="center" border="1" bgcolor="white" cellspacing="0" width="auto" height="auto"> 
    
<tr>
	<th bgcolor="white">Medicine ID</th>
        <th bgcolor="white">Medicine Name</th>
        <th bgcolor="white">Stock</th>
        <th bgcolor="white">Medicine Type</th>
        <th bgcolor="white">Price</th>
        <th bgcolor="white">Units</th>
        <th bgcolor="white">Expiry Date</th>
 </tr>

    <?php 
      $result=fetchMedicine();
      while($row=mysql_fetch_array($result,MYSQL_ASSOC))
      {
            echo "<tr ><td>".$row['medid']."</td>"
                . "<td>".$row['medname']."</td>"
                    . "<td>". $row['stock']."</td>"
                 ."<td>".$row['medtype']."</td>"
                ."<td>".$row['price']."</td>"
                ."<td>".$row['units']."</td>"
                ."<td>".$row['expiry_date']."</td>"
            ." <td><form action='deletemedicine.php' method='post'>"
                    ."<input type='hidden' name='txtmedid' id='txtmedid' value=".$row['medid']."/>"
                    ."<input type='submit' name='btndelete' value='Delete'/>"
                    . "</form></td></tr>";
               
      }
      ?>
 
 </table>
       </form>
       
        <?php include 'footer.php';?>
</body>
</html>
   