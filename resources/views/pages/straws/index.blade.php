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
                {{--  <i class="fa fa-glass"></i>  --}}
                <i style="background-image: url('/images/straws.png'); min-height: 110px;background-repeat: no-repeat;background-position: 50% 50%;"></i>
                <h2>Turtle Happiness Visualiser</h2>
                <div id='turtleMap'></div>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->

        
        
        <!-- Twitter Feed -->
        <div class="col-lg-6 col-md-6">
            <div class="social-box straws">
                <i style="background-image: url('/images/turtle.png'); min-height: 110px;background-repeat: no-repeat;background-position: 50% 53%;"></i>
                <h2>Turtleometer</h2>              
                <div id="div-turtleometer"></div>
                {{--  <p><a class="btn btn-primary" href="straws/report" style="color: white !important; margin-top: 10px; font-size: 12px; background-color: #5E9950; border-color: #5E8850; margin-bottom: 30px;">Click here to report a straw</a></p>  --}}
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->


        
        <!-- Twitter Feed -->
        <div class="col-lg-6 col-md-6">
            <div class="social-box straws">
                <i style="background-image: url('/images/straws.png'); min-height: 110px;background-repeat: no-repeat;background-position: 50% 53%;"></i>
                <h2>Turtle's Best Friends</h2>
                <?php $num = 1; ?>
                <p>
                    @foreach($turtleFriends as $turtleFriend)
                <b>#{{ $num }}: </b>{{ $turtleFriend->name }}<br>
                        <?php $num += 1; ?>
                    @endforeach
                </p>
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
        var infowindow = null;


        function initMap() {
            var nottingham = {lat: 52.954783, lng: -1.158109};
            var map = new google.maps.Map(document.getElementById('turtleMap'), {
                zoom: 14,
                center: nottingham
            });

            infowindow = new google.maps.InfoWindow({
                content: "holding..."
            });

            // var markers= 

            var markers = {!! json_encode($turtleMarkers) !!};;

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; i++) {
                
                var contentString = "<div><h1>" + markers[i].name + " </h1><p>Something turtles</p></div>";
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(markers[i].latitude), lng: parseFloat(markers[i].longitude)},
                    map: map,
                    icon: markers[i].happyStraws < markers[i].sadStraws ? "/images/sad-turtle.png" : "/images/happy-turtle.png",
                    title: markers[i].name,
                    html: getInfoWindow(markers[i].name, markers[i].happyStraws, markers[i].sadStraws)
                });

                google.maps.event.addListener(marker, 'click', function () {
                    // where I have added .html to the marker object.
                    infowindow.setContent(this.html);
                    infowindow.open(map, this);
                });

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

        function getInfoWindow(name, happyStraws, sadStraws) {
            return "<div class='info-window'><h1>" + name + "</h1><p>" + (happyStraws > sadStraws ? "This place loves turtles!" : "This place doesn't care about turtles!") + "</p><p>They have a " + parseInt(( 100 / (happyStraws + sadStraws) ) * happyStraws) + "% happy turtle rating!</p></div>";
        }

        
    </script>
@endsection