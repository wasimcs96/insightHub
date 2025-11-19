<?php

namespace App\Http\Controllers\Demographics;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Rest\Demographics\NationalityRepository;

use App\Http\Requests\Demographics\DemographicsRequest;

class NationalityController extends Controller
{
  private NationalityRepository $nationalityRepository;

  public function __construct(Request $request, NationalityRepository $nationalityRepository){

    $this->nationalityRepository = $nationalityRepository;

  }

  public function usersByNationality(DemographicsRequest $request){

    return $this->nationalityRepository->usersByNationality($request);

  }

  public function usersByGender(DemographicsRequest $request){

    return $this->nationalityRepository->usersByGender($request);

  }

  public function usersByEthnicity(DemographicsRequest $request){

    return $this->nationalityRepository->usersByEthnicity($request);

  }

  public function usersOtherNationalities(DemographicsRequest $request){

    return $this->nationalityRepository->usersOtherNationalities($request);

  }
}
