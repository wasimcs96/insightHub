<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsightHub\EmailTemplateRequest;
use App\Services\InsightHub\EmailTemplateService;
use App\Models\Template;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    protected $emailService;

    public function __construct(EmailTemplateService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index(Request $request)
    {
        $data = $this->emailService->getAll($request);

        return view('insighthub.settings.general-settings.email-templates.index', [
            'emailTemplates' => $data['emailTemplates'],
            'modules' => $data['modules'],
        ]);
    }

    public function show($id)
    {
        $template = $this->emailService->getById($id);
        return view('insighthub.settings.general-settings.email-templates.view', compact('template'));
    }

    public function edit($id)
    {
        $template = $this->emailService->getById($id);
        return view('insighthub.settings.general-settings.email-templates.edit', compact('template'));
    }

    public function update(EmailTemplateRequest $request, $id)
    {
        $template = Template::findOrFail($id);
        $template->update($request->validated());

        return redirect()
            ->route('insighthub.settings.email-templates.index')
            ->with('success', 'Email Template updated successfully!');
    }
}
