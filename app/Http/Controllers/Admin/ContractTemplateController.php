<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContractTemplate;
use App\Models\ContractTemplateField;
use App\Models\JobOpeningApplication;
use App\Models\User;
use App\Models\Contract;
use App\Models\Job;
use App\Helpers\HelperFunctions;
use Str;
use App\Helpers\MainHelper;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use File;


class ContractTemplateController extends Controller
{
    public function index() {
        $templates = ContractTemplate::paginate(10);
        return view('admin.contract_template.index', compact('templates'));
    }

    public function create() {
        return view('admin.contract_template.create');
    }

    public function store(Request $request) 
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $template = ContractTemplate::create([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        if ($request->has('optional_fields')) {
            foreach ($request->optional_fields as $fieldIndex => $fieldData) {
                ContractTemplateField::create([
                    'template_id' => $template->id,
                    'field_name' => $fieldData['key'],
                    'field_type' => $fieldData['type'],
                    'is_optional' => 1,
                    'group_id' => $fieldData['group_id'], // Add this line to assign the group_id
                ]);
            }
        }

        return redirect()->route('templates.index')->with('success', 'Template created successfully.');
    }

    public function edit($id)
    {
        $template = ContractTemplate::findOrFail($id);

        $optionalFieldDefinitions = [
         
            "contract-details" => [
                "contract_end_date" => ["name" => "Contract End Date (months)", "type" => "date"],
            ],
          
            "compensation-benefits" => [
                "overtime_rates" => ["name" => "Overtime Rates (if applicable)", "type" => "text"],
                "allowances" => ["name" => "Allowances", "type" => "text"],
                "bonuses_incentives" => ["name" => "Bonuses and Incentives", "type" => "text"],
                // "deductions" => ["name" => "Deductions", "type" => "text"],
                "benefits" => ["name" => "Benefits", "type" => "text"],
                // "payment_method" => ["name" => "Payment Method", "type" => "text"]
            ],
           
        ];

        return view('admin.contract_template.edit', compact('template', 'optionalFieldDefinitions'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
    
        $template = ContractTemplate::findOrFail($id);
        $template->update([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);
    
        $template->fields()->delete(); // Remove existing optional fields
        if ($request->has('optional_fields')) {
            foreach ($request->optional_fields as $fieldIndex => $fieldData) {
                ContractTemplateField::create([
                    'template_id' => $template->id,
                    'field_name' => $fieldData['key'],
                    'field_type' => $fieldData['type'],
                    'is_optional' => 1,
                    'group_id' => $fieldData['group_id'], // Add this line to assign the group_id
                ]);
            }
        }
    
        return redirect()->route('templates.index')->with('success', 'Template updated successfully.');
    }

    public function destroy($id)
    {
        $template = ContractTemplate::findOrFail($id);
        $template->delete();
        return redirect()->route('templates.index')->with('success', 'Template deleted successfully.');
    }

    public function loadContractForm($id,$application_id,$type) 
    {
        
        if($type == 'candidate'){
           
            $jobApplication = JobOpeningApplication::find($application_id);
            // dd($jobApplication);
            $job = $jobApplication->jobOpening->job_position;
            // dd($jobApplication->jobOpening->job_position);
            $employee = User::find($jobApplication->user_id);
            $template = ContractTemplate::find($id);
            $company = Auth()->user();
        }else{
            $jobApplication = '';
           
            $employee = User::find($application_id);
            $job = Job::find($employee->position_id);
            $template = ContractTemplate::find($id);
            // dd($template);
            $company = Auth()->user();
            
        }
        

        // dd($job->OrgDepartment);
        $optionalFieldDefinitions = [
         
            "contract-details" => [
                "contract_end_date" => ["name" => "Contract End Date (months)", "type" => "date"],
            ],
          
            "compensation-benefits" => [
                "overtime_rates" => ["name" => "Overtime Rates (if applicable)", "type" => "text"],
                "allowances" => ["name" => "Allowances", "type" => "text"],
                "bonuses_incentives" => ["name" => "Bonuses and Incentives", "type" => "text"],
                // "deductions" => ["name" => "Deductions", "type" => "text"],
                "benefits" => ["name" => "Benefits", "type" => "text"],
                // "payment_method" => ["name" => "Payment Method", "type" => "text"]
            ],
           
        ];
        $data = [
            'template'=>$template,
            'company'=>$company,
            'optionalFieldDefinitions'=>$optionalFieldDefinitions,
            'jobApplication' => $jobApplication,
            'employee'=>$employee,
            'job'=>$job
        ];
        return view('admin.contract.form',$data);
    }

    public function assignContract(Request $request,$id)
    {
        
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'company_id' => 'required',
            'job_application_id' => 'nullable',
            'job_id' => 'required',
            'emp_official_email' => 'required|email|unique:users,email',

            // 'company_name' => 'required|string|max:255',
            // 'company_address' => 'required|string|max:255',
            // 'company_branch' => 'nullable|string|max:255',
            // 'contact_person' => 'required|string|max:255',
            // 'contact_phone_number' => 'required|string|max:20',
            // 'contact_email' => 'required|email|max:255',
            // 'full_name' => 'required|string|max:255',
            // 'position' => 'required|string|max:255',
            // 'department' => 'nullable|string|max:255',
            // 'date_of_birth' => 'nullable|date',
            // 'gender' => 'nullable|string|max:255',
            // 'civil_status' => 'nullable|string|max:255',
            // 'address' => 'nullable|string|max:255',
            // 'phone' => 'nullable|string|max:20',
            // 'email' => 'nullable|email|max:255',
            'commencement_date' => 'required|date',
            'probationary_period' => 'nullable|integer',
            'contract_end_date' => 'nullable',
            'employment_type' => 'required|string|max:255',
            'place_of_work' => 'required|string|max:255',
            'responsibilities' => 'required|string',
            'basic_salary' => 'required|numeric',
            'pay_frequency' => 'required|string|max:255',
            'statutary_deduction' => 'required|string',
            'tardiness_policy' => 'required|string',
            'holiday_entitlement' => 'required|string',
            'notice_period' => 'nullable|integer',
            'grounds_for_termination' => 'nullable|string',
            'separation_pay' => 'nullable|string',
            'confidentiality_agreement' => 'nullable|string',
            'non_compete_clause' => 'nullable|string',
            'non_disclosure_agreement' => 'nullable|string',
            'intellectual_property_rights' => 'nullable|string',
            'dispute_resolution' => 'nullable|string',
            'acknowledgement_of_company_policies' => 'nullable|string',
            'acknowledgement_of_receipt_of_handbook' => 'nullable|string',
            'acknowledgement_of_understanding_terms_and_conditions' => 'nullable|string',
            'employee_signature' => 'nullable|string|max:255',
            'date_signed_by_employee' => 'nullable|date',
            'employer_signature' => 'required',
            'date_signed_by_employer' => 'nullable|date',
            'overtime_rate' => 'nullable|string',
            'is_allowance' => 'nullable',
            'uniform_allowance' => 'nullable',
            'rice_subsidy' => 'nullable',
            'laundry_allowance' => 'nullable',
            'daily_meal_allowance' => 'nullable',
            'bonuses_incentive' => 'nullable|string',
            'leave_entitlement' => 'nullable',
            'paid_leave_count' => 'nullable',
            'rest_days'=>'nullable',
            'working_hour'=> 'nullable',
            'benefits'=>'nullable',
            'contact_person'=>'nullable',
        ]);

        $previousContracts =Contract::where('employee_id', '=',$request->employee_id)->where('company_id', '=',$request->company_id)->where('job_application_id',$request->job_application_id)->get();

        if($previousContracts->isNotEmpty()) {
            foreach ($previousContracts as $contract) {
                $contract->delete();
            }
        }

        $benefits = $validatedData['benefits'] ?? '';
       

        if (is_array($benefits) && !empty($benefits)) {
            // Initialize an empty array to hold the final benefits
            $formatted_benefits = [];
            
            // Iterate over the array to format it correctly
            foreach ($benefits as $key => $value) {
                // Check if the key is a string (which means it's a benefit with its value)
                if (is_string($key)) {
                    $formatted_benefits[$key] = $value;
                }
            }
            
            // Convert to JSON
            $json_benefits = json_encode($formatted_benefits, JSON_PRETTY_PRINT);
            
            // Assign the JSON back to the validated data array
            $validatedData['benefits'] = $json_benefits;
        } else {
            // Handle the case where benefits is not an array or is empty
            $validatedData['benefits'] = '';
        }


        if($request->has('leave_entitlement')){
            $validatedData['leave_entitlement'] = implode(',', $validatedData['leave_entitlement']);
            // if($validatedData['paid_leave_count']){
            //     $validatedData['paid_leave_count'] = json_encode($validatedData['paid_leave_count']);
            // }

            if (isset($validatedData['paid_leave_count'])) {
                $validatedData['paid_leave_count'] = json_encode($validatedData['paid_leave_count']);
            }

        }
    
        if($request->has('rest_days')){

        $validatedData['rest_days'] = implode(',', $validatedData['rest_days']);
        }
        if($request->has('is_allowance')){

        $validatedData['is_allowance'] = 1;
        }
        // dd($validatedData);

        $user = User::find($request->employee_id);
        $user->marital_status = $request->marital_status ?? '';
        $user->gender = $request->gender ?? '' ;
        $user->mobile_number = $request->mobile_number ?? '' ;
        $user->home_address = $request->home_address ?? '' ;
        $user->birth_date = $request->birth_date ?? '' ;
        $user->save();
      

        // dd($validatedData);
    
        $contract = Contract::create($validatedData);

        // dd($contract);
        

        $signatureData = $request->input('employer_signature');
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);
    
        // Convert the image to base64
        $signatureBase64 = 'data:image/png;base64,' . base64_encode($signatureImage);
    
        $today = Carbon::now();
        $contract->update([
            'employer_signature' => $signatureBase64,
            'date_signed_by_employer' => $today->toDateString(),
        ]);

        $pdf = PDF::loadView('admin.contract.pdf', compact('contract'));

        // Define the PDF path
        $destinationPath = public_path('uploads/contracts/');
        $random_number = Rand(1,999999);
        $pdfPath = $destinationPath . $random_number .'_'.$contract->employee_id .'_'. $contract->id . '_contract.pdf';

        // Check if the directory exists, if not, create it
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Save the PDF to the storage
        $pdf->save($pdfPath);

        // Update the contract record with the PDF path
        $contract->update(['contract_pdf' => '/uploads/contracts/' . $random_number .'_'.$contract->employee_id .'_'. $contract->id . '_contract.pdf']);

        if($request->has('job_application_id') && $request->job_application_id){
            $jobApplication = JobOpeningApplication::find($request->job_application_id);
            $jobApplication->status = 8;
            $jobApplication->save();

            $activity = MainHelper::CreatejobApplicationLogs($jobApplication->user_id, $jobApplication->id, 'Contract Letter assigned');

            // Send Email
            // $to = $user->secondary_email ?? '';
            // $subject = 'Letter of Appointment Assigned';
            // $message = 'Hired Email';
            // $mailableClass = 'SendHiredEmail';
            // $data = [
            //     'new_email' => $user->email ?? '',
            //     'previous_email' => $user->secondary_email ?? '',
            //     'name' => $user->name ?? '',
            //     'job_title' => $jobApplication->jobOpening->job_title ?? '',
            //     'company_name' =>auth()->user()->userCompany->name ? $user->company->userCompany->name : ''
            // ];

            // HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);

            $to = $user->email;
            $subject = 'Employment Offer from EEI';
            
            $mailableClass = 'send_contract_issued_email';
            $filePath = public_path($contract->contract_pdf ?? '');
            // dd(public_path($contract->contract_pdf ?? ''), $contract->contract_pdf );
            $data = [
                'Employee Full Name' => $user->name ?? '',
                'Employee First Name' => $user->first_name ?? '',
                'Employee Middle Name' => $user->middle_name ?? '',
                'Employee Last Name' => $user->last_name ?? '',
                'Status' => config('helpers.application_status')[$jobApplication->status] ?? '',
                'Company Name' => $jobApplication->jobOpening->company->userCompany->name ?? '',
                'Job Title'=>$jobApplication->jobOpening->job_title ?? 'Job Title',
                'Department'=>$jobApplication->jobOpening->department->name ?? 'Department name',
                'Start Date'=>$contract->commencement_date,
                'Basic Salary'=>$contract->basic_salary,
                'File Path'=>$filePath
            ];
    
            HelperFunctions::sendEmail($to, $mailableClass, $data);
        }
        // Redirect or return a response
        // return redirect('/admin/dashboard')->with('success', 'Contract created successfully and PDF generated.');
        if($request->has('job_application_id') && $request->job_application_id){
            $message = 'Success! The contract has been successfully sent to'. $user->email .'.';
            return redirect()->route('admin.talent-acquisition.job-advertisement.detail',[$jobApplication->job_opening_id ?? ''])->with('alert-success', $message);

        }else{
            return redirect('/admin/myemployee')->with('success', 'Contract created successfully and PDF generated.');

    if ($previousContracts->isNotEmpty()) {
        foreach ($previousContracts as $contract) {
            $contract->delete();
        }
    }

    // Process benefits and other array-based fields
    $benefits = $validatedData['benefits'] ?? '';
    if (is_array($benefits) && !empty($benefits)) {
        $formatted_benefits = [];
        foreach ($benefits as $key => $value) {
            if (is_string($key)) {
                $formatted_benefits[$key] = $value;
            }
        }
        $json_benefits = json_encode($formatted_benefits, JSON_PRETTY_PRINT);
        $validatedData['benefits'] = $json_benefits;
    } else {
        $validatedData['benefits'] = '';
    }

    // Handle leave entitlement and other fields
    if ($request->has('leave_entitlement')) {
        $validatedData['leave_entitlement'] = implode(',', $validatedData['leave_entitlement']);
        if (isset($validatedData['paid_leave_count'])) {
            $validatedData['paid_leave_count'] = json_encode($validatedData['paid_leave_count']);
        }
    }

    if ($request->has('rest_days')) {
        $validatedData['rest_days'] = implode(',', $validatedData['rest_days']);
    }

    if ($request->has('is_allowance')) {
        $validatedData['is_allowance'] = 1;
    }

    // Update the user's personal details
    $user = User::find($request->employee_id);
    $user->marital_status = $request->marital_status ?? '';
    $user->gender = $request->gender ?? '';
    $user->mobile_number = $request->mobile_number ?? '';
    $user->home_address = $request->home_address ?? '';
    $user->birth_date = $request->birth_date ?? '';
    $user->save();

    // Create the contract
    $contract = Contract::create($validatedData);

    // Handle employer's signature
    $signatureData = $request->input('employer_signature');
    $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
    $signatureData = str_replace(' ', '+', $signatureData);
    $signatureImage = base64_decode($signatureData);
    $signatureBase64 = 'data:image/png;base64,' . base64_encode($signatureImage);

    // Update contract with employer's signature and date
    $today = Carbon::now();
    $contract->update([
        'employer_signature' => $signatureBase64,
        'date_signed_by_employer' => $today->toDateString(),
    ]);

    // Generate PDF for the contract
    $pdf = PDF::loadView('admin.contract.pdf', compact('contract'));
    $destinationPath = public_path('uploads/contracts/');
    $random_number = Rand(1, 999999);
    $pdfPath = $destinationPath . $random_number . '_' . $contract->employee_id . '_' . $contract->id . '_contract.pdf';

    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0755, true);
    }

    // Save the PDF
    $pdf->save($pdfPath);
    $contract->update(['contract_pdf' => '/uploads/contracts/' . $random_number . '_' . $contract->employee_id . '_' . $contract->id . '_contract.pdf']);

    // Send email if job application is provided
    if ($request->has('job_application_id') && $request->job_application_id) {
        $jobApplication = JobOpeningApplication::find($request->job_application_id);
        $jobApplication->status = 7;  // Assuming 7 is the status for "Contract assigned"
        $jobApplication->save();

        $activity = MainHelper::CreatejobApplicationLogs($jobApplication->user_id, $jobApplication->id, 'Contract Letter assigned');

        // Prepare email data and template for sending contract email
        // $to = $user->email;
        // $templateType = 'send_contract_issued_email';  // Template type for the contract issue
        // $filePath = public_path($contract->contract_pdf ?? '');
        // $data = [
        //     'status' => config('helpers.application_status')[$jobApplication->status] ?? '',
        //     'company_name' => $jobApplication->jobOpening->company->userCompany->name ?? '',
        //     'job_title' => $jobApplication->jobOpening->job_title ?? 'Job Title',
        //     'department' => $jobApplication->jobOpening->department->name ?? 'Department name',
        //     'start_date' => $contract->commencement_date,
        //     'basic_salary' => $contract->basic_salary,
        //     'filePath' => $pdfPath,  // Path to the PDF
        // ];

        // // Send email using helper function
        // HelperFunctions::sendEmail($to, $templateType, $data);
    }

    // Redirect based on the presence of job_application_id
    if ($request->has('job_application_id') && $request->job_application_id) {
        return redirect()->route('admin.job-opening.applicant-details', [$request->job_application_id, $request->employee_id])
            ->with('success', 'Contract created successfully and PDF generated.');
    } else {
        return redirect('/admin/myemployee')->with('success', 'Contract created successfully and PDF generated.');
    }
}
    }
    public function contractPDF($id)
    {
        set_time_limit(300); // Increase the maximum execution time
       
        $contract = Contract::find($id);
    
        if (!$contract) {
            return redirect('/admin/dashboard')->with('error', 'Contract not found.');
        }
    
        // Generate PDF
        $pdf = PDF::loadView('admin.contract.pdf', compact('contract'))->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    
        // Return the PDF as a stream to view in the browser
        return $pdf->stream('contract_' . $contract->id . '.pdf');
    }

    public function generatePreview(Request $request)
    {
        // dd($request->all());
       
        // Cleanup: Remove old preview PDFs
        $previewFolder = public_path('uploads/contracts/preview');
        // if (!File::exists($previewFolder)) {
        //     $files = File::files($previewFolder);

        //     foreach ($files as $file) {
        //         if (Str::startsWith($file->getFilename(), 'preview_')) {
        //             $lastModified = $file->getMTime(); // Timestamp of last modification
        //             if (now()->diffInMinutes(Carbon::createFromTimestamp($lastModified)) > 60) {
        //                 File::delete($file->getRealPath());
        //             }
        //         }
        //     }
        // }
        //    dd($request->all());
      
        // Continue with preview generation (same as before)...
        // $validatedData = $request->validate([
        //     'employee_id' => 'required',
        //     'company_id' => 'required',
        //     'job_application_id' => 'nullable',
        //     'job_id' => 'required',
        //     'emp_official_email' => 'required|email|unique:users,email',

        //     // 'company_name' => 'required|string|max:255',
        //     // 'company_address' => 'required|string|max:255',
        //     // 'company_branch' => 'nullable|string|max:255',
        //     // 'contact_person' => 'required|string|max:255',
        //     // 'contact_phone_number' => 'required|string|max:20',
        //     // 'contact_email' => 'required|email|max:255',
        //     // 'full_name' => 'required|string|max:255',
        //     // 'position' => 'required|string|max:255',
        //     // 'department' => 'nullable|string|max:255',
        //     // 'date_of_birth' => 'nullable|date',
        //     // 'gender' => 'nullable|string|max:255',
        //     // 'civil_status' => 'nullable|string|max:255',
        //     // 'address' => 'nullable|string|max:255',
        //     // 'phone' => 'nullable|string|max:20',
        //     // 'email' => 'nullable|email|max:255',
        //     'commencement_date' => 'required|date',
        //     'probationary_period' => 'nullable|integer',
        //     'contract_end_date' => 'nullable',
        //     'employment_type' => 'required|string|max:255',
        //     'place_of_work' => 'required|string|max:255',
        //     'responsibilities' => 'required|string',
        //     'basic_salary' => 'required|numeric',
        //     'pay_frequency' => 'required|string|max:255',
        //     'statutary_deduction' => 'required|string',
        //     'tardiness_policy' => 'required|string',
        //     'holiday_entitlement' => 'required|string',
        //     'notice_period' => 'nullable|integer',
        //     'grounds_for_termination' => 'nullable|string',
        //     'separation_pay' => 'nullable|string',
        //     'confidentiality_agreement' => 'nullable|string',
        //     'non_compete_clause' => 'nullable|string',
        //     'non_disclosure_agreement' => 'nullable|string',
        //     'intellectual_property_rights' => 'nullable|string',
        //     'dispute_resolution' => 'nullable|string',
        //     'acknowledgement_of_company_policies' => 'nullable|string',
        //     'acknowledgement_of_receipt_of_handbook' => 'nullable|string',
        //     'acknowledgement_of_understanding_terms_and_conditions' => 'nullable|string',
        //     'employee_signature' => 'nullable|string|max:255',
        //     'date_signed_by_employee' => 'nullable|date',
        //     'employer_signature' => 'required',
        //     'date_signed_by_employer' => 'nullable|date',
        //     'overtime_rate' => 'nullable|string',
        //     'is_allowance' => 'nullable',
        //     'uniform_allowance' => 'nullable',
        //     'rice_subsidy' => 'nullable',
        //     'laundry_allowance' => 'nullable',
        //     'daily_meal_allowance' => 'nullable',
        //     'bonuses_incentive' => 'nullable|string',
        //     'leave_entitlement' => 'nullable',
        //     'paid_leave_count' => 'nullable',
        //     'rest_days'=>'nullable',
        //     'working_hour'=> 'nullable',
        //     'benefits'=>'nullable',
        //     'contact_person'=>'nullable',
        // ]);
        $validatedData = $request->all();
        // return response()->json($validatedData);
        $benefits = $request->input('benefits', []);
        $validatedData['benefits'] = is_array($benefits) ? json_encode($benefits) : '';

        if ($request->has('leave_entitlement')) {
            $validatedData['leave_entitlement'] = implode(',', $request->leave_entitlement);
            $validatedData['paid_leave_count'] = json_encode($request->paid_leave_count ?? []);
        }

        if ($request->has('rest_days')) {
            $validatedData['rest_days'] = implode(',', $request->rest_days);
        }

        if ($request->has('is_allowance')) {
            $validatedData['is_allowance'] = 1;
        }

        $signatureData = $validatedData['employer_signature'];
        $signatureImage = base64_decode(str_replace('data:image/png;base64,', '', str_replace(' ', '+', $signatureData)));
        $validatedData['employer_signature'] = 'data:image/png;base64,' . base64_encode($signatureImage);
        $validatedData['date_signed_by_employer'] = Carbon::now()->toDateString();
     // dd($validatedData);
        $employee = User::find($request->employee_id);
        $company = auth()->user();
        
        $job = Job::find($request->job_id);

        $contract = new \stdClass();
        foreach ($validatedData as $key => $value) {
            $contract->{$key} = $value;
        }
        $contract->user = $employee;
        $contract->company = $company;
        $contract->jobPosition = $job;
        
        $pdf = PDF::loadView('admin.contract.pdf', compact('contract'));

        $random_name = 'preview_' . time() . '_' . Str::random(6) . '.pdf';
        $tempPath = public_path('uploads/contracts/preview' . $random_name);

        if (!File::exists($previewFolder)) {
            File::makeDirectory($previewFolder, 0755, true);
        }

        $pdf->save($tempPath);

        return response()->json([
            'success' => true,
            'pdf_url' => asset('uploads/contracts/preview' . $random_name)
        ]);
    }


    private function handleEmpFileUpload($employment, $fieldName, $destinationPath, $userEmp)
    {
        if (isset($employment[$fieldName])) {
            $currentImagePath = public_path($destinationPath . '/' . $userEmp->$fieldName);
            if (File::exists($currentImagePath)) {
                File::delete($currentImagePath);
            }

            $imageName = $userEmp->id . '_' . auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . auth()->user()->id . '.' . $employment[$fieldName]->extension();
            $employment[$fieldName]->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;
            $userEmp->update([$fieldName => $imagePath]);
        }
    }


    

}