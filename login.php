<?php
    session_start();
    require('connect.php');
    require('functions.php');
    write_log ( "Próba logowania" );
if ( isset($_POST["login"]) ) {
    if ( isset($_POST["password"]) ) {
        $login = $_POST["login"];
        $password = $_POST["password"];
    }
}
if (isset($login) && isset($password)) {
    $password = md5($password);
    $loginRequest = $pdo->prepare('SELECT * FROM users WHERE login = :login AND password=:password');
    $loginRequest->execute(['login' => $login, 'password' => $password]);
    $user = $loginRequest->fetch();
    if ($user) {
        write_log ( "Poprawne logowanie" );
        $_SESSION['loggedIn'] = true;
        $JSON = json_encode(true);
        echo $JSON;
    } else {
        $JSON = json_encode(false);
        echo $JSON;
    }
}


