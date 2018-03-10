@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Report a Straw</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="/">Dashboard</a></li>
                    <li><a href="/straws">Straws</a></li>
                    <li class="active">Report a Straw</li>
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

    <div class="col-sm-6 col-lg-6 offset-md-3">
        <div class="card text-white bg-flat-color-1" style="background-color: #B8D36D">
            <div class="card-body pb-0">
                <form method="POST">
                    {{ csrf_field() }}
                    
                    <input type="hidden" id="hidden-bing-id" name="Id">
                    <input type="hidden" id="hidden-business-name" name="Name">
                    <input type="hidden" id="hidden-address-latitude" name="Latitude">
                    <input type="hidden" id="hidden-address-longitude" name="Longitude">

                    <label for="select-venue">Select a Venue</label><br>
                    <select id="select-venue" name="company_id" style="width: 100%;"></select>
                    <br><br>
                    <input id="radio-straws-no" type="radio" name="Straws" value="0" checked><label for="radio-straws-no" style="margin-left: 10px;"> The Venue did not have Plastic straws</label><br>
                    <input id ="radio-straws-yes" type="radio" name="Straws" value="1"><label for="radio-straws-yes" style="margin-left: 10px; margin-bottom: 15px;">The Venue used Plastic straws</label>
                    <p>
                        <a class="btn btn-secondary" href="/" style="background-color: #656565">Cancel</a>
                        <button class="btn btn-primary" type="submit" id="btn-submit" style="background-color: #5E9950; border-color: #5E8850">Submit Report</button>
                    </p>

                </form>

            </div>

        </div>
    </div>
    <!--/.col-->
</div>

@endsection

@section('js_content')
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
@endsection