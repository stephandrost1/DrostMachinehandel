@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="dealer-create-wrapper text-black px-5 block md:px-20 py-12" id="page-dealer-create">
    <form action="{{ route("dealer-create-request") }}" method="POST" class="create-dealer-account">
        @csrf

        @if (isset($status)) {
            {{ $status }}
        }
        @endif

        @if ($errors) {
            @foreach($errors as $key => $value)
                {{ $value }}
            @endforeach
        }
        @endif

        <div class="header block">
            <h1 class="title text-center text-lg font-bold">Handelaars account aanmaken</h1>
        </div>
        <div class="body">
            <div class="form-group">
                <div class="form-item">
                    <label class="form-item-label border-transparent" for="firstname">Voornaam</label>
                    <input class="form-item-input" type="text" id="firstname" name="firstname">
                </div>
                <div class="form-item">
                    <label class="form-item-label" for="lastname">Achternaam</label>
                    <input class="form-item-input" type="text" id="lastname" name="lastname">
                </div>
            </div>
            <div class="form-item">
                <label class="form-item-label" for="email">E-mailadres</label>
                <input class="form-item-input" type="email" id="email" name="email">
            </div>
            <div class="form-item">
                <label class="form-item-label" for="phonenumber">Telefoon nummer</label>
                <input class="form-item-input" type="text" id="phonenumber" name="phonenumber">
            </div>
            <div class="form-item">
                <label class="form-item-label" for="companyname">Bedrijfsnaam</label>
                <input class="form-item-input" type="text" id="companyname" name="companyname">
            </div>
            <div class="form-item">
                <label class="form-item-label" for="kvknumber">KVK nummer</label>
                <input class="form-item-input" type="text" id="kvknumber" name="kvknumber">
            </div>
            <div class="form-item">
                <label class="form-item-label" for="password">Wachtwoord</label>
                <input class="form-item-input" type="text" id="password" name="password">
            </div>
            <div class="form-item">
                <label class="form-item-label" for="password-repeat">Wachtwoord herhalen</label>
                <input class="form-item-input" type="text" id="password-repeat" name="password-repeat">
            </div>
            <div class="form-item no-style terms">
                <p>Wanneer u een account aanmaakt geeft u de beheerder toestemming om uw gegevens te gebruiken om uw account te controleren.</p>
            </div>
            <div class="form-item no-style submit-form">
                <button type="submit" class="form-item-input">Account aanvragen</button>
            </div>
        </div>
    </form>
</div>

@endsection