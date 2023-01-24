@extends('layouts.app')
 
@section('title', 'Leasen')
 
@section('sidebar')
    @parent
@endsection

@section('content')

<hr class="w-full h-3 bg-primary border-none">

<div class="px-5 md:px-20 py-7">

    <div class="flex flex-col items-center justify-center">

        <img src="{{ asset('/img/errors/404.png') }}" class="lg:w-4/12" alt="logo" />
  
        <h1 class="font-bold text-5xl text-center">De pagina die je probeert te bezoeken <br> bestaat niet!</h1>

    </div>
    
  
</div>

@endsection