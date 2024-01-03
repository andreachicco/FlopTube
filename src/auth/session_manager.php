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

        public static function check_session_and_redirect(string $location): void {
            if(isset($_SESSION["id"])) {
                header("Location: " . $location);
            }
        }
    }
?>