<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
class DocumentUploadController extends Controller
{
    public function document(){
        return view('employee.document');
    }

    public function document_store(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $rules = [
            'reference_letter' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',
            'nbi_clearence' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',
            'police_clearence' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',
            'barangay_clearence' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',
            'marriage_certificate' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',

            'certificate_of_no_marriage' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',
            'special_power_of_attorny' => 'file|mimes:pdf,png,jpg,jpeg|max:2048',
           
        ];

        if (!$request->has('existing_reference_letter')) {
            $rules['reference_letter'] = 'required|' . $rules['reference_letter'];
        }
        if (!$request->has('existing_nbi_clearence')) {
            $rules['nbi_clearence'] = 'required|' . $rules['nbi_clearence'];
        }
        if (!$request->has('existing_police_clearence')) {
            $rules['police_clearence'] = 'required|' . $rules['police_clearence'];
        }
        if (!$request->has('existing_barangay_clearence')) {
            $rules['barangay_clearence'] = 'required|' . $rules['barangay_clearence'];
        }
        if (!$request->has('existing_marriage_certificate')) {
            $rules['marriage_certificate'] = 'required|' . $rules['marriage_certificate'];
        }

        if (!$request->has('existing_certificate_of_no_marriage')) {
            $rules['certificate_of_no_marriage'] = 'required|' . $rules['certificate_of_no_marriage'];
        }
        if (!$request->has('existing_special_power_of_attorny')) {
            $rules['special_power_of_attorny'] = 'required|' . $rules['special_power_of_attorny'];
        }
       
        $validatedData = $request->validate($rules);

        $this->handleFileUpload($request, 'reference_letter', 'uploads/reference_letter', $user);
        $this->handleFileUpload($request, 'nbi_clearence', 'uploads/nbi_clearence', $user);
        $this->handleFileUpload($request, 'police_clearence', 'uploads/police_clearence', $user);
        $this->handleFileUpload($request, 'barangay_clearence', 'uploads/barangay_clearence', $user);
        $this->handleFileUpload($request, 'marriage_certificate', 'uploads/marriage_certificate', $user);
        $this->handleFileUpload($request, 'certificate_of_no_marriage', 'uploads/certificate_of_no_marriage', $user);
        $this->handleFileUpload($request, 'special_power_of_attorny', 'uploads/special_power_of_attorny', $user);
      
        return redirect()->back()->with('success', 'Documents Uploaded Successfully.');
    }

    
    private function handleFileUpload(Request $request, $fieldName, $destinationPath, $user)
    {
        if ($request->hasFile($fieldName)) {
            $currentImagePath = public_path($destinationPath . '/' . $user->$fieldName);
            if (File::exists($currentImagePath)) {
                File::delete($currentImagePath);
            }

            $imageName = auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . auth()->user()->id . '.' . $request->$fieldName->extension();
            $request->$fieldName->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;
            $user->update([$fieldName => $imagePath]);
        }
    }
}



