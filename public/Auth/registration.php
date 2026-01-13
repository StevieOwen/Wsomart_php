<?php 

require_once __DIR__ . '/../../vendor/autoload.php'; // Load all libraries;
require_once __DIR__ . '/../../includes/dbconnexion.php'; // Load DB;

    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration|WSOMART</title>
    <link rel="stylesheet" href="../../assets/css/registration.css">
    <!-- link to google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <!-- the header contains the logo plus the name of the app -->
    <header class="header">
        <p><svg width="40" style="color:#013F62" height="40" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M2.787 2.28a.75.75 0 0 1 .932.507l.55 1.863h14.655c1.84 0 3.245 1.717 2.715 3.51l-1.655 5.6c-.352 1.193-1.471 1.99-2.715 1.99H8.113c-1.244 0-2.362-.797-2.715-1.99L2.281 3.212a.75.75 0 0 1 .506-.931M6.25 19.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0m8 0a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0'/></svg></p>
        <h3>WSOMART</h3>
    </header>
    <!-- Registration formular -->
     
    <form action="">
        <h4>Create Free Account</h4>
        <div class="form-container">
            <!-- First name     -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="first_name"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg></span>
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" aria-label="first_name" aria-describedby="first_name">
                
            </div>
            <!-- Last name -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="last_name"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg></span>
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" aria-label="last_name" aria-describedby="last_name">
                
            </div>
            <!-- Email -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="email"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M7.125 3.75h9.75c.813 0 1.468 0 2 .043.546.045 1.026.14 1.47.366a3.75 3.75 0 0 1 1.64 1.639c.226.444.32.924.365 1.47q.01.12.016.247a.75.75 0 0 1 .014.336c.013.41.013.879.013 1.417v5.464c0 .813 0 1.469-.043 2-.045.546-.14 1.026-.366 1.47a3.75 3.75 0 0 1-1.639 1.64c-.444.226-.924.32-1.47.365-.532.043-1.187.043-2 .043h-9.75c-.813 0-1.468 0-2-.043-.546-.045-1.026-.14-1.47-.366a3.75 3.75 0 0 1-1.639-1.639c-.226-.444-.32-.924-.365-1.47-.044-.531-.044-1.187-.044-2V9.268c0-.538 0-1.007.013-1.417a.75.75 0 0 1 .014-.336q.007-.128.017-.246c.044-.547.139-1.027.365-1.471a3.75 3.75 0 0 1 1.639-1.64c.444-.226.924-.32 1.47-.365.532-.043 1.187-.043 2-.043M20.85 7.341c-.038-.423-.105-.672-.202-.862a2.25 2.25 0 0 0-.983-.984c-.198-.1-.459-.17-.913-.207-.462-.037-1.057-.038-1.909-.038H7.157c-.852 0-1.446 0-1.91.038-.453.037-.714.107-.911.207a2.25 2.25 0 0 0-.984.984c-.096.19-.164.439-.202.862l6.604 4.403c1.01.674 1.363.895 1.722.981a2.25 2.25 0 0 0 1.048 0c.36-.086.711-.307 1.723-.981z'/></svg></span>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                
            </div>
            <!-- Address -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="adress"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 8.75a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5'/><path d='M18.227 3.9A8.68 8.68 0 0 0 12 1.25c-2.34 0-4.579.956-6.227 2.65-3.03 3.117-3.012 6.85-1.612 10.199 1.386 3.312 4.143 6.335 6.794 8.304a1.75 1.75 0 0 0 2.09 0c2.65-1.969 5.408-4.992 6.794-8.304 1.4-3.348 1.418-7.082-1.612-10.199M12 12.75a2.75 2.75 0 1 1 0-5.5 2.75 2.75 0 0 1 0 5.5'/></svg></span>
                <input type="text" id="adress" name="adress" class="form-control" placeholder="Adress" aria-label="adress" aria-describedby="adress">    
            </div>
            <!-- Phone number -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="phone_number"><label for="phone_number">+250</label></span>
                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" aria-label="phone_number" aria-describedby="phone_number">
            </div>
            <!-- password -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="password"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M16.75 8c0-1.478-.33-2.901-1.107-3.975-.8-1.107-2.03-1.775-3.643-1.775s-2.842.668-3.643 1.775C7.58 5.099 7.25 6.522 7.25 8v1.25h-.58c-.535 0-.98 0-1.345.03-.38.031-.736.098-1.073.27a2.75 2.75 0 0 0-1.202 1.202c-.172.337-.24.694-.27 1.074-.03.364-.03.81-.03 1.344v4.66c0 .535 0 .98.03 1.345.03.38.098.737.27 1.074a2.75 2.75 0 0 0 1.202 1.202c.337.172.693.239 1.073.27.365.03.81.03 1.345.03h10.66c.535 0 .98 0 1.345-.03.38-.031.736-.098 1.073-.27a2.75 2.75 0 0 0 1.202-1.202c.172-.337.24-.694.27-1.074.03-.364.03-.81.03-1.344V13.17c0-.534 0-.98-.03-1.344-.03-.38-.098-.737-.27-1.074a2.75 2.75 0 0 0-1.2-1.202c-.338-.172-.694-.239-1.074-.27-.365-.03-.81-.03-1.345-.03h-.58zm-8 0c0-1.283.29-2.36.822-3.096.51-.703 1.28-1.154 2.428-1.154s1.919.45 2.428 1.154c.532.736.822 1.813.822 3.096v1.25h-6.5zm4 7.25v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0M16 14.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 .75-.75m-7.25.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0'/></svg></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="password">    
            </div>
            <!-- password confirmation -->
            <div class="input-group input-wrapper">
                <span class="input-group-text" id="confirm_password"><svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M16.75 8c0-1.478-.33-2.901-1.107-3.975-.8-1.107-2.03-1.775-3.643-1.775s-2.842.668-3.643 1.775C7.58 5.099 7.25 6.522 7.25 8v1.25h-.58c-.535 0-.98 0-1.345.03-.38.031-.736.098-1.073.27a2.75 2.75 0 0 0-1.202 1.202c-.172.337-.24.694-.27 1.074-.03.364-.03.81-.03 1.344v4.66c0 .535 0 .98.03 1.345.03.38.098.737.27 1.074a2.75 2.75 0 0 0 1.202 1.202c.337.172.693.239 1.073.27.365.03.81.03 1.345.03h10.66c.535 0 .98 0 1.345-.03.38-.031.736-.098 1.073-.27a2.75 2.75 0 0 0 1.202-1.202c.172-.337.24-.694.27-1.074.03-.364.03-.81.03-1.344V13.17c0-.534 0-.98-.03-1.344-.03-.38-.098-.737-.27-1.074a2.75 2.75 0 0 0-1.2-1.202c-.338-.172-.694-.239-1.074-.27-.365-.03-.81-.03-1.345-.03h-.58zm-8 0c0-1.283.29-2.36.822-3.096.51-.703 1.28-1.154 2.428-1.154s1.919.45 2.428 1.154c.532.736.822 1.813.822 3.096v1.25h-6.5zm4 7.25v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0M16 14.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 .75-.75m-7.25.75v.5a.75.75 0 0 1-1.5 0v-.5a.75.75 0 0 1 1.5 0'/></svg></span>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm the Password" aria-label="confirm_password" aria-describedby="confirm_password">    
            </div>

            <!-- Gender -->
            <div class="form-floating select-wrapper">
            <select class="form-select" id="gender" aria-label="Floating label select example">
                <option value="">Choose option</option>
                <option value="F">Female</option>
                <option value="M">Male</option>
            </select>
            <label for="nationality">Select your gender</label>
            </div>    
            <!-- Nationality -->
            <div class="form-floating select-wrapper">
            <select class="form-select" id="nationality" aria-label="Floating label select example">
                <option value="">Choose option</option>
                
            </select>
            <label for="nationality">Select your country of origin</label>
            </div>    
             <!-- profile picture -->
            <div class="mb-3 input-wrapper">
                <label for="profile" class="form-label">Upload a profile picture</label>
                <input class="form-control" type="file" id="profile" accept="image/*">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="accept_terms" name="accept_terms">
                <label class="form-check-label" for="accept_terms">
                    Accept our <a href="">terms</a> and <a href="">conditions</a> to use our services.                  
                </label>
            </div> <br><br>
            <!-- submit button -->
             <div style="text-align:center">
                <input type="submit" value="CREATE ACCOUNT" class="register" id="register" name="register">
                <p>Already have an account? <a href="">Login here</a></p>
             </div>
            

        </div>
           
        
    </form>


 
<script src="../../assets/js/nationality.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>