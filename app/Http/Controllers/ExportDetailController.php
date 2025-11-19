<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportDataToExcel;

class ExportDetailController extends Controller
{
    public function exportToExcel($userid)
    {
        // dd($userid);    
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
        $api = env('MYNEXT_URL').'/api/dashboard/university/analytical/demographic/total-questions-by-user-cognitive?page_size=100000';
        $response = \Http::get($api);
        // dd($response->json()['data']['results']);
        // return $response->json();
        // For this example, I'll use sample data.
        return $response->json()['data']['results'];
    }

    private function prepareDataForExcel($data)
    {
        // You can modify the data here if needed before exporting to Excel
        return $data;
    }
}
