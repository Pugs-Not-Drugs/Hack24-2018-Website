@extends('layouts.app')

@section('content')
<h2>Report Straws Form</h2>

<form method="POST">
    {{ csrf_field() }}
    
    <p>
        <a href="/straws">Cancel</a>
        <button type="submit">Submit Report</button>
    </p>

</form>

@endsection

@section('js_content')

@endsection