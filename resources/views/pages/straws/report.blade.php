@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">
<h2>Report Straws Form</h2>

<form method="POST">
    {{ csrf_field() }}
    
    <input type="hidden" id="hidden-bing-id" name="BingEntityID">
    <input type="hidden" id="hidden-business-name" name="BusinessName">
    <input type="hidden" id="hidden-address-line" name="Address[AddressLine]">
    <input type="hidden" id="hidden-address-locality" name="Address[Locality]">
    <input type="hidden" id="hidden-address-postcode" name="Address[PostalCode]">
    <input type="hidden" id="hidden-address-latitude" name="Address[Latitude]">
    <input type="hidden" id="hidden-address-longitude" name="Address[Longitude]">

    <label for="select-venue">Select a Venue</label><br>
    <select id="select-venue" name="company_id" style="width: 400px;"></select>
    <br><br>
    <input id="radio-straws-no" type="radio" name="UsingStraws" value="0" checked><label for="radio-straws-no">No Straws</label>
    <input id ="radio-straws-yes" type="radio" name="UsingStraws" value="1"><label for="radio-straws-yes">Yes Straws</label>
    <p>
        <a href="/straws">Cancel</a>
        <button type="submit" id="btn-submit">Submit Report</button>
    </p>

</form>

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
                            'id': data[i].EntityID,
                            'text': data[i].DisplayName + " (" + data[i].AddressLine + ")"
                        });

                        currentResults[data[i].EntityID] = data[i];
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
            $('#hidden-bing-id').val(selected.EntityID);
            $('#hidden-business-name').val(selected.DisplayName);
            $('#hidden-address-line').val(selected.AddressLine);
            $('#hidden-address-locality').val(selected.Locality);
            $('#hidden-address-postcode').val(selected.PostalCode);
            $('#hidden-address-latitude').val(selected.Latitude);
            $('#hidden-address-longitude').val(selected.Longitude);
        });


    </script>
@endsection