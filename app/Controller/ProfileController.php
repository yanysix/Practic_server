<?php
namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\User;

class ProfileController
{
    // Показать личный кабинет
    public function index(Request $request): string
    {
        $user = app()->auth->user(); // текущий пользователь
        return (new View('profile.index', ['user' => $user]));
    }

    // Обновление данных (смена пароля и аватарки)
    public function update(Request $request): string
    {
        $user = app()->auth->user();
        $data = $request->all();
        $message = '';

        // Смена пароля
        if (!empty($data['password'])) {
            $user->password = md5($data['password']);
            $message .= "Пароль успешно обновлён. ";
        }

        // Загрузка аватарки
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = $_FILES['avatar'];
            $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
            $filename = 'avatar_' . $user->user_id . '.' . $ext;
            $uploadDir = __DIR__ . '/../../public/uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $target = $uploadDir . $filename;
            if (move_uploaded_file($avatar['tmp_name'], $target)) {
                $user->avatar = '/practic_server/public/uploads/' . $filename;
                $message .= "Аватар успешно обновлён.";
            } else {
                $message .= "Ошибка при загрузке аватарки.";
            }
        }

        $user->save();

        return (new View('profile.index', ['user' => $user, 'message' => $message]));
    }
}
