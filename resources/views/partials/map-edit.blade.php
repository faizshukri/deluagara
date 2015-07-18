<div id='map-edit' style="width: 100%; height: 200px; border: 1px solid #aaa;"></div>

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

                var coord = user.location && user.location.latitude ? [user.location.latitude, user.location.longitude] : [user_coord.latitude, user_coord.longitude];
                var map      = L.mapbox.map('map-edit', 'mapbox.streets').setView(coord, 18),
                    geocoder = L.mapbox.geocoder('mapbox.places');

                var marker_option = {
                    icon: L.mapbox.marker.icon({'marker-symbol': 'building', 'marker-color': '#548cba'}),
                    draggable: true
                };

                if(user.location) {
                    var marker = L.marker(new L.LatLng(user.location.latitude, user.location.longitude), marker_option);
                } else {
                    var marker = L.marker(new L.LatLng(user_coord.latitude, user_coord.longitude), marker_option);
                }
                map.addLayer(marker);

                var address_elems = ['input[name="location[street]"]', 'input[name="location[postcode]"]', 'input[name="location[city][name]"]'];
                address_elems.forEach(function (elem) {
                    var elem = $(elem);

                    // For every input change
                    elem.change(function (e) {

                        // Search by concatenating value of street, postcode, and city name
                        geocoder.query($(address_elems[0]).val() + ', ' + $(address_elems[1]).val() + ', ' + $(address_elems[2]).val(), function(err, data){
                            if (data.lbounds) {
                                map.fitBounds(data.lbounds);
                            } else if (data.latlng) {
                                map.setView([data.latlng[0], data.latlng[1]], 18);
                            }
                            if (data.latlng) {
                                marker.setLatLng( data.latlng );
                                addLatLng();
                            }
                        });
                    });
                });

                marker.on('dragend', function(e){
                    addLatLng();
                });

                function addLatLng(){
                    var latlng = marker.getLatLng();
                    $('input[name="location[latitude]').val(latlng.lat);
                    $('input[name="location[longitude]').val(latlng.lng);
                }
            };

        })();

    </script>
@endsection
