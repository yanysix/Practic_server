<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/practic_server/public/css/list_employee.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список сотрудников</title>
</head>
<body>

<div class="list-container">
    <h2>Список сотрудников</h2>

    <?php if (!empty($users)): ?>
        <table class="staff-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user->user_id) ?></td>
                    <td><?= htmlspecialchars($user->login) ?></td>
                    <td><?= htmlspecialchars($user->role) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Сотрудников пока нет.</p>
    <?php endif; ?>

    <a class="add-employee-btn" href="<?= app()->route->getUrl('/add-employee') ?>">Добавить нового сотрудника</a>
</div>

</body>
</html>
