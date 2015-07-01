<div id='map-front'></div>

@section('header')
    <link rel="stylesheet" href="/vendor/mapbox.js/mapbox.css"/>
@endsection

@section('footer')
    <script src="/vendor/mapbox.js/mapbox.js"></script>
    <script>
        (function(){

            initMap();

            function initMap() {
                L.mapbox.accessToken = "{{ env('MAPBOX_ACCESSTOKEN')  }}";
                var map = L.mapbox.map('map-front', 'mapbox.streets')
                        .setView([ {{ $location[0] }}, {{ $location[1] }} ], 14);
            };
        })();

    </script>
@endsection