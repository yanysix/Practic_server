<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить здание</title>
    <link rel="stylesheet" href="/practic_server/css/form_building.css">
</head>
<body>

<div class="form-container">
    <h2>Добавить здание</h2>

    <?php if (!empty($message)): ?>
        <div class="message" style="background-color: <?= $message === 'Здание успешно добавлено' ? '#d4edda' : '#f8d7da' ?>;
                color: <?= $message === 'Здание успешно добавлено' ? '#155724' : '#721c24' ?>;
                border-color: <?= $message === 'Здание успешно добавлено' ? '#c3e6cb' : '#f5c6cb' ?>;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <label>Название здания:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>">

        <label>Адрес:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($address ?? '') ?>">

        <label>Общее количество мест:</label>
        <input type="number" name="total_number_seats" value="<?= htmlspecialchars($total_number_seats ?? '') ?>">

        <label>Общая площадь аудиторий:</label>
        <input type="number" name="total_auditorium_square" value="<?= htmlspecialchars($total_auditorium_square ?? '') ?>">

        <button type="submit">Добавить</button>
    </form>

    <p><a href="/practic_server/buildings">Список зданий</a></p>
</div>

</body>
</html>
