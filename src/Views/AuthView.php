<?php
declare(strict_types=1);

namespace App\Views;

class AuthView
{
    const STATIC = '<!doctype html>
                    <html lang="ru">
                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <title style="text-decoration: underline; text-decoration-style: dotted;">Аторизация</title>
                        <link rel="icon" href="/src/Static/LogoIcon.png">
                        <!-- Bootstrap core CSS -->
                        <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet"
                              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                    
                        <!-- Custom styles for this template -->
                        <link href="https://getbootstrap.com/docs/5.1/examples/sign-in/signin.css" rel="stylesheet">
                    </head>
                    <body class="text-center" style="background-color: white;">
                    
                    <main class="form-signin">
                        <form>
                            <img class="mb-4" src="/src/Static/Logo.jpg" alt="" width="300">
                            <h1 class="h3 mb-3 fw-normal"><b>Домовёнок, </br>приветсвует Вас!</b></h1>
                    
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Укажите Номер ЛС или email</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Введите пароль</label>
                            </div>
                    
                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Запомнить
                                </label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit"
                                    style="background-color: #0D6E83;border-color: #0D6E83">Войти
                            </button>
                            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
                        </form>
                    </main>
                    
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                            crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                            crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                            crossorigin="anonymous"></script>
                    
                    </body>
                    </html>';

    public static function render(): void
    {
        echo self::STATIC;
    }
}


