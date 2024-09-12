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
    $db = connect_to_db();

    $email = !empty($_POST['field-email'])? $_POST['field-email'] : "";
    $password = !empty($_POST['field-password'])? $_POST['field-password'] : "";
    $password_hash = get_password_hash($password);

    $user_id = get_user_id($db, $email, $password_hash);
    if ($user_id == -1) {
        setcookie("login-error", "1");
        header("Location: ./");
        exit();
    }
    else {
        setcookie("login-error", "", 1);
        
        session_start();

        $_SESSION['user_id'] = $user_id;
    
        header("Location: ./../reservation/");
    }
}


switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        on_get();
        break;
    case "POST":
        on_post();
        break;
}