<?php
$error="";
function testinput($data)
{
    $data=trim($data);
    $data=htmlspecialchars($data);
    $data=stripslashes($data);
    return $data;
}
if(isset($_POST['btnlogin']))
{
     #Validation for username
    if(empty($_POST['txtusername']))
    {
        $error.="<p class='error'>Username is required</p>";
    }
   else if(!preg_match("/^[a-z]+$/",$_POST['txtusername']))
    {
        $error.="<p class='error'>Enter proper username in smaller case</p>";
    }
    else
    {
        $user=testinput($_POST['txtusername']);
    }
      #Validation for password
    if(empty($_POST['txtpwd']))
    {
        $error.="<p class='error'>Password is required</p>";
    }
    else if(!preg_match("/^[A-Za-z]+@[0-9]+$/",$_POST['txtpwd']))
    {
        $error.="<p class='error'>Enter proper password ex:abc@123</p>";
    }
    else
    {
        $pwd=testinput($_POST['txtpwd']);
    }
}
?>