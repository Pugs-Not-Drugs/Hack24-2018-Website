@extends('layouts.app')

@section('content')

    <style>
       #turtleMap {
        height: 600px;
        width: 100%;
       }
    </style>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Straws</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="/">Dashboard</a></li>
                        <li class="active">Straws</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        @if(!empty($success_message))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Success</span> {{ $success_message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
            
        <!-- Twitter Feed -->
        <div class="col-lg-12 col-md-12">
            <div class="social-box straws">
                <i class="fa fa-anchor"></i>

                <div id='turtleMap'></div>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->

        
        
        <!-- Twitter Feed -->
        <div class="col-lg-6 col-md-6">
            <div class="social-box pollution">
                <i class="fa fa-anchor"></i>                    
                <div id="div-turtleometer"></div>
                <p><a href="straws/report">Click here to report a straw</a></p>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->


        
        <!-- Twitter Feed -->
        <div class="col-lg-6 col-md-6">
            <div class="social-box recycle">
                <i class="fa fa-recycle"></i>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->
   
    </div> <!-- .content -->

    <!-- Right Panel -->
@endsection

@section('js_content')
    <script type='text/javascript' src="/assets/js/turtleometer.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCadA9-6PJqd9mvG7xCdMssoxk2DG7gqrE&callback=initMap"></script>
    <script type='text/javascript'>
        
        function initMap() {
            var nottingham = {lat: 52.954783, lng: -1.158109};
            var map = new google.maps.Map(document.getElementById('turtleMap'), {
                zoom: 14,
                center: nottingham
            });

            var markers = [
                {id: 1, name: "Burger King", latitude: 52.854783, longitude: -1.158109, straws: 1},
                {id: 2, name: "Five Guys", latitude: 52.754783, longitude: -1.158109, straws: 0},
                {id: 3, name: "MOD Pizza", latitude: 52.354783, longitude: -1.158109, straws: 1},
            ];

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; i++) {
                
                var contentString = "<div><h1>" + markers[i].name + " </h1><p>Something turtles</p></div>";
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: {lat: markers[i].latitude, lng: markers[i].longitude},
                    map: map,
                    icon: markers[i].straws ? "/images/sad-turtle.png" : "/images/happy-turtle.png",
                    title: markers[i].name
                });

                // marker.addListener('click', function() {
                //     infowindow.open(map, marker);
                // });

                bounds.extend(marker.getPosition());
            }


            google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
                this.setZoom(map.getZoom()-1);

                if (this.getZoom() > 15) {
                    this.setZoom(15);
                }
            });

            map.fitBounds(bounds)

        }

        
    </script>
@endsection