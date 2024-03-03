<?php 

    require_once(dirname(__FILE__) . "/user.service.php");
    require_once(dirname(__FILE__) . "/cookie.service.php");
    require_once(dirname(__FILE__) . "/../common/sanitizer.php");
    require_once(dirname(__FILE__) . "/../common/constants.php");
    require_once(dirname(__FILE__) . "/../common/redirector.php");
    require_once(dirname(__FILE__) . "/../common/error_handler.php");

    class auth_service {

        private ?user_service $user_service;
        private ?cookie_service $cookie_service;

        public function __construct(
            user_service $user_service = null,
            cookie_service $cookie_service = null
        ) {
            $this->user_service = $user_service;
            $this->cookie_service = $cookie_service;
        }

        public function init_session(user $user) {

            $image = $user->get_profile_pic();

            $_SESSION["logged"] = true;
            $_SESSION["id"] = $user->get_id();
            $_SESSION["firstname"] = $user->get_first_name();
            $_SESSION["lastname"] = $user->get_last_name();
            $_SESSION["email"] = $user->get_email();
            $_SESSION["bio"] = $user->get_bio();
            $_SESSION["img_name"] = $image ? $image->get_name() . "." . $image->get_extension() : DEFAULT_PROFILE_IMG; 
        }

        public function sign_up() {
            try {
                $this->user_service->create(
                    sanitizer::sanitize($_POST["firstname"]), 
                    sanitizer::sanitize($_POST["lastname"]), 
                    sanitizer::sanitize($_POST["email"]), 
                    trim($_POST["pass"])
                );
                

                die(change_location("auth/login.php"));
            } catch (mysqli_sql_exception $e) {
                $error_code = $e->getCode();

                switch($error_code) {
                    case ERR_DUP_ENTRY:
                        error_handler::set_error("Email already in use", 409);
                        break;
                    default:
                        error_handler::set_error("An error occurred, try again", 500);
                }

                die(change_location("auth/registration.php"));
            }
        }

        public function sign_in() {

            $user = null;

            try {
                $user = $this->user_service->find_one_by_email(sanitizer::sanitize($_POST["email"]));
            } catch (mysqli_sql_exception $e) {
                error_handler::set_error("An error occurred, try again", 500);
                die(change_location("auth/login.php"));
            }
            
            
            if($user) {
                if(password_verify(trim($_POST["pass"]), $user->get_password())) {
                    $this->init_session($user);

                    if(isset($_POST["remember"])) $this->remember_me($user->get_id()); 
                    
                    die(change_location(""));
                }
            }
            //The user cannot know if the email or the password is wrong
            error_handler::set_error("Check your credentials and try again", 401);
        }

        public function sign_out() {
            $_SESSION = array();
            session_destroy();

            if (isset($_COOKIE[REMEMBER_ME_COOKIE]) && !empty($_COOKIE[REMEMBER_ME_COOKIE])) {                
                [$selector, $validator] = $this->cookie_service->parse_token($_COOKIE["remember_me"]);

                unset($_COOKIE[REMEMBER_ME_COOKIE]);
                setcookie(REMEMBER_ME_COOKIE, '', -1, '/');

                try {
                    $this->cookie_service->delete_cookie_by_selector($selector);
                } catch (mysqli_sql_exception $e) {
                    die(change_location("error/500.php"));    
                }
            }

            die(change_location("auth/login.php"));
        }

        private function remember_me(string $user_id) {
            [$selector, $validator, $token] = $this->cookie_service->generate_tokens();
            $expired_seconds = $this->cookie_service->calculate_expiry(30);

            $validator_hash = password_hash($validator, PASSWORD_DEFAULT);
            $expiry = date("Y-m-d H:i:s", $expired_seconds);

            try {
                $this->cookie_service->create($user_id, $selector, $validator_hash, $expiry);
                setcookie(REMEMBER_ME_COOKIE, $token, $expired_seconds, "/");
            } catch (mysqli_sql_exception $e) {
                error_handler::set_error("An error occurred, try again", 500);
                die(change_location("auth/login.php"));
            }
        }

        private function log_user_in(user $user): bool {

            if(session_regenerate_id()) {
                $this->init_session($user);
                return true;
            }

            return false;
        }

        public function is_user_logged(): bool {
            if((isset($_SESSION["logged"]) && $_SESSION["logged"])) return true;

            if(!isset($_COOKIE[REMEMBER_ME_COOKIE])) return false;
            $token = $_COOKIE[REMEMBER_ME_COOKIE];
            
            [$selector, $validator] = $this->cookie_service->parse_token($token);

            try {
                $user = $this->user_service->find_one_by_selector($selector);

                if(!$user) return false;

                $cookie = $user->get_cookie();
                if(!$cookie) return false;
                $is_cookie_valid = password_verify($validator, $cookie->get_validator());

                if(!$is_cookie_valid) return false;

                return $this->log_user_in($user);

            } catch (mysqli_sql_exception $e) {
                die(change_location("error/500.php"));
            }
        }
    }

?>