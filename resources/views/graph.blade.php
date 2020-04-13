@extends('layouts.app')
@section('jQuery')
<script>
$(document).ready(function(){
  $("#btn1").click(function(){
    $("#country_select").append("<select id='countries' name='countries' class='form-control'>@foreach($confirmed_cases_timeseries['data'] as $confirmed_case) @if($confirmed_case['Province/State'] == '')<option value='{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}'>{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}</option>@endif @endforeach</select>");
  });
});
</script>
@endsection
@section('content')
<div class="container">
  <div id="app">
    {!! $confirmed_chart->container() !!}
  </div>
  <div>
    <h5>Add countries to the graph</h5>
  </div>
  <form method="POST" action="/">
    @csrf
    <div id="country_select" class="form-group col-lg-3">
      <select id="countries1" name="countries1" class="form-control">
        <option value="">Empty</option>
        @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
          @if($confirmed_case['Province/State'] == "")
            <option value="{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}">{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}</option>
          @endif
        @endforeach
      </select>
      <select id="countries2" name="countries2" class="form-control">
        <option value="">Empty</option>
        @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
          @if($confirmed_case['Province/State'] == "")
            <option value="{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}">{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}</option>
          @endif
        @endforeach
      </select>
      <select id="countries3" name="countries3" class="form-control">
        <option value="">Empty</option>
        @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
          @if($confirmed_case['Province/State'] == "")
            <option value="{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}">{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}</option>
          @endif
        @endforeach
      </select>
      <select id="countries4" name="countries4" class="form-control">
        <option value="">Empty</option>
        @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
          @if($confirmed_case['Province/State'] == "")
            <option value="{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}">{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}</option>
          @endif
        @endforeach
      </select>
      <select id="countries5" name="countries5" class="form-control">
        <option value="">Empty</option>
        @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
          @if($confirmed_case['Province/State'] == "")
            <option value="{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}">{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <input type="submit" value="Submit">
  </form>
</div>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $confirmed_chart->script() !!}
@endsection

<!--<select class='form-control'>
@foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
  @if($confirmed_case['Province/State'] == '')
    <option value='{{$confirmed_case[str_replace("'", "\\'", 'Country/Region')]}}'>{{$confirmed_case['Country/Region']}}</option>
  @endif
@endforeach
</select>-->
