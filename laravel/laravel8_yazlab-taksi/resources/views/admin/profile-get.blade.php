@extends('layouts.admin')
@section('title','Admin Anasayfa')
<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <form action="{{route('profile-post')}}" method="post">
                    @csrf

                    <div class="input-group mt-2">
                        <span class="input-group-text bg-dark text-white col-md-auto">Kullanıcının Taksi Plakası</span>

                        <div class="col-md-9 pl-md-3 px-0">
                            <select name="car" class="form-control col-9 ">
                                <option @if($carInfos[$user->id]->car_id == 3) selected="selected"
                                        @endif value="3">araba3
                                </option>

                                <option @if($carInfos[$user->id]->car_id == 7) selected="selected"
                                        @endif value="7">araba 7
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mt-2">
                        <span class="input-group-text bg-dark text-white col-md-3">Dakika Bilgisi</span>

                        <div class="col-md-9 pl-md-3 px-0">
                            <input type="text" class="form-control" name="minute" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<div id="map"></div>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYasWKE9kbmpllu8LBx-rvYAZnbgmgxfk&callback=initMap&v=weekly"
    async></script>

<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        const uluru = {lat: <?= $firstLocInfo["x"] ?>, lng: <?= $firstLocInfo["y"] ?>};
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }
</script>
