<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(dirname(__FILE__) . "/../common/head.php"); ?>
    <title>FlopTube | Register</title>
</head>
<body class="overflow-x-hidden h-screen">
    <?php 
        require_once(dirname(__FILE__) . "/../components/component_renderer.php");

        $componentRenderer = new ComponentRenderer();

        require_once(dirname(__FILE__) . "/../components/header.php"); 
    ?>

    <?php 
        require_once(dirname(__FILE__) . "/../common/data_validation.php");
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["firstname", "lastname", "email", "pass", "confirm"];
            if(DataValidation::fields_exist($_POST, $required_fields)) {
                $password = trim($_POST["pass"]);
                $confirm = trim($_POST["confirm"]);
                
                if($password === $confirm) {
                    require_once(dirname(__FILE__) . "/../common/user.php");
                    $user = new User(
                        DataValidation::sanitize($_POST["firstname"]),
                        DataValidation::sanitize($_POST["lastname"]),
                        DataValidation::sanitize($_POST["email"]),
                        $password
                    );
                }
                else header("Location: /auth/registration.php?code=Passwords do not match");
            }
            else header("Location: /auth/registration.php?code=Please fill in all fields");
        }
    ?>

    <div class="hidden sm:grid w-sm-container sm:w-container h-[45vh] mx-auto rounded-md bg-ft-red bg-banner bg-cover bg-no-repeat bg-center place-self-center"></div>

    <section class="flex flex-col w-sm-container mx-auto sm:w-1/2 sm:min-w-[27rem] sm:max-w-[30rem] sm:p-5 sm:bg-white sm:shadow sm:rounded absolute top-1/2 left-1/2 translate-x-minus-50% translate-y-minus-50%">
        <h1 class="mb-0.5 text-2xl sm:text-3xl font-montserrat font-extrabold">Create Account</h1>
        <p class="mb-5 text-xs font-montserrat sm:text-base">Give us some of your information to get started</p>
        <?php 
            if(isset($_GET["code"])) {
                $code = $_GET["code"];
                require_once(dirname(__FILE__) . "/../components/alert_box.php");
                require_once(dirname(__FILE__) . "/../common/alert_type.php");
                
                $alertBox = new AlertBox($code, AlertType::ERROR);
                $componentRenderer->set_component($alertBox);
                $componentRenderer->render();
            }    
            require_once(dirname(__FILE__) . "/../components/registration_form.php"); 
        ?>
    </section>
</body>
</html>