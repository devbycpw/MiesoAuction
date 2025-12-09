<?php 
require_once "../app/helpers/auth/Session.php"; 

$error = Session::get('error'); 
Session::unset('error'); 
?>

<main class ="page-register">
    <div class="register-container">

        <!-- Logo Image -->
         <img src="<?= BASE_URL?>assets/img/Logo.png" class="logo" alt="logo">

        <h2 class="auth-title">Create an Admin Account</h2>

        <?php if ($error): ?>
            <div class="error-box"><?= $error ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>admin/createAdminProsses" method="POST">

            <div class="input-group">
                <label>Nama</label>
                <input type="text" name="name" required value="<?= Session::get('old_name') ?>">
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required value="<?= Session::get('old_email') ?>">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>

            <button type="submit">Add</button>
        </form>
    </div>
</main>

<?php 
Session::unset('old_name');
Session::unset('old_email');
?>
