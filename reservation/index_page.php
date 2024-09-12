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
    <div id="content">
        <section id="reservation-form" class="container">
            <h2>Записаться</h2>
            <form action="./index.php" method="POST">
                <label>Мастер:
                    <select name="field-master">
                        <?php 
                            foreach ($masters as $master_id => $master_name) {
                                ?>
                                <option value="<?php print $master_id?>"><?php print $master_name?></option>
                                <?php
                            }
                        ?>
                    </select>
                </label>
                <label>Дата:
                    <input name="field-date" type="date" value="2024-01-01">
                </label>
                <label for="field-hour"> Время:
                    <select name="field-hour">
                        <option value="8">8:00</option>
                        <option value="9">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                    </select>
                </label>
                <label class="submit-button">
                    <button type="submit">Записаться</button>
                </label>
            </form>
        </section>
        <section id="reservations" class="container">
            <h2>Ваши записи</h2>
            <div class="reservations__list">
                <?php
                foreach($reservations as &$reservation) {
                    ?>
                    <div class="reservations__list__item">
                        <p class="master-name">Мастер: <?php print $masters[$reservation["worker_id"]]?></p>
                        <p class="reservation-time">Дата записи: <?php print $reservation["date"] . " " . $reservation["hour"] . ":00"?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </div>
</body>

</html>