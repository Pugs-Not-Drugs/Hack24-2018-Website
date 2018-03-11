@extends('layouts.app')

@section('content')

    <style>
       #recycleMap {
        height: 600px;
        width: 100%;
       }
    </style>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Recycling</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="/">Dashboard</a></li>
                        <li class="active">Recycling</li>
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
            <div class="social-box foodbank">
                <i class="fa fa-recycle"></i>
                <h2>Local Recycling Centres</h2>
                <div id='recycleMap'></div>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->

        
        <style>
        
        </style>
        <!-- Twitter Feed -->
        <div class="col-lg-12 col-md-12">
            <div class="social-box foodbank">
                <style>
                    .recycle-container {
                        margin-bottom: 30px;
                    }
                    .recycle-option img {
                        height: 40px;
                    }
                </style>
                <i class="fa fa-recycle"></i>
                <h2>What to recycle where</h2>

                <div class="col-1 recycle-option" id="recycling-options">
                    <a href="/recycling"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px;" src="/images/recycling/ALL.png" alt="ALL"></a><br>
                    <span>All</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=CLEAR_GLASS"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'CLEAR_GLASS' ? 'border: black 1px solid' : '' }}" src="/images/recycling/CLEAR_GLASS.png" alt="CLEAR_GLASS"></a><br>
                    <span>Clear Glass</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=GREEN_GLASS"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'GREEN_GLASS' ? 'border: black 1px solid' : '' }}" src="/images/recycling/GREEN_GLASS.png" alt="GREEN_GLASS"></a><br>
                    <span>Green Glass</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=BROWN_GLASS"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'BROWN_GLASS' ? 'border: black 1px solid' : '' }}" src="/images/recycling/BROWN_GLASS.png" alt="BROWN_GLASS"></a><br>
                    <span>Brown Glass</span>
                </div>
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=CANS_TINS"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'CANS_TINS' ? 'border: black 1px solid' : '' }}" src="/images/recycling/TINS_CANS.png" alt="CANS_TINS"></a><br>
                    <span>Cans Tins</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=TEXTILES"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'TEXTILES' ? 'border: black 1px solid' : '' }}" src="/images/recycling/TEXTILES.png" alt="TEXTILES"></a><br>
                    <span>Textiles</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=OIL"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'OIL' ? 'border: black 1px solid' : '' }}" src="/images/recycling/OIL.png" alt="OIL"></a><br>
                    <span>Oil</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=PLASTIC"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'PLASTIC' ? 'border: black 1px solid' : '' }}" src="/images/recycling/PLASTIC.png" alt="PLASTIC"></a><br>
                    <span>Plastic</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=LITTER"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'LITTER' ? 'border: black 1px solid' : '' }}" src="/images/recycling/LITTER.png" alt="LITTER"></a><br>
                    <span>Litter</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=CARTON_TETRAPAK"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'CARTON_TETRAPAK' ? 'border: black 1px solid' : '' }}" src="/images/recycling/CARTON_TETRAPAK.png" alt="CARTON_TETRAPAK"></a><br>
                    <span>Carton Tetrapak</span>
                </div>
                                
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=PAPER"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'PAPER' ? 'border: black 1px solid' : '' }}" src="/images/recycling/PAPER.png" alt="PAPER"></a><br>
                    <span>Paper</span>
                </div>
            
                <div class="col-1 recycle-option">
                    <a href="/recycling?type=SHOES"><img style="padding: 5px; max-width: 40px; margin-bottom: 10px; {{ !empty($_GET['type']) && $_GET['type'] == 'SHOES' ? 'border: black 1px solid' : '' }}" src="/images/recycling/SHOES.png" alt="SHOES"></a><br>
                    <span>Shoes</span>
                </div>
                <div class="col-12">
                <table class="table table-striped" style="width: 80%; margin-left: auto; margin-right: auto; margin-bottom: 30px; margin-top: 30px;">
                    <thead>
                        <tr>
                            <th width="20%">Name</th>
                            <th width="25%">Address</th>
                            <th width="55%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($centres as $centre)
                            <tr>
                                <td>{{ $centre->NAME }}</td>
                                <td>{{ $centre->ADDRESS }}</td>
                                <td>
                                    <p>
                                        @if($centre->CLEAR_GLASS == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/CLEAR_GLASS.png" alt="CLEAR_GLASS">
                                        @endif
                                        @if($centre->GREEN_GLASS == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/GREEN_GLASS.png" alt="GREEN_GLASS">
                                        @endif
                                        @if($centre->BROWN_GLASS == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/BROWN_GLASS.png" alt="BROWN_GLASS">
                                        @endif
                                        @if($centre->MIXED == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/MIXED.png" alt="MIXED">
                                        @endif
                                        @if($centre->CANS_TINS == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/TINS_CANS.png" alt="CANS_TINS">
                                        @endif
                                        @if($centre->TEXTILES == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/TEXTILES.png" alt="TEXTILES">
                                        @endif
                                        @if($centre->OIL == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/OIL.png" alt="OIL">
                                        @endif
                                        @if($centre->PLASTIC == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/PLASTIC.png" alt="PLASTIC">
                                        @endif
                                        @if($centre->LITTER == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/LITTER.png" alt="LITTER">
                                        @endif
                                        @if($centre->CARTON_TETRAPAK == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/CARTON_TETRAPAK.png" alt="CARTON_TETRAPAK">
                                        @endif
                                        @if($centre->BOOKS == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/BOOKS.png" alt="BOOKS">
                                        @endif
                                        @if($centre->PAPER == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/PAPER.png" alt="PAPER">
                                        @endif
                                        @if($centre->SHOES == "Yes")
                                            <img style="max-width: 40px; margin-bottom: 10px;" src="/images/recycling/SHOES.png" alt="SHOES">
                                        @endif

                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->


    
   
    </div> <!-- .content -->

    <!-- Right Panel -->
@endsection

@section('js_content')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCadA9-6PJqd9mvG7xCdMssoxk2DG7gqrE&callback=initMap"></script>
    <script type='text/javascript'>
        var infowindow = null;


        function initMap() {
            var nottingham = {lat: 52.954783, lng: -1.158109};
            var map = new google.maps.Map(document.getElementById('recycleMap'), {
                zoom: 14,
                center: nottingham
            });

            infowindow = new google.maps.InfoWindow({
                content: "holding..."
            });

            var markers = {!! json_encode($centres) !!};

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; i++) {
                
                var contentString = "<div><h1>" + markers[i].name + " </h1><p>Something banks</p></div>";
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                // console.log(parseFloat(markers[i]);
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(markers[i].LAT), lng: parseFloat(markers[i].LONG)},
                    map: map,
                    title: markers[i].NAME,
                    html: getInfoWindow(markers[i])
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

        function getInfoWindow(centre) {
            var content = "<div class='info-window'><h1>" + centre.NAME + "</h1><br><p><b>Address: </b><br>" + centre.ADDRESS + "<br><br><b>Accepts: </b><br>";
            
            content += "</p></div>";
            return content;
        }

        
    </script>
@endsection