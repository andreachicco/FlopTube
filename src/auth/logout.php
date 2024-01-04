<?php 
    require_once(dirname(__FILE__) . "/../auth/session_manager.php");
    require_once(dirname(__FILE__) . "/../auth/cookie_manager.php");
    SessionManager::start();

    require_once(dirname(__FILE__) . "/../database/cookie.table.php");
    require_once(dirname(__FILE__) . "/../database/connection.php");

    $connection = new DBConnection();
    $cookie_table = new CookieTable($connection);

    if(isset($_COOKIE["remember"])) {

        $selector = CookieManager::parse_token(CookieManager::get("remember"))["selector"];

        unset($_COOKIE["remember"]);
        try {
            $is_deleted = $cookie_table->delete_by_selector($selector);
        }
        catch(mysqli_sql_exception $e) {
            $connection->close();
            header("Location: /errors/500.php");
        }

        //TODO: use cookie manager and cookie class
        setcookie("remember", "", time() - 3600, "/");
    }

    $connection->close();
    SessionManager::destroy();
    
    header("Location: /auth/login.php");
?>