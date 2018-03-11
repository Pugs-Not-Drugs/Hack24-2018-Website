@extends('layouts.app')

@section('content')
    <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
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
            <div class="col-lg-3 col-md-3">
                <div class="social-box twitter" style="min-height: 800px;">
                    <i class="fa fa-twitter"></i>
                    <h2>Twitter Feed</h2>
                </div>
                <!--/social-box-->
            </div><!--/.col-->
            <!-- End Twitter Feed -->

            <div class="col-lg-9 col-md-9">
                
                <!-- Twitter Feed -->
                <div class="col-lg-6 col-md-6">
                    <div class="social-box straws">
                        <i class="fa fa-glass"></i>
                        <h2>Turtleometer</h2>
                        <a href="/straws">
                        <div id="div-turtleometer"></div>
                        </a>
                        {{--  <p><a href="straws/report" class='btn btn-primary' style="color: white !important; margin-top: 10px; font-size: 12px; background-color: #5E9950; border-color: #5E8850; margin-bottom: 30px;">Click here to report a straw</a></p>  --}}
                    </div>
                    <!--/social-box-->
                </div><!--/.col-->
                <!-- End Twitter Feed -->

                
                <!-- Twitter Feed -->
                <div class="col-lg-6 col-md-6">
                    <div class="social-box straws" >
                        <i class="fa fa-glass"></i>
                        <h2>Report a Venue</h2>
                        <div style="margin-bottom: 30px; min-height:350px; padding: 30px;">
                            <form method="POST" action='/straws/report' style="margin-bottom: 30px;">
                                {{ csrf_field() }}
                                
                                <input type="hidden" id="hidden-bing-id" name="Id">
                                <input type="hidden" id="hidden-business-name" name="Name">
                                <input type="hidden" id="hidden-address-latitude" name="Latitude">
                                <input type="hidden" id="hidden-address-longitude" name="Longitude">

                                <label for="select-venue">Select a Venue</label><br>
                                <select id="select-venue" name="company_id" style="width: 100%;"></select>
                                <br><br>
                                <input id="radio-straws-no" type="radio" name="Straws" value="0" checked><label for="radio-straws-no" style="margin-left: 10px; margin-top: 30px;"> The Venue did not have Plastic straws</label><br>
                                <input id ="radio-straws-yes" type="radio" name="Straws" value="1"><label for="radio-straws-yes" style="margin-left: 10px; margin-bottom: 15px;">The Venue used Plastic straws</label>
                                <p style="margin-top: 30px;">
                                    <a class="btn btn-secondary" href="/" style="background-color: #656565">Cancel</a>
                                    <button class="btn btn-primary" type="submit" id="btn-submit" style="background-color: #5E9950; border-color: #5E8850">Submit Report</button>
                                </p>

                            </form>
                        </div>
                        
                    </div>
                    <!--/social-box-->
                </div><!--/.col-->
                <!-- End Twitter Feed -->
                
                
                <!-- Twitter Feed -->
                <div class="col-lg-6 col-md-6">
                    <div class="social-box pollution" style="padding-bottom: 20px;">
                        <i class="fa fa-recycle"></i>
                        <h2>Nottingham Centre Real-time Air Quality</h2>
                        <div style="height: 120px; width: 40%; margin-left: auto; margin-right: auto; background-color: {{ $pollutionData->aqi < 51 ? 'green' : 'yellow' }};margin-top: 50px; padding-top: 50px;">
                            <p style="color: {{ $pollutionData->aqi < 51 ? 'white' : 'black' }}; font-size: 80px;">{{ $pollutionData->aqi }}</p>
                        </div>
                        @if ($pollutionData->aqi >= 51)
                            <p style="margin-top: 10px; padding-left: 20px; padding-right: 20px; padding-top: 20px;"><b>Active children and adults, and people with respiratory disease, such as asthma, should limit prolonged outdoor exertion.</b></p>
                        @else
                            <p style="margin-top: 10px; padding-left: 20px; padding-right: 20px; padding-top: 20px;"><b>There are no air concerns.</b></p>
                        @endif
                        <p style="margin-top: 10px; font-size: 12px;">Last Updated: {{ date('jS F Y, H:i', strtotime($pollutionData->time->s)) }}</p>
                        <p><a href="http://aqicn.org/city/united-kingdom/nottingham-centre" target="_blank" class='btn btn-primary' style="color: white !important; margin-top: 10px; font-size: 12px; background-color: #5E9950; border-color: #5E8850;">More Information</a></p>
                    </div>
                    <!--/social-box-->
                </div><!--/.col-->
                <!-- End Twitter Feed -->


                
                <!-- Twitter Feed -->
                <div class="col-lg-6 col-md-6">
                    <div class="social-box foodbank">
                        <i class="fa fa-recycle"></i>
                        <h2>Foodbank - Most Needed Items</h2>
                        <?php $num = 1; ?>
                        <p>
                            @foreach(array_slice($foodbankNeeds, 0, 10) as $foodbankNeed => $number)
                                <b>#{{ $num }}: </b>{{ $foodbankNeed }}<br>
                                <?php $num += 1; ?>
                            @endforeach
                        </p>
                       
                    </div>
                    <!--/social-box-->
                </div><!--/.col-->
                <!-- End Twitter Feed -->

            </div>
           

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
@endsection

@section('js_content')
    <script type='text/javascript' src="/assets/js/turtleometer.js"></script>
@endsection