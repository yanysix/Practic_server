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

        $allowedRoles = explode(',', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            // роль не разрешена — редирект
            header('Location: /practic_server/hello');
            exit;
        }
    }
}
