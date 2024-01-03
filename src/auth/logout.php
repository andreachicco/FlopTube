<?php 
    require_once(dirname(__FILE__) . "/../auth/session_manager.php");
    SessionManager::start();

    require_once(dirname(__FILE__) . "/../database/cookie.table.php");
    require_once(dirname(__FILE__) . "/../database/connection.php");

    $connection = new DBConnection();
    $cookie_table = new CookieTable($connection);

    if(isset($_COOKIE["remember"])) {
        unset($_COOKIE["remember"]);
        $is_deleted = $cookie_table->delete_by_user_id($_SESSION["id"]);

        //TODO: use cookie manager and cookie class
        setcookie("remember", "", time() - 3600, "/");
    }

    $connection->close();
    SessionManager::destroy();
    
    header("Location: /auth/login.php");
?>