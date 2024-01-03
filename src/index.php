<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(dirname(__FILE__) . "/common/head.php"); ?>
    <title>FlopTube</title>
</head>
<body class="overflow-x-hidden">
    <?php require_once(dirname(__FILE__) . "/components/header.php"); 
        $header = new Header();
        $header->render();

        $home_text = ((!isset($_SESSION["email"])) ? "FlopTube: like YouTube, but worse" : "Welcome back, " . $_SESSION["firstname"]);
        print("<h1 class=\"text-ft-red\">{$home_text}</h1>");
    ?>
</body>
</html>