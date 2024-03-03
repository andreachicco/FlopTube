<?php 
    require_once(dirname(__FILE__) . "/../models/database.php");
    require_once(dirname(__FILE__) . "/../models/user.php");
    require_once(dirname(__FILE__) . "/../models/image.php");
    require_once(dirname(__FILE__) . "/../common/error_reporter.php");
    require_once(dirname(__FILE__) . "/base.service.php");

    class image_service extends service {

        public function handle_file_upload(string $filename, string $redirect_on_failure) {
            define("SUPPORTED_IMG_EXTENSIONS", array("png", "jpg", "jpeg"));

            $file_error = $_FILES[$filename]["error"];
            $new_file = null;

            switch($file_error) {
                case UPLOAD_ERR_OK:
                    $new_file = $_FILES[$filename];
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $new_file = null;
                    break;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    error_handler::set_error("Thumbnail size too big");
                    die(change_location($redirect_on_failure));
                case UPLOAD_ERR_PARTIAL:
                    error_handler::set_error("Thumbnail upload was not completed");
                    die(change_location($redirect_on_failure));
                case UPLOAD_ERR_NO_TMP_DIR:
                case UPLOAD_ERR_CANT_WRITE:
                case UPLOAD_ERR_EXTENSION:
                    error_handler::set_error("Server error. Please try again later");
                    die(change_location($redirect_on_failure));
            }

            if($new_file) {
                $file_extension = strtolower(pathinfo($new_file["name"], PATHINFO_EXTENSION));
                
                if(!in_array($file_extension, SUPPORTED_IMG_EXTENSIONS)) {
                    error_handler::set_error("Unsupported thumbnail file extension. Supported extensions are: " . implode(", ", SUPPORTED_IMG_EXTENSIONS));
                    die(change_location($redirect_on_failure)); 
                }
                
                $newName = time();
                $new_file["name"] = $newName; 
                $new_file["extension"] = $file_extension;

                $FILE_DIR = $filename == "profile-pic" ? PROFILE_IMG_PATH : THUMBNAIL_IMG_PATH;

                if(!move_uploaded_file($_FILES[$filename]["tmp_name"], dirname(__FILE__) . "/.." . $FILE_DIR . "/" . $newName . "." . $file_extension)) {
                    error_reporter::report_message("Error: cannot move file " . $_FILES[$filename]["tmp_name"] . " to " . dirname(__FILE__) . "/.." . $FILE_DIR . $newName . "." . $file_extension);
                    error_handler::set_error("An error occurred, try again", 500);
                    die(change_location($redirect_on_failure));
                }
            }

            return $new_file;
        }

        public function create(string $file_name, string $extension, string $type) {
            $query = "INSERT INTO image (file_name, extension, type) VALUES (?, ?, ?)";
            

            try {
                $stmt = $this->db->get_connection()->prepare($query);
                $stmt->bind_param("sss", $file_name, $extension, $type);
                $this->insert_one($stmt);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            } 
        }

        public function update_by_name(string $name, array $new_fields) {
            $query = "UPDATE image SET file_name = ?, extension = ? WHERE file_name = ? AND extension = ?";

            $complete_file_name = explode(".", $name);
            $file_name = $complete_file_name[0];
            $extension = $complete_file_name[1];

            try {
                $stmt = $this->db->get_connection()->prepare($query);
                $stmt->bind_param("ssss", $new_fields["name"], $new_fields["extension"], $file_name, $extension);
                $this->update_one($stmt);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }  
        }

        public function find_thumbnail_by_full_name(string $file_name, string $extension) {
            $query = "SELECT * FROM image WHERE file_name = ? AND extension = ? AND type = 'thumbnail'";

            try {
                $stmt = $this->db->get_connection()->prepare($query);
                $stmt->bind_param("ss", $file_name, $extension);
                $row = $this->select_one($stmt);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                throw $e;
            }

            if($row == null) return null;

            return new thumbnail(
                $row["id"], 
                $row["file_name"], 
                $row["extension"]
            );
        }
    }
?>