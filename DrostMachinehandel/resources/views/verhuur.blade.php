@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="verhuur-wrapper px-5 md:px-20 py-7">
  <div class="flex gap-5">
    @foreach($filters as $key => $value)
        <div class="bg-white m-8 p-3">
            <label class="text-black">{{ $value["filter_name"] }}</label>
            <select>
                @foreach($value["getFilterOptions"] as $key => $value1)
                    <option class="text-black">{{ $value1["name"] }}</option>
                @endforeach
            </select>
        </div>
    @endforeach
      
    </div>
</div>


@endsection