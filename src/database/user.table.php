<?php 
    // require_once(dirname(__FILE__) . "/../database/connection.php");
    require_once(dirname(__FILE__) . "/../common/user.php");

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

        public function get_by_email(string $email): ?User {
            $query = "SELECT * FROM user WHERE email = ?";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                return null;
            }

            $row = $result->fetch_assoc();
            return new User($row["id"], $row["first_name"], $row["last_name"], $row["email"], $row["password"]);
        }
    }
?>