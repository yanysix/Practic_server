<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop It MVC</title>
    <link rel="stylesheet" href="/practic_server/public/css/style.css">
</head>
<body>

<header>
    <nav class="nav-center">
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>

        <?php if (!app()->auth::check()): ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        <?php else: ?>
            <a href="<?= app()->route->getUrl('/staff/list') ?>">Сотрудники</a>
            <a href="<?= app()->route->getUrl('/buildings') ?>">Здания</a>
            <a href="<?= app()->route->getUrl('/rooms') ?>">Помещения</a>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->login ?>)</a>
            <a href="<?= app()->route->getUrl('/profile') ?>">Профиль</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
