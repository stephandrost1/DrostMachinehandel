<header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
        <div class="flex flex-row justify-between items-center md:pr-10">
            <div>
                <a href="{{ route("home") }}" aria-label="Home">
                    <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-14 sm:h-[5rem] md:h-12 pt-3 pb-3 pl-1" alt="logo" />
                </a>
            </div>

            <div>
                <div class="group inline-block relative">
                    <button
                        class="inline-flex items-center font-bold"
                    >
                        <span class="mr-1 text-white">Hallo, {{ auth()->user()->email }}</span>
                        <i class="fas fa-chevron-down text-white"></i>
                    </button>
                    <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                        <li>
                        <a
                            class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap"
                            href="{{ route("home") }}"
                            >Homepagina</a
                        >
                        </li>
                        <li class="cursor-pointer">
                        <form method="POST" action="{{ route('logout') }}"
                            class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap"
                            >@csrf<button type="submit">Uitloggen</button></form
                        >
                        </li>
                    </ul>
                    </div>
            </div>
        </div>
    </nav>
</header>