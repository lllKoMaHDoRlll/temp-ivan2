<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="stylesheet" href="./../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>

<body>
    <header>
        <h1>Салон красоты</h1>
    </header>
    <div class="content">
        <section id="reg-form" class="card shadow">
            <h2 class="card__title shadow">Регистрация</h2>
            <form action="./index.php" method="POST" class="card__content">
                <label>ФИО:
                    <input name="field-name" placeholder="Ваше ФИО" type="text" required>
                </label>
                <label>Телефон:
                    <input name="field-phone" placeholder="89123456789" type="tel" required>
                </label>
                <label>Почта:
                    <input name="field-email" placeholder="example@example.com" type="mail" required>
                </label>
                <label>Пароль:
                    <input name="field-password" placeholder="Придумайте пароль" type="password" required>
                </label>
                <label class="submit-button">
                    <button type="submit">Зарегистрироваться</button>
                </label>
            </form>
        </section>
        <a href="./../auth/">У меня есть аккаунт</a>
    </div>
</body>

</html>