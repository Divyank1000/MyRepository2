 <?php
        /*if(isset($_REQUEST['msg']))
        {
            foreach($_REQUEST as $key=>$value)
            {
                if($key=='name')
                        $name=$value;
                if($key=='msg')
                        $msg=$value;
            }
        }   
            /* echo "<h4 style='color:blue;'>".$_REQUEST['msg']."</h4>";*/
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
         <?php include 'Firstheader.php'; ?>

        <p style="color:red;">*:Required field</p>
       <form action="srcregister.php" method="post">
            <table>
                 <tr>
                    <td>Customer ID</td>
                    <td><input type="text" name="txtcustid" value="<?php if(isset($_REQUEST['custid'])){ echo $_REQUEST['custid'];}?>"disabled ></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="txtname"><span style="color:red;">*</span></td>
                </tr> 
                <tr>
                    <td>Gender</td>
                    <td><input type="radio" name="rdbgender" value="M" checked>Male
                    <input type="radio" name="rdbgender" value="F">Female</td>
                </tr>   
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea rows ="5" cols="20" name="txtaddr"></textarea><span style="color:red;">*</span></td>
                </tr> 
                <tr>
                    <td>Mobile No</td>
                    <td><input type="text" name="txtphone"><span style="color:red;">*</span></td>
                </tr> 
                <tr>
                    <td>E-mail ID</td>
                    <td><input type="email" name="txtemail"><span style="color:red;">*</span></td>
                </tr> 
                 <tr>
                    <td>Username</td>
                    <td><input type="text" name="txtuser" ><span style="color:red;">*</span></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="txtpwd"><span style="color:red;">*</span></td>
                </tr>
              
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="Register">
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

