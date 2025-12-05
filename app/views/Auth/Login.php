<?php 
require_once "../app/helpers/auth/Session.php"; 

$error = Session::get('error'); 
Session::unset('error'); 

$success = Session::get('success'); 
Session::unset('success');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login in to your account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @font-face {
            font-family:'PlusJakartaSans';
            src: url('public/assets/Plus_Jakarta_Sans/static/PlusJakartaSans-Regular.ttf') format('truetype');
        }
        body{
            font-family : 'PlusJakartaSans', sans-serif;
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container{
            text-align: center;
            width: 350px;
            margin-top: -250px;
        }

        .logo{
            width: 140px;
            margin-bottom: 30px;
        }

        h2{
            font-size: 24px;
            margin-bottom: 25px;
            font-weight: 500;
            color: #2f2f2f;
        }

        .input-group{
            text-align: left;
            margin-bottom: 18px;
            position: relative;
        }

        label{
            font-weight: 500;
            font-size: 14px;
            display: block;
            margin-bottom: 6px;
            color:#333333;
        }

        input[type="email"],
        input[type="password"]{
            width: 100%;
            padding: 12px;
            border: 1px solid #cfcfcf;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fafafa;            
        }

        .eye-icon{
            position: absolute;
            right: 12px;
            top: 40px;
            cursor: pointer;
            opacity: 0.6;
        }

        .eye-icon:hover{
            opacity: 1;
        }

        button{
            width:100%;
            padding: 12px;
            border: none;
            background: #d1d5db;
            color: #555555;           
            border-radius: 4px;
            font-size:15px;
            margin-top: 10px;
            cursor: pointer;
        }

        button:hover{
            background-color: #c3c7cd;
        }

        .register a{
            color:#1a3da8;
            text-decoration: none;
        }

        .register a:hover{
            text-decoration: underline;
        }

        .msg{
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 14px;
        }

        .success{
            background-color:#e9ffea;
            color:#2b7a2b;
            border: 1px solid #7bbf7b;
        }

        .error{
            background: #ffeaea;
            color:#b94444;
            border: 1px solid #d17a7a;
        }
    </style>
</head>
<body>
    <div class="login-container">

        <!-- Logo Image -->
        <img src="<?= BASE_URL ?>assets/images/Logo.png" class="logo" alt="Logo">


        <h2>Log in to your account</h2>

        <?php if ($success): ?>
            <div class="msg success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="msg error"><?= $error ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>login/auth" method="POST">
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" id="passwordField" name="password" required>

                <!-- Icon Mata -->
                <span class="eye-icon" onclick="togglePassword()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M12 5C6 5 1.73 9.11 1 12c.73 2.89 5 7 11 7s10.27-4.11 11-7c-.73-2.89-5-7-11-7Z" 
                            stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="3" stroke="#555" stroke-width="2"/>
                    </svg>
                </span>
            </div>

            <button type="submit">Log in</button>
        </form>

        <div class="register">
            Don't have an account?
            <a href="<?= BASE_URL ?>register">Register here</a>
        </div>
    </div>

    <script>
        function togglePassword(){
            const field = document.getElementById('passwordField');
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>




