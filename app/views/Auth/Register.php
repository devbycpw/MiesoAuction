<?php 
require_once "../app/helpers/auth/Session.php"; 

$error = Session::get('error'); 
Session::unset('error'); 
?>

<div class="auth-container">

    <h2 class="auth-title">Pendaftaran Akun Baru</h2>

    <?php if ($error): ?>
        <div class="error-box">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>register/create" method="POST">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" required value="<?= Session::get('old_name') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required value="<?= Session::get('old_email') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="confirm_password" required>
        </div>

        <button type="submit" class="btn btn-gold mt-2">Daftar</button>
    </form>

    <p class="text-center mt-3">
        Sudah punya akun? <a href="<?= BASE_URL ?>login">Login</a>
    </p>
</div>

<?php 
Session::unset('old_name');
Session::unset('old_email');
?>
