<?php

function connect_to_db()
{
    try {
        include("db_data.php");
        $db = new PDO('mysql:host=localhost;dbname=beauty', $user, $pass, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $db;
    }
    catch (PDOException $e) {
        setcookie("action_status", "-2");
        header("Location: ./");
        exit();
    }
}

function get_user_db_data($db, $email, $password_hash)
{
    try {
        $stmt = $db->prepare('SELECT user_id FROM users WHERE
        email = :email AND password_hash = :password_hash');
        $stmt->bindParam('email', $email);
        $stmt->bindParam('password_hash', $password_hash);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (Exception $e) {
        setcookie("action_status", "-3");
        header("Location: ./");
        exit();
    }
}

function get_user_id($db, $email, $password_hash) {
    $result = get_user_db_data($db, $email, $password_hash);
    print_r($result);
    if (!$result || count($result) == 0) {
        return -1;
    }
    else {
        return $result[0]['user_id'];
    }
}



function register_user($db, $user_data, $password_hash) {
    try {
        $stmt = $db->prepare("INSERT INTO users (name, phone, email, password_hash) VALUES (:name, :phone, :email, :password_hash)");
        $stmt->bindParam('name', $user_data["name"]);
        $stmt->bindParam('phone', $user_data["phone"]);
        $stmt->bindParam('email', $user_data["email"]);
        $stmt->bindParam('password_hash', $password_hash);
        $stmt->execute();

        $user_id = $db->lastInsertId();
        return $user_id;
    }
    catch (PDOException $e) {
        setcookie("action_status", "-3");
        header("Location: ./");
        exit();
    }
}

function get_workers($db) {
    try {
        $stmt = $db->prepare('SELECT * FROM workers');
        $stmt->execute();
        
        $res = $stmt->fetchAll();
        $masters = array();
        foreach ($res as &$master) {
            $masters[$master["worker_id"]] = $master["name"];
        }
        unset($master);

        return $masters;
    } catch (Exception $e) {
        setcookie("action_status", "-3");
        header("Location: ./");
        exit();
    }
}

function get_user_reservations($db, $user_id) {
    try {
        $stmt = $db->prepare('SELECT * FROM reservations WHERE
        user_id = :user_id');
        $stmt->bindParam('user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (Exception $e) {
        setcookie("action_status", "-3");
        header("Location: ./");
        exit();
    }
}

function save_reservation($db, $user_id, $reservation)
{
    try {
        $stmt = $db->prepare("INSERT INTO reservations 
        (user_id, worker_id, hour, date) 
        VALUES (:user_id, :worker_id, :hour, :date);");
        $stmt->bindParam('user_id', $user_id);
        $stmt->bindParam('worker_id', $reservation['worker_id']);
        $stmt->bindParam('hour', $reservation['hour']);
        $stmt->bindParam('date', $reservation['date']);
        $stmt->execute();

    } catch (Exception $e) {
        setcookie("action_status", "-3");
        header("Location: ./");
        return;
    }
}