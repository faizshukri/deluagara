<div id='map-result' style="width: 100%; height: 200px; border: 1px solid #aaa;"></div>

@section('header')
    @parent
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    @parent

    <script>
        (function(){

            var users = {!! $users->map(function($user, $key){ return $user->getMarkerInfo(); })->toJson() !!};
                users = {
                    type: "FeatureCollection",
                    features: users
                };

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-result', 'mapbox.streets')
                        .setView([ {{ $user_coord['latitude'] }}, {{ $user_coord['longitude'] }} ], 12);

                if(users.features.length <= 0) return;

                var featureLayer = L.mapbox.featureLayer(users)

                map.on('popupopen', function(e){
                    var px = map.project(e.popup._latlng); // find the pixel location on the map where the popup anchor is
                    px.y -= e.popup._container.clientHeight/2; // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                    map.panTo(map.unproject(px),{animate: true}); // pan to new center
                });

                setTimeout(function(){
                    var clusterGroup = new L.MarkerClusterGroup();
                    featureLayer.eachLayer(function(layer) {
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
                    map.addLayer(clusterGroup).fitBounds(clusterGroup.getBounds());
                }, 500);
            };
        })();

    </script>
@endsection
