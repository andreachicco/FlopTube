<?php 
    require_once(dirname(__FILE__) . "/../models/database.php");
    require_once(dirname(__FILE__) . "/../models/cookie.php");
    require_once(dirname(__FILE__) . "/../common/error_reporter.php");
    require_once(dirname(__FILE__) . "/base.service.php");

    class cookie_service extends service {
        public function calculate_expiry(int $days): int {
            return time() + 60 * 60 * 24 * $days;
        }

        public function generate_token(int $bytes): string {
            return bin2hex(random_bytes($bytes));
        }

        public function generate_tokens(): array {
            $selector = $this->generate_token(16);
            $validator = $this->generate_token(32);

            return [$selector, $validator, "$selector:$validator"];
        }

        public function parse_token(string $token): ?array {
            $parts = explode(':', $token);
        
            if ($parts && count($parts) == 2) {
                return [$parts[0], $parts[1]];
            }
            return null;
        }

        public function create(string $user_id, string $selector, string $validator_hash, string $expiry) {
            $query = "INSERT INTO cookie (selector, validator, user_id, expiry) VALUES (?, ?, ?, ?)";
            
            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("ssss", $selector, $validator_hash, $user_id, $expiry);
                $this->insert_one($statement);

            } catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }
        }

        public function delete_cookie_by_selector(string $selector) {
            $query = "DELETE FROM cookie WHERE selector = ?";
            
            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("s", $selector);
                $this->delete_one($statement);
            } catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }
        }
    }

?>