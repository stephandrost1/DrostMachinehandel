@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper">
    <form action="{{ route("dealer-login-action") }}" method="POST">
        @csrf

        @if (Session::has('errors'))
            <div class="bg-red-500 text-white p-4 rounded">
                <ul>
                    @foreach (Session::get('errors')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <input name="email" class="text-black" />
        <input name="password" class="text-black" type="password">
        <button type="submit">Inloggen</button>
    </form>
</div>

@endsection