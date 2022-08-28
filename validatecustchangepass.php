<?php
function testinput($data)
{
    $data=trim($data);
    $data=htmlspecialchars($data);
    $data=stripslashes($data);
    return $data;
}
if(isset($_POST['btnchangepass']))
{
    #Validation for Old Password
   if(empty($_POST['txtoldpwd']))
    {
        $error.="<p class='error'>Password is required</p>";
    }
    else if(!preg_match("/^[A-Za-z]+@[0-9]+$/",$_POST['txtoldpwd']))
    {
        $error.="<p class='error'>Enter proper password ex:abc@123</p>";
    }
    else
    {
        $oldpwd=testinput($_POST['txtoldpwd']);
    }
     #Validation for New Password
   if(empty($_POST['txtnewpwd']))
    {
        $error.="<p class='error'>Password is required</p>";
    }
    else if(!preg_match("/^[A-Za-z]+@[0-9]+$/",$_POST['txtnewpwd']))
    {
        $error.="<p class='error'>Enter proper password ex:abc@123</p>";
    }
    else
    {
        $newpwd=testinput($_POST['txtnewpwd']);
    }
     #Validation for Confirm Password
   if(empty($_POST['txtconfpwd']))
    {
        $error.="<p class='error'>Password is required</p>";
    }
    else if(!preg_match("/^[A-Za-z]+@[0-9]+$/",$_POST['txtconfpwd']))
    {
        $error.="<p class='error'>Enter proper password ex:abc@123</p>";
    }
    else
    {
        $confpwd=testinput($_POST['txtconfpwd']);
    }
   if(isset($oldpwd)&& $oldpwd!=$sess_oldpwd)
   {
        $error.="<p class='error'>OldPassword did not match with password stored in session, Please give another time</p>";
   }
    if(isset($newpwd)&& isset($confpwd))
    {
        if($newpwd!==$confpwd)
        {
            $error.="<p class='error'>Password did not match, Please give another time</p>";
        }
    }
}
?>
   