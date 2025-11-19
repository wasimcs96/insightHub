<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quiz;
use App;
use App\Services\ApiService;

class AuthController extends Controller
{
  public function setUserTokenReferece($tokenReference, Quiz $quiz, $lang)
  {

    App::setLocale($lang);

    session()->put('locale', $lang);
    session([config('app.token_name') => $tokenReference]);
    

    $redirectUrl = $quiz->api ? '/quiz/' . $quiz->name : '/quiz/' . $quiz->name . '/intro';

    return redirect($redirectUrl);
  }

  public static function checkUser()
  {

    if (!session(config('app.token_name'))) {

      return false;
    }


    $api = new ApiService(config('app.check_user_token_endpoint'));

    $api->setHeader('Authorization', 'Token ' . session(config('app.token_name')));

    $user = $api->get();

    if (!$user || ($user['status'] && $user['status'] != 'success')) return false;

    return ['id' => base64_decode($user['data']['userId'])];

    //  $users = [
    //    'test-reference-mihajlo' => 1,
    //    'test-reference-burak' => 2,
    //    'test-reference-mehmet' => 3,
    //    'test-reference-andrew' => 4,
    //    'test-reference-test1' => 5,
    //    'test-reference-test2' => 6,
    //    'test-reference-test3' => 7,
    //    'test-reference-test4' => 8,
    //    'test-reference-test5' => 9,
    //    'test-reference-test6' => 10,
    //    'test-reference-test7' => 11,
    //    'test-reference-test8' => 12,
    //    'test-reference-test9' => 13,
    //    'test-reference-test10' => 14,
    //  ];
    //
    // return ['id' => $users[session(config('app.token_name'))]]; //here will be remote token check


  }
}
