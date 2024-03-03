<?php 

    class base_image {
        protected int $id;
        protected string $name;
        protected string $extension;

        public function __construct(int $id, string $name, string $extension) {
            $this->id = $id;
            $this->name = $name;
            $this->extension = $extension;
        }

        public function get_id() {
            return $this->id;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_extension() {
            return $this->extension;
        }

        public function get_full_name() {
            return $this->name . "." . $this->extension;
        }
    }

    class thumbnail extends base_image {
        public function __construct(int $id, string $name, string $extension) {
            parent::__construct($id, $name, $extension);
        }
    }

    class profile_pic extends base_image {
        public function __construct(int $id, string $name, string $extension) {
            parent::__construct($id, $name, $extension);
        }
    }

    class image {
        private int $id;
        private string $file_name;
        private string $extension;
        private string $type;
        private string $user_id;
        //private int $size;
        private DateTime $created_at;

        public function __construct(
            int $id,
            string $file_name,
            string $extension,
            string $type,
            string $user_id,
            //int $size,
            DateTime $created_at
        ) {
            $this->id = $id;
            $this->file_name = $file_name;
            $this->extension = $extension;
            $this->type = $type;
            $this->user_id = $user_id;
            //$this->size = $size;
            $this->created_at = $created_at;
        }

        public function get_id() {
            return $this->id;
        }

        public function get_file_name() {
            return $this->file_name;
        }

        public function get_extension() {
            return $this->extension;
        }

        public function get_type() {
            return $this->type;
        }

        // public function get_size() {

        // }

        public function get_created_at() {
            return $this->created_at;
        }

        public function get_full_name() {
            return $this->file_name . "." . $this->extension;
        }
    }
?>