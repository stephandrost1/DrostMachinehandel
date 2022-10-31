@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="verhuur-wrapper px-5 md:px-20 py-7">
    <div class="verhuur-content">
            <div class="filter-wrapper" style="flex-basis: 25%">
                <div class="result-amount result-amount-mobile">{{ count($machines) }} Resultaten gevonden</div>
                <div class="filter-button">
                    Filter
                </div>
                <div class="filters">
                    <div class="filter-wrapper">
                        <span class="filter-name">Categorie
                            <i class="fas fa-chevron-up filter-arrow"></i>
                        </span> </br>
                        <div class="filter-items-wrapper">
                            <input type="checkbox" class="filter-item"> Machine </br>
                        </div>
                    </div>
                    <div class="filter-wrapper">
                        <span class="filter-name">Merk 
                            <i class="fas fa-chevron-up filter-arrow"></i>
                        </span> </br>
                        <div class="filter-items-wrapper">
                            <input type="checkbox" class="filter-item accent-pink-500"> John Deere </br>
                            <input type="checkbox" class="filter-item"> Lamborghini </br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="results-content">
                <div class="result-amount result-amount-desktop">{{ count($machines) }} Resultaten gevonden</div>
                <div class="machines-wrapper">
                    @foreach ($machines as $machine)
                        <div class="vehicle-card swiper-slide">
                            <div class="thumbnail-wrapper">
                                <img src="https://www.voorraadmodule.nl/i/TMggcgJPmo3HhU4a1PLo_dijFlq3iD_gkxw4tee61AaZ6g==/Hangcha-stapelaar-elektrische-hefhoogte-330-cm-1.jpg" class="vehicle-thumbnail">
                            </div>
                            <div class="card-body">
                                <div class="vehicle-description-content">
                                    <a class="vehicle-title">{{ $machine->vehicle_name }}</a>
                                        <div class="vehicle-description">
                                            <ul class="description-list">
                                                @foreach ($machine->details as $detail)
                                                    <li class="description-item">{{ $detail->detail_value }}</li>
                                                @endforeach
                                                <li class="description-item">test 2</li>
                                                <li class="description-item">test 3</li>
                                                <li class="description-item">test 4</li>
                                                <li class="description-item">test 5</li>
                                                <li class="description-item">test 6</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="vehicle-price-content">
                                        <div class="vehicle-price-wrapper">
                                        <span class="vehicle-price">
                                                €&nbsp;{{ $machine->price_per_day }} 
                                            <span class="vehicle-price-time">Per dag</span>
                                        </span>
                                        <span class="vehicle-price-sub-text">Excl. BTW</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
</div>


@endsection