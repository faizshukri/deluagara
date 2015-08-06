@if(!$user->location)
    <div align="center" class="alert alert-info">
        User didn't create his/her location yet
    </div>
@endif
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
            var user_coord = {!! json_encode($user_coord) !!};

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";

                var coord = user.location && user.location.latitude ? [ user.location.latitude, user.location.longitude ] : [ user_coord.latitude, user_coord.longitude ] ;
                var map = L.mapbox.map('map-account', 'mapbox.streets').setView(coord, 14);

                if(!user.location) return;

                var marker = L.marker(new L.LatLng(user.location.latitude, user.location.longitude), {
                    icon: L.mapbox.marker.icon({'marker-symbol': 'building', 'marker-color': '#548cba'})
                });
                marker.bindPopup(user.location.city.name);
                map.addLayer(marker);

                map.on('popupopen', function(e){
                    var px = map.project(e.popup._latlng); // find the pixel location on the map where the popup anchor is
                    px.y -= e.popup._container.clientHeight/2; // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                    map.panTo(map.unproject(px),{animate: true}); // pan to new center
                });
            };
        })();

    </script>
@endsection
