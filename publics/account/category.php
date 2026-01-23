<?php 
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once  '../../includes/session.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category| WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header2.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
</head>
<body>
   <?php require_once "../../includes/header2.php" ;?>
   
   


   <?php require_once "../../includes/footer.php" ;
        render_footer("../home.php", '#', './dashboard.php', "./settings.php")
    ?>  
</body>
</html>