<div id='map-result' style="width: 100%; height: 200px; border: 1px solid #aaa;"></div>

@section('header')
    @parent
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    @parent

    <script>
        (function(){

            var users = {!! $users->map(function($user, $key){ return $user->load('location'); })->toJson() !!};

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-result', 'mapbox.streets')
                        .setView([ {{ $user_coord['latitude'] }}, {{ $user_coord['longitude'] }} ], 12);

                if(users.length <= 0) return;

                var markers = new L.MarkerClusterGroup();

                users.forEach(function(user, index){
                    var marker = L.marker(new L.LatLng(user.location.latitude, user.location.longitude), {
                        icon: L.mapbox.marker.icon({'marker-symbol': 'building', 'marker-color': '#548cba'})
                    });
                    marker.bindPopup(user.name);
                    markers.addLayer(marker);
                });

                map.addLayer(markers).fitBounds(markers.getBounds());
            };
        })();

    </script>
@endsection
