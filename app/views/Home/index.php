<h1>List User</h1>

<?php foreach($users as $u): ?>
    <p><?= $u['full_name']; ?></p>
<?php endforeach; ?>
