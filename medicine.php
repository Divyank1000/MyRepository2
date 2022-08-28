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
       <form action="srcmedicine.php" method="post">
            <table>
                 <tr>
                    <td>Medicine ID</td>
                    <td><input type="text" name="txtmedid" value="<?php if(isset($_REQUEST['medid'])){ echo $_REQUEST['medid'];}?>"disabled ></td>
                </tr>
                <tr>
                    <td>Medicine Name</td>
                    <td><input type="text" name="txtmedname"><span style="color:red;">*</span></td>
                </tr>
                <tr>
                    <td>Stock</td>
                   <td><input type="text" name="txtstock" value="0"></td>
                </tr>   
                </tr>
                <tr>
                    <td>Medicine Type</td>
                    <td><input type="radio" name="rdbmedtype" value="Tabs" checked>Tablets
                    <input type="radio" name="rdbmedtype" value="Syrup">Syrup</td>
                </tr> 
                <tr>
                    <td>Price(Rs.)</td>
                    <td><input type="text" name="txtprice"><span style="color:red;">*</span></td>
                </tr> 
                 <tr>
                    <td>Units</td>
                    <td><input type="text" name="txtunits"><span style="color:red;">*</span></td>
                </tr>
                 <tr>
                     <td>Expiry Date</td>
                    <td><input type="date" name="txtexpdate"><span style="color:red;">*</span></td>
                </tr>
              
              
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="Add Medicine">
                    <input type="reset" name="btnreset" value="Cancel"></td>
                </tr>
            </table>
        </form>
         <?php
        if(isset($_REQUEST['msg']))
              echo $_REQUEST['msg']; /* echo "<h4 style='color:blue;'>".$_REQUEST['msg']."</h4>";*/
        ?>
          <?php include 'footer.php';?>
</body>
</html>

