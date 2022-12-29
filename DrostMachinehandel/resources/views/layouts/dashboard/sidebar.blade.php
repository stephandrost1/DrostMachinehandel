        <nav aria-label="alternative nav" class="bg-gray-800">
            <div class="bg-gray-800 h-20 md:h-screen fixed bottom-0 mt-12 md:relative z-10 w-full md:w-48 content-center">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between overflow-auto">
                    <ul class="list-reset flex flex-row md:flex-col mt-3 md:my-3 mx-1 md:mx-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-verhuur") }}" class="@if(Request::is('dashboard/verhuur')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-truck-loading"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Verhuur</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-vehicles") }}" class="@if(Request::is('dashboard/vehicles')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-truck-pickup"></i></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Machines</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-dealers") }}" class="@if(Request::is('dashboard/dealers')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-users"></i></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Handelaren</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-statistics") }}" class="@if(Request::is('dashboard/statistics')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-chart-bar"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Statistieken</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-reservations") }}" class="@if(Request::is('dashboard/reservations')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-file-invoice"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Reserveringen</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-account") }}" class="@if(Request::is('dashboard/account')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-user"></i></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Account</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>