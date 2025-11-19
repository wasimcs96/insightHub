<?php

namespace App\Http\Controllers\Demographics;

use Illuminate\Http\Request;

use App\Repositories\Rest\Demographics\DemographicsRepository;

use App\Http\Requests\Demographics\DemographicsRequest;

use App\Models\User;

use App\Http\Controllers\Controller;

class DemographicsController extends Controller
{

    private DemographicsRepository $demographicsRepository;

    public function __construct(Request $request, DemographicsRepository $demographicsRepository){

      $this->demographicsRepository = $demographicsRepository;

    }

    public function userStatus(DemographicsRequest $request){

      return $this->demographicsRepository->userStatus($request);

    }

    public function userEducation(DemographicsRequest $request){

      return $this->demographicsRepository->userEducation($request);

    }

    public function userScholarship(DemographicsRequest $request){

      return $this->demographicsRepository->userScholarship($request);

    }

    public function userDemographics(DemographicsRequest $request){

      return $this->demographicsRepository->userDemographics($request);

    }

    public function userSignups(DemographicsRequest $request){

      return $this->demographicsRepository->userSignups($request);

    }


}
