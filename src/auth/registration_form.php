<form action="<?php print(ROOT_PATH); ?>/auth/registration.php" method="post">
    <input class="first-input" aria-label="Firstname" required type="text" name="firstname" placeholder="Firstname">
    <input aria-label="Lastname" required type="text" name="lastname" placeholder="Lastname">
    <input aria-label="Email" type="email" name="email" placeholder="Email">
    <input aria-label="Password" type="password" name="pass" placeholder="Password">
    <input aria-label="Confirm Password" type="password" name="confirm" placeholder="Confirm Password">
    <input type="submit" name="submit" value="Register">
    <p>Already have an account? <a href="<?php print(ROOT_PATH); ?>/auth/login.php">Login</a></p>
</form>