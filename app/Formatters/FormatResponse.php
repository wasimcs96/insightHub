<?php

namespace App\Formatters;

use Illuminate\Support\Arr;

class FormatResponse {

  private $request;

  private $results;

  private $collection;

  public function __construct($request, $results, $collection){

    $this->request = $request;

    $this->results = $results;

    $this->collection = $collection;

  }

  public static function format($request, $results, $collection){

    return new static($request, $results, $collection);

  }

  public function get(){

    return [
      'facet' => $this->facet(),
      'request' => $this->requestParams(),
      'results' => $this->results
    ];

  }

  private function facet(){

    return [
      // 'insti_name' => array_keys($this->collection->groupBy('insti_name')->toArray()),
      // 'campus' => array_keys($this->collection->groupBy('campus')->toArray()),
      // 'faculty' => array_keys($this->collection->groupBy('faculty')->toArray()),
      // 'study_program' => array_keys($this->collection->groupBy('study_program')->toArray()),
      // 'year_of_study' => array_keys($this->collection->groupBy('year_of_study')->toArray()),
    ];

  }

  private function requestParams(){

    return $this->request->validated();

  }

}
