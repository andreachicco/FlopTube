<?php 

    require_once(dirname(__FILE__) . "/base.service.php");
    require_once(dirname(__FILE__) . "/../common/error_reporter.php");
    require_once(dirname(__FILE__) . "/../models/video.php");
    require_once(dirname(__FILE__) . "/../models/image.php");
    require_once(dirname(__FILE__) . "/../models/user.php");

    class video_service extends service {

        public function handle_file_upload(string $filename, string $redirect_on_failure) {
            define("SUPPORTED_VIDEO_EXTENSIONS", array("mp4", "mov"));

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
                    error_handler::set_error("Video size too big");
                    die(change_location($redirect_on_failure));
                case UPLOAD_ERR_PARTIAL:
                    error_handler::set_error("Video upload was not completed");
                    die(change_location($redirect_on_failure));
                case UPLOAD_ERR_NO_TMP_DIR:
                case UPLOAD_ERR_CANT_WRITE:
                case UPLOAD_ERR_EXTENSION:
                    error_handler::set_error("Server error. Please try again later");
                    die(change_location($redirect_on_failure));
            }

            if($new_file) {
                $file_extension = strtolower(pathinfo($new_file["name"], PATHINFO_EXTENSION));
                
                if(!in_array($file_extension, SUPPORTED_VIDEO_EXTENSIONS)) {
                    error_handler::set_error("Unsupported video file extension. Supported extensions are: " . implode(", ", SUPPORTED_VIDEO_EXTENSIONS));
                    die(change_location($redirect_on_failure)); 
                }
                
                $newName = time();
                $new_file["name"] = $newName; 
                $new_file["extension"] = $file_extension;


                if(!move_uploaded_file($_FILES[$filename]["tmp_name"], dirname(__FILE__) . "/.." . VIDEO_PATH . "/" . $newName . "." . $file_extension)) {
                    error_reporter::report_message("Error: cannot move file " . $_FILES[$filename]["tmp_name"] . " to " . dirname(__FILE__) . "/.." . VIDEO_PATH . $newName . "." . $file_extension);
                    error_handler::set_error("An error occurred, try again", 500);
                    die(change_location($redirect_on_failure));
                }
            }

            return $new_file;
        }

        public function create(string $file_name, string $extension, string $title, string $description, thumbnail $thumbnail) {
            $query = "INSERT INTO video (file_name, extension, title, description, user_id, thumbnail_id) VALUES (?, ?, ?, ?, ?, ?);";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("sssssi", $file_name, $extension, $title, $description, $_SESSION["id"], $thumbnail->get_id());
                $this->insert_one($statement);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                die(change_location("error/500.php"));
            }
        }

        public function get_video_by_id(int $id): ?video {
            $query = "SELECT * FROM show_video AS sv WHERE sv.video_id = ?;";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("i", $id);
                $row = $this->select_one($statement);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                die(change_location("error/500.php"));
            }

            if($row == null) return null;

            $profile_pic = new profile_pic(
                $row["img_id"], 
                $row["img_name"], 
                $row["img_extension"]
            );

            $author = new author(
                $row["author_id"], 
                $row["author_first_name"], 
                $row["author_last_name"],
                $profile_pic
            );

            return new video(
                $row["video_id"], 
                $row["video_name"], 
                $row["video_extension"], 
                $row["title"], 
                $row["description"], 
                new DateTime($row["upload_date"]),
                $author
            );
        }

        public function get_video_previews(?string $search = null, ?string $user_id = null) {
            $query = "SELECT * FROM video_preview";
            $title_query = "title LIKE CONCAT('%', ?, '%')";
            $author_query = "author_id = ?";

            if($search && $user_id) $query .= " WHERE " . $title_query . " AND " . $author_query . ";";
            else if($search) $query .= " WHERE " . $title_query . ";";
            else if($user_id) $query .= " WHERE " . $author_query . ";";
            else $query .= ";";

            // die($query);

            try {
                $statement = $this->db->get_connection()->prepare($query);
                if($search && $user_id) $statement->bind_param("ss", $search, $user_id);
                else if($search) $statement->bind_param("s", $search);
                else if($user_id) $statement->bind_param("s", $user_id);
                $rows = $this->select_multiple($statement);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                die(change_location("error/500.php"));
            }

            foreach($rows as $row) {
                
                $profile_pic = new profile_pic(
                    $row["pic_id"], 
                    $row["pic_name"], 
                    $row["pic_extension"]
                );

                $author = new author(
                    $row["author_id"], 
                    $row["author_first_name"], 
                    $row["author_last_name"],
                    $profile_pic
                );

                $thumbnail = new thumbnail(
                    $row["thumb_id"], 
                    $row["thumb_name"], 
                    $row["thumb_extension"]
                );

                $video_preview = new video_preview(
                    $row["id"], 
                    $thumbnail, 
                    $row["title"], 
                    new DateTime($row["upload_date"]), 
                    $author
                );
                
                yield $video_preview;
            }
        }

        public function create_comment(string $comment, int $video_id) {
            $query = "INSERT INTO comment (text, video_id, user_id) VALUES (?, ?, ?);";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("sis", $comment, $video_id, $_SESSION["id"]);
                $this->insert_one($statement);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                die(change_location("error/500.php"));
            }
        }

        public function get_video_comments(int $video_id) {
            $query = "SELECT * FROM video_comment AS v WHERE v.video_id = ?;";

            try {
                $statement = $this->db->get_connection()->prepare($query);
                $statement->bind_param("i", $video_id);
                $rows = $this->select_multiple($statement);
            }
            catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                die(change_location("error/500.php"));
            }

            foreach($rows as $row) {
                $profile_pic = new profile_pic(
                    $row["pic_id"], 
                    $row["pic_name"], 
                    $row["pic_extension"]
                );

                $author = new author(
                    $row["user_id"], 
                    $row["first_name"], 
                    $row["last_name"],
                    $profile_pic
                );

                $comment = new comment(
                    $author, 
                    $row["comment_text"], 
                    new DateTime($row["comment_created_at"])
                );
                
                yield $comment;
            }
        }

    }
?>