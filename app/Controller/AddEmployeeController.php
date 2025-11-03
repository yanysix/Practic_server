<?php
namespace Controller;

use Src\View;
use Src\Request;
use Model\User;

class AddEmployeeController
{
    // Показать форму добавления сотрудника
    public function create(Request $request): string
    {
        return new View('employee.create');
    }

    // Обработка формы добавления
    public function store(Request $request): void
    {
        $data = $request->all();

        $login = $data['login'] ?? '';
        $password = $data['password'] ?? '';

        if (!$login || !$password) {
            // Если ошибка, снова показать форму с сообщением
            echo (new View('employee.create', ['message' => 'Все поля обязательны']))->render();
            return;
        }

        // Создать нового сотрудника с ролью 'staff'
        User::create([
            'login' => $login,
            'password' => $password,
            'role' => 'staff' // всегда сотрудник
        ]);

        // Редирект на список сотрудников
        app()->route->redirect('/staff/list');
    }

    // Список сотрудников
    public function index(): string
    {
        $users = User::all();
        return new View('employee.list', ['users' => $users]);
    }
}
