<?php

namespace App\Http\Controllers\Results;

use App\Http\Controllers\Controller;
use App\Http\Requests\Results\ResultsRequest;
use App\Repositories\Rest\Results\ResultsRepository;
use App\Repositories\Rest\Results\DomainsRepository;
use App\Models\Quiz;

class ResultsController extends Controller
{
  private ResultsRepository $resultsRepository;

  public function __construct(ResultsRepository $resultsRepository)
  {

    $this->resultsRepository = $resultsRepository;
  }

  public function index(ResultsRequest $request)
  {

    return $this->resultsRepository->allResults($request);
  }

  public function totals(Quiz $quiz, $user_id)
  {

    return $this->resultsRepository->totals($quiz, $user_id);
  }

  public function totalsForPipelines(Quiz $quiz, $user_id)
  {

    return $this->resultsRepository->totalsForPipelines($quiz, $user_id);
  }
}
