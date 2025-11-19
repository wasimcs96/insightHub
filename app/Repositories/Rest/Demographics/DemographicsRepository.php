<?php

namespace App\Repositories\Rest\Demographics;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Demographics\DemographicsRequest;
use MongoDB\BSON\UTCDateTime;
use App\Models\User;
use App\Formatters\FormatResponse;
use StdClass;

class DemographicsRepository{

  public function userStatus(DemographicsRequest $request){

    $pipeline =[
      [
        '$match' => 
        [
          'talent_status' => ['$ne' => null]
        ]
      ], 
      [
        '$group' => 
        [
          '_id' => '$talent_status', 
          'total' => ['$sum' => 1]
        ]
      ], 
      [
        '$group' => 
        [
          '_id' => null, 
          'count' => 
            [
              '$push' => ['k' => '$_id', 'v' => '$total']
            ]
        ]
      ], 
      [
        '$replaceRoot' => 
        ['newRoot' => ['$arrayToObject' => '$count']]
      ]
    ];

    if($request->input('insti_name')) {
      $pipeline[0]['$match']['insti_name'] = ['$in'=> explode(",", $request->input('insti_name'))];
    }

    if($request->input('campus')) {
      $pipeline[0]['$match']['campus'] = ['$in'=> explode(",", $request->input('campus'))];
    }

    if($request->input('faculty')) {
      $pipeline[0]['$match']['faculty'] = ['$in'=> explode(",", $request->input('faculty'))];
    }

    if($request->input('study_program')) {
      $pipeline[0]['$match']['study_program'] = ['$in'=> explode(",", $request->input('study_program'))];
    }

    if($request->input('curr_study_year')) {
      $pipeline[0]['$match']['curr_study_year'] = ['$in'=> explode(",", $request->input('curr_study_year'))];
    }

    if($request->input('scope_of_study')) {
      $pipeline[0]['$match']['scope'] = ['$in'=> explode(",", $request->input('scope_of_study'))];
    }

    $result = (object)DB::connection('mongodb')->collection('core_model_onboardform')->raw(function ($collection) use ($pipeline) {
      return $collection->aggregate($pipeline);
    })->toArray();
    if(isset($result->{'0'})){
      return FormatResponse::format($request, $result->{'0'}, [])->get();
    } else {
      $emptyObject = new stdClass();
      return FormatResponse::format($request, $emptyObject, [])->get();
    }
    
  }

  public function userEducation(DemographicsRequest $request){

    $pipeline = [
      [
        '$match' => [
          'curr_qualification' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$curr_qualification',
            'total' => [
              '$sum' => 1
            ],
            //'data' => ['$first' => '$$ROOT']
        ]
      ],
      [
        '$addFields' => [
            '_id' => [
                '$toInt' => '$_id'
            ],
        ]
      ],
      [
        '$lookup' => [
          'from' => 'master_academic_qualifications',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'academic_qualification'
        ]
      ],
      [
        '$project' => [
          '_id' => '$academic_qualification.Name',
          'total' => '$total'
        ]
      ],
      [
        '$sort' => [
          '_id' => 1,
          'total' => 1
        ]
      ],
    ];

    $options = [
      'typeMap' => ['root' => 'array', 'document' => 'array'],
    ];

    if($request->input('insti_name')) {
      $pipeline[0]['$match']['insti_name'] = ['$in'=> explode(",", $request->input('insti_name'))];
    }

    if($request->input('campus')) {
      $pipeline[0]['$match']['campus'] = ['$in'=> explode(",", $request->input('campus'))];
    }

    if($request->input('faculty')) {
      $pipeline[0]['$match']['faculty'] = ['$in'=> explode(",", $request->input('faculty'))];
    }

    if($request->input('study_program')) {
      $pipeline[0]['$match']['study_program'] = ['$in'=> explode(",", $request->input('study_program'))];
    }

    if($request->input('curr_study_year')) {
      $pipeline[0]['$match']['curr_study_year'] = ['$in'=> explode(",", $request->input('curr_study_year'))];
    }

    if($request->input('scope_of_study')) {
      $pipeline[0]['$match']['scope'] = ['$in'=> explode(",", $request->input('scope_of_study'))];
    }

    $result = DB::connection('mongodb')->collection('core_model_onboardform')->raw(function ($collection) use ($pipeline, $options) {
      return $collection->aggregate($pipeline, $options);
    })->toArray();

    return FormatResponse::format($request, $result, [])->get();

  }

