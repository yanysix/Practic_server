<?php
use Src\Route;
use Controller\BuildingController;
use Controller\RoomController;


// =========================
// Общие маршруты
// =========================
Route::add('GET', '/hello', [Controller\SiteController::class, 'hello'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/login', [Controller\SiteController::class, 'login']);
Route::add('GET', '/logout', [Controller\SiteController::class, 'logout']);

// =========================
// Добавление сотрудников
// =========================
Route::add('GET', '/add-employee', [Controller\AddEmployeeController::class, 'create'])
    ->middleware('auth');
Route::add('POST', '/add-employee', [Controller\AddEmployeeController::class, 'store'])
    ->middleware('auth');

// Список сотрудников
Route::add('GET', '/staff/list', [Controller\AddEmployeeController::class, 'index'])
    ->middleware('auth');

// =========================
// Здания
// =========================

// Список зданий
Route::add('GET', '/buildings', [BuildingController::class, 'index'])
    ->middleware('auth', 'role:admin,staff');

// Форма добавления здания
Route::add('GET', '/buildings/create', [BuildingController::class, 'create'])
    ->middleware('auth', 'role:admin,staff');

// Обработка POST-запроса
Route::add('POST', '/buildings/create', [BuildingController::class, 'store'])
    ->middleware('auth', 'role:admin,staff');


// =========================
// Помещения
// =========================
Route::add('GET', '/rooms', [RoomController::class, 'index'])
    ->middleware('auth');

Route::add('GET', '/rooms/create', [RoomController::class, 'create'])
    ->middleware('auth');

Route::add('POST', '/rooms/create', [RoomController::class, 'store'])
    ->middleware('auth');
