<?php 
    session_start();

    require_once("../models/database.php");
    require_once("../services/cookie.service.php");
    require_once("../services/auth.service.php");
    require_once("../common/redirector.php");
    
    $db = new db_connection();

    try {
        
        $cookie_service = new cookie_service($db);
        $auth_service = new auth_service(null, $cookie_service);

        $auth_service->sign_out();

    } catch (mysqli_sql_exception $e) {
        die(change_location("error/500.php"));
    }

    die(change_location("auth/login.php"));
?>