<div id='map-front'></div>

@section('header')
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    <script>
        (function(){

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-front', 'mapbox.streets')
                        .setView([ {{ $location['latitude'] }}, {{ $location['longitude'] }} ], 14);
            };
        })();

    </script>
@endsection