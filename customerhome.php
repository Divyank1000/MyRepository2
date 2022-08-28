<html>
<head>
    <?php include 'Custheader_link.php'; ?>
</head>
<body bgcolor="skyblue">
    <?php include 'Custheader.php'; ?>

    <h1><a href="#">Welcome <?php if(isset($_REQUEST['custname'])){echo $_REQUEST['custname'];}?></a></h1>
  
<?php include 'footer.php';?>
</body>
</html>
