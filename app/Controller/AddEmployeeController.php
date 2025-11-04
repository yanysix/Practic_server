<?php
namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Src\Validator\Validator;

class AddEmployeeController
{
    // Показать форму добавления сотрудника
    public function create(Request $request): string
    {
        return new View('employee.create');
    }

    // Обработка формы добавления
    public function store(Request $request): string
    {
        $data = $request->all();

        // Валидация пустых полей
        $login = trim($data['login'] ?? '');
        $password = trim($data['password'] ?? '');

        if ($login === '' || $password === '') {
            return new View('employee.create', [
                'message' => 'Все поля обязательны'
            ]);
        }

        // Проверяем, есть ли пользователь с таким логином
        $existingUser = User::where('login', $login)->first();
        if ($existingUser) {
            return new View('employee.create', [
                'message' => 'Пользователь с таким логином уже существует'
            ]);
        }


        // Создаём нового сотрудника
        User::create([
            'login' => $login,
            'password' => $password,
            'role' => 'staff'
        ]);

        // Перенаправляем на список сотрудников
        app()->route->redirect('/staff/list');

        return new View('employee.index');
    }

    // Список сотрудников
    public function index(): string
    {
        $users = User::all();
        return new View('employee.list', ['users' => $users]);
    }
}
