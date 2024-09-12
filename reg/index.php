<?php
include("./../utils.php");
include("./../db_utils.php");

function on_get() {
    global $STATUS_DESCRIPTION;
    if (!empty($_COOKIE["action_status"])) {
        alert($STATUS_DESCRIPTION[$_COOKIE["action_status"]]);
        setcookie('action_status', '', 1);
    }

    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['user_id'])) {
        header('Location: ./../reservation/');
        return;
    }

    include("./index_page.php");
}

function on_post() {
    header('Content-Type: text/html; charset=UTF-8');

    if (!validate_fields_and_set_cookies_reg()) {
        setcookie("action_status", "-1");
        exit();
    }

    $db = connect_to_db();

    $user_data = parse_user_reg_from_post();

    $password_hash = get_password_hash($user_data["password"]);

    $user_id = register_user($db, $user_data, $password_hash);
    session_start();

    $_SESSION['user_id'] = $user_id;
    header("Location: ./../reservation/");
    exit();
}


switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        on_get();
        break;
    case "POST":
        on_post();
        break;
}