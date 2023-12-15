<header class="w-full h-header shadow-sm md:shadow-md lg:shadow-lg">
    <div class="wrapper w-sm-container sm:w-container w-4/5 mx-auto h-full">
        <nav class="flex items-center justify-between h-full">
            <div id="logo-container" class="h-full">
                <a href="/" class="h-full">
                    <img class="min-w-[6rem] w-1/2 h-full" src="/assets/floptube_complete_logo.svg" alt="FlopTube Logo" />
                </a>
            </div>
            <div class="hover:cursor-pointer burger z-[100] sm:hidden">
                <div class="origin-left rounded line first w-burger-line-w h-burger-line-h bg-black m-1"></div>
                <div class="origin-left rounded line second w-burger-line-w h-burger-line-h bg-black m-1"></div>
                <div class="origin-left rounded line third w-burger-line-w h-burger-line-h bg-black m-1"></div>
            </div>
            <ul class="uppercase text-sm links bg-white absolute justify-around h-1/2 w-screen top-0 left-[100vw] flex flex-col sm:flex-row sm:bg-transparent sm:static sm:justify-end items-center list-none">
                <li class="hover:text-ft-red p-sm-nav-links md:p-md-nav-links lg:p-lg-nav-links"><a href="/">Home</a></li>
                <li class="hover:text-ft-red p-sm-nav-links md:p-md-nav-links lg:p-lg-nav-links"><a href="#">Videos</a></li>
                <li class="hover:text-ft-red p-sm-nav-links md:p-md-nav-links lg:p-lg-nav-links"><a href="#">Login</a></li>
                <li class="hover:text-ft-red p-sm-nav-links md:p-md-nav-links lg:p-lg-nav-links"><a href="/auth/registration.php">Register</a></li>
            </ul>
        </nav>
    </div>
</header>
<script src="/scripts/js/menu_animation.js"></script>