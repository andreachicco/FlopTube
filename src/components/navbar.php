<?php 

    require_once(dirname(__FILE__) . "/../common/constants.php");
    require_once(dirname(__FILE__) . "/../components/search_form.php");

    class navabar {
        public function render(bool $is_user_logged = true) {
            ?>
                <header>
                    <a id="logo" href="<?php print(ROOT_PATH); ?>/">
                        <!-- LOGO  -->
                        <img src="<?php print(ROOT_PATH); ?>/assets/images/floptube_complete_logo.svg" alt="Floptube Logo">
                    </a>

                    <div class="search big-screen-search">
                        <?php (new search_form())->render(); ?>
                    </div>

                    <nav>
                        <ul id="outer-nav-links">
                            <?php if($is_user_logged) { ?>
                                <li class="outer-nav-item">
                                    <div id="nav-profile-picture" class="profile-picture">
                                        <img src="<?php print(ROOT_PATH . PROFILE_IMG_PATH . "/" . $_SESSION["img_name"]); ?>" alt="profile">
                                    </div>
                                    <div id="profile-pop-up" class="display-none">
                                        <h4><?php print($_SESSION["firstname"] . " " . $_SESSION["lastname"]) ?></h4>
                                        <p><?php print($_SESSION["email"]) ?></p>
                                        <br>
                                        <ul id="inner-nav-links">
                                            <li class="inner-nav-item">
                                                <a href="<?php print(ROOT_PATH); ?>/video/upload.php">
                                                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                    Upload
                                                </a>
                                            </li>
                                            <li class="inner-nav-item">
                                                <a href="<?php print(ROOT_PATH); ?>/user/show_profile.php">
                                                    <i class="fa-regular fa-user"></i>
                                                    Profile
                                                </a>
                                            </li>
                                            <li class="inner-nav-item">
                                                <a href="<?php print(ROOT_PATH); ?>/auth/logout.php">
                                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php } else {?>
                                <li class="outer-nav-item">
                                    <a href="<?php print(ROOT_PATH); ?>/auth/login.php">Login</a>
                                </li>
                                <li class="outer-nav-item">
                                    <a class="colored" href="<?php print(ROOT_PATH); ?>/auth/registration.php">Register</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </header>
            <?php
        }
    }

?>