  public function userScholarship(DemographicsRequest $request){

    $pipeline =[
      [
        '$match' => 
        [
          'scholar_status' => ['$ne' => null]
        ]
      ], 
      [
        '$group' => 
        [
          '_id' => '$scholar_status', 
          'total' => ['$sum' => 1]
        ]
      ]
    ];

    if($request->input('insti_name')) {
      $pipeline[0]['$match']['insti_name'] = ['$in'=> explode(",", $request->input('insti_name'))];
    }

    if($request->input('campus')) {
      $pipeline[0]['$match']['campus'] = ['$in'=> explode(",", $request->input('campus'))];
    }

    if($request->input('faculty')) {
      $pipeline[0]['$match']['faculty'] = ['$in'=> explode(",", $request->input('faculty'))];
    }

    if($request->input('study_program')) {
      $pipeline[0]['$match']['study_program'] = ['$in'=> explode(",", $request->input('study_program'))];
    }

    if($request->input('curr_study_year')) {
      $pipeline[0]['$match']['curr_study_year'] = ['$in'=> explode(",", $request->input('curr_study_year'))];
    }

    if($request->input('scope_of_study')) {
      $pipeline[0]['$match']['scope'] = ['$in'=> explode(",", $request->input('scope_of_study'))];
    }

    $result = DB::connection('mongodb')->collection('core_model_onboardform')->raw(function ($collection) use ($pipeline) {
      return $collection->aggregate($pipeline);
    })->toArray();
    
    
    $result = ['scholarship' => $result[0]['total'] ?? 0 , 'selfFunded' => $result[1]['total'] ?? 0];

    return FormatResponse::format($request, $result, [])->get();

  }

  public function userDemographics(DemographicsRequest $request){

    $pipeline = [
      [
        '$match' => [
          'country' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$country',
            'total' => [
              '$sum' => 1
            ],
            //'data' => ['$first' => '$$ROOT']
        ]
      ],
      [
        '$addFields' => [
            '_id' => [
                '$toInt' => '$_id'
            ],
        ]
      ],
      [
        '$lookup' => [
          'from' => 'master_countries',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'master_country'
        ]
      ],
      [
        '$project' => [
          '_id' => '$master_country.Name',
          'total' => '$total'
        ]
      ],
      [
        '$sort' => [
          '_id' => 1,
          'total' => 1
        ]
      ],
    ];

    $options = [
      'typeMap' => ['root' => 'array', 'document' => 'array'],
    ];

    if($request->input('insti_name')) {
      $pipeline[0]['$match']['insti_name'] = ['$in'=> explode(",", $request->input('insti_name'))];
    }

    if($request->input('campus')) {
      $pipeline[0]['$match']['campus'] = ['$in'=> explode(",", $request->input('campus'))];
    }

    if($request->input('faculty')) {
      $pipeline[0]['$match']['faculty'] = ['$in'=> explode(",", $request->input('faculty'))];
    }

    if($request->input('study_program')) {
      $pipeline[0]['$match']['study_program'] = ['$in'=> explode(",", $request->input('study_program'))];
    }

    if($request->input('curr_study_year')) {
      $pipeline[0]['$match']['curr_study_year'] = ['$in'=> explode(",", $request->input('curr_study_year'))];
    }

    $result = DB::connection('mongodb')->collection('core_model_onboardform')->raw(function ($collection) use ($pipeline, $options) {
      return $collection->aggregate($pipeline, $options);
    })->toArray();

    return FormatResponse::format($request, $result, [])->get();

  }

  public function userSignups(DemographicsRequest $request){

    $collection = $request->filter(User::class)->where('created_at', '>=', \Carbon\Carbon::today()->subDays(14))->get();

    $result = $collection->countBy(function($date) {

      $utcdatetime = new UTCDateTime($date->created_at);

      $datetime = $utcdatetime->toDateTime();

          return \Carbon\Carbon::parse($datetime)->format('d');

      })->all();

    return FormatResponse::format($request, $result, $collection)->get();

  }
  
}