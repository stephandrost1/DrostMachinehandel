@extends('layouts.app')
@section('content')

<hr class="w-full h-3 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
  
  <div class="mb-5">
    <h1 class="font-bold text-3xl">De totale voorraad</h1>
  </div>

  <div class="flex gap-5">
      <div class="stock text-white" id="stock-items"></div>
      <div id="svm-canvas"></div>
    </div>
</div>

@endsection