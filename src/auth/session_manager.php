<?php 
    class SessionManager {
        
        public static function start(): void {
            session_start();
        }

        public static function set(Session $session): void {
            $field = $session->get_fields();
            foreach($field as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }

        public static function get(string $field): string | null {
            if(isset($_SESSION[$field])) {
                return $_SESSION[$field];
            }

            return null;
        }  

        public static function destroy(): void {
            $_SESSION = array();
            session_destroy();
        }

        public static function is_session_valid(): bool {
            return isset($_SESSION["id"]);
        }
    }
?>