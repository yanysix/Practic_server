<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить сотрудника</title>
    <link rel="stylesheet" href="/practic_server/css/form.css">
</head>
<body>

<div class="form-container">
    <h2>Добавить сотрудника</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form class="form" action="" method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Логин:</label>
        <input type="text" name="login" value="<?= htmlspecialchars($login ?? '') ?>">

        <label>Пароль:</label>
        <input type="password" name="password">

        <button type="submit">Добавить</button>
    </form>
    <p><a href="/practic_server/staff/list">Список сотрудников</a></p>
</div>

</body>
</html>
