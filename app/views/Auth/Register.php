<?php 
require_once "../app/helpers/auth/Session.php"; 

$error = Session::get('error'); 
Session::unset('error'); 
?>

<h1>Pendaftaran Akun Baru</h1>

<?php if ($error): ?>
    <div style="color:red; border:1px solid red; padding:10px; margin-bottom:10px;">
        <?= $error ?>
    </div>
<?php endif; ?>

<form action="<?= BASE_URL ?>register/create" method="POST">
    <div>
        <label>Nama:</label>
        <input type="text" name="name" required value="<?= Session::get('old_name') ?>">
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" required value="<?= Session::get('old_email') ?>">
    </div>

    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Konfirmasi Password:</label>
        <input type="password" name="confirm_password" required>
    </div>

    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="<?= BASE_URL ?>login">Login</a></p>

<?php 
Session::unset('old_name');
Session::unset('old_email');
?>
