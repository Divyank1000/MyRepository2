<?php
  $con="";
  function connect()
  {
      $dbserver="localhost:3306";
      $dbuser="root";
      $dbpwd="";
      $GLOBALS['con']=mysql_connect($dbserver,$dbuser,$dbpwd);
}
function fetchCustomers()
{
    connect();
    $sql="select custid,name from customer";
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
if(isset($_REQUEST['btnsubmit']))
{
    echo $_REQUEST['ddlcust'];
}
?>
<html>
    <head>
        <?php include 'header_link.php'; ?>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <?php include 'header.php'; ?>
       <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post">
            <table>
                 <tr>
                    <td>Select A Customer</td>
                    <td>
                        <select name="ddlcust">
                                <?php
                                $result=fetchCustomers();
                                while($row=mysql_fetch_array($result,MYSQL_ASSOC))
                                {
                                    echo "<option value=".$row['custid'].">".$row['name']."</option>";
                                }
                                ?>
                    </select>
                    </td>
                 </tr>
                
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="Register">
                    <input type="reset" name="btnreset" value="Cancel"></td>
                </tr>
            </table>
        </form>
       <?php
      /*  if(isset($_REQUEST['msg']))
                echo "<h4 style='color:blue;'>".$_REQUEST['msg']."</h4>";*/
       ?>
        <?php include 'footer.php';?>
    </body>
</html>

