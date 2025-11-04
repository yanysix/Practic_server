<?php
use Src\Route;
use Controller\BuildingController;
use Controller\RoomController;
use Controller\AddEmployeeController;
use Controller\ProfileController;

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
// Только админ может добавлять сотрудников
Route::add('GET', '/add-employee', [AddEmployeeController::class, 'create'])
    ->middleware('auth', 'role:admin');
Route::add('POST', '/add-employee', [AddEmployeeController::class, 'store'])
    ->middleware('auth', 'role:admin');

// Список сотрудников — доступен всем авторизованным
Route::add('GET', '/staff/list', [AddEmployeeController::class, 'index'])
    ->middleware('auth');

// =========================
// Здания
// =========================
// Список зданий — доступен и admin, и staff
Route::add('GET', '/buildings', [BuildingController::class, 'index'])
    ->middleware('auth', 'role:admin,staff');

// Форма добавления здания — доступно и admin, и staff
Route::add('GET', '/buildings/create', [BuildingController::class, 'create'])
    ->middleware('auth', 'role:admin,staff');

// Обработка POST-запроса — доступно и admin, и staff
Route::add('POST', '/buildings/create', [BuildingController::class, 'store'])
    ->middleware('auth', 'role:admin,staff');

// =========================
// Помещения
// =========================

Route::add('GET', '/rooms', [RoomController::class, 'index'])
    ->middleware('auth','role:admin,staff');

// Форма создания комнаты — доступно всем авторизованным
Route::add('GET', '/rooms/create', [RoomController::class, 'create'])
    ->middleware('auth','role:admin,staff');

// Сохранение комнаты — доступно всем авторизованным
Route::add('POST', '/rooms/create', [RoomController::class, 'store'])
    ->middleware('auth','role:admin,staff');

// =========================
// Личный кабинет
// =========================
Route::add('GET', '/profile', [ProfileController::class, 'index'])
    ->middleware('auth');

Route::add('POST', '/profile', [ProfileController::class, 'update'])
    ->middleware('auth');