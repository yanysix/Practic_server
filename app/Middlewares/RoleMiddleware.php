<?php
namespace Middlewares;

use Src\Request;
use Src\Auth\Auth;

class RoleMiddleware
{
    public function handle(Request $request, ?string $roles = null)
    {
        // Проверяем, залогинен ли пользователь
        if (!Auth::check()) {
            header('Location: /practic_server/login');
            exit;
        }

        $user = Auth::user();
        $userRole = $user->role ?? null;

        if (!$roles) {
            return; // роли не указаны — пропускаем
        }

        // Преобразуем список ролей в массив
        $allowedRoles = explode(',', $roles);

        if (in_array('admin', $allowedRoles) && $userRole === 'admin') {
            return; // админ — доступ разрешен
        }

        if (in_array('staff', $allowedRoles) && $userRole === 'staff') {
            return; // staff — доступ разрешен
        }

        // Если роль не разрешена — редирект на главную
        header('Location: /practic_server/hello');
        exit;
    }
}
