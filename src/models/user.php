<?php 

    class base_user {
        protected string $id;
        protected string $first_name;
        protected string $last_name;
        protected profile_pic $profile_pic;

        public function __construct(string $id, string $first_name, string $last_name, profile_pic $profile_pic) {
            $this->id = $id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->profile_pic = $profile_pic;
        }

        public function get_id() {
            return $this->id;
        }

        public function get_first_name() {
            return $this->first_name;
        }

        public function get_last_name() {
            return $this->last_name;
        }

        public function get_profile_pic() {
            return $this->profile_pic;
        }
    }

    class user_profile extends base_user {
        protected string $email;
        protected ?string $bio;
        protected DateTime $created_at;
        protected DateTime $updated_at;

        public function __construct(
            string $id,
            string $first_name,
            string $last_name,
            string $email,
            ?string $bio,
            DateTime $created_at,
            DateTime $updated_at,
            profile_pic $profile_pic
        ) {
            parent::__construct($id, $first_name, $last_name, $profile_pic);
            $this->email = $email;
            $this->bio = $bio;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_bio() {
            return $this->bio;
        }

        public function get_created_at() {
            return $this->created_at;
        }

        public function get_updated_at() {
            return $this->updated_at;
        }
    }

    class user extends user_profile {
        private string $password;
        private ?cookie $cookie;

        public function __construct(
            string $id,
            string $first_name,
            string $last_name,
            string $email,
            ?string $bio,
            string $password,
            DateTime $created_at,
            DateTime $updated_at,
            profile_pic $profile_pic,
            cookie $cookie = null
        ) {
            parent::__construct($id, $first_name, $last_name, $email, $bio, $created_at, $updated_at, $profile_pic);
            $this->password = $password;
            $this->cookie = $cookie;
        }

        public function get_password() {
            return $this->password;
        }

        public function get_cookie() {
            return $this->cookie;
        }
    }

    class author extends base_user {}
?>