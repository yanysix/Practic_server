<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/practic_server/public/css/building_list.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список зданий</title>
</head>
<body>

<div class="list-container">
    <h2>Список зданий</h2>

    <?php if (!empty($buildings)): ?>
        <table class="building-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Адрес</th>
                <th>Количество мест (в здании)</th>
                <th>Общая площадь аудиторий (кв.м)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalSeats = 0;
            $totalSquare = 0;
            foreach ($buildings as $building):
                $buildingSeats = $building->rooms ? array_sum(array_column($building->rooms->toArray(), 'count_seats')) : 0;
                $buildingSquare = $building->rooms ? array_sum(array_column($building->rooms->toArray(), 'square')) : 0;
                $totalSeats += $buildingSeats;
                $totalSquare += $buildingSquare;
                ?>
                <tr>
                    <td><?= htmlspecialchars($building->building_id) ?></td>
                    <td><?= htmlspecialchars($building->name) ?></td>
                    <td><?= htmlspecialchars($building->address) ?></td>
                    <td><?= $buildingSeats ?></td>
                    <td><?= $buildingSquare ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="totals">
            <p><strong>Общее количество мест по учебному заведению:</strong> <?= $totalSeats ?></p>
            <p><strong>Общая площадь аудиторий по учебному заведению:</strong> <?= $totalSquare ?> кв.м</p>
        </div>

    <?php else: ?>
        <p>Зданий пока нет.</p>
    <?php endif; ?>

    <a class="add-building-btn" href="<?= app()->route->getUrl('/buildings/create') ?>">Добавить новое здание</a>
</div>

</body>
</html>
