<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;
require_once "../../includes/checkinput.php";
require_once "../../includes/token_generation.php";

$cust=["email"=>"","fname"=>"","lname"=>"","address"=>"","phone"=>"",];
$errors=["fname"=>"","lname"=>"","address"=>"","phone"=>"",];

if(isset($_POST['update'])){
   
    if(empty($_POST['fname'])){
        $errors['fname']="The first name is required";
    }else{
        $cust['fname']=checkinput($_POST['fname']);
    }

    if(empty($_POST['lname'])){
        $errors['lname']="The last name is required";
    }else{
        $cust['lname']=checkinput($_POST['lname']);
    }

    if(empty($_POST['address'])){
        $errors['address']="The address is required";
    }else{
        $cust['address']=checkinput($_POST['address']);
    }    

    if(empty($_POST['phone'])){
        $errors['phone']="The phone is required";
    }else{
        $cust['phone']=checkinput($_POST['phone']);
    }    

    $num_err=0;
    foreach($errors as $error){
        if(!empty($error)){
            $num_err+=1;
        }
    }

    if($num_err==0){
        $stm=$conn->prepare("UPDATE customer set cust_first_name=:fname, cust_last_name=:lname, cust_phone=:phone, cust_address=:address where cust_email=:cust_email " );
        $data=[
                ':fname',$cust['fname'],
                ':lname',$cust['lname'],
                ':phone',$cust['phone'],
                ':address',$cust['address'],
                ':cust_email',$email,
              ];
        $stm->execute($data);      
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings |WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/header2.css">
    <link rel="stylesheet" href="../../assets/css/settings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body class="">
    <?php require_once "../../includes/header2.php" ?>

    <main>
        <h3>ACCOUNT SETTINGS</h3>
        <div class="setting-container">
            <div class="setting-wrapper">
                <label for="profile">Edit your profile</label>
                <span>You can change your email, phone, names, image etc....</span>
                <input type="submit" value="Edit profile" name="profile" id="profile" > <br>
                <form id="edit_form" class="hidden" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" >
                    <div class="form-container">
                        <!-- first name -->
                        <div class="error"><?php echo $errors['fname'] ?></div>
                        <div class="input-group  input-wrapper mb-3">
                            <input disabled ="text" class="form-control" value="<?php  ?>" name="fname" aria-label="Recipient’s fname" aria-describedby="fname_edit">
                            <button class="btn btn-outline-secondary edit_btn" type="button" id="fname_edit">Edit</button>
                        </div>   
                        
                        <!-- last name -->
                        <div class="error"><?php echo $errors['lname'] ?></div>
                        <div class="input-group input-wrapper mb-3">
                            <input disabled type="text" class="form-control" value="<?php  ?>" name="lname" aria-label="Recipient’s lname" aria-describedby="lname_edit">
                            <button class="btn btn-outline-secondary edit_btn" type="button" id="lname_edit">Edit</button>
                        </div>   

                        <!-- address -->
                        <div class="error"><?php echo $errors['address'] ?></div>
                        <div class="input-group input-wrapper mb-3">
                            <input disabled type="text" class="form-control" value="<?php  ?>" name="address" aria-label="Recipient’s address" aria-describedby="address_edit">
                            <button class="btn btn-outline-secondary edit_btn" type="button" id="address_edit">Edit</button>
                        </div> 

                        <!-- phone number -->
                        <div class="error"><?php echo $errors['phone'] ?></div>
                        <div class="input-group input-wrapper mb-3">
                            <input disabled type="text" class="form-control" value="<?php  ?>" name="phone" aria-label="Recipient’s phone" aria-describedby="phone_edit">
                            <button class="btn btn-outline-secondary edit_btn" type="button" id="phone_edit">Edit</button>
                        </div> 


                        <div class="submitbut">
                            <button type="button"  name="update" id="update" >Update</button>
                        </div>



                    </div>
                </form>
            </div>

            <div class="setting-wrapper">
                <label for="theme">Change Theme</label>
                <span>You can switch your system's theme to dark or light mode</span>
                <input type="submit" value="Switch Mode" name="theme" id="theme" >
            </div>

            <div class="setting-wrapper">
                <label for="visibility">Change Theme</label>
                <span>You can change your account visibility to private or public</span>
                <input type="submit" value="Switch to private" name="visibility" id="visibility" >
            </div>
        <div>
        <div class="card rate" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Rate our services</h5>
                <div class="stars" style="margin-bottom: 15px;">
                    <i class="fa-solid fa-star" style="font-size: 2rem; margin: 0 5px;"></i>
                    <i class="fa-solid fa-star" style="font-size: 2rem; margin: 0 5px;"></i>
                    <i class="fa-solid fa-star" style="font-size: 2rem; margin: 0 5px;"></i>
                    <i class="fa-solid fa-star" style="font-size: 2rem; margin: 0 5px;"></i>
                    <i class="fa-solid fa-star" style="font-size: 2rem; margin: 0 5px;"></i>
                </div>
                <p>According to your experiences give us some stars</p>
            </div>
        </div>
        <div>
            <input type="submit" value="Logout" name="logout" id="logout">
        </div>
    </main>

    <script src="../../assets/js/edit_infos.js"></script>
</body>
</html>