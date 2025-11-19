<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class UserResultsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return the collection of data for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = DB::table('user_results AS ur')
            ->select([
                'u.name',
                DB::raw('MAX(CASE WHEN ur.result_type = "soft_skill_score" THEN ur.percentage END) AS bfr_percentage'),
                DB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Very Low'
                            WHEN ur.level = 2 THEN 'Low'
                            WHEN ur.level = 3 THEN 'Moderate'
                            WHEN ur.level = 4 THEN 'High'
                            WHEN ur.level = 5 THEN 'Very High'
                            ELSE 'Unknown' END ELSE NULL END) AS bfr_level"),
                DB::raw('MAX(CASE WHEN ur.result_type = "ccs_match_rate" THEN ur.percentage END) AS ssmr_percentage'),
                DB::raw("MAX(CASE WHEN ur.result_type = 'ccs_match_rate' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Very Low'
                            WHEN ur.level = 2 THEN 'Low'
                            WHEN ur.level = 3 THEN 'Moderate'
                            WHEN ur.level = 4 THEN 'High'
                            WHEN ur.level = 5 THEN 'Very High'
                            ELSE 'Unknown' END ELSE NULL END) AS ssmr_level"),
                DB::raw('MAX(CASE WHEN ur.result_type = "jmr" THEN ur.percentage END) AS jmr_percentage'),
                DB::raw("MAX(CASE WHEN ur.result_type = 'jmr' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Very Low'
                            WHEN ur.level = 2 THEN 'Low'
                            WHEN ur.level = 3 THEN 'Moderate'
                            WHEN ur.level = 4 THEN 'High'
                            WHEN ur.level = 5 THEN 'Very High'
                            ELSE 'Unknown' END ELSE NULL END) AS jmr_level"),
                DB::raw('MAX(CASE WHEN ur.assessment_type = "cognitive" AND ur.result_type = "overall" THEN ur.percentage END) AS cat_percentage'),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Low'
                            WHEN ur.level = 2 THEN 'Moderate'
                            WHEN ur.level = 3 THEN 'High'
                            ELSE 'Unknown' END ELSE NULL END) AS cat_level"),
                DB::raw('MAX(CASE WHEN ur.result_type = "growth_potential" THEN ur.percentage END) AS gp_percentage'),
                DB::raw("MAX(CASE WHEN ur.result_type = 'growth_potential' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Very Low'
                            WHEN ur.level = 2 THEN 'Low'
                            WHEN ur.level = 3 THEN 'Moderate'
                            WHEN ur.level = 4 THEN 'High'
                            WHEN ur.level = 5 THEN 'Very High'
                            ELSE 'Unknown' END ELSE NULL END) AS gp_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'rci' THEN 
                            CASE WHEN ur.level = 0 THEN 'Somewhat Consistent'
                            WHEN ur.level = 1 THEN 'Fairly Consistent'
                            WHEN ur.level = 2 THEN 'Consistent'
                            ELSE 'Unknown' END ELSE NULL END) AS rci_level"),
                DB::raw('MAX(CASE WHEN ur.result_type = "flight_risk" THEN ur.percentage END) AS fr_percentage'),
                DB::raw("MAX(CASE WHEN ur.result_type = 'flight_risk' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Very Low'
                            WHEN ur.level = 2 THEN 'Low'
                            WHEN ur.level = 3 THEN 'Moderate'
                            WHEN ur.level = 4 THEN 'High'
                            WHEN ur.level = 5 THEN 'Very High'
                            ELSE 'Unknown' END ELSE NULL END) AS fr_level"),
                DB::raw('MAX(CASE WHEN ur.result_type = "organizational_fit_forecast" THEN ur.percentage END) AS waf_percentage'),
                DB::raw("MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN 
                            CASE WHEN ur.level = 0 THEN 'Data not available'
                            WHEN ur.level = 1 THEN 'Very Low'
                            WHEN ur.level = 2 THEN 'Low'
                            WHEN ur.level = 3 THEN 'Moderate'
                            WHEN ur.level = 4 THEN 'High'
                            WHEN ur.level = 5 THEN 'Very High'
                            ELSE 'Unknown' END ELSE NULL END) AS waf_level"),
            ])
            ->join('users AS u', 'ur.user_id', '=', 'u.id')
            ->when($this->request->userType == 'candidate', function ($query) {
                return $query->join('job_opening_applications AS joa', 'u.id', '=', 'joa.user_id')
                             ->where('joa.job_opening_id', $this->request->job_opening_id);
            })
            ->when($this->request->has('exclude_user_ids'), function ($query) {
                return $query->whereNotIn('u.id', explode(',', $this->request->exclude_user_ids));
            })
            ->when($this->request->has('user_id_comparison'), function ($query) {
                // Split the comparison into the operator and value
                $comparison = $this->request->user_id_comparison;
                // Match the operator (e.g., >=, <=, >, <, =)
                $operator = preg_match('/[<>]=?/', $comparison, $matches) ? $matches[0] : '=';
                // Get the value to compare
                $value = preg_replace('/[<>]=?/', '', $comparison);
            
                return $query->where('u.id', $operator, $value);
            })
            
            ->groupBy('ur.user_id')
            ->get();

        return $query;
    }

    /**
     * Return the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'BFR Percentage',
            'BFR Level',
            'SSMR Percentage',
            'SSMR Level',
            'JMR Percentage',
            'JMR Level',
            'CAT Percentage',
            'CAT Level',
            'GP Percentage',
            'GP Level',
            'RCI Level',
            'FR Percentage',
            'FR Level',
            'WAF Percentage',
            'WAF Level',
        ];
    }
}
