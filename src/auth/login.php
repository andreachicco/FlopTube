<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(dirname(__FILE__) . "/../common/head.php"); ?>
    <title>FlopTube | Login</title>
</head>
<body class="overflow-x-hidden h-screen">
    <?php 

        require_once(dirname(__FILE__) . "/../auth/session_manager.php");
        SessionManager::start();
        //check for active session
        SessionManager::check_session_and_redirect("/");

        require_once(dirname(__FILE__) . "/../components/header.php"); 
        $header = new Header();
        $header->render();  
    ?>

    <?php 
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            require_once(dirname(__FILE__) . "/../auth/auth.php");

            $auth = new Auth();
            $auth->login();
        }
    ?>

<div class="hidden md:grid w-sm-container sm:w-container h-[45vh] mx-auto rounded-md bg-ft-red bg-banner bg-cover bg-no-repeat bg-center place-self-center"></div>

<section class="flex flex-col w-sm-container mx-auto sm:w-1/2 sm:min-w-[27rem] sm:max-w-[30rem] sm:p-5 sm:bg-white sm:shadow sm:rounded absolute top-1/2 left-1/2 translate-x-minus-50% translate-y-minus-50%">
    <h1 class="mb-0.5 text-2xl sm:text-3xl font-montserrat font-extrabold">Welcome Back</h1>
    <p class="mb-5 text-xs font-montserrat sm:text-base">Enter your email and password to login</p>
    <?php 
            require_once(dirname(__FILE__) . "/../common/data_validation.php");
            DataValidation::check_code();
            require_once(dirname(__FILE__) . "/../components/login_form.php"); 
            
            $login_form = new LoginForm();
            $login_form->render();
        ?>
        <p class="m-3 text-xs font-montserrat text-center">Don't have an account? <a class="text-ft-red" href="/auth/registration.php">Register</a></p>
    </section>
</body>
</html>