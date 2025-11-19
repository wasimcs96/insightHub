<?php

namespace App\Http\Controllers;

use App\Models\FacetQuestionOption;
use App\Models\MasterFacet;
use App\Models\SelectedFacetQuestionOption;
use Illuminate\Http\Request;

class FacetsQuestionController extends Controller
{
    function teamDynamics()
    {
        $masterFacets = MasterFacet::with(['facetQuestions.facetQuestionOptions'])->get();
        $savedSelections = SelectedFacetQuestionOption::pluck('facet_question_option_id', 'facet_question_id')->toArray();
        return view('admin.setting.team_dynamics', compact('masterFacets', 'savedSelections'));
    }

    public function store(Request $request)
    {

        $answers = $request->input('answers'); // This will be an array of question_id => option_id pairs

        foreach ($answers as $questionId => $optionId) {
            SelectedFacetQuestionOption::updateOrCreate(
                [
                    'facet_question_id' => $questionId,
                ],
                [
                    'facet_question_option_id' => $optionId,
                ]
            );
        }

        $scores = ['low' => 1.25, 'medium' => 2.5, 'high' => 4];

        // Initialize variables to calculate averages
        $facetScores = [];
        $facetCounts = [];

        // Iterate through answers to calculate scores
        foreach ($answers as $questionId => $optionId) {
            $option = FacetQuestionOption::find($optionId);

            // Assuming you have a method to retrieve the option type (Low, Medium, High) from the option
            $optionType = $option->type; // Adjust based on your actual data structure
            $facetId = $option->facetQuestion->facet_id; // Ensure your model relationships allow this


            // Initialize facet score and count if not already set
            if (!isset($facetScores[$facetId])) {
                $facetScores[$facetId] = 0;
                $facetCounts[$facetId] = 0;
            }

            // Add the score for this option to the total for its facet
            if (isset($scores[$optionType])) {
                $facetScores[$facetId] += $scores[$optionType];
                $facetCounts[$facetId]++;
            }
        }

        // Calculate the average score for each facet
        $facetAverages = [];
        foreach ($facetScores as $facetId => $totalScore) {
            $facetAverages[$facetId] = $facetCounts[$facetId] > 0 ? $totalScore / $facetCounts[$facetId] : 0;
            $facet = MasterFacet::find($facetId);
            $facet->point = $facetCounts[$facetId] > 0 ? number_format($totalScore / $facetCounts[$facetId], 2) : 0;
            $facet->save();
        }

        return redirect()->back()->with('success', 'Data updated successfully.');
    }
}
