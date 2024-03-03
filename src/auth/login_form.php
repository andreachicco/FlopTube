<form action="<?php print(ROOT_PATH); ?>/auth/login.php" method="post">
    <input class="first-input" aria-label="Email" type="email" name="email" placeholder="Email">
    <input aria-label="Password" type="password" name="pass" placeholder="Password">
    <div class="remember-me">
        <input aria-label="Remember me" type="checkbox" name="remember" value="1">
        <p>Remember Me</p>
    </div>
    <input type="submit" name="submit" value="Login">
    <p>Don't have an account? <a href="<?php print(ROOT_PATH); ?>/auth/registration.php">Register</a></p>
</form>