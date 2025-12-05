<?php 
$role = Session::get('role') ?? 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <?php if(isset($custom_css)): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/style/<?= $custom_css ?>.css">
    <?php endif; ?>
</head>
<body>

    <?php include __DIR__ . "/partials/navbar/navbar-$role.php"; ?>

    <main>
        <?= $content ?>
    </main>

    <?php include __DIR__ . "/partials/footer.php"; ?>

    <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
     <?php if(isset($custom_js)): ?>
        <script src="<?= BASE_URL ?>assets/js/<?= $custom_js ?>.js"></script>
    <?php endif; ?>
</body>
</html>
