

<?php 

    require_once(dirname(__FILE__) . "/form.php");

    class LoginForm implements IForm {
        public function render() {
            print("
                <form class=\"h-full flex flex-col justify-between\" action=\"/auth/login.php\" method=\"post\">
                    <input class=\"my-1 border focus:outline-ft-red p-4 rounded-lg\" autocomplete=\"off\" required type=\"email\" name=\"email\" placeholder=\"Email\">
                    <input class=\"my-1 border focus:outline-ft-red p-4 rounded-lg\" autocomplete=\"off\" required type=\"password\" name=\"pass\" placeholder=\"Password\">
                    <input class=\"my-1 hover:cursor-pointer rounded-lg p-4 hover:text-white hover:bg-ft-red text-ft-red border border-ft-red\" type=\"submit\" name=\"submit\" value=\"Login\">
                    <label for=\"remember_me\" class=\"text-xs sm:text-base align-middle\">
                        <input type=\"checkbox\" name=\"remember_me\"> Remember me
                    </label>
                </form>
            ");            
        }
    }

?>

