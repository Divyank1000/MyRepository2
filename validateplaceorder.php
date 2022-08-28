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
 #Validation for quantity
    if(empty($_POST['txtqty']))
    {
        $error.="<p class='error'>Quantity is required</p>";
    }
    else if(!preg_match("/^[0-9]+$/",$_POST['txtqty']))
    {
        $error.="<p class='error'>Enter correct quantity in digits</p>";
    }
    else
    {
        $qty=testinput($_POST['txtqty']);
    }
}
?>
