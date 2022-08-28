
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
            <?php include 'Custheader_link.php'; ?>
    </head>
    <body>
         <?php include 'Custheader.php'; ?>

        <p style="color:red;">*:Required field</p>
       <form action="srccustchangepassword.php" method="post">
            <table>
                 <tr>
                    <td>Old Password</td>
                     <td><input type="password" name="txtoldpwd"><span style="color:red;">*</span></td>
                </tr>
                <tr>
                    <td>New Password</td>
                     <td><input type="password" name="txtnewpwd"><span style="color:red;">*</span></td>
                </tr> 
                  
                </tr>
                <tr>
                    <td>Confirm Password</td>
                     <td><input type="password" name="txtconfpwd"><span style="color:red;">*</span></td>
                </tr> 
                
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnchangepass" value="Change Password">
                    <input type="reset" name="btnreset" value="Cancel"></td>
                </tr>
            </table>
        </form>
         <?php
        if(isset($_REQUEST['msg']))
              echo $_REQUEST['msg'];  /*echo "<h5 style='color:red;'>".$_REQUEST['msg']."</h5>"; /*<?=@$msg?>*/
        ?> 
         <?php include 'footer.php';?>

 </body>
</html>

