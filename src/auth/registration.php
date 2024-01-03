<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(dirname(__FILE__) . "/../common/head.php"); ?>
    <title>FlopTube | Register</title>
</head>
<body class="overflow-x-hidden h-screen">
    <?php 

        if(isset($_SESSION["email"])) {
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
                        DataValidation::hash_password($password)
                    );

                    $connection = new DBConnection();

                    require_once(dirname(__FILE__) . "/../database/user.table.php");
                    $user_table = new UserTable($connection);

                    try {
                        $user_created = $user_table->create($user);
                        $connection->close();
                        if($user_created) header("Location: /");
                        else header("Location: /auth/registration.php?code=0");
                    }
                    catch(mysqli_sql_exception $e) {
                        $connection->close();
                        if($e->getCode() == 1062) header("Location: /auth/registration.php?code=1");
                        else header("Location: /auth/registration.php?code=0");
                    }
                }
                else header("Location: /auth/registration.php?code=2");
            }
            else header("Location: /auth/registration.php?code=3");
        }
    ?>

    <div class="hidden md:grid w-sm-container sm:w-container h-[45vh] mx-auto rounded-md bg-ft-red bg-banner bg-cover bg-no-repeat bg-center place-self-center"></div>

    <section class="flex flex-col w-sm-container mx-auto sm:w-1/2 sm:min-w-[27rem] sm:max-w-[30rem] sm:p-5 sm:bg-white sm:shadow sm:rounded absolute top-1/2 left-1/2 translate-x-minus-50% translate-y-minus-50%">
        <h1 class="mb-0.5 text-2xl sm:text-3xl font-montserrat font-extrabold">Create Account</h1>
        <p class="mb-5 text-xs font-montserrat sm:text-base">Give us some of your information to get started</p>
        <?php 
            DataValidation::check_code();
            require_once(dirname(__FILE__) . "/../components/registration_form.php"); 

            $registrationForm = new RegistrationForm();
            $registrationForm->render();
        ?>
        <p class="m-3 text-xs font-montserrat text-center">Already have an account? <a class="text-ft-red" href="/auth/login.php">Login</a></p>
    </section>
</body>
</html>