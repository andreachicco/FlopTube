<?php 



    class comment {
        private author $author;
        private string $text; 
        private DateTime $created_at;

        public function __construct(
            author $author,
            string $text,
            DateTime $created_at
        ) {
            $this->author = $author;
            $this->text = $text;
            $this->created_at = $created_at;
        }

        public function get_author() {
            return $this->author;
        }

        public function get_text() {
            return $this->text;
        }

        public function get_created_at() {
            return $this->created_at;
        }
    }
?>