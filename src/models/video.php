<?php 

    class base_video {
        protected int $id;
        protected string $title;
        protected DateTime $upload_date;
        protected author $author;

        public function __construct(int $id, string $title, DateTime $upload_date, author $author) {
            $this->id = $id;
            $this->title = $title;
            $this->upload_date = $upload_date;
            $this->author = $author;
        }

        public function get_id() {
            return $this->id;
        }

        public function get_title() {
            return $this->title;
        }

        public function get_upload_date() {
            return $this->upload_date;
        }

        public function get_author() {
            return $this->author;
        }
    }

    class video extends base_video {
        private string $description;
        protected string $name;
        protected string $extension;
        
        public function __construct(int $id, string $name, string $extension, string $title, string $description, DateTime $upload_date, author $author) {
            parent::__construct($id, $title, $upload_date, $author);
            $this->name = $name;
            $this->extension = $extension;
            $this->description = $description;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_extension() {
            return $this->extension;
        }

        public function get_description() {
            return $this->description;
        }
    }

    class video_preview extends base_video {
        private thumbnail $thumbnail;

        public function __construct(int $id, thumbnail $thumbnail, string $title, DateTime $upload_date, author $author) {
            parent::__construct($id, $title, $upload_date, $author);
            $this->thumbnail = $thumbnail;
        }

        public function get_thumbnail() {
            return $this->thumbnail;
        }
    }
?>