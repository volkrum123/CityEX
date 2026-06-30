<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'City Explorer' ?></title>

    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body>

    <header>
        <h2>City Explorer</h2>
        <?php require __DIR__ . '/../partials/nav.php'; ?>
        <hr>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <hr>
        <small>© <?= date('Y') ?> City Explorer</small>
    </footer>

</body>
</html>