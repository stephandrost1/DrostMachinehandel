@extends('layouts/dashboard.dashboard')
@section('content')

<style>
    .password-icon {
        float: right;
        margin-right: 15px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
        color: rgb(31 41 55);
        font-size: large;
        cursor: pointer;
    }
</style>

<div class="w-full h-full flex grow mt-[35px] md:mt-[40px]">
        <section class="w-full">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Account instellingen</h1>
                </div>
            </div>
            
            <div class="p-10 min-[1225px]:px-32 2xl:w-4/6">
                <div id="page-dashboard-account"></div>
            </div>
        </div>
    </section>
</div>

@endsection