<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список помещений</title>
    <link rel="stylesheet" href="/practic_server/css/room_list.css">
</head>
<body>

<div class="list-container">
    <h2>Список помещений</h2>

    <form class="filter-form" method="GET" action="">
        <label for="building_filter">Выберите здание:</label>
        <select id="building_filter" name="building_id">
            <option value="">Все здания</option>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->building_id ?>" <?= isset($_GET['building_id']) && $_GET['building_id'] == $building->building_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($building->name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="search_name">Поиск по названию:</label>
        <input type="text" id="search_name" name="search" placeholder="Введите название" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

        <button type="submit">Применить</button>
    </form>

    <?php if (!empty($rooms)): ?>
        <table class="room-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Здание</th>
                <th>Название</th>
                <th>Тип</th>
                <th>Мест</th>
                <th>Площадь</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= $room->room_id ?></td>
                    <td><?= htmlspecialchars($room->building->name ?? '-') ?></td>
                    <td><?= htmlspecialchars($room->name) ?></td>
                    <td><?= htmlspecialchars($room->room_type) ?></td>
                    <td><?= htmlspecialchars($room->count_seats) ?></td>
                    <td><?= htmlspecialchars($room->square) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Помещений пока нет.</p>
    <?php endif; ?>

    <p><a class="add-link" href="/practic_server/rooms/create">Добавить новое помещение</a></p>
</div>

</body>
</html>
