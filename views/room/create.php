<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить комнату</title>
    <link rel="stylesheet" href="/practic_server/css/room_form.css">
</head>
<body>

<div class="form-container">
    <h2>Добавить помещение</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <label>Название помещения:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>">

        <label>Тип помещения:</label>
        <select name="room_type">
            <option value="">Выберите тип</option>
            <option value="Кабинет" <?= isset($room_type) && $room_type === 'Кабинет' ? 'selected' : '' ?>>Кабинет</option>
            <option value="Лаборатория" <?= isset($room_type) && $room_type === 'Лаборатория' ? 'selected' : '' ?>>Лаборатория</option>
            <option value="Аудитория" <?= isset($room_type) && $room_type === 'Аудитория' ? 'selected' : '' ?>>Аудитория</option>
            <option value="Компьютерный кабинет" <?= isset($room_type) && $room_type === 'Компьютерный кабинет' ? 'selected' : '' ?>>Компьютерный кабинет</option>
        </select>

        <label>Площадь (кв.м):</label>
        <input type="number" name="square" value="<?= htmlspecialchars($square ?? '') ?>">

        <label>Количество мест:</label>
        <input type="number" name="count_seats" value="<?= htmlspecialchars($count_seats ?? '') ?>">

        <label>Здание:</label>
        <select name="fk_building_id">
            <option value="">Выберите здание</option>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->building_id ?>" <?= isset($fk_building_id) && $fk_building_id == $building->building_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($building->name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Добавить</button>
    </form>

    <p><a href="/practic_server/rooms">Список помещений</a></p>
</div>

</body>
</html>
