<?php
if(isset($_SESSION['sess_user']))
{
    session_destroy();
}
header("Location:custlogin.php");
?>
