<div class="container">
    <?php 
        require_once(dirname(__FILE__) . "/../components/navbar.php"); 
        (new navabar())->render(isset($_SESSION["logged"]) && $_SESSION["logged"]);
    ?>