<?php 
$role = Session::get('role') ?? 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php if(isset($custom_css)): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/style/<?= $custom_css ?>.css">
    <?php endif; ?>
</head>
<body>

    <?php include __DIR__ . "/partials/navbar/navbar-$role.php"; ?>

    <main class="container mt-4">
        <?= $content ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
