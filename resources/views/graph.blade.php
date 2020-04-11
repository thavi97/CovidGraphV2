@extends('layouts.app')
@section('jQuery')
<script>
$(document).ready(function(){
  $("#btn1").click(function(){
    $("#country_select").append("<select id='countries' name='countries' class='form-control'>
      @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
        @if($confirmed_case['Province/State'] == '')
          @php $confirmed_case_with_country = $confirmed_case['Country/Region']; @endphp
          <option value='{{$confirmed_case_with_country}}'>{{$confirmed_case_with_country}}</option>
        @endif
      @endforeach
    </select>");
  });
});
</script>
@endsection
@section('content')
<div class="container">
  <div id="app">
    {!! $confirmed_chart->container() !!}
  </div>
  <form method="POST" action="/">
    @csrf
    <div id="country_select" class="form-group col-lg-3">
      <select id="countries" name="countries" class="form-control">
        @foreach($confirmed_cases_timeseries['data'] as $confirmed_case)
          @if($confirmed_case['Province/State'] == "")
            <option value="{{$confirmed_case['Country/Region']}}">{{$confirmed_case['Country/Region']}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <input type="submit" value="Submit">
  </form>
<button id="btn1">Append text</button>
</div>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $confirmed_chart->script() !!}
@endsection
