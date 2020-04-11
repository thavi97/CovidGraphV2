@extends('layouts.app')
@section('content')
<div class="container">
  <div id="app">
    {!! $confirmed_chart->container() !!}
  </div>
  @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
    @if($confirmed_case['Province/State'] == "")
      <div>{{$confirmed_case['Country/Region']}}</div>
    @endif
  @endforeach
</div>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $confirmed_chart->script() !!}
@endsection
