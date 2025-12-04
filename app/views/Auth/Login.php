<?php 
require_once "../app/helpers/auth/Session.php"; 

$error = Session::get('error'); 
Session::unset('error'); 

$success = Session::get('success'); 
Session::unset('success');
?>

<h1>Login Pengguna</h1>

<?php if ($success): ?>
    <div style="color: green; border:1px solid green; padding:10px; margin-bottom:10px;">
        <?= $success ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div style="color: red; border:1px solid red; padding:10px; margin-bottom:10px;">
        <?= $error ?>
    </div>
<?php endif; ?>

<form action="<?= BASE_URL ?>login/auth" method="POST">
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

<p>
    Belum punya akun? 
    <a href="<?= BASE_URL ?>register">Daftar di sini</a>
</p>
