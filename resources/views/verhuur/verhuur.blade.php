@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="verhuur-wrapper px-5 md:px-20 py-7" id="page-verhuur-app"></div>

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