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
                <div class="social-box twitter" style="min-height: 600px;">
                    <i class="fa fa-twitter"></i>
                </div>
                <!--/social-box-->
            </div><!--/.col-->
            <!-- End Twitter Feed -->

            <div class="col-lg-9 col-md-9">
                
                <!-- Twitter Feed -->
                <div class="col-lg-12 col-md-12">
                    <div class="social-box straws">
                        <i class="fa fa-anchor"></i>

                        <div id="div-turtleometer"></div>
                        <p><a href="straws/report">Click here to report a straw</a></p>
                    </div>
                    <!--/social-box-->
                </div><!--/.col-->
                <!-- End Twitter Feed -->

                
                
                <!-- Twitter Feed -->
                <div class="col-lg-6 col-md-6">
                    <div class="social-box pollution" style="padding-bottom: 20px;">
                        <i class="fa fa-ambulance"></i>
                    <div style="height: 200px; width: 60%; margin-left: auto; margin-right: auto; background-color: {{ $pollutionData->aqi < 51 ? 'green' : 'yellow' }};margin-top: 50px; padding-top: 80px;">
                            <p style="color: {{ $pollutionData->aqi < 51 ? 'white' : 'black' }}; font-size: 80px;">{{ $pollutionData->aqi }}</p>
                        </div>
                        <p style="margin-top: 20px; font-weight: bold;">Nottingham Centre Real-time Air Quality</p>
                        @if ($pollutionData->aqi >= 51)
                            <p>Active children and adults, and people with respiratory disease, such as asthma, should limit prolonged outdoor exertion.</p>
                        @endif
                        <p style="margin-top: 10px; font-size: 12px;">Last Updated: {{ date('jS F Y, H:i', strtotime($pollutionData->time->s)) }}</p>
                        <p><a href="http://aqicn.org/city/united-kingdom/nottingham-centre" target="_blank" class='btn btn-primary' style="color: white !important; margin-top: 10px; font-size: 12px; background-color: #5E9950; border-color: #5E8850;">More Information</a></p>
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

            </div>
           

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
@endsection

@section('js_content')
    <script type='text/javascript' src="/assets/js/turtleometer.js"></script>
@endsection