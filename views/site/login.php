<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="/practic_server/public/css/style.css">
</head>
<body>
<div class="login-container">
    <h2>Авторизация</h2>
    <?php if(!empty($message)): ?>
        <div class="message"><?= $message; ?></div>
    <?php endif; ?>
    <?php if(app()->auth::check()): ?>
        <div class="welcome">
            Вы вошли как: <strong><?= app()->auth->user()->login; ?></strong>
        </div>
    <?php else: ?>
        <form method="post" class="login-form">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>
                Логин
                <input type="text" name="login" placeholder="Введите логин">
            </label>
            <label>
                Пароль
                <input type="password" name="password" placeholder="Введите пароль">
            </label>
            <button type="submit">Войти</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
