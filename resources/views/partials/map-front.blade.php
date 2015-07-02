<div id='map-front'></div>

@section('header')
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    <script>
        (function(){

            var locations = {!! $locations->toJson() !!};

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-front', 'mapbox.streets')
                        .setView([ {{ $user_coord['latitude'] }}, {{ $user_coord['longitude'] }} ], 13);

                var featureLayer = L.mapbox.featureLayer()
                    .loadURL('/api/v1/locations.geojson')
                    .on('ready', function(e) {
                        var clusterGroup = new L.MarkerClusterGroup();
                        e.target.eachLayer(function(layer) {
                            clusterGroup.addLayer(layer);
                        });
                        map.addLayer(clusterGroup);
                    });
            };
        })();

    </script>
@endsection
