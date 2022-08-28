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
    #Validation for medicine name
    if(empty($_POST['txtmedname']))
    {
        $error.="<p class='error'>Medicine Name is required</p>";
    }
    else if(!preg_match("/^[A-Za-z\s0-9]+$/",$_POST['txtmedname']))
    {
        $error.="<p class='error'>Enter proper medicine name ex:Vicks Action 500</p>";
    }
    else
    {
        $medname=testinput($_POST['txtmedname']);
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
     #Validation for units
    if(empty($_POST['txtunits']))
    {
        $error.="<p class='error'>Units is required</p>";
    }
    else if(!preg_match("/^[mg|ml]+$/",$_POST['txtunits']))
    {
        $error.="<p class='error'>Enter proper units in smaller case ex:mg,ml,....</p>";
    }
    else
    {
        $units=testinput($_POST['txtunits']);
    }
      #Validation for expiry date
    if(empty($_POST['txtexpdate']))
    {
        $error.="<p class='error'>Expiry date is required</p>";
    }
    else
    {
        $expdate=testinput($_POST['txtexpdate']);
    }
}
?>