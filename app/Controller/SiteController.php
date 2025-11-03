<?php
namespace Controller;

use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class SiteController
{
    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        $data = $request->all();

        $validator = new Validator($data, [
            'login' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = implode('<br>', array_merge(...array_values($errors)));
            return new View('site.login', ['message' => $message]);
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }

        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
}
