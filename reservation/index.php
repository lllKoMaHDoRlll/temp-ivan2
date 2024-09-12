<?php
include("./../utils.php");
include("./../db_utils.php");

function on_get() {
    global $STATUS_DESCRIPTION;
    if (!empty($_COOKIE["action_status"])) {
        alert($STATUS_DESCRIPTION[$_COOKIE["action_status"]]);
        setcookie('action_status', '', 1);
    }

    if (empty($_COOKIE[session_name()]) || !session_start() && empty($_SESSION['user_id'])) {
        header('Location: ./../reg/');
        return;
    }

    $user_id = $_SESSION["user_id"];

    $db = connect_to_db();
    $masters = get_workers($db);
    $reservations = get_user_reservations($db, $user_id);

    include("./index_page.php");
}

function on_post() {
    header('Content-Type: text/html; charset=UTF-8');

    if (empty($_COOKIE[session_name()]) || !session_start() && empty($_SESSION['user_id'])) {
        header('Location: ./../reg/');
        return;
    }

    $db = connect_to_db();

    $user_id = $_SESSION["user_id"];

    $reservation = parse_reservation_from_post();

    save_reservation($db, $user_id, $reservation);

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