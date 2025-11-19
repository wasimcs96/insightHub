<?php

namespace App\Repositories\Rest\Demographics;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Demographics\DemographicsRequest;
use MongoDB\BSON\UTCDateTime;
use App\Models\User;
use App\Models\Company;
use App\Formatters\FormatResponse;

class SignupInfoRepository{

  public function monthlySignups(DemographicsRequest $request){

    $collection = $request->filter(User::class)->where('created_at', '>=', \Carbon\Carbon::today()->subDays(30))->get();

    $result = $collection->countBy(function($date) {

      $utcdatetime = new UTCDateTime($date->created_at);

      $datetime = $utcdatetime->toDateTime();

          return \Carbon\Carbon::parse($datetime)->format('d/m');

      })->all();

    return FormatResponse::format($request, $result, $collection)->get();

  }

  public function weeklySignups(DemographicsRequest $request){

    $collection = $request->filter(User::class)->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->get();

    $result = $collection->countBy(function($date) {

      $utcdatetime = new UTCDateTime($date->created_at);

      $datetime = $utcdatetime->toDateTime();

          return \Carbon\Carbon::parse($datetime)->format('d/m');

      })->all();

    return FormatResponse::format($request, $result, $collection)->get();

  }

  public function userStatusPerUniversity(DemographicsRequest $request){

    //$result = [];

    //$universities = $request->filter(User::class)->distinct('insti_name')->get()->toArray();
    //$collection = $request->filter(User::class)->get();

    //foreach ($universities as $value) {
    //  if(!isset($value[0])) continue;
    //  $result[$value[0]] = $collection->where('insti_name', $value[0])->countBy('talent_status');
    //}

    $pipeline = [
      [
        '$match' => [
          '$and' => [
            ['insti_name' => ['$ne' => null]],
            ['insti_name' => ['$ne' => '']],
            ['insti_name' => ['$regex' => '^[0-9]+$']],
            ['talent_status' => ['$ne' => null]],  
            ['talent_status' => ['$ne' => '']],          
          ],
        ]
      ],      
      [
        '$group' => [
            '_id' => [
                'name' => '$insti_name',
                'status' => '$talent_status',
            ],
            'total_status' => [
              '$sum' => 1
          ],
        ]
      ],
      [
        '$addFields' => [
            '_id.name' => [
                '$toInt' => '$_id.name'
            ],
        ]
      ],
      [
        '$lookup' => [
          'from' => 'master_universities',
          'localField' => '_id.name',
          'foreignField'=> 'Id',
          'as' => 'uni'
        ]
      ],
      [
        '$addFields' => [
          'name' => [ '$arrayElemAt'=> [ '$uni.Name', 0 ]],
          'status' => '$_id.status',
        ]
      ],
      [
        '$group' => [
          '_id'=> '$name',
          'status'=> [
              '$push'=> [
                  'k'=>'$status',
                  'v'=>'$total_status',
              ],
          ],
        ]
      ],
      [
        '$match'=> [ '_id'=> [ '$ne'=> null ]]
      ],
      [
       '$group'=> [
            '_id'=> null,
            'root'=>
            [
                '$push'=>
                [
                    'k'=> ['$toString'=>'$_id'],
                    'v'=> ['$arrayToObject'=> '$status']
                ]
            ]
        ]  
      ],
      [
        '$replaceRoot'=> [ 'newRoot'=> [ '$arrayToObject'=> '$root' ]]
      ], 
      [
        '$sort' => [
          'k' => 1
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

  public function weeklyCompanySignups(DemographicsRequest $request){

    $result = Company::where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->where($request->validated())->get()->transform(function($item) {

      $utcdatetime = new UTCDateTime($item->created_at);

      $datetime = $utcdatetime->toDateTime();

      $date = \Carbon\Carbon::parse($datetime)->format('d/m/Y');

      return ['name' => $item->name, 'created_at' => $date];

      });

    return $result->all();

  }

  public function companiesStatus(DemographicsRequest $request){

    $result = Company::where($request->validated())->get()->countBy('status');

    $result = $result->filter(function ($item, $key) {

        return !empty($key);

    });

    return $result->all();

  }

}
