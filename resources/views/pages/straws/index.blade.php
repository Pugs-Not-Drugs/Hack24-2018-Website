@extends('layouts.app')

@section('content')
<h2>Straws Index</h2>
@if(!empty($success_message))
<p style="background-color: green">{{ $success_message }}</p>
@endif
<p>
    <a href="/straws">Straw Index</a><br>
    <a href="/straws/report">Report Straws</a>
</p>
@endsection

@section('js_content')

@endsection