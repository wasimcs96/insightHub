<?php

namespace App\Http\Controllers\Demographics;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Rest\Demographics\GeographyRepository;

use App\Http\Requests\Demographics\DemographicsRequest;

class GeographyController extends Controller
{
  private GeographyRepository $geographyRepository;

  public function __construct(Request $request, GeographyRepository $geographyRepository){

    $this->geographyRepository = $geographyRepository;

  }

  public function usersByResidence(DemographicsRequest $request){

    return $this->geographyRepository->usersByResidence($request);

  }

  public function usersByState(DemographicsRequest $request){

    return $this->geographyRepository->usersByState($request);

  }

  public function usersByCity(DemographicsRequest $request){

    return $this->geographyRepository->usersByCity($request);

  }
}
