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
         <?php include 'Firstheader.php'; ?>
          <p style="color:red;">*:Required field</p>
       <form action="srclogin.php" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="txtusername"><span style="color:red;">*</span></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="txtpwd"><span style="color:red;">*</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnlogin" value="Login"></td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_REQUEST['msg']))
                 echo $_REQUEST['msg'];
               /* echo "<h5 style='color:red;'>".$_REQUEST['msg']."</h5>";*/
           
       ?> 
        <?php include 'footer.php';?>
    </body>
</html>

