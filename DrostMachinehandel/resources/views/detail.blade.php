@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
  <div class="page-back-button">
    <a class="back-button" href="{{ route("voorraad") }}"><i class="fas fa-chevron-left back-arrow"></i><span>Terug naar overzicht</span></a>
  </div>
  <div class="flex gap-5">
      <div id="svm-canvas"></div>
    </div>
</div>

@endsection