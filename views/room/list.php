<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список комнат</title>
    <link rel="stylesheet" href="/practic_server/css/room_list.css">
</head>
<body>

<div class="list-container">
    <h2>Список комнат</h2>

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
