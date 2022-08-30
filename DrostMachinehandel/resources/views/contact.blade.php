@extends('layouts.app')
 
@section('title', 'Contact')
 
@section('sidebar')
    @parent
@endsection

@section('content')

<hr class="w-full h-3 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
  
  <div class="mb-5">
    <h1 class="font-bold text-3xl">Contact</h1>
    <p>Hier informatie over contact opnemen...</p>
  </div>
  


  <div class="flex flex-wrap gap-10">
    <div class="min-w-fit grow order-2 lg:order-1">
      <iframe style="border-radius: 30px;" class="w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2458.070408120187!2d5.586690315925717!3d51.96914118465768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c65562389fb899%3A0x112e7eab2267408a!2sDrost%20Machinehandel!5e0!3m2!1sen!2snl!4v1659089766517!5m2!1sen!2snl" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="min-w-fit grow order-1 lg:order-2">
      <div>
        <h1 class="text-2xl font-bold">Contactgegevens</h1>
        <hr class="w-full h-[4px] bg-primary border-none">
        <div class="flex flex-col gap-2 ml-3 font-bold mt-1">
          <div><i class="fas fa-envelope"></i> info@drostmachinehandel.com</div>
          <div><i class="fas fa-phone-alt"></i> +31 0(6) 498 275 16</div>
          <div><i class="fas fa-map-marker-alt"></i> Boslandweg 148, Rhenen</div>
        </div>
      </div>
      <div class="mt-5">
        <h1 class="text-2xl font-bold">Openingstijden</h1>
        <hr class="w-full h-[4px] bg-primary border-none">
        <div class="flex justify-between py-1 px-3"><span>Maandag</span><span>09:00-17:00</span></div>
        <div class="flex justify-between py-1 px-3 bg-secondary"><span>Dinsdag</span><span>09:00-17:00</span></div>
        <div class="flex justify-between py-1 px-3"><span>Woensdag</span><span>09:00-17:00</span></div>
        <div class="flex justify-between py-1 px-3 bg-secondary"><span>Donderdag</span><span>09:00-17:00</span></div>
        <div class="flex justify-between py-1 px-3"><span>Vrijdag</span><span>09:00-17:00</span></div>
        <div class="flex justify-between py-1 px-3 bg-secondary"><span>Zaterdag & zondag</span><span>Gesloten</span></div>
      </div>

    </div>
  </div>

  
</div>

@endsection