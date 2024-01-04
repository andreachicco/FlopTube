<?php 
    class CookieManager {

        public static function generate_token(int $lenght): string {
            return bin2hex(random_bytes($lenght));
        }

        public static function get_expired_seconds(int $days): int {
            return time() + 60 * 60 * 24 * $days;
        }

        public static function get_expired_date(int $expired_seconds): string {
            return date("Y-m-d H:i:s", $expired_seconds);
        }

        public static function parse_token(string $token): array | null {
            $parts = explode(":", $token);

            if(count($parts) != 2) return null;

            return [
                "selector" => $parts[0],
                "validator" => $parts[1]
            ];
        }

        public static function handle_cookie() {
            
            $cookie_value = self::get("remember");

            if($cookie_value == null) return false;

            $cookie = self::parse_token($cookie_value);
            $selector = $cookie["selector"];
            $validator = $cookie["validator"];

            require_once(dirname(__FILE__) . "/../database/cookie.table.php");
            require_once(dirname(__FILE__) . "/../database/connection.php");

            $connection = new DBConnection();
            $cookie_table = new CookieTable($connection);

            try {
                $db_cookie = $cookie_table->find_by_selector($selector, true);
                print_r($db_cookie);

                if($db_cookie == null) return false;
                
                if(password_verify($validator, $db_cookie["validator"])) {
                    $expiry_data = $db_cookie["expiry"];
                    $expity_seconds = strtotime($expiry_data);
                    
                    if($expity_seconds < time()) {
                        $cookie_table->delete_by_user_id($db_cookie["user_id"]);
                        return false;
                    }

                    require_once(dirname(__FILE__) . "/../auth/session_manager.php");
                    require_once(dirname(__FILE__) . "/../auth/session.php");

                    $session = new Session(
                        $db_cookie["user_id"],
                        $db_cookie["email"],
                        $db_cookie["first_name"],
                        $db_cookie["last_name"]
                    );

                    print_r($session);

                    SessionManager::set($session);

                    return true;
                }
            }
            catch(mysqli_sql_exception $e) {
                $connection->close();
                return false;
            }

            return false;
        }

        public static function set(Cookie $cookie): void {
            setcookie(
                $cookie->get_name(),
                $cookie->get_value(),
                $cookie->get_expiry_seconds(),
                $cookie->get_path(),
                $cookie->get_domain(),
                $cookie->get_secure(),
                $cookie->get_http_only()
            );
        }

        public static function get(string $name): string | null {
            if(isset($_COOKIE[$name])) {
                return $_COOKIE[$name];
            }

            return null;
        }
    }
?>