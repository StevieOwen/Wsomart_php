<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once "../../includes/checkinput.php";
require_once "../../includes/token_generation.php";

$email="";

if(isset($_SESSION['customer'])){
    $email=$_SESSION['customer'];
}
$pwd="";
$confirm_pwd="";
$errors=['pwd'=>'','confirm_pwd'=>'','no_match'=>''];
if(isset($_POST['reset'])){
    

    if(empty($_POST['password'])){
        $errors['pwd']="Password is required";
    }else{
        $pwd=checkinput($_POST['password']);
    }

    if(empty($_POST['confirm_password'])){
        $errors['confirm_pwd']="You must confirm the password";
    }else{
        $confirm_pwd=checkinput($_POST['confirm_password']);
    }
    if($pwd==$confirm_pwd){
        $pwd=password_hash($pwd,PASSWORD_DEFAULT);
    }else{
        $errors['no_match']="Password don't match";
    }

    $num_error=0;
    foreach($errors as $error){
        if(!empty($error)){
            $num_error+=1;
        }
    }

    if($num_error==0){
        $stm=$conn->prepare("Update customer set cust_password=:cust_password where cust_email=:cust_email");
        $stm->bindParam(':cust_password',$pwd);
        $stm->bindParam(':cust_email',$email);
        $stm->execute();
        header("Location:./login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/reset_password.css">
    <!-- link to google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
</head>
<body>

    <?php require_once "../../includes/header.php" ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="POST">
        
        <h4>Set a new password</h4>
        <div class="form-container">

            <div class="error"><?php echo $errors['pwd']; ?></div>
            <div class="error"><?php echo $errors['no_match'] ?></div>
           <div class="input-group input-wrapper mb-3">
                <span class="input-group-text" id="pwd_icon"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M8 10V8c0-2.761 1.239-5 4-5s4 2.239 4 5v2M3.5 17.8v-4.6c0-1.12 0-1.68.218-2.107a2 2 0 0 1 .874-.875c.428-.217.988-.217 2.108-.217h10.6c1.12 0 1.68 0 2.108.217a2 2 0 0 1 .874.874c.218.428.218.988.218 2.108v4.6c0 1.12 0 1.68-.218 2.108a2 2 0 0 1-.874.874C18.98 21 18.42 21 17.3 21H6.7c-1.12 0-1.68 0-2.108-.218a2 2 0 0 1-.874-.874C3.5 19.481 3.5 18.921 3.5 17.8m8.5-2.05v-.5m4 .5v-.5m-8 .5v-.5'/></svg></span>
                <input type="password" name="password" class="form-control" placeholder="New Password" aria-label="password" aria-describedby="pwd_icon">
           </div>    

           <div class="error"><?php echo $errors['confirm_pwd'] ?></div>
           <div class="input-group input-wrapper mb-3">
                <span class="input-group-text" id="confirm_pwd_icon"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M8 10V8c0-2.761 1.239-5 4-5s4 2.239 4 5v2M3.5 17.8v-4.6c0-1.12 0-1.68.218-2.107a2 2 0 0 1 .874-.875c.428-.217.988-.217 2.108-.217h10.6c1.12 0 1.68 0 2.108.217a2 2 0 0 1 .874.874c.218.428.218.988.218 2.108v4.6c0 1.12 0 1.68-.218 2.108a2 2 0 0 1-.874.874C18.98 21 18.42 21 17.3 21H6.7c-1.12 0-1.68 0-2.108-.218a2 2 0 0 1-.874-.874C3.5 19.481 3.5 18.921 3.5 17.8m8.5-2.05v-.5m4 .5v-.5m-8 .5v-.5'/></svg></span>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" aria-label="confirm_pwd" aria-describedby="confirm_pwd_icon">
           </div>    

           <div class="submitbut">
            <input type="submit" value="Reset Password" name="reset" id="reset">
           </div>
        </div>
    </form>

    
</body>
</html>