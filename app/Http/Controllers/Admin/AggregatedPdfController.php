<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class AggregatedPdfController extends Controller
{
    // Controller
public function generatePdf(Request $request)
    {
        $imagePaths = [
            'base64MainImage' => public_path('images/pdf-aggregated-department/pdf-main-page-image.png'),
            'base64MainImageRight' => public_path('images/pdf-aggregated-department/test-1.png'),
        ];

        foreach ($imagePaths as $key => $path) {
            $data[$key] = file_exists($path) ? 'data:image/png;base64,' . base64_encode(file_get_contents($path)) : null;
        }

        $htmlContent = view('pdf_template', $data)->render();

        $mpdf = new Mpdf([
            'orientation' => 'L',
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'allow_output_buffering' => true,
        ]);

        $stylesheet = file_get_contents(public_path('css/pdf-styles.css'));
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($htmlContent, \Mpdf\HTMLParserMode::HTML_BODY);

        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}