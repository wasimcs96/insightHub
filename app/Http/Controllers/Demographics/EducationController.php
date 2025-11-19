<?php

namespace App\Http\Controllers\Demographics;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Rest\Demographics\EducationRepository;

use App\Http\Requests\Demographics\DemographicsRequest;

class EducationController extends Controller
{
  private EducationRepository $educationRepository;

  public function __construct(Request $request, EducationRepository $educationRepository){

    $this->educationRepository = $educationRepository;

  }

  public function usersByInstitution(DemographicsRequest $request){

    return $this->educationRepository->usersByInstitution($request);

  }

  public function usersByScope(DemographicsRequest $request){

    return $this->educationRepository->usersByScope($request);

  }

  public function usersByStudyYear(DemographicsRequest $request){

    return $this->educationRepository->usersByStudyYear($request);

  }
}
