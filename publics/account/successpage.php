<?php
// success.php
// You can optionally check for a session or a 'success' parameter here 
// to prevent people from accessing this page directly.
session_start();
if(isset($_SESSION['customer'])){
    $cust_id=$_SESSION['customer'];
}
$_SESSION['customer']=$cust_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success | WSOMART</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #003d5b; /* Dark blue from your image */
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 400px;
        }

        .icon-circle {
            font-size: 100px;
            margin-bottom: 30px;
        }

        h2 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.2rem;
            margin-bottom: 100px;
        }

        .redirect-text {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        #timer {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon-circle">
            <i class="fa-regular fa-circle-check"></i>
        </div>
        
        <h2>Product Listed Successfully</h2>

        <p class="redirect-text">Redirecting in <span id="timer">2</span> seconds...</p>
    </div>

    <script>
        let timeLeft = 2; // Set your 2-second timer
        const timerElement = document.getElementById('timer');

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = "./dashboard.php"; // Change to your dashboard path
            }
        }, 1000);
    </script>
</body>
</html>