@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="verhuur-wrapper px-5 md:px-20 py-7">
    <div class="verhuur-content">
            <div class="total-filter-wrapper">
                <div id="result_amount_mobile" class="result-amount result-amount-mobile">{{ count($machines) }} Resultaten gevonden</div>
                <div id="hide_filters" class="close-filters-button">
                    <span class="hide-filter-text">Filters</span>
                    <span style="float: right;" onclick="hideFilters()"><i class="fas fa-times"></i></span>
                </div>
                <div id="filter_button" onclick="showFilters()" class="filter-button">
                    Filter
                </div>
                <div id="active_filters" class="active-filters">
                    <div>
                        <div class="active-filter">
                            <span class="delete-filter-button">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="delete-filter-name">
                                Machine (4)
                            </span>
                        </div>
                        <div class="active-filter">
                            <span class="delete-filter-button">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="delete-filter-name">
                                BT (4)
                            </span>
                        </div>
                    </div>
                    <div class="delete-active-filters">Verwijder alle filters</div>
                </div>
                <div id="filters" class="filters">
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
            <div id="results_content" class="results-content">
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

<script>
    function showFilters() {
      var filters = document.getElementById("filters");
      var hide_filters = document.getElementById("hide_filters");
      var active_filters = document.getElementById("active_filters");
      var filter_button = document.getElementById("filter_button");
      var result_amount_mobile = document.getElementById("result_amount_mobile");
      var results_content = document.getElementById("results_content");

        filters.style.display = "block";
        hide_filters.style.display = "block";
        active_filters.style.display = "block";

        results_content.style.display = "none";
        filter_button.style.display = "none";
        result_amount_mobile.style.display = "none";
    }

    function hideFilters() {
        var filters = document.getElementById("filters");
        var hide_filters = document.getElementById("hide_filters");
        var active_filters = document.getElementById("active_filters");
        var filter_button = document.getElementById("filter_button");
        var result_amount_mobile = document.getElementById("result_amount_mobile");
        var results_content = document.getElementById("results_content");


        hide_filters.style.display = "none";
        filters.style.display = "none";
        active_filters.style.display = "none";

        filter_button.style.display = "block";
        results_content.style.display = "block";
        result_amount_mobile.style.display = "block";
        
    }
</script>


@endsection