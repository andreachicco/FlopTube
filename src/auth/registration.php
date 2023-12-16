<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(dirname(__FILE__) . "/../common/head.php"); ?>
    <title>FlopTube | Register</title>
</head>
<body class="overflow-x-hidden h-screen">
    <?php require_once(dirname(__FILE__) . "/../components/header.php"); ?>

    <div class="hidden sm:grid w-sm-container sm:w-container h-[45vh] mx-auto rounded-md bg-ft-red bg-banner bg-cover bg-no-repeat bg-center place-self-center"></div>

    <section class="flex flex-col w-sm-container mx-auto h-[55vh] max-h-[40rem] sm:w-1/2 sm:min-w-[25rem] sm:max-w-[30rem] sm:p-5 sm:bg-white sm:shadow sm:rounded absolute top-1/2 left-1/2 translate-x-minus-50% translate-y-minus-50%">
        <h1 class="mb-0.5 text-2xl sm:text-3xl font-montserrat font-extrabold">Create Account</h1>
        <p class="mb-5 text-xs font-montserrat sm:text-base">Give us some of your information to get started</p>
        <?php require_once(dirname(__FILE__) . "/../components/registration_form.php"); ?>
    </section>
</body>
</html>