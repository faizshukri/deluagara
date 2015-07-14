<div id='map-account' style="width: 100%; height: 200px; border: 1px solid #aaa;"></div>

@section('header')
    @parent
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    @parent

    <script>
        (function(){

            var user = {!! $user->load('location.city')->toJson() !!};

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-account', 'mapbox.streets')
                        .setView([ user.location.latitude, user.location.longitude ], 13);

                var marker = L.marker(new L.LatLng(user.location.latitude, user.location.longitude), {
                    icon: L.mapbox.marker.icon({'marker-symbol': 'building', 'marker-color': '#548cba'})
                });
                marker.bindPopup(user.location.city.name);
                map.addLayer(marker);
            };
        })();

    </script>
@endsection
