@extends('layouts/dashboard.dashboard')
@section('content')

<div class="w-full h-full flex grow mt-[35px] md:mt-[40px]">
        <section class="w-full">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-4 md:mt-2 pb-24">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Machines verhuur</h1>
                </div>
            </div>
            <div class="flex flex-wrap w-full h-auto" id="page-dashboard-verhuur">
            </div>
        </div>
    </section>
</div>

@endsection