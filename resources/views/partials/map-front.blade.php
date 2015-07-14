<div id='map-front'></div>

@section('header')
    @parent
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    @parent

    <script>
        (function(){

            var locations = {!! $locations->toJson() !!};

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-front', 'mapbox.streets')
                        .setView([ {{ $user_coord['latitude'] }}, {{ $user_coord['longitude'] }} ], 13);

                map.scrollWheelZoom.disable();

                var featureLayer = L.mapbox.featureLayer()
                    .loadURL('/api/v1/locations.geojson')
                    .on('ready', function(e) {
                        var clusterGroup = new L.MarkerClusterGroup();
                        e.target.eachLayer(function(layer) {
                            clusterGroup.addLayer(layer);
                        });
                        map.addLayer(clusterGroup);
                    }).on('click', function(e) {
                        map.panTo(e.layer.getLatLng());
                    });
            };
        })();

    </script>
@endsection
