<form action="<?php print(ROOT_PATH); ?>/user/update_profile.php" method="POST" enctype="multipart/form-data">
    <label class="first-input" for="proile-pic">Profile Picture</label>
    <input type="file" name="profile-pic" id="profile-pic">
    <label for="firstname">First Name</label>
    <input type="text" required name="firstname" id="firstname" value="<?php print($_SESSION["firstname"]) ?>">
    <label for="lastname">Last Name</label>
    <input type="text" required name="lastname" id="lastname" value="<?php print($_SESSION["lastname"]) ?>">
    <label for="email">Email</label>
    <input type="email" required name="email" id="email" value="<?php print($_SESSION["email"]) ?>">
    <label for="bio">Bio</label>
    <input type="text" name="bio" id="bio" value="<?php print($_SESSION["bio"]) ?>">
    <input type="submit" name="submit" value="Save">
</form>