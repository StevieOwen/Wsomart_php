<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once "../../includes/checkinput.php";
require_once "../../includes/token_generation.php";

$email="";
$pwd="";
$pwd_db="";
$email_verified="";

$errors=["email"=>"", "pwd"=>"", "email_not_found"=>""];

if(isset($_POST['login'])){

    // check if the user submitted the email
    if(empty($_POST['email'])){
        $errors["email"]="Email is required";
    }else{
        $email=checkinput($_POST["email"]);
    }

    // check if the user submitted the password
    if(empty($_POST["pwd"])){
        $errors["pwd"]="Password is required";
    }else{
        $pwd=checkinput($_POST["pwd"]);
    }
    
    $num_err=0;

    foreach($errors as $error){
        if(!empty($error)){
            $num_err+=1;
        }
    }

    if($num_err==0){
        $stm=$conn->prepare("SELECT cust_password, email_verified from customer where cust_email=:cust_email");
        $stm->bindParam(":cust_email", $email);
        $stm->execute();

        $result=$stm->setFetchMode(PDO::FETCH_ASSOC);
        $custs=$stm->fetchAll();

        if(empty($custs[0])){
            $errors["email_not_found"]="Email not found";
        }else{
            $pwd_db=$custs[0]["cust_password"];
            $email_verified=$custs[0]["cust_email_verified"];
        }

        if($pwd!=$pwd_db){
            $errors['pwd']="Incorrect password";
        }else if($pwd=$pwd_db && $email_verified=="yes"){
          //redirect to home page
            $_SESSION['customer']=$email;
            header("Location:../home.php");

        }else if($pwd=$pwd_db && $email_verified=="no"){
            // generate new token and redirect to token_validation
            
            $generated_token= generate_token();
            
            //updating the token related infos in the DB
            $stmt=$conn->prepare("update customer set cust_token=:cust_token, token_created_at=:token_created_at, token_expires_at=:token_expires_at,  token_used=:token_used where cust_email=:cust_email");
    
            $value="no";
            $stmt->execute(
                [":cust_token"=>$generated_token[0],
                ":token_created_at"=>$generated_token[1],
                ":token_expires_at"=>$generated_token[2],
                ":token_used"=> $value,
                ":cust_email"=> $email     
                ]
            );
            //send email with token to customer 
            require_once "../../includes/email.php";
            $body=file_get_contents ("../../includes/email_template.html");
            $subject="Email Verification";
            $data = [
                        'message'     => 'We are excited to have you! Please use the verification code below to activate your account:',
                        'token' => $customer["cust_token"],
                        
                    ];
            foreach ($data as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }        
            send_mail($subject,$body,$recipient);
            $_SESSION['customer']=$email;
            header("Location: ./token_validation.php");
        }


    }

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login| WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <!-- link to google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
        <?php require_once "../../includes/header.php" ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <h3>Login here</h3>

            <div class="form-container">
                <div class="input-group input-wrapper mb-3">
                <span class="input-group-text" id="email_icon"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M7.125 3.75h9.75c.813 0 1.468 0 2 .043.546.045 1.026.14 1.47.366a3.75 3.75 0 0 1 1.64 1.639c.226.444.32.924.365 1.47q.01.12.016.247a.75.75 0 0 1 .014.336c.013.41.013.879.013 1.417v5.464c0 .813 0 1.469-.043 2-.045.546-.14 1.026-.366 1.47a3.75 3.75 0 0 1-1.639 1.64c-.444.226-.924.32-1.47.365-.532.043-1.187.043-2 .043h-9.75c-.813 0-1.468 0-2-.043-.546-.045-1.026-.14-1.47-.366a3.75 3.75 0 0 1-1.639-1.639c-.226-.444-.32-.924-.365-1.47-.044-.531-.044-1.187-.044-2V9.268c0-.538 0-1.007.013-1.417a.75.75 0 0 1 .014-.336q.007-.128.017-.246c.044-.547.139-1.027.365-1.471a3.75 3.75 0 0 1 1.639-1.64c.444-.226.924-.32 1.47-.365.532-.043 1.187-.043 2-.043M20.85 7.341c-.038-.423-.105-.672-.202-.862a2.25 2.25 0 0 0-.983-.984c-.198-.1-.459-.17-.913-.207-.462-.037-1.057-.038-1.909-.038H7.157c-.852 0-1.446 0-1.91.038-.453.037-.714.107-.911.207a2.25 2.25 0 0 0-.984.984c-.096.19-.164.439-.202.862l6.604 4.403c1.01.674 1.363.895 1.722.981a2.25 2.25 0 0 0 1.048 0c.36-.086.711-.307 1.723-.981z'/></svg></span>
                <input type="text" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="email_icon">
                </div>
                
                 <div class="input-group input-wrapper mb-3">
                <span class="input-group-text" id="pwd_icon"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M16.75 8c0-1.478-.33-2.901-1.107-3.975-.8-1.107-2.03-1.775-3.643-1.775s-2.842.668-3.643 1.775C7.58 5.099 7.25 6.522 7.25 8v1.25h-.58c-.535 0-.98 0-1.345.03-.38.031-.736.098-1.073.27a2.75 2.75 0 0 0-1.202 1.202c-.172.337-.24.694-.27 1.074-.03.364-.03.81-.03 1.344v4.66c0 .535 0 .98.03 1.345.03.38.098.737.27 1.074a2.75 2.75 0 0 0 1.202 1.202c.337.172.693.239 1.073.27.365.03.81.03 1.345.03h10.66c.535 0 .98 0 1.345-.03.38-.031.736-.098 1.073-.27a2.75 2.75 0 0 0 1.202-1.202c.172-.337.24-.694.27-1.074.03-.364.03-.81.03-1.344V13.17c0-.534 0-.98-.03-1.344-.03-.38-.098-.737-.27-1.074a2.75 2.75 0 0 0-1.2-1.202c-.338-.172-.694-.239-1.074-.27-.365-.03-.81-.03-1.345-.03h-.58zm-8 0c0-1.283.29-2.36.822-3.096.51-.703 1.28-1.154 2.428-1.154s1.919.45 2.428 1.154c.532.736.822 1.813.822 3.096v1.25h-6.5zm4 7.25v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0M16 14.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 .75-.75m-7.25.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0'/></svg></span>
                <input type="password" class="form-control" name="pwd" placeholder="Password" aria-label="Password" aria-describedby="pwd_icon">
                </div>
                
                <div class="submitbut">
                    <input type="submit" name="login" id="login" Value="LOGIN">
                </div>    
                <p>Don't have an Account yet? <a href="./registration.php">Register here</a> </p>

            </div>
        </form>
</body>
</html>