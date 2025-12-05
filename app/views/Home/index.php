<h1>Welcome</h1>

<?php if (Auth::isClient()): ?>
    <p>Halo <?= Auth::user('full_name'); ?>! Kamu bisa melihat daftar produk.</p>
<?php endif; ?>

<?php if (!Auth::check()): ?>
    <p>Login untuk fitur lebih lengkap.</p>
<?php endif; ?>


<h1>List User</h1>

<?php foreach($users as $u): ?>
    <p><?= $u['full_name']; ?></p>
<?php endforeach; ?>
