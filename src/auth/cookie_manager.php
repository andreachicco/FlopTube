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
            print_r($_COOKIE);
            if(isset($_COOKIE[$name])) {
                return $_COOKIE[$name];
            }

            return null;
        }
    }
?>