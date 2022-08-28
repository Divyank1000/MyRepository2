<?php
$error="";
function testinput($data)
{
    $data=trim($data);
    $data=htmlspecialchars($data);
    $data=stripslashes($data);
    return $data;
}
if(isset($_POST['btnsubmit']))
{
    #Validation for Customer name
    if(empty($_POST['txtname']))
    {
        $error.="<p class='error'>Name is required</p>";
    }
    else if(!preg_match("/^[A-Z][a-z]+$/",$_POST['txtname']))
    {
        $error.="<p class='error'>Enter proper name ex:Anita</p>";
    }
    else
    {
        $name=testinput($_POST['txtname']);
    }
    #Validation for address
    if(empty($_POST['txtaddr']))
    {
        $error.="<p class='error'>Address is required</p>";
    }
    else
    {
        $address=testinput($_POST['txtaddr']);
    }
    #Validation for phone
    if(empty($_POST['txtphone']))
    {
        $error.="<p class='error'>Phone no. is required</p>";
    }
    else if(!preg_match("/^[0-9]{10}$/",$_POST['txtphone']))
    {
        $error.="<p class='error'>Enter mobile no. in 10 digits</p>";
    }
    else
    {
        $phone=testinput($_POST['txtphone']);
    }
    #Validation foe Email ID
     if (empty($_POST['txtemail'])) 
    {
        $error.="<p class='error'>Email ID is required</p>";
    }
   else if(!preg_match("/^[a-z0-9-\.]+@[a-z]+\.[a-z]{3}$/",$_POST['txtemail']))
   {
       $error.="<p class='error'>Enter valid Email ID Ex:abc@gmail.com</p>";
   }
   else
   {
       $email=testinput($_POST['txtemail']);
   }
     #Validation for username
    if(empty($_POST['txtuser']))
    {
        $error.="<p class='error'>Username is required</p>";
    }
    else if(!preg_match("/^[a-z]+$/",$_POST['txtuser']))
    {
        $error.="<p class='error'>Enter proper username in smaller case</p>";
    }
    else
    {
        $user=testinput($_POST['txtuser']);
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