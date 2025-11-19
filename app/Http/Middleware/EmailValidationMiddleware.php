<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\NeverBounceService;
use App\Exports\InvalidEmailsExport;
use Exception;

class EmailValidationMiddleware
{
    protected $neverBounceService;

    public function __construct(NeverBounceService $neverBounceService)
    {
        $this->neverBounceService = $neverBounceService;
    }

    public function handle(Request $request, Closure $next)
    {
        set_time_limit(500);

        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        try {
            $emails = $this->extractEmailsFromExcel($request->file('file'));

            if (empty($emails)) {
                return response()->json(['error' => 'No valid email column found'], 400);
            }

            $invalidEmails = [];
            foreach ($emails as $email) {
                $result = $this->neverBounceService->validateEmailWithGuzzle($email);

                if ($result['result'] !== 'valid') {
                    $invalidEmails[] = [$email, $result['result']];
                }
            }

            if (!empty($invalidEmails)) {
                //return Excel::download(new InvalidEmailsExport($invalidEmails), 'invalid_emails.xlsx');
                $filePath = 'invalid_emails.xlsx';
                Excel::store(new InvalidEmailsExport($invalidEmails), 'public/' . $filePath);
    
                // Redirect with error message and download link
                return redirect()->back()->with([
                    'error' => 'Validation failed. Please download the file to check invalid emails.',
                    'download_link' => asset('storage/' . $filePath)
                ]);
            }

            return $next($request);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function extractEmailsFromExcel($file): array
    {
        $rows = Excel::toArray([], $file);
        $emails = [];

        foreach ($rows[0] as $row) {
            foreach ($row as $value) {
                if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $emails[] = $value;
                }
            }
        }

        return $emails;
    }
}
