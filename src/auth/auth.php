<?php 

    require_once(dirname(__FILE__) . "/../common/data_validation.php");

    class Auth {
        public function login() {
            $required_fields = ["email", "pass"];
            if(!DataValidation::fields_exist($_POST, $required_fields)) header("Location: /auth/login.php?code=3");
            
            $password = trim($_POST["pass"]);
            
            require_once(dirname(__FILE__) . "/../database/connection.php");
            require_once(dirname(__FILE__) . "/../database/user.table.php");
            
            $connection = new DBConnection();
            $user_table = new UserTable($connection);
            
            $user = null;
            
            try {
                $user = $user_table->get_by_email(DataValidation::sanitize($_POST["email"]));
            } catch (mysqli_sql_exception $e) {
                print($e);
                $connection->close();
                header("Location: /auth/login.php?code=0");
            }
            
            if($user == null || !password_verify($password, $user->get_password())) header("Location: /auth/login.php?code=4");
            
            //setup session
            require_once(dirname(__FILE__) . "/../auth/session.php");

            $session = new Session(
                $user->get_id(),
                $user->get_email(),
                $user->get_firstname(),
                $user->get_lastname()
            );
            
            SessionManager::set($session);
            
            require_once(dirname(__FILE__) . "/../auth/cookie_manager.php");
            require_once(dirname(__FILE__) . "/../auth/cookie.php");
            
            //setup cookie
            $remember_me = $_POST["remember_me"];
            
            if($remember_me != null && $remember_me == "on") {
                $selector = CookieManager::generate_token(16);
                $validator = CookieManager::generate_token(16);
                
                $expired_seconds = CookieManager::get_expired_seconds(30);
                
                require_once(dirname(__FILE__) . "/../database/cookie.table.php");
                $cookie_table = new CookieTable($connection);

                try {
                    $new_cookie = new Cookie("remember", "{$selector}:{$validator}", $expired_seconds, "/", "", false, false);
                    $is_created = $cookie_table->create($new_cookie, $user->get_id());

                    if($is_created) CookieManager::set($new_cookie);
                }
                catch(mysqli_sql_exception $e) {
                    $connection->close();
                    header("Location: /auth/login.php?code=0");
                }
            } 

            $connection->close();
            header("Location: /");
        }
    }
    ?>