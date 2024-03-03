<?php 

    require_once(dirname(__FILE__) . "/../common/error_handler.php");

    class error_pop_up {        
        public function render() {
            if(error_handler::has_error()) {
                $error = error_handler::get_error();
                http_response_code($error["status_code"])
                ?>  
                    <div class="error-pop-up">
                        <p class="error-message"><?php print($error["message"]); ?></p>
                        <button class="close-error-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                <?php
            }
        }
    }
?>