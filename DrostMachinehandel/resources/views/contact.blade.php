@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper">
   <div class="col-left">
    <div class="form-wrapper">
      <div class="header">
        <h1 class="title">{{ __('/content/contact.title') }}</h1>
        <p class="subtitle">{{ __('/content/contact.subtext') }}</p>
      </div>
      @if (!isset($statusCode)) 
        <form class="form" action="contact" method="POST">
          @csrf
          {{-- <div class="form-group">
            <div class="form-item">
              <label for="firstname">{{ __('/content/contact.firstname') }} *</label>
              <input required type="text" name="firstname" placeholder="{{ __('/content/contact.firstname-placeholder') }}">
            </div>
            <div class="form-item">
              <label for="lastname">{{ __('/content/contact.lastname') }} *</label>
              <input required type="text" name="lastname" placeholder="{{ __('/content/contact.lastname-placeholder') }}">
            </div>
          </div> --}}
    
          <div class="form-item">
            <label for="email">{{ __('/content/contact.email') }} *</label>
            <input required type="email" name="email" placeholder="{{ __('/content/contact.email-placeholder') }}">
          </div>
          <div class="form-item">
            <label for="phonenumber">{{ __('/content/contact.phonenumber') }}</label>
            <input type="text" name="phonenumber" placeholder="{{ __('/content/contact.phonenumber-placeholder') }}">
          </div>
          <div class="form-item">
            <label for="message">{{ __('/content/contact.message') }} *</label>
            <textarea required name="message"></textarea>
          </div>
          <div class="form-item">
            <button type="submit">{{ __('/content/contact.send-button') }}</button>
          </div>
        </form>
      @elseif (isset($statusCode) && $statusCode == 200)  
        <div class="contact-send-status">
          <p>Bedankt voor uw bericht, we nemen zo snel mogelijk contact met u op!</p>
          <p>Nieuw bericht versturen? <a href="/contact">klik hier</a></p>
        </div>
      
      @else
        <p>Er is iets fout gegaan bij het versturen van uw bericht! <a href="/contact">Probeer het opnieuw!</a></p>
        <p>Of mail naar <b>info@drostmachinehandel.nl</b></p>
      @endif
    </div>
  </div>
  <div class="col-right">
    <div class="col-content-wrapper">
      <div class="location">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6437.295412349521!2d5.586254144159689!3d51.967911983647404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6547e04fb11bf%3A0xec31152c00df33f7!2sBoslandweg%20148%2C%203911%20VE%20Rhenen!5e0!3m2!1snl!2snl!4v1663931805330!5m2!1snl!2snl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="office-hours">
        <div class="hours-wrapper">
          <div class="contact-details">
            <h1 class="text-2xl font-bold">{{ __('content/contact.subtitle 1') }}</h1>
            <hr class="w-full h-[4px] bg-primary border-none">
            <div class="flex flex-col gap-2 ml-3 font-bold mt-1">
              <div><i class="fas fa-envelope"></i> info@drostmachinehandel.com</div>
              <div><i class="fas fa-phone-alt"></i> +31 0(6) 498 275 16</div>
              <div><i class="fas fa-map-marker-alt"></i> Boslandweg 148, Rhenen</div>
            </div>
          </div>
          <div class="hours">
            <h1 class="text-2xl font-bold">{{ __('content/contact.subtitle 2') }}</h1>
            <hr class="w-full h-[4px] bg-primary border-none">
            <div class="flex justify-between py-1 px-3"><span>{{ __('content/contact.day 1') }}</span><span>09:00-17:00</span></div>
            <div class="flex justify-between py-1 px-3 bg-secondary"><span>{{ __('content/contact.day 2') }}</span><span>09:00-17:00</span></div>
            <div class="flex justify-between py-1 px-3"><span>{{ __('content/contact.day 3') }}</span><span>09:00-17:00</span></div>
            <div class="flex justify-between py-1 px-3 bg-secondary"><span>{{ __('content/contact.day 4') }}</span><span>09:00-17:00</span></div>
            <div class="flex justify-between py-1 px-3"><span>{{ __('content/contact.day 5') }}</span><span>09:00-17:00</span></div>
            <div class="flex justify-between py-1 px-3 bg-secondary"><span>{{ __('content/contact.day 6 & 7') }}</span><span>{{ __('content/contact.closed') }}</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection