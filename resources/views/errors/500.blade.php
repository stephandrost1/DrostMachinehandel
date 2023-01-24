@extends('layouts.app')
 
@section('title', 'Leasen')
 
@section('sidebar')
    @parent
@endsection

@section('content')

<hr class="w-full h-3 bg-primary border-none">

<div class="px-5 md:px-20 py-7">

    <div class="flex flex-col items-center justify-center">

        <img src="{{ asset('/img/errors/505.png') }}" class="lg:w-4/12" alt="logo" />
  
        <h1 class="font-bold text-5xl text-center">Er is aan onze kant iets fout gegaan! <br> Probeer het later opnieuw.</h1>

    </div>
    
  
</div>

@endsection