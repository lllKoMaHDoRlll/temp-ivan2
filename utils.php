<?php

$STATUS_DESCRIPTION = array(
    "-1" => "Неправильно заполнены поля!",
    "-2" => "Ошибка при подключении к базе данных!",
    "-3"=> "Ошибка при запросе к базе данных",
    "-4" => "Неправильный логин или пароль"
);

function parse_user_reg_from_post() {
    $submission = array();
    $submission['name'] = strip_tags($_POST['field-name']);
    $submission['phone'] = strip_tags($_POST['field-phone']);
    $submission['email'] = strip_tags($_POST['field-email']);
    $submission['password'] = strip_tags($_POST['field-password']);

    return $submission;
}

function parse_reservation_from_post() {
    $reservation = array();
    $reservation['worker_id'] = strip_tags($_POST['field-master']);
    $reservation['hour'] = strip_tags($_POST['field-hour']);
    $reservation['date'] = strip_tags($_POST['field-date']);

    return $reservation;
}


function get_password_hash($password) {
    return md5($password);
}

function validate_fields_and_set_cookies_reg()
{
    $expiration_time_on_error = 0;
    $expiration_time_on_success = time() + 60*60*24*365;
    $validation_passed = True;

    if (empty($_POST["field-name"]) || strlen($_POST["field-name"]) > 150 || !preg_match("/^[\p{Cyrillic}a-zA-Z-' ]*$/u", $_POST["field-name"])) {
        setcookie("field-name-error", "1", $expiration_time_on_error);
        setcookie('field-name', $_POST["field-name"], $expiration_time_on_error);
        $validation_passed = False;
    }
    else {
        setcookie('field-name', $_POST["field-name"], $expiration_time_on_success);
        setcookie("field-name-error", "", 1);
    }
    
    if (empty($_POST["field-phone"]) || !preg_match('/[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}/i', $_POST["field-phone"])) {
        setcookie("field-phone-error", "1", $expiration_time_on_error);
        setcookie('field-phone', $_POST["field-phone"], $expiration_time_on_error);
        $validation_passed = False;
    }
    else {
        setcookie('field-phone', $_POST["field-phone"], $expiration_time_on_success);
        setcookie("field-phone-error", "", 1);
    }

    if (empty($_POST["field-email"]) || !filter_var($_POST["field-email"], FILTER_VALIDATE_EMAIL)) {
        setcookie("field-email-error", "1", $expiration_time_on_error);
        setcookie('field-email', $_POST["field-email"], $expiration_time_on_error);
        $validation_passed = False;
    }
    else {
        setcookie('field-email', $_POST["field-email"], $expiration_time_on_success);
        setcookie("field-email-error", "", 1);
    }

    if (empty($_POST["field-password"]) || strlen($_POST["field-password"]) < 3 || !preg_match("/.*[0-9].*/", $_POST["field-password"])) {
        setcookie("field-password-error", "1", $expiration_time_on_error);
        $validation_passed = False;
    }
    else {
        setcookie("field-password-error", "", 1);
    }

    return $validation_passed;
}

function alert($message) {
    echo sprintf("<script>alert ('%s')</script>", $message);
}
