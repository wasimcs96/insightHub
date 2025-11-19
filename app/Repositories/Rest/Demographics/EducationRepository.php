<?php

namespace App\Repositories\Rest\Demographics;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Demographics\DemographicsRequest;
use App\Models\User;
use App\Formatters\FormatResponse;

class EducationRepository{

  public function usersByInstitution(DemographicsRequest $request){

    //$collection = $request->filter(User::class)->orderBy('insti_name','asc')->get();

    //$result = $collection->countBy('insti_name')->filter(function ($item, $key) {
    //    return !empty($key);
    //})->all();    

    $pipeline = [
      [
        '$match' => [
          '$and' => [
            ['insti_name' => ['$ne' => null]],
            ['insti_name' => ['$ne' => '']],
            ['insti_name' => ['$regex' =>  '^[0-9]+$']]
          ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$insti_name',
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
          'from' => 'master_universities',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'university'
        ]
      ],
      [
        '$project' => [
          '_id' => '$university.Name',
          'total' => '$total'
        ]
      ],
      [
        '$sort' => [
          'total' => -1
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

  public function usersByScope(DemographicsRequest $request){

    //$collection = $request->filter(User::class)->orderBy('scope','asc')->get();

    //$result = $collection->countBy('scope')->filter(function ($item, $key) {
    //    return !empty($key);
    //})->all();

    $pipeline = [
      [
        '$match' => [
          'scope' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$scope',
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
          'from' => 'master_scope_of_studies',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'scope_of_study'
        ]
      ],
      [
        '$project' => [
            '_id'  => '$scope_of_study.Name',
            'total' => '$total',
            //'data' => ['$first' => '$$ROOT']
        ]
      ],
      [
        '$sort' => [
          'total' => -1
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


  public function usersByStudyYear(DemographicsRequest $request){

    //$collection = $request->filter(User::class)->orderBy('curr_study_year','asc')->get();

    //$result = $collection->countBy('curr_study_year')->filter(function ($item, $key) {
    //    return !empty($key);
    //})->all();

    $pipeline = [
      [
        '$match' => [
          'curr_study_year' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$curr_study_year',
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
          'from' => 'master_year_of_studies',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'year_of_study'
        ]
      ],
      [
        '$project' => [
            '_id'  => '$year_of_study.Name',
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
