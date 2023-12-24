<?php 
    // require_once(dirname(__FILE__) . "/../database/connection.php");

    class UserTable {
        private DBConnection $db;

        public function __construct(DBConnection $db) {
            $this->db = $db;
        }

        public function create(User $user): bool {
            $query = "INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

            $first_name = $user->get_firstname();
            $last_name = $user->get_lastname();
            $email = $user->get_email();
            $password = $user->get_password();

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
            return $stmt->execute();
        }
    }
?>