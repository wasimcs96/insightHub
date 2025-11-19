<?php

namespace App\Repositories\Rest\Demographics;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Demographics\DemographicsRequest;
use App\Models\User;
use App\Formatters\FormatResponse;

class FinancialSupportRepository{

  public function usersByScholarData(DemographicsRequest $request){

    //$collection = $request->filter(User::class)->get();

    //$result = $collection->countBy('scholar_data')->filter(function ($item, $key) {
    //    return !empty($key);
    //})->all();

    $pipeline = [
      [
        '$match' => [
          'scholar_data' => [
            '$ne' => null
          ],
        ]
      ],
      [
        '$group' => [
            '_id'  => '$scholar_data',
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
          'from' => 'master_scholarship_subtypes',
          'localField' => '_id',
          'foreignField'=> 'Id',
          'as' => 'scholarship_subtype'
        ]
      ],
      [
        '$project' => [
            '_id'  => '$scholarship_subtype.Title',
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
