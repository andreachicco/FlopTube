<?php 

    require_once(dirname(__FILE__) . "/../common/data_validation.php");
    require_once(dirname(__FILE__) . "/../database/connection.php");
    require_once(dirname(__FILE__) . "/../database/user.table.php");
    
    class Auth {
        public function login() {
            $required_fields = ["email", "pass"];
            if(!DataValidation::fields_exist($_POST, $required_fields)) header("Location: /auth/login.php?code=3");
            
            $password = trim($_POST["pass"]);
            
            
            $connection = null;

            try {
                $connection = new DBConnection();
            }
            catch(mysqli_sql_exception $e) {
                exit(header("Location: /errors/500.php"));
            }

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

                $db_token = $selector . ":" . password_hash($validator, PASSWORD_DEFAULT);
                $cookie_token = $selector . ":" . $validator;
                
                $expired_seconds = CookieManager::get_expired_seconds(30);
                
                require_once(dirname(__FILE__) . "/../database/cookie.table.php");
                $cookie_table = new CookieTable($connection);

                try {
                    $new_cookie = new Cookie("remember", $db_token, $expired_seconds, "/", "", false, false);
                    $is_created = $cookie_table->create($new_cookie, $user->get_id());

                    if($is_created) { 
                        $new_cookie->set_value($cookie_token);
                        CookieManager::set($new_cookie);
                    } 
                }
                catch(mysqli_sql_exception $e) {
                    $connection->close();
                    header("Location: /auth/login.php?code=0");
                }
            } 

            $connection->close();
            header("Location: /");
        }

        public function register() {
            $required_fields = ["firstname", "lastname", "email", "pass", "confirm"];
            if(!DataValidation::fields_exist($_POST, $required_fields)) header("Location: /auth/registration.php?code=3");
            
            $password = trim($_POST["pass"]);
            $confirm = trim($_POST["confirm"]);

            if($password !== $confirm) header("Location: /auth/registration.php?code=2");

            require_once(dirname(__FILE__) . "/../common/user.php");
            
            $user = new User(
                DataValidation::sanitize($_POST["firstname"]),
                DataValidation::sanitize($_POST["lastname"]),
                DataValidation::sanitize($_POST["email"]),
                DataValidation::hash_password($password)
            );

            $connection = new DBConnection();
            $user_table = new UserTable($connection);

            try {
                $user_created = $user_table->create($user);
                $connection->close();
                if($user_created) header("Location: /auth/login.php");
                else header("Location: /auth/registration.php?code=0");
            }
            catch(mysqli_sql_exception $e) {
                $connection->close();
                if($e->getCode() == 1062) header("Location: /auth/registration.php?code=1");
                else header("Location: /auth/registration.php?code=0");
            }
        }
    }
    ?>