<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="stylesheet" href="./../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>

<body>
    <header>
        <h1>Салон красоты</h1>
    </header>
    <div class="content">
        <section id="auth-form" class="card shadow">
            <h2 class="card__title shadow">Вход</h2>
            <form action="./index.php" method="POST" class="card__content">
                <label>Почта:
                    <input name="field-email" placeholder="example@example.com" type="mail">
                </label>
                <label>Пароль:
                    <input name="field-password" placeholder="Введите пароль" type="password">
                </label>
                <label class="submit-button">
                    <button type="submit">Войти</button>
                </label>
            </form>
        </section>
        <a href="./../reg/">У меня нет аккаунта</a>
    </div>
</body>

</html>