<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once "../../includes/checkinput.php";
require_once "../../includes/token_generation.php";
$email="";
$cust_id="";
if(isset($_SESSION['customer'])){
    $email=$_SESSION['customer']['cust_email'];
    $cust_id=$_SESSION['customer']['cust_id'];
}
$token="";
$errors=["empty"=>"", "nomatch"=>"","expired"=>""];

if(isset($_POST['send'])){
    // checking if the user entered the token
    if(empty($_POST["token"])){
        $error="The token is required";
    }else{
        $token=checkinput($_POST['token']);
    }

    if(empty($error["empty"])){
        //fetching token related information from the database
        $stm=$conn->prepare("SELECT cust_token, token_expires_at,token_used from customer where cust_email=:cust_email ");

        $stm->bindParam(':cust_email',$email);
        $stm->execute();
        $result=$stm->setFetchMode(PDO::FETCH_ASSOC);
        
        $custs=$stm->fetchAll();

        $token_db=$custs[0]["cust_token"];
        $expires_at=$custs[0]["token_expires_at"];
        $token_used=$custs[0]["token_used"];

        $currentTime = new DateTime();
        $formattedCurrentTime = $currentTime->format('Y-m-d H:i:s');

     // comparing the token in DB to the token enterd by the user
        if($token!=$token_db){
            $errors["nomatch"]="The token entered is not correct.<br> Please enter the token sent to your email";
        }else if(($token==$token_db && $formattedCurrentTime>$expires_at) || ($token_used=="yes")){
            $errors['expired']="The token expired or has been used.";

        } else if($token==$token_db && $formattedCurrentTime<$expires_at && $token_used=="no" ){
        $stmt=$conn->prepare("update customer set token_used=:value, email_verified=:email_verified, cust_status=:cust_status where cust_email=:cust_email");
        $stmt->bindParam(":value",$value);
        $stmt->bindParam(":email_verified",$email_verified);
        $stmt->bindParam(":cust_status",$cust_status);
        $cust_status="active";
        $email_verified="yes";
        $value="yes";
        $stmt->bindParam(":cust_email",$email);  
        $stmt->execute();
        header("Location:./login.php");
        }
    }
}

//reset token
if(isset($_POST['reset'])){
             //generating new token

            $generated_token= generate_token();
            
            //updating the token related infos in the DB
            $stmt=$conn->prepare("update customer set cust_token=:cust_token, token_created_at=:token_created_at, token_expires_at=:token_expires_at,  token_used=:token_used where cust_email=:cust_email");
            // $stmt->bindParam(":cust_token",$generated_token[0]);
            // $stmt->bindParam(":token_expired_at",$generated_token[1]);
            // $stmt->bindParam(":token_expires_at",$generated_token[2]);
            // $stmt->bindParam(":token_used", $value);
            // $stmt->bindParam(":cust_email", $email);
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
                        'token' => $generated_token[0],
                        
                    ];
            foreach ($data as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }        

            
            if(send_mail($subject,$body,$email)){
                // redirect to token validation
                $_SESSION['customer']=$email;
                header("Location:token_validation.php");
                exit();
            }else{
                // Email failed
                $errors["email_failed"] = "Sorry we couldn't send the email. Please contact support.";
            }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Validation| WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/token_validation.css">
    <!-- link to google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
        <?php require_once "../../includes/header.php" ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <h4>Just one more Step</h4>
            <p>We sent an email to <?php echo $email; ?> with a token</p>
            <div class="form-container">
                <div>
                    <input type="text" value="" name="token" id="token" placeholder="Enter the token here"> 
                </div>
                <div class="error"><?php echo $errors["empty"]?></div>
                <div class="error"><?php echo $errors["nomatch"]?></div>
                <div class="error"><?php echo $errors["expired"]?></div>

                <div class="submitbut">
                    <input type="submit" value="Validate" name="send" id="send">
                </div>
                <div class="resetbut">
                    <input type="submit" value=" Token expired? Resend " name="reset" id="reset">
                </div>
            </div>

        </form>
</body>
</html>