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

        $validator = new \Src\Validator\Validator(
            $request->all(),
            [
                'login' => ['required'],
                'password' => ['required'],
            ],
            ['required' => 'Поле :field пусто']
        );

        if ($validator->fails()) {
            return new View('site.login', ['errors' => $validator->errors()]);
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
