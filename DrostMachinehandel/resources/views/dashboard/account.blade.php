@extends('layouts/dashboard.dashboard')
@section('content')

<div class="w-full h-full flex grow mt-[35px] md:mt-[40px]">
        <section class="w-full">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Account instellingen</h1>
                </div>
            </div>
            
            <div class="p-10 min-[1225px]:px-32 @if (Auth::guard('web')->check()) 2xl:w-4/6 @endif">
                @if (Auth::guard('web')->check())
                    <div id="page-dashboard-admin-account"></div>
                @elseif (Auth::guard('dealer')->check())
                    <div id="page-dashboard-dealer-account"></div>
                @endif
            </div>
        </div>
    </section>
</div>

@endsection