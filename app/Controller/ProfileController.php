<?php
namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\User;
use FileUploader\FileUploader;


class ProfileController
{
    // Показать личный кабинет
    public function index(Request $request): string
    {
        $user = app()->auth->user();
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
            $uploader = new FileUploader($_FILES['avatar'], ['image/jpeg','image/png','image/webp']);
            $filename = 'avatar_' . $user->user_id;

            $savedFile = $uploader->save(__DIR__ . '/../../public/uploads/', $filename);
            if ($savedFile) {
                $user->avatar = '/practic_server/public/uploads/' . $savedFile;
                $message .= "Аватар успешно обновлён.";
            } else {
                $message .= "Ошибка при загрузке аватарки: " . implode(', ', $uploader->errors());
            }
        }

        $user->save();

        return new View('profile.index', ['user' => $user, 'message' => $message]);
    }
}
