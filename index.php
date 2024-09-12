<?php
include("./utils.php");
include("./db_utils.php");

function on_get() {
    global $STATUS_DESCRIPTION;
    if (!empty($_COOKIE["action_status"])) {
        alert($STATUS_DESCRIPTION[$_COOKIE["action_status"]]);
        setcookie('action_status', '', 1);
    }

    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['user_id'])) {
        header('Location: ./reservation/');
        return;
    } else {
        header('Location: ./reg/');
    }
}

function on_post() {
    return;
}


switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        on_get();
        break;
    case "POST":
        on_post();
        break;
}