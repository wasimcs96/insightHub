<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportPopulationTabularDataToExcel;

class ExportPopulationController extends Controller
{
    public function exportToExcel($type)
    {
        
        // Fetch data from the API (replace with your API call)
        $dataFromApi = $this->getDataFromApi();

        // Prepare data for the Excel export
        $dataForExcel = $this->prepareDataForExcel($dataFromApi);

        // Export the data to Excel
        return Excel::download(new ExportPopulationTabularDataToExcel($dataForExcel,$type), 'data.xlsx');
    }

    // Replace this method with your API call
    private function getDataFromApi()
    {
        // Make your API call here and get the data
        // For example:
        $base_url =  env('MYNEXT_URL')."/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10000";
     
     
        $response = \Http::get($base_url);
        // dd($response->json()['data']['data']['population_question_report_count']);
        // return $response->json();
        // For this example, I'll use sample data.
        $data= $response->json()['data']['results'];
        return $data;
    }

    private function prepareDataForExcel($data)
    {
        // You can modify the data here if needed before exporting to Excel
        return $data;
    }
}