<?php
   if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
      if(!isset($_SESSION['customer'])) {
         header("Location: /wsomart_php/publics/Auth/login.php");
      }else{
         $cust_id = $_SESSION['customer']['cust_id'];

      }
?>