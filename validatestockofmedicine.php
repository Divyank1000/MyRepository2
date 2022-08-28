<?php
if(isset($_REQUEST['btnupdate']))
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

#Validation for price
if(empty($_POST['txtprice']))
    {
        $error.="<p class='error'>Price is required</p>";
    }
    else if(!preg_match("/^[0-9]+\.[0-9]+$/",$_POST['txtprice']))
    {
        $error.="<p class='error'>Enter price correctly in digits</p>";
    }
    else
    {
        $price=testinput($_POST['txtprice']);
    }
}
?>