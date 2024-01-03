<?php 
    session_start();

    require_once(dirname(__FILE__) . "/../database/cookie.table.php");
    require_once(dirname(__FILE__) . "/../database/connection.php");

    $connection = new DBConnection();
    $cookie_table = new CookieTable($connection);

    if(isset($_COOKIE["remember_me"])) {
        unset($_COOKIE["remember_me"]);
        $is_deleted = $cookie_table->delete_by_user_id($_SESSION["id"]);

        if($is_deleted) setcookie("remember_me", "", time() - 3600, "/");
    }

    $_SESSION = array();
    session_destroy();
    
    header("Location: /auth/login.php");
?>