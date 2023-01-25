@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
    <div class="page-back-button">
        <a class="back-button" href="{{ route("verhuur") }}"><i class="fas fa-chevron-left back-arrow text-white"></i><span>Terug naar overzicht</span></a>
      </div>

    <div class="detail-wrapper">
        <div id="get-vehicle-id" class="hidden" data-vehicleid="{{$vehicle->id}}"></div>
        <div class="reservation-popup hidden" id="reservation-popup-rent-detail"></div>
        <div class="images-specs-wrapper">
            <div class="images-wrapper select-none">
                <div id="dm-images-slider-app"></div>
                <div id="vehicle-id" data-vehicleid="{{ $vehicle->id }}"></div>
            </div>
            <div class="specs-wrapper">
                <div class="vehicle-title">{{ $vehicle->vehicle_name }}</div>
                <div class="specs">
                    @foreach($vehicle->details as $key => $detail)
                        <div class="spec">
                            <div class="spec-type">
                                <span class="type">{{ $detail["detail_name"] }}</span>
                                <span class="colon">:</span>
                            </div>
                            <div class="spec-value">{{ $detail["detail_value"] }}</div>
                        </div>
                    @endforeach
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Aantal beschikbaar</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">{{ $vehicle->stock }}</div>
                    </div>
                </div>
                <div class="price-block">
                    <div class="price-wrapper">
                        <div class="price price-per-day">
                            € {{$vehicle->price_per_day}},-
                        </div>
                        <div class="price-btw">per Dag</div>
                    </div>
                    <div class="price-wrapper">
                        <div class="price price-per-week">
                            € {{$vehicle->price_per_week}},-
                        </div>
                        <div class="price-btw">per Week</div>
                    </div>
                </div>
                <div class="contact-wrapper">
                    <div class="contact-button cursor-pointer reserve-button">Reserveren</div>
                    <a href="{{ route("contact") }}" class="contact-button">Contact</a>
                </div>
                <div class="share-wrapper">
                    <div class="share-text">Deel deze pagina:</div>
                    <div class="share-links">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode("Bekijk deze machine op: " . request()->url()) }}" class="link">
                            <span><i class="fab fa-whatsapp icon"></i></span>
                            <span>Whatsapp</span>
                        </a>
                        <a href="mailto:?subject={{ urlencode('Bekijk deze machine op drostmachinehandel.nl') }}&body={{ urlencode('Link: ' .request()->url()) }}" class="link">
                            <span><i class="far fa-envelope-open icon"></i></span>
                            <span>E-mail</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection