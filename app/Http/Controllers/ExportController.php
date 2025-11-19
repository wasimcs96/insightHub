<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDataToExcel;

class ExportController extends Controller
{
    public function exportToExcel()
    {
        // Fetch data from the API (replace with your API call)
        $dataFromApi = $this->getDataFromApi();

        // Prepare data for the Excel export
        $dataForExcel = $this->prepareDataForExcel($dataFromApi);

        // Export the data to Excel
        return Excel::download(new ExportDataToExcel($dataForExcel), 'data.xlsx');
    }

    // Replace this method with your API call
    private function getDataFromApi()
    {
        // Make your API call here and get the data
        // For example:
        $api = env('MYNEXT_URL').'/api/dashboard/university/analytical/demographic/total-students-cognitive-counts';
        $response = \Http::get($api);

        $data= $response->json()['data']['data']['population_question_report_count'];

        return $data;
    }

    private function prepareDataForExcel($data)
    {
        // You can modify the data here if needed before exporting to Excel
        return $data;
    }
}