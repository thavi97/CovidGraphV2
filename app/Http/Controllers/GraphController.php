<?php

namespace App\Http\Controllers;
use App\Charts\CovidGraph;

use Illuminate\Http\Request;

class GraphController extends Controller
{

  public function index()
  {
    $get_confirmed_timeseries = $this->getJson(); //Store the entire Json into this variable.
    $dataset_for_a_country = $this->get_country_confirmed_stats('United Kingdom', $get_confirmed_timeseries); //Store a country's timeseries data into this variable.
    $dates_array = $this->get_dates($this->getJson()); //Create the array with all the dates.

    $confirmed_chart = new CovidGraph;
    $confirmed_chart->labels($dates_array);
    $confirmed_chart->dataset('United Kingdom', 'line', $dataset_for_a_country);

    $data = [
        'confirmed_cases_timeseries' => $get_confirmed_timeseries,
        'confirmed_chart', $confirmed_chart,
    ];

    return view('graph')->with('confirmed_cases_timeseries', $get_confirmed_timeseries)->with('confirmed_chart', $confirmed_chart);

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $get_confirmed_timeseries = $this->getJson(); //Store the entire Json into this variable.
    $dataset_for_a_country = $this->get_country_confirmed_stats($request->countries, $get_confirmed_timeseries); //Store a country's timeseries data into this variable.
    $dates_array = $this->get_dates($this->getJson()); //Create the array with all the dates.

    $confirmed_chart = new CovidGraph;
    $confirmed_chart->labels($dates_array);
    $confirmed_chart->dataset($request->countries, 'line', $dataset_for_a_country);

    $data = [
        'confirmed_cases_timeseries' => $get_confirmed_timeseries,
        'confirmed_chart', $confirmed_chart,
    ];

    return view('graph')->with('confirmed_cases_timeseries', $get_confirmed_timeseries)->with('confirmed_chart', $confirmed_chart);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }

  function getJson(){
    $url = 'https://covid2019-api.herokuapp.com/v2/timeseries/confirmed';
    $url_json = file_get_contents($url);
    $get_confirmed_timeseries = json_decode($url_json, true);
    return $get_confirmed_timeseries;
  }

  function get_dates($dataset){
    $dates_array = array();
    for($i=0; $i<sizeOf($dataset['data'][0]['TimeSeries']); $i++){
      array_push($dates_array, $dataset['data'][0]['TimeSeries'][$i]['date']);
    }
    return $dates_array;
  }

  /*
  *
  * @param $country: A string that contains the name of a country
  * @param $get_confirmed_timeseries: An array that contains a country's timeseries data.
  */
  function get_country_confirmed_stats($country, $get_confirmed_timeseries){
    $dataset_for_a_country = array();
    $i=0;
    foreach($get_confirmed_timeseries['data'] as $confirmed_case){
      if($confirmed_case['Province/State'] == "" && $confirmed_case['Country/Region'] == $country){
        for($u=0; $u<sizeOf($get_confirmed_timeseries['data'][$i]['TimeSeries']); $u++){
          array_push($dataset_for_a_country, $get_confirmed_timeseries['data'][$i]['TimeSeries'][$u]['value']);
        }
      }
      $i++;
    }
    return $dataset_for_a_country;
  }
}
