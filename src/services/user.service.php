<?php 
    require_once(dirname(__FILE__) . "/../models/database.php");
    require_once(dirname(__FILE__) . "/../models/user.php");
    require_once(dirname(__FILE__) . "/../models/image.php");
    require_once(dirname(__FILE__) . "/../common/error_reporter.php");
    require_once(dirname(__FILE__) . "/base.service.php");

    class user_service extends service {

        private function get_new_user_profile(array $row) {
            return new user_profile(
                $row["id"],
                $row["first_name"],
                $row["last_name"],
                $row["email"],
                $row["bio"],
                new DateTime($row["created_at"]),
                new DateTime($row["updated_at"]),
                new profile_pic(
                    $row["profile_img_id"],
                    $row["profile_img_name"],
                    $row["profile_img_extension"],
                    $row["profile_img_type"],
                    $row["id"],
                    new DateTime($row["profile_img_created_at"])
                )
            );
        }

        public function create(string $firstname, string $lastname, string $email, string $password) {
            $query = "INSERT INTO user (first_name, last_name, email, password) 
                      VALUES (?, ?, ?, ?)";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("ssss", $firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT));
                $this->insert_one($statement);
            } catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }
        }

        public function find_one_by_id(string $id): ?user {
            $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.password, u.bio, u.created_at, u.updated_at, 
                             i.id AS img_id, i.file_name, i.extension, i.type, i.created_at AS img_created_at
                      FROM user AS u
                      LEFT JOIN image AS i
                      ON i.id = u.img_id
                      WHERE u.id = ?";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("s", $id);
                $row = $this->select_one($statement);
                if(!$row) return null;
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }

            return new user(
                $row["id"],
                $row["first_name"],
                $row["last_name"],
                $row["email"],
                $row["bio"],
                $row["password"],
                new DateTime($row["created_at"]),
                new DateTime($row["updated_at"]),
                new profile_pic(
                    $row["img_id"],
                    $row["file_name"],
                    $row["extension"],
                    $row["type"],
                    $row["id"],
                    new DateTime($row["img_created_at"])
                )
            );
        }

        public function find_one_by_email(string $email): ?user {
            $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.password, u.bio, u.created_at, u.updated_at, 
                             i.id AS img_id, i.file_name, i.extension, i.type, i.created_at AS img_created_at
                      FROM user AS u
                      LEFT JOIN image AS i
                      ON i.id = u.img_id
                      WHERE u.email = ?";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("s", $email);
                $row = $this->select_one($statement);
                if(!$row) return null;
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }


            return new user(
                $row["id"],
                $row["first_name"],
                $row["last_name"],
                $row["email"],
                $row["bio"],
                $row["password"],
                new DateTime($row["created_at"]),
                new DateTime($row["updated_at"]),
                new profile_pic(
                    $row["img_id"],
                    $row["file_name"],
                    $row["extension"],
                    $row["type"],
                    $row["id"],
                    new DateTime($row["img_created_at"])
                )
            );
        }

        public function find_one_by_selector(string $selector): ?user {
            $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.password, u.bio, u.created_at, u.updated_at, 
                             i.id AS img_id, i.file_name, i.extension, i.type, i.created_at AS img_created_at,
                             c.id AS cookie_id, c.selector, c.validator, c.expiry
                      FROM user AS u
                      LEFT JOIN cookie AS c
                      ON u.id = c.user_id 
                      LEFT JOIN image AS i
                      ON u.img_id = i.id
                      WHERE c.selector = ? AND c.expiry >= now() 
                      LIMIT 1";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("s", $selector);
                $row = $this->select_one($statement);
                if(!$row) return null; 
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }

            return new user(
                $row["id"],
                $row["first_name"],
                $row["last_name"],
                $row["email"],
                $row["bio"],
                $row["password"],
                new DateTime($row["created_at"]),
                new DateTime($row["updated_at"]),
                new profile_pic(
                    $row["img_id"],
                    $row["file_name"],
                    $row["extension"],
                    $row["type"],
                    $row["id"],
                    new DateTime($row["img_created_at"])
                ),
                new cookie(
                    $row["cookie_id"],
                    $row["selector"],
                    $row["validator"],
                    $row["id"],
                    new DateTime($row["expiry"])
                )
            );
        }

        public function find_user_profile_by_id(string $id) {
            $query = "SELECT * FROM user_profile WHERE id = ?";
            
            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("s", $id);
                $row = $this->select_one($statement);
                if(!$row) return null;
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }

            return $this->get_new_user_profile($row);
        }

        public function find_user_profile_by_email(string $email): user_profile {
            $query = "SELECT *
                      FROM user_profile
                      WHERE email = ?";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("s", $email);
                $row = $this->select_one($statement);

                if(!$row) return null;
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }

            return $this->get_new_user_profile($row);
        }

        public function update_user_profile(array $new_fields) {

            $query = "UPDATE user 
                      SET first_name = ?, last_name = ?, email = ?, bio = ? 
                      WHERE id = ?";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("sssss", $new_fields["firstname"], $new_fields["lastname"], $new_fields["email"], $new_fields["bio"], $_SESSION["id"]);
                $this->update_one($statement);
            } catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }
        }

        public function update_user_image(string $img_name, string $user_id) {
            $query = "UPDATE user SET img_id = (SELECT id FROM image WHERE file_name = ?) WHERE id = ?"; 

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("ss", $img_name, $user_id);
                $this->update_one($statement);
            } catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }
        }
    }
?>