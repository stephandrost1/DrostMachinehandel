<header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap justify-between items-center">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <a href="{{ route("dashboard") }}" aria-label="Home">
                    <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-8 md:h-12 pt-3 pl-1" alt="logo" />
                </a>
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <div id="profile-wrapper" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> Hallo, {{ auth()->user()->email }} <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></div>
                            <div id="profile-dropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 w-28 mt-3 p-3 overflow-auto z-30 invisible">
                                <a href="#" class="flex justify-between items-center p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                                <div class="border border-white"></div>
                                <a href="#" class="flex justify-between items-center p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>