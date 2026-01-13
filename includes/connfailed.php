<?php session_start(); ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background: #ffcccc; color: #990000; padding: 10px; border: 1px solid #990000;">
        <?php 
            echo $_SESSION['error']; 
            unset($_SESSION['error']); // Clear it so it doesn't show again on refresh
        ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion failed</title>
</head>
<body>
    
<script>
prompt("hello")

</script>
</body>
</html>