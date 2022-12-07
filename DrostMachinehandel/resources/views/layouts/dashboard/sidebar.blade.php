        <nav aria-label="alternative nav">
            <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-verhuur") }}" class="@if(Request::is('dashboard/verhuur')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-truck-loading"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Verhuur</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-dealer-requests") }}" class="@if(Request::is('dashboard/dealer-requests')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-exclamation-circle"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Aanvragen</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-analytics") }}" class="@if(Request::is('dashboard/analytics')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-chart-bar"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Analytics</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-payments") }}" class="@if(Request::is('dashboard/payments')) border-primary text-primary @else border-gray-800 @endif flex items-center gap-2 block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2">
                                <i class="fas fa-file-invoice"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Payments</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>