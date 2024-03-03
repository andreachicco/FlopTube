<?php 
    class date_converter {
        public static function get_elapsed_time(DateTime $upload_time) {
            $now = new DateTime();
        
            // Calculate the difference between the two dates
            $interval = $upload_time->diff($now);
        
            // Format the difference
            if ($interval->y > 0) {
                return $interval->format('%y years ago');
            } elseif ($interval->m > 0) {
                return $interval->format('%m months ago');
            } elseif ($interval->d > 0) {
                return $interval->format('%d days ago');
            } elseif ($interval->h > 0) {
                return $interval->format('%h hours ago');
            } elseif ($interval->i > 0) {
                return $interval->format('%i minutes ago');
            } else {
                return 'Just now';
            }
        }
    }
?>