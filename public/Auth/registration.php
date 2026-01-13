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
        <h4>Create Free Account</h4><br><br>
        <div class="form_container">
            <div> </div>
            <div>
                <div class="pers_infos">
                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg>
                        <input type="text" placeholder="First Name" id="first_name" name="first_name" value="">
                    </div>

                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg>
                        <input type="text" placeholder="Last Name" id="last_name" name="last_name" value="">
                    </div>

                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='m2.357 7.714 6.98 4.654c.963.641 1.444.962 1.964 1.087.46.11.939.11 1.398 0 .52-.125 1.001-.446 1.964-1.087l6.98-4.654M7.157 19.5h9.686c1.68 0 2.52 0 3.162-.327a3 3 0 0 0 1.31-1.311c.328-.642.328-1.482.328-3.162V9.3c0-1.68 0-2.52-.327-3.162a3 3 0 0 0-1.311-1.311c-.642-.327-1.482-.327-3.162-.327H7.157c-1.68 0-2.52 0-3.162.327a3 3 0 0 0-1.31 1.311c-.328.642-.328 1.482-.328 3.162v5.4c0 1.68 0 2.52.327 3.162a3 3 0 0 0 1.311 1.311c.642.327 1.482.327 3.162.327'/></svg>
                        <input type="email" placeholder="Email" id="email" name="email" value="">
                    </div>
                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M12.597 21.8a.995.995 0 0 1-1.194 0C6.253 17.976.785 10.109 6.31 4.425A7.93 7.93 0 0 1 12 2c2.134 0 4.18.872 5.689 2.424 5.526 5.684.059 13.55-5.092 17.377'/><path d='M12 12a2 2 0 1 0 0-4 2 2 0 0 0 0 4'/></svg>
                        <input type="text" placeholder="Address" id="address" name="address" value="">
                    </div>
                    <div class="input-wrapper">
                        <label for="phone_number">+250</label>
                        <input type="text" placeholder="Phone Number" id="phone_number" name="phone_number" >
                    </div>

                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M8 10V8c0-2.761 1.239-5 4-5s4 2.239 4 5v2M3.5 17.8v-4.6c0-1.12 0-1.68.218-2.107a2 2 0 0 1 .874-.875c.428-.217.988-.217 2.108-.217h10.6c1.12 0 1.68 0 2.108.217a2 2 0 0 1 .874.874c.218.428.218.988.218 2.108v4.6c0 1.12 0 1.68-.218 2.108a2 2 0 0 1-.874.874C18.98 21 18.42 21 17.3 21H6.7c-1.12 0-1.68 0-2.108-.218a2 2 0 0 1-.874-.874C3.5 19.481 3.5 18.921 3.5 17.8m8.5-2.05v-.5m4 .5v-.5m-8 .5v-.5'/></svg>
                        <input type="password" id="password" name="password" value="" placeholder="Password">
                    </div>
                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M8 10V8c0-2.761 1.239-5 4-5s4 2.239 4 5v2M3.5 17.8v-4.6c0-1.12 0-1.68.218-2.107a2 2 0 0 1 .874-.875c.428-.217.988-.217 2.108-.217h10.6c1.12 0 1.68 0 2.108.217a2 2 0 0 1 .874.874c.218.428.218.988.218 2.108v4.6c0 1.12 0 1.68-.218 2.108a2 2 0 0 1-.874.874C18.98 21 18.42 21 17.3 21H6.7c-1.12 0-1.68 0-2.108-.218a2 2 0 0 1-.874-.874C3.5 19.481 3.5 18.921 3.5 17.8m8.5-2.05v-.5m4 .5v-.5m-8 .5v-.5'/></svg>
                        <input type="password" id="password_confirm" name="password_confirm" value="" placeholder="Confirm Password">
                    </div> 

                    <div class="input-wrapper">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d='M12.597 21.8a.995.995 0 0 1-1.194 0C6.253 17.976.785 10.109 6.31 4.425A7.93 7.93 0 0 1 12 2c2.134 0 4.18.872 5.689 2.424 5.526 5.684.059 13.55-5.092 17.377'/><path d='M12 12a2 2 0 1 0 0-4 2 2 0 0 0 0 4'/></svg>
                        <select name="nationality" id="nationality">
                            <option value="">Select Nationality</option>
                        </select>
                    </div>

                    <div class="select-wrapper">
                    <select name="gender" id="gender">
                        <option value="">Select Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                    </div>

                    <div class="select-wrapper">
                        <label for="cust_profile">Choose a profile picture</label>
                        <input type="file" id="cust_profile" name="cust_profile" accept="image/*" placeholder="Choose a file" >
                    </div>

                </div>
                <div class="accept_condition " >
                        <input  type="checkbox" id="accept_terms" name="accept_terms"> 
                        <label  for="accept_terms">Accept our <a href="">terms</a> and <a href="">conditions</a> to use our services</label>
                </div>
                <div class="submit_registration">
                    <input type="submit" value="CREATE ACCOUNT" name="register" id="register"> <br>
                    <p>Already have an account? <a href="./login.php">Login here</a> </p>

            </div>

            </div>
            <div></div>
        </div>
    </form>



    
<script src="../../assets/js/nationality.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>