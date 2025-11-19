<?php

namespace App\Http\Controllers\Admin\TalentAcquisition;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ContractTemplate;
use App\Models\ContractTemplateField;
use App\Models\Template;
use App\Models\MasterCompanyOverview;
use App\Models\MasterCompanyBenefit;

class TemplateSettingsController extends Controller
{

    public function index() 
    {
        $page = request()->get('page');
  
     
        switch ($page) {
            case 'employee-contract':
                $responseData = $this->indexEmployeeContract();
                break;
            case 'email-template':
                $responseData = $this->indexEmailTemplate();
                break;
            case 'company-overview':
                $responseData = $this->indexCompanyOverview();
                break;
            case 'compensation-benefits':
                $responseData = $this->indexCompensationBenefits();
                break;
            default:
               $responseData = $this->indexEmployeeContract();
        }

       return view('admin.talent-acquisition.template-settings.index', $responseData);
    }

    /**
     * =======================
     * Employee Contract Methods
     * =======================
     */
    public function indexEmployeeContract()
    {
        $responseData = [];
        $contracts = ContractTemplate::all();
        $responseData['employeeContracts'] = $contracts;

        return $responseData;
        // return view('admin.talent-acquisition.template-settings.employee-contract.index', compact('contracts'));
    }

    public function createEmployeeContract()
    {
        return view('admin.talent-acquisition.template-settings.employee-contract.create');
    }

    public function storeEmployeeContract(Request $request)
    {
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

        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'employee-contract'])->with('success', 'Employee Contract created successfully.');
    }

    // Edit Function: Display the form for editing an existing contract template
    public function editEmployeeContract($id)
    {
        $contractTemplate = ContractTemplate::with('fields')->findOrFail($id);
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
        return view('admin.talent-acquisition.template-settings.employee-contract.edit', compact('contractTemplate', 'optionalFieldDefinitions'));
    }

    // Update Function: Update the contract template and its associated optional fields
    public function updateEmployeeContract(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // Find the contract template by its ID
        $template = ContractTemplate::findOrFail($id);

        // Update the contract template
        $template->update([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        // Delete existing optional fields
        $template->fields()->delete();

        // If optional fields exist, update them
        if ($request->has('optional_fields')) {
            foreach ($request->optional_fields as $fieldIndex => $fieldData) {
                ContractTemplateField::create([
                    'template_id' => $template->id,
                    'field_name' => $fieldData['key'],
                    'field_type' => $fieldData['type'],
                    'is_optional' => 1,
                    'group_id' => $fieldData['group_id'],
                ]);
            }
        }

        // Redirect to the contract template index page
        return redirect()->route('admin.talent-acquisition.template-settings.index', ['page' => 'employee-contract'])
            ->with('success', 'Employee Contract updated successfully.');
    }

    public function destroyEmployeeContract($id)
    {
        // Find the contract template by its ID
        $contract = ContractTemplate::findOrFail($id);

        // Delete associated optional fields (ContractTemplateField) before deleting the main contract
        $contract->fields()->delete();

        // Delete the contract template itself
        $contract->delete();

        // Redirect back with a success message
        return redirect()->route('admin.talent-acquisition.template-settings.index', ['page' => 'employee-contract'])
            ->with('success', 'Employee Contract deleted successfully.');
    }


    // Duplicate Function: Duplicate an existing contract template
    public function duplicateEmployeeContract($id)
    {
        // Find the contract template by its ID
        $originalTemplate = ContractTemplate::with('fields')->findOrFail($id);

        // Create a duplicate of the contract template
        $newTemplate = $originalTemplate->replicate();
        $newTemplate->name = $originalTemplate->name . ' (Copy)'; // Append (Copy) to the name
        $newTemplate->save();

        // Duplicate the associated fields
        foreach ($originalTemplate->fields as $field) {
            ContractTemplateField::create([
                'template_id' => $newTemplate->id,
                'field_name' => $field->field_name,
                'field_type' => $field->field_type,
                'is_optional' => $field->is_optional,
                'group_id' => $field->group_id,
            ]);
        }

        // Redirect to the contract template index page
        return redirect()->route('admin.talent-acquisition.template-settings.index', ['page' => 'employee-contract'])
            ->with('success', 'Employee Contract duplicated successfully.');
    }

    /**
     * =======================
     * Email Template Methods
     * =======================
     */
    public function indexEmailTemplate()
    {
        $responseData = [];
        $emailTemplates = Template::all();
        $responseData['emailTemplates'] = $emailTemplates;

        return $responseData;
        // return view('admin.talent-acquisition.template-settings.email-template.index', compact('templates'));
    }

    public function createEmailTemplate()
    {
        return view('admin.talent-acquisition.template-settings.email-template.create');
    }

    public function storeEmailTemplate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|unique:templates,type',
            'subject' => 'required|string',
        ]);

        Template::create($validated);

        return redirect()->route('admin.talent-acquisition.template-settings.index', ['page' => 'email-template'])
            ->with('success', 'Email Template created successfully.');
    }


    public function editEmailTemplate($id)
    {
        $template = Template::findOrFail($id);
        return view('admin.talent-acquisition.template-settings.email-template.edit', compact('template'));
    }

    public function updateEmailTemplate(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => [
                'required',
                'string',
                Rule::unique('templates', 'type')->ignore($id),
            ],
            'subject' => 'required|string',
        ]);

        $template = Template::findOrFail($id);
        $template->update($validated);

        return redirect()->route('admin.talent-acquisition.template-settings.index', ['page' => 'email-template'])
            ->with('success', 'Email Template updated successfully.');
    }

    public function destroyEmailTemplate($id)
{
    $template = Template::findOrFail($id);
    $template->delete();

    return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'email-template'])
        ->with('success', 'Email Template deleted successfully.');
}

public function duplicateEmailTemplate($id)
{
    $template = Template::findOrFail($id);
    
    session([
        'duplicate_template' => [
            'title' => $template->title,
            'subject' => $template->subject,
            'type' => $template->type,
            'description' => $template->description,
        ]
    ]);
    
    return redirect()->route('admin.talent-acquisition.template-settings.email-template.create');
}
    

    /**
     * =======================
     * Company Overview Methods
     * =======================
     */
    public function indexCompanyOverview()
    {
        $responseData = [];
        $overviews = MasterCompanyOverview::all();
        $responseData['overviews'] = $overviews;
        return $responseData;
        // return view('admin.talent-acquisition.template-settings.company-overview.index', compact('overviews'));
    }

    public function createCompanyOverview()
    {
        return view('admin.talent-acquisition.template-settings.company-overview.create');
    }

    public function storeCompanyOverview(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required'
            ]
        );

        MasterCompanyOverview::create(
            [
                'name' => $request->name,
                'description' => $request->description
            ]
        );

        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'company-overview'])->with('success', 'Company Overview created successfully.');
    }

    public function editCompanyOverview($id)
    {
        $overview = MasterCompanyOverview::findOrFail($id);
        return view('admin.talent-acquisition.template-settings.company-overview.edit', compact('overview'));
    }

    public function updateCompanyOverview(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required'
            ]
        );
        $overview = MasterCompanyOverview::findOrFail($id);
        $overview->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'company-overview'])->with('success', 'Company Overview updated successfully.');
    }

    public function destroyCompanyOverview($id)
    {
        MasterCompanyOverview::findOrFail($id)->delete();
        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'company-overview'])->with('success', 'Company Overview deleted successfully.');
    }

    public function duplicateCompanyOverview($id)
    {
        $overview = MasterCompanyOverview::findOrFail($id);

        $newOverview = $overview->replicate();
        $newOverview->name = $overview->name . ' (Copy)';
        $newOverview->save();
        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'company-overview'])->with('success', 'Company Overview duplicated successfully.');
    }

    /**
     * =======================
     * Compensation & Benefits Methods
     * =======================
     */
    public function indexCompensationBenefits()
    {

        $responseData = [];
        $compensationBenefits = MasterCompanyBenefit::all();
        $responseData['compensationBenefits'] = $compensationBenefits;

        return $responseData;
        // return view('admin.talent-acquisition.template-settings.compensation-benefits.index', compact('compensations'));
    }

    public function createCompensationBenefits()
    {
        return view('admin.talent-acquisition.template-settings.compensation-benefits.create');
    }

    public function storeCompensationBenefits(Request $request)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required'
            ]);
        MasterCompanyBenefit::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'compensation-benefits'])->with('success', 'Compensation & Benefits created successfully.');
    }

    public function editCompensationBenefits($id)
    {
        $compensation = MasterCompanyBenefit::findOrFail($id);
        return view('admin.talent-acquisition.template-settings.compensation-benefits.edit', compact('compensation'));
    }

    public function updateCompensationBenefits(Request $request, $id)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required'
            ]);
        $compensation = MasterCompanyBenefit::findOrFail($id);
        $compensation->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'compensation-benefits'])->with('success', 'Compensation & Benefits updated successfully.');
    }

    public function destroyCompensationBenefits($id)
    {
        MasterCompanyBenefit::findOrFail($id)->delete();
        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'compensation-benefits'])->with('success', 'Compensation & Benefits deleted successfully.');
    }

    public function duplicateCompensationBenefits($id)
    {
        $benefit = MasterCompanyBenefit::findOrFail($id);

        $newBenefit = $benefit->replicate();
        $newBenefit->name = $benefit->name . ' (Copy)';
        $newBenefit->save();
        return redirect()->route('admin.talent-acquisition.template-settings.index',['page' => 'compensation-benefits'])->with('success', 'Company & Benefits duplicated successfully.');
    }
}
