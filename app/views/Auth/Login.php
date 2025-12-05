<?php 
require_once "../app/helpers/auth/Session.php"; 

$error = Session::get('error'); 
Session::unset('error'); 

$success = Session::get('success'); 
Session::unset('success');
?>

<main class="page-login">
    <div class="login-container">

        <!-- Logo Image -->
        <img src="<?= BASE_URL ?>assets/img/Logo.png" class="logo" alt="Logo">

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
</main>





