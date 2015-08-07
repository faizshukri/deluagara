<div id='map-front'></div>

@section('header')
    @parent
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    @parent

    <script>
        (function(){

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
                            var content =
                                '<div class="media">'+
                                    '<div class="media-left">'+
                                        '<a href="#">'+
                                            '<img style="width: 55px;" class="media-object" src="'+ layer.feature.properties.profile_image +'" alt="'+layer.feature.properties.name+'">'+
                                        '</a>'+
                                    '</div>'+
                                    '<div class="media-body">'+
                                        '<h4 class="media-heading" style="font-weight: bold;">' +
                                            '<a href="'+layer.feature.properties.username+'">'+layer.feature.properties.name+'</a>' +
                                        '</h4>'+
                                        layer.feature.properties.city +
                                    '</div>'+
                                '</div>';
                            layer.bindPopup(content);
                            clusterGroup.addLayer(layer);
                        });
                        map.addLayer(clusterGroup);
                    });

                map.on('popupopen', function(e){
                    var px = map.project(e.popup._latlng); // find the pixel location on the map where the popup anchor is
                    px.y -= e.popup._container.clientHeight/2; // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                    map.panTo(map.unproject(px),{animate: true}); // pan to new center
                });
            };
        })();

    </script>
@endsection
