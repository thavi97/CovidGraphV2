@extends('layouts.app')
@section('content')
<div class="container">
  @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
    @if($confirmed_case['Province/State'] == "")
      <div>{{$confirmed_case['Country/Region']}}</div>
    @endif
  @endforeach
</div>
@endsection
