        <nav aria-label="alternative nav">
            <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-tasks") }}" class="@if(Request::is('dashboard/tasks')) border-pink-500 text-pink-500 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2 border-gray-800">
                                <i class="fas fa-tasks"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Tasks</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-messages") }}" class="@if(Request::is('dashboard/messages')) border-purple-500 text-purple-500 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underlinehover:text-white hover:border-white border-b-2 border-gray-800">
                                <i class="fas fa-comments"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Messages</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-analytics") }}" class="@if(Request::is('dashboard/analytics')) border-blue-600 text-blue-500 @endif flex items-center gap-2 block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2 border-gray-800">
                                <i class="fas fa-chart-bar"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Analytics</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route("dashboard-payments") }}" class="@if(Request::is('dashboard/payments')) border-red-500 text-red-500 @endif flex items-center gap-2 block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white hover:border-white border-b-2 border-gray-800">
                                <i class="fas fa-file-invoice"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">Payments</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>