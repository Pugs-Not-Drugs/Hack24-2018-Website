@extends('layouts.app')

@section('content')

    <style>
       #bankMap {
        height: 600px;
        width: 100%;
       }
    </style>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Food Banks</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="/">Dashboard</a></li>
                        <li class="active">Food Banks</li>
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
                <i style="background-image: url('/images/food_bank.png'); min-height: 110px;background-repeat: no-repeat;background-position: 50% 50%;"></i>
                <h2>Local Foodbanks</h2>
                <div id='bankMap'></div>
            </div>
            <!--/social-box-->
        </div><!--/.col-->
        <!-- End Twitter Feed -->

        
        <style>
        
        </style>
        <!-- Twitter Feed -->
        <div class="col-lg-12 col-md-12">
            <div class="social-box foodbank">
                <i style="background-image: url('/images/food_bank.png'); min-height: 110px;background-repeat: no-repeat;background-position: 50% 50%;"></i>
                <h2>Foodbank Needs</h2>         
                <table class="table table-striped" style="width: 80%; margin-left: auto; margin-right: auto; margin-bottom: 30px;">
                    <thead>
                        <tr>
                            <th width="20%">Name</th>
                            <th width="25%">Address</th>
                            <th width="25%">Items Needed</th>
                            <th width="40%">Drop Off</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($foodbanks as $foodbank)
                            <tr>
                                <td>{{ $foodbank->name }}</td>
                                <td>{{ implode(', ', $foodbank->address) }}</td>
                                {{--  <td>{{ var_dump($foodbank->items_needed) }}</td>  --}}
                                <td class="td-foodbank-icons">
                                    @foreach($foodbank->items_needed as $item_needed)
                                        <span style="margin-bottom: 10px"><img src="/images/icons/{{ str_replace('/', '_', str_replace(' ', '', strtolower($item_needed))) }}.png" style='max-width: 40px; margin-bottom: 10px;'> {{ $item_needed }}</span><br>
                                    @endforeach                                 
                                </td>
                                <td>
                                    @if(!empty($foodbank->food_dropoff))
                                        @if(is_array($foodbank->food_dropoff))
                                            @foreach($foodbank->food_dropoff as $dropoff_point)
                                                <span style="padding: 10px; margin-bottom: 10px;">{{ $dropoff_point }}</span><br><br>
                                            @endforeach
                                        @else
                                            {{ $foodbank->food_dropoff }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            var map = new google.maps.Map(document.getElementById('bankMap'), {
                zoom: 14,
                center: nottingham
            });

            infowindow = new google.maps.InfoWindow({
                content: "holding..."
            });

            var markers = {!! json_encode($foodbanks) !!};

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; i++) {
                
                var contentString = "<div><h1>" + markers[i].name + " </h1><p>Something banks</p></div>";
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                // console.log(parseFloat(markers[i]);
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(markers[i].latitude), lng: parseFloat(markers[i].longitude)},
                    map: map,
                    title: markers[i].name,
                    html: getInfoWindow(markers[i].name, markers[i].address.join(', '), markers[i].items_needed)
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

        function getInfoWindow(name, address, needs) {
            var content = "<div class='info-window'><h1>" + name + "</h1><br><p><b>Address: </b><br>" + address + "<br><br><b>Needs: </b><br>";
            for(var j = 0; j < needs.length; j++) {
                content += needs[j] + "<br>";
            }
            content += "</p></div>";
            return content;
        }

        
    </script>
@endsection