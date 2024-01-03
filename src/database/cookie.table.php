<?php 
    require_once(dirname(__FILE__) . "/../database/table.php");

    class CookieTable extends Table {
        public function create(array $cookie) {
            $query = "INSERT INTO cookie (user_id, selector, validator, expiry) VALUES (?, ?, ?, ?)";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssss", $cookie["user_id"], $cookie["selector"], $cookie["validator"], $cookie["expiry"]);
            return $stmt->execute();
        }

        public function delete_by_user_id(string $user_id) {
            $query = "DELETE FROM cookie WHERE user_id = ?";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $user_id);
            return $stmt->execute();
        }

        public function find_by_selector(string $selector) {
            $query = "SELECT * FROM cookie WHERE selector = ?";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $selector);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            if($result->num_rows == 0) return null;

            return $result->fetch_assoc();
        }

        public function is_token_valid(string $selector, string $validator) {
            $token = $this->find_by_selector($selector);

            if(!$token) return false;

            return password_verify($validator, $token["validator"]);
        }
    }
?>