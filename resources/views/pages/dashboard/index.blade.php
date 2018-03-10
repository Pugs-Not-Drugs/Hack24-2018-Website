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
                    <div class="social-box pollution">
                        <i class="fa fa-ambulance"></i>
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