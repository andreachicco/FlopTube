<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(dirname(__FILE__) . "/../common/head.php"); ?>
    <title>FlopTube | Login</title>
</head>
<body class="overflow-x-hidden h-screen">
    <?php 

        if(isset($_SESSION["id"])) {
            exit(header("Location: /"));
        }

        require_once(dirname(__FILE__) . "/../components/header.php"); 

        $header = new Header();
        $header->render();  
    ?>

    <?php 
        require_once(dirname(__FILE__) . "/../common/data_validation.php");
        require_once(dirname(__FILE__) . "/../database/connection.php");

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["email", "pass"];
            if(DataValidation::fields_exist($_POST, $required_fields)) {
                $password = trim($_POST["pass"]);
                
                require_once(dirname(__FILE__) . "/../database/user.table.php");

                $connection = new DBConnection();
                $user_table = new UserTable($connection);
                $user = null;

                try {
                    $user = $user_table->get_by_email(DataValidation::sanitize($_POST["email"]));
                }
                catch(mysqli_sql_exception $e) {
                    $connection->close();
                    header("Location: /auth/login.php?code=0");
                }

                if($user != null && password_verify($password, $user->get_password())) {
                    // session_start();
                    $_SESSION["id"] = $user->get_id();
                    $_SESSION["email"] = $user->get_email();
                    $_SESSION["firstname"] = $user->get_firstname();
                    $_SESSION["lastname"] = $user->get_lastname();

                    if(isset($_POST["remember_me"]) && $_POST["remember_me"] == "on") {
                        require_once(dirname(__FILE__) . "/../database/cookie.table.php");
                        require_once(dirname(__FILE__) . "/../common/cookie_handler.php");
    
                        $selector = CookieHandler::generate_token(16);
                        $validator = CookieHandler::generate_token(32);
                        $token = $selector . ":" . $validator;
                        $expiry = CookieHandler::generate_expiry(30);
    
                        $cookie_table = new CookieTable($connection);
                        
    
                        try {
                            $is_created = $cookie_table->create([
                                "user_id" => $user->get_id(),
                                "selector" => $selector,
                                "validator" => password_hash($validator, PASSWORD_DEFAULT),
                                "expiry" => $expiry[0]
                            ]);

                            if($is_created) {
                                setcookie("remember_me", $token, $expiry[1], "/");
                            }
                        }
                        catch(mysqli_sql_exception $e) {
                            $connection->close();
                            header("Location: /auth/login.php?code=0");
                        }
                    }

                    $connection->close();
                    header("Location: /");
                }
                else header("Location: /auth/login.php?code=4");
                
            }
            else header("Location: /auth/login.php?code=3");
        }
    ?>

    <div class="hidden md:grid w-sm-container sm:w-container h-[45vh] mx-auto rounded-md bg-ft-red bg-banner bg-cover bg-no-repeat bg-center place-self-center"></div>

    <section class="flex flex-col w-sm-container mx-auto sm:w-1/2 sm:min-w-[27rem] sm:max-w-[30rem] sm:p-5 sm:bg-white sm:shadow sm:rounded absolute top-1/2 left-1/2 translate-x-minus-50% translate-y-minus-50%">
        <h1 class="mb-0.5 text-2xl sm:text-3xl font-montserrat font-extrabold">Welcome Back</h1>
        <p class="mb-5 text-xs font-montserrat sm:text-base">Enter your email and password to login</p>
        <?php 
            DataValidation::check_code();
            require_once(dirname(__FILE__) . "/../components/login_form.php"); 
            
            $login_form = new LoginForm();
            $login_form->render();
        ?>
        <p class="m-3 text-xs font-montserrat text-center">Don't have an account? <a class="text-ft-red" href="/auth/registration.php">Register</a></p>
    </section>
</body>
</html>