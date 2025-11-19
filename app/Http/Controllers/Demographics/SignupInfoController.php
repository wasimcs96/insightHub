<?php

namespace App\Http\Controllers\Demographics;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Rest\Demographics\SignupInfoRepository;

use App\Http\Requests\Demographics\DemographicsRequest;

class SignupInfoController extends Controller
{
  private SignupInfoRepository $signupInfoRepository;

  public function __construct(Request $request, SignupInfoRepository $signupInfoRepository){

    $this->signupInfoRepository = $signupInfoRepository;

  }

  public function monthlySignups(DemographicsRequest $request){

    return $this->signupInfoRepository->monthlySignups($request);

  }

  public function weeklySignups(DemographicsRequest $request){

    return $this->signupInfoRepository->weeklySignups($request);

  }

  public function userStatusPerUniversity(DemographicsRequest $request){

    return $this->signupInfoRepository->userStatusPerUniversity($request);

  }

  public function weeklyCompanySignups(DemographicsRequest $request){

    return $this->signupInfoRepository->weeklyCompanySignups($request);

  }

  public function companiesStatus(DemographicsRequest $request){

    return $this->signupInfoRepository->companiesStatus($request);

  }
}
