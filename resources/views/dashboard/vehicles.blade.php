@extends('layouts/dashboard.dashboard')
@section('content')

<div class="w-full h-full mt-[35px] md:mt-[40px] flex grow">
        <section class="w-full">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-4 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Machines prijzen instellen handelaren</h1>
                </div>
            </div>
            <div class="flex flex-wrap bg-gray-100 w-full h-full" id="page-dashboard-dealer-vehicles">
            </div>
        </div>
    </section>
</div>

@endsection