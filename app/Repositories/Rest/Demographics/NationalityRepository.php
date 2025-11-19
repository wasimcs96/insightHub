<?php

namespace App\Repositories\Rest\Demographics;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Demographics\DemographicsRequest;
use App\Models\User;
use App\Formatters\FormatResponse;

class NationalityRepository{

  public function usersByNationality(DemographicsRequest $request){

    $collection = $request->filter(User::class)->get();

    $result = $collection->countBy('nationality')->toArray();

    $result = ['Malaysians' => $result[1], 'Others' => $result[0]];

    return FormatResponse::format($request, $result, $collection)->get();

  }

  public function usersByGender(DemographicsRequest $request){

    $collection = $request->filter(User::class)->get();

    $result = $collection->countBy('gender')->filter(function ($item, $key) {

        return !empty($key);

    })->all();

    return FormatResponse::format($request, $result, $collection)->get();

  }

  public function usersByEthnicity(DemographicsRequest $request){

    //$collection = $request->filter(User::class)->get();

    //$result = $collection->countBy('race')->filter(function ($item, $key) {
    //    return !empty($key);
    //})->all();

    $pipeline = [
      [
        '$match' => [
          'race' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$addFields' => [
            'race' => [
                '$toInt' => '$race'
            ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$race',
            'total' => [
              '$sum' => 1
            ],
            //'data' => ['$first' => '$$ROOT']
        ]
      ],
      [
        '$lookup' => [
          'from' => 'master_ethinicities',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'ethinicity'
        ]
      ],
      [
        '$project' => [
            '_id'  => '$ethinicity.Name',
            'total' => '$total'
            //'data' => ['$first' => '$$ROOT']
        ]
      ],
      [
        '$sort' => [
          '_id' => 1
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

  public function usersOtherNationalities(DemographicsRequest $request){

    //$collection = $request->filter(User::class)->get();

    //$result = $collection->countBy('country')->filter(function ($item, $key) {
    //    return !empty($key);
    //})->all();

    $pipeline = [
      [
        '$match' => [
          'country' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$match' => [
          'nationality' => [
            '$eq' => 0
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
          'as' => 'country'
        ]
      ],
      [
        '$project' => [
            '_id'  => '$country.Name',
            'total' => '$total'
            //'data' => ['$first' => '$$ROOT']
        ]
      ],
      [
        '$sort' => [
          '_id' => 1
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

}
