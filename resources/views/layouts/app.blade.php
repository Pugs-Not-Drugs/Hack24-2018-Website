<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eco Notts</title>
    <meta name="description" content="Eco Notts">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="/apple-icon.png">
    <link rel="shortcut icon" href="/favicon.ico">

    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="/assets/scss/style.css">
    <link rel="stylesheet" href="/assets/css/c3.min.css">
    <link href="/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <style>
        .social-box h2 {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 40px;
            text-align: left;
            font-size: 1.7rem;
        }

        .social-box {
            min-height: 550px;
        }
    </style>
</head>
<body>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">                
                <div class="col-sm-7">
                    <div class="header-left">
                        <img src="/images/EcoNotts_Logo.png" style="max-height: 100px;">
                        <a href="/" style="margin-right: 20px;">Home</a>
                        <a href="/straws" style="margin-right: 20px;">Straws</a>
                        <a href="/food-banks" style="margin-right: 20px;">Food Banks</a>
                    </div>
                </div>


                {{--  <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="/#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="/#"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="/#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="/#"><i class="fa fa -cog"></i>Settings</a>

                                <a class="nav-link" href="/#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="/#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>  --}}
            </div>

        </header><!-- /header -->
        <!-- Header-->
        @yield('content')

        
    <script>
        var strawPercentage = {{ !empty($strawPercentage) ? $strawPercentage : 0 }};
    </script>
    <script src="/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="/assets/js/plugins.js"></script>
    <script src="/assets/js/main.js"></script>


    <script src="/assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="/assets/js/dashboard.js"></script>
    <script src="/assets/js/widgets.js"></script>
    <script src="/assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="/assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="/assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="/assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script src="https://d3js.org/d3.v3.min.js"></script>

    <script src="/assets/js/c3.min.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
    <script>
        var currentResults = [];
        $('#select-venue').select2({
            ajax: {
                url: '/ajax/companies/search',
                dataType: 'json',
                processResults: function (data, params) {
                    currentResults = [];
                    var formattedData = [];
                    for(var i = 0; i < data.length; i++) {
                        formattedData.push({
                            'id': data[i].id,
                            'text': data[i].name + " (" + data[i].vicinity + ")"
                        });

                        currentResults[data[i].id] = data[i];
                    }
                    
                    return {
                        results: formattedData
                    };
                },
            },
            placeholder: 'Search for a venue',
            minimumInputLength: 3 
        });

        $('#btn-submit').on('click', function(event) {
            if($('#select-venue').val() == "" || $('#select-venue').val() == null) {
                alert("Please select a Venue");
                event.preventDefault();
                return false;
            }
        });

        $('#select-venue').on('change', function() {
            var selected = currentResults[$(this).val()];

            console.log(selected);
            $('#hidden-bing-id').val(selected.id);
            $('#hidden-business-name').val(selected.name);
            $('#hidden-address-latitude').val(selected.geometry.location.lat);
            $('#hidden-address-longitude').val(selected.geometry.location.lng);
        });


    </script>
    @yield('js_content')


</body>
</html>
