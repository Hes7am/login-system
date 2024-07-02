<?php

class database
{
    public static function connect()
    {
        $conn = null;
        $servername = "localhost";
        $username = "root";  
        $password = ""; 
        $dbname = "login_pvb_2024";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
        return $conn;
    }


    public static function login($username, $password)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT userid, password FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user['userid'];
        } else {
            return false;
        }
    }

    public static function register($username, $password, $postcode, $huisnummer, $woonplaats)
    {
        $conn = self::connect();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user (username, password, postcode, huisnummer, woonplaats) VALUES (:username, :password, :postcode, :huisnummer, :woonplaats)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':postcode', $postcode);
        $stmt->bindParam(':huisnummer', $huisnummer);
        $stmt->bindParam(':woonplaats', $woonplaats);
        return $stmt->execute();
    }

    public static function getUsers()
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT userid, username, postcode, huisnummer, woonplaats FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

