<?php

namespace App\Http\Controllers\Demographics;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Rest\Demographics\FinancialSupportRepository;

use App\Http\Requests\Demographics\DemographicsRequest;

class FinancialSupportController extends Controller
{
  private FinancialSupportRepository $financialSupportRepository;

  public function __construct(Request $request, FinancialSupportRepository $financialSupportRepository){

    $this->financialSupportRepository = $financialSupportRepository;

  }

  public function usersByScholarData(DemographicsRequest $request){

    return $this->financialSupportRepository->usersByScholarData($request);

  }
}
