<?php 
    class search_form {
        public function render() {
            ?>
                <form action="<?php print(ROOT_PATH); ?>/" method="get">
                    <input aria-label="Search Video" type="text" name="search" class="search-bar" placeholder="Search">
                    <button class="search-button" value="search video">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            <?php
        }
    }
?>