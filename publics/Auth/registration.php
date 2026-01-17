<?php 
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;

require_once "../../includes/checkinput.php";
require_once "../../includes/token_generation.php";
$customer=[
        "cust_id"=>"",
        "cust_fname"=>"",
        "cust_lname"=>"",
        "cust_email"=>"",
        "cust_phone"=>"",
        "cust_gender"=>"",
        "cust_address"=>"",
        "cust_profile"=>"",
        "cust_nationality"=>"",
        "cust_status"=>"",
        "cust_created_at"=>"",
        "cust_password"=>"",
        "cust_confirm_pwd"=>"",
        "cust_email_verified"=>"",
        "cust_token"=>"",
        "token_created_at"=>"",
        "token_expires_at"=>"",
        "token_expired"=>"",
        "token_used"=>""
];
$errors=[
        "cust_fname"=>"",
        "cust_lname"=>"",
        "cust_email"=>"",
        "cust_phone"=>"",
        "cust_gender"=>"",
        "cust_address"=>"",
        "cust_profile"=>"",
        "cust_nationality"=>"",
        "cust_password"=>"",
        "cust_confirm_pwd"=>"",
        "password_match"=>"",
        "accept_terms"=>""       
];

if(isset($_POST['register'])){
    //checking first name
    if(empty($_POST['first_name'])){
        $errors["cust_fname"]="First name is required";
    }else{
        $customer["cust_fname"]=checkinput($_POST["first_name"]);
    }

    // check last name
    if(empty($_POST['last_name'])){
        $errors["cust_lname"]="Last name is required";
    }else{
        $customer["cust_lname"]=checkinput($_POST["last_name"]);
    }

    //check email
    if(empty($_POST['email'])){
        $errors["cust_email"]="Email is required";
    }else{
        $customer["cust_email"]=checkinput($_POST["email"]);
    }

    // check address
    if(empty($_POST['address'])){
        $errors["cust_address"]="Address is required";
    }else{
        $customer["cust_address"]=checkinput($_POST["address"]);
    }

    //check phone number
    if(empty($_POST['phone_number'])){
        $errors["cust_phone"]="Phone number is required";
    }else{
        $customer["cust_phone"]=checkinput($_POST["phone_number"]);
    }

    // check password
    if(empty($_POST['password'])){
        $errors["cust_password"]="Password is required";
    }else{
        $customer["cust_password"]=checkinput($_POST["password"]);
    }
    // check password confirmation
    if(empty($_POST['confirm_password'])){
        $errors["cust_confirm_pwd"]="Password confirmation is required";
    }else{
        $customer["cust_confirm_pwd"]=checkinput($_POST["confirm_password"]);
    }

    // check password match
    if($customer["cust_password"]!=$customer["cust_confirm_pwd"]){
        $errors["password_match"]="Password don't match";
    }else{
        $customer["cust_password"]=password_hash($customer["cust_password"],PASSWORD_DEFAULT);
    }

    // check gender
    if(empty($_POST['gender'])){
        $errors["cust_gender"]="Gender is required";
    }else{
        $customer["cust_gender"]=checkinput($_POST["gender"]);
    }

    // check nationality
    if(empty($_POST['nationality'])){
        $errors["cust_nationality"]="Nationality is required";
    }else{
        $customer["cust_nationality"]=checkinput($_POST["nationality"]);
    }

    //check terms acceptance
    if(!isset($_POST["accept_terms"])){
        $errors["accept_terms"]="You must accept our terms and conditions";
    }

    //check profile picture
    if (!isset($_FILES["profile"]) && $_FILES["profile"]['error'] === UPLOAD_ERR_OK) {
        $errors['cust_profile']="You must upload a profile picture";
    }else{
        $tmp_name = $_FILES['profile']['tmp_name'];
    $name = basename($_FILES['profile']['name']);
    }

    $num_error=0;
    foreach($errors as $error){
        if(!empty($error)){
            $num_error+=1;
        }
    }
    
    if($num_error==0){
      
        $customer["cust_id"]="cuts_".str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $customer["cust_created_at"]=date("y/m/d") ;
        $customer["cust_status"]="not active";
        $customer["cust_email_verified"]="no";
        
        //token generation
        $generated_token= generate_token();

        $customer["cust_token"]=$generated_token[0];
        $customer["token_created_at"]=$generated_token[1];
        $customer["token_expires_at"]=$generated_token[2];
        $customer["token_used"]="no";
        try {
        $stm=$conn->prepare("INSERT INTO customer(cust_id, cust_first_name, cust_last_name, cust_email, cust_phone, cust_gender, cust_address, cust_profile, cust_nationality, cust_status, cust_created_at, cust_password, email_verified, cust_token, token_created_at, token_expires_at,token_used) Values(:cust_id, :cust_first_name, :cust_last_name, :cust_email, :cust_phone, :cust_gender, :cust_address, :cust_profile, :cust_nationality, :cust_status, :cust_created_at, :cust_password, :email_verified, :cust_token, :token_created_at, :token_expires_at,:token_used)");

        $data=[
                ":cust_id"=>$customer["cust_id"],
                ":cust_first_name"=>$customer["cust_fname"],
                ":cust_last_name"=>$customer["cust_lname"],
                ":cust_email"=>$customer["cust_email"],
                ":cust_phone"=>$customer["cust_phone"],
                ":cust_gender"=>$customer["cust_gender"],
                ":cust_address"=>$customer["cust_address"],
                ":cust_profile"=>$customer["cust_profile"],
                ":cust_nationality"=>$customer["cust_nationality"],
                ":cust_status"=>$customer["cust_status"],
                ":cust_created_at"=>$customer["cust_created_at"],
                ":cust_password"=>$customer["cust_password"],
                ":email_verified"=>$customer["cust_email_verified"],
                ":cust_token"=>$customer["cust_token"],
                ":token_created_at"=>$customer["token_created_at"],
                ":token_expires_at"=>$customer["token_expires_at"],
                ":token_used"=>$customer["token_used"]
        ];
        $stm->execute($data);
        // send email to user
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

        // redirect to token validation
        $_SESSION['customer']=$customer['cust_email'];
        header("Location:token_validation.php");
        } catch(PDOException $e) {
        echo  $e->getMessage();
        } 
        $conn = null;   
    }
}
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration|WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/registration.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <!-- link to google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
   <?php require_once "../../includes/header.php" ?>
    <!-- Registration formular -->
     
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
        <h4>Create Free Account</h4>
        <div class="form-container">
            <!-- First name     -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="first_name"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg></span>
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" aria-label="first_name" aria-describedby="first_name">
                <div class="error"><?php echo $errors['cust_fname'] ?></div>
            </div>
            <!-- Last name -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="last_name"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg></span>
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" aria-label="last_name" aria-describedby="last_name">
                <div class="error"><?php echo $errors['cust_lname'] ?></div>
            </div>
            <!-- Email -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="email"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M7.125 3.75h9.75c.813 0 1.468 0 2 .043.546.045 1.026.14 1.47.366a3.75 3.75 0 0 1 1.64 1.639c.226.444.32.924.365 1.47q.01.12.016.247a.75.75 0 0 1 .014.336c.013.41.013.879.013 1.417v5.464c0 .813 0 1.469-.043 2-.045.546-.14 1.026-.366 1.47a3.75 3.75 0 0 1-1.639 1.64c-.444.226-.924.32-1.47.365-.532.043-1.187.043-2 .043h-9.75c-.813 0-1.468 0-2-.043-.546-.045-1.026-.14-1.47-.366a3.75 3.75 0 0 1-1.639-1.639c-.226-.444-.32-.924-.365-1.47-.044-.531-.044-1.187-.044-2V9.268c0-.538 0-1.007.013-1.417a.75.75 0 0 1 .014-.336q.007-.128.017-.246c.044-.547.139-1.027.365-1.471a3.75 3.75 0 0 1 1.639-1.64c.444-.226.924-.32 1.47-.365.532-.043 1.187-.043 2-.043M20.85 7.341c-.038-.423-.105-.672-.202-.862a2.25 2.25 0 0 0-.983-.984c-.198-.1-.459-.17-.913-.207-.462-.037-1.057-.038-1.909-.038H7.157c-.852 0-1.446 0-1.91.038-.453.037-.714.107-.911.207a2.25 2.25 0 0 0-.984.984c-.096.19-.164.439-.202.862l6.604 4.403c1.01.674 1.363.895 1.722.981a2.25 2.25 0 0 0 1.048 0c.36-.086.711-.307 1.723-.981z'/></svg></span>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                <div class="error"><?php echo $errors['cust_email'] ?></div>
            </div>
            <!-- Address -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="adress"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 8.75a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5'/><path d='M18.227 3.9A8.68 8.68 0 0 0 12 1.25c-2.34 0-4.579.956-6.227 2.65-3.03 3.117-3.012 6.85-1.612 10.199 1.386 3.312 4.143 6.335 6.794 8.304a1.75 1.75 0 0 0 2.09 0c2.65-1.969 5.408-4.992 6.794-8.304 1.4-3.348 1.418-7.082-1.612-10.199M12 12.75a2.75 2.75 0 1 1 0-5.5 2.75 2.75 0 0 1 0 5.5'/></svg></span>
                <input type="text" id="adress" name="address" class="form-control" placeholder="Address" aria-label="address" aria-describedby="address">    
                <div class="error"><?php echo $errors['cust_address'] ?></div>
            </div>
            <!-- Phone number -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="phone_number"><label for="phone_number">+250</label></span>
                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" aria-label="phone_number" aria-describedby="phone_number">
                <div class="error"><?php echo $errors['cust_phone'] ?></div>
            </div>
            <!-- password -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="password"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M16.75 8c0-1.478-.33-2.901-1.107-3.975-.8-1.107-2.03-1.775-3.643-1.775s-2.842.668-3.643 1.775C7.58 5.099 7.25 6.522 7.25 8v1.25h-.58c-.535 0-.98 0-1.345.03-.38.031-.736.098-1.073.27a2.75 2.75 0 0 0-1.202 1.202c-.172.337-.24.694-.27 1.074-.03.364-.03.81-.03 1.344v4.66c0 .535 0 .98.03 1.345.03.38.098.737.27 1.074a2.75 2.75 0 0 0 1.202 1.202c.337.172.693.239 1.073.27.365.03.81.03 1.345.03h10.66c.535 0 .98 0 1.345-.03.38-.031.736-.098 1.073-.27a2.75 2.75 0 0 0 1.202-1.202c.172-.337.24-.694.27-1.074.03-.364.03-.81.03-1.344V13.17c0-.534 0-.98-.03-1.344-.03-.38-.098-.737-.27-1.074a2.75 2.75 0 0 0-1.2-1.202c-.338-.172-.694-.239-1.074-.27-.365-.03-.81-.03-1.345-.03h-.58zm-8 0c0-1.283.29-2.36.822-3.096.51-.703 1.28-1.154 2.428-1.154s1.919.45 2.428 1.154c.532.736.822 1.813.822 3.096v1.25h-6.5zm4 7.25v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0M16 14.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 .75-.75m-7.25.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0'/></svg></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="password">    
                <div class="error"><?php echo $errors['cust_password'] ?></div>
            </div>
            <!-- password confirmation -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="confirm_password"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M16.75 8c0-1.478-.33-2.901-1.107-3.975-.8-1.107-2.03-1.775-3.643-1.775s-2.842.668-3.643 1.775C7.58 5.099 7.25 6.522 7.25 8v1.25h-.58c-.535 0-.98 0-1.345.03-.38.031-.736.098-1.073.27a2.75 2.75 0 0 0-1.202 1.202c-.172.337-.24.694-.27 1.074-.03.364-.03.81-.03 1.344v4.66c0 .535 0 .98.03 1.345.03.38.098.737.27 1.074a2.75 2.75 0 0 0 1.202 1.202c.337.172.693.239 1.073.27.365.03.81.03 1.345.03h10.66c.535 0 .98 0 1.345-.03.38-.031.736-.098 1.073-.27a2.75 2.75 0 0 0 1.202-1.202c.172-.337.24-.694.27-1.074.03-.364.03-.81.03-1.344V13.17c0-.534 0-.98-.03-1.344-.03-.38-.098-.737-.27-1.074a2.75 2.75 0 0 0-1.2-1.202c-.338-.172-.694-.239-1.074-.27-.365-.03-.81-.03-1.345-.03h-.58zm-8 0c0-1.283.29-2.36.822-3.096.51-.703 1.28-1.154 2.428-1.154s1.919.45 2.428 1.154c.532.736.822 1.813.822 3.096v1.25h-6.5zm4 7.25v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0M16 14.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 .75-.75m-7.25.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0'/></svg></span>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm the Password" aria-label="confirm_password" aria-describedby="confirm_password">    
                <div class="error"><?php echo $errors['cust_confirm_pwd'] ?></div>
                 <div class="error"><?php echo $errors['password_match'] ?></div>
            </div>

            <!-- Gender -->
            <div class="form-floating select-wrapper">
                <select class="form-select" id="gender" name="gender" aria-label="Floating label select example">
                    <option value="">Choose option</option>
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                </select>
                <label for="gender">Select your gender</label>
                <div class="error"><?php echo $errors['cust_gender'] ?></div>
            </div>    
            <!-- Nationality -->
            <div class="form-floating select-wrapper">
                <select class="form-select" id="nationality" name="nationality" aria-label="Floating label select example">
                    <option value="">Choose option</option>
                    
                </select>
                <label for="nationality">Select your country of origin</label>
                <div class="error"><?php echo $errors['cust_nationality'] ?></div>
            </div>    
             <!-- profile picture -->
            <div class="mb-3 input-wrapper">
                <label for="profile" class="form-label">Upload a profile picture</label>
                <input class="form-control" type="file" name="profile" id="profile" accept="image/*">
                <div class="error"><?php echo $errors['cust_profile'] ?></div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="accept_terms" name="accept_terms">
                <label class="form-check-label" for="accept_terms">
                    Accept our <a href="">terms</a> and <a href="">conditions</a> to use our services.                  
                </label>
                <div class="error"><?php echo $errors['accept_terms'] ?></div>
            </div> <br><br>
            <!-- submit button -->
             <div style="text-align:center">
                <input type="submit" value="CREATE ACCOUNT" class="register" id="register" name="register">
                <p>Already have an account? <a href="./login.php">Login here</a></p>
             </div>
            

        </div>
           
        
    </form>


 
<script src="../../assets/js/nationality.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>