<?php

namespace App\Services\InsightHub;

use App\Models\Template;
use App\Models\Module;

class EmailTemplateService
{
    /**
     * Get all templates with optional filters and sorting.
     */
    public function getAll($request)
    {
        $query = Template::query()
            ->with('module'); // eager load related module

        // 🔹 Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // 🔹 Module filter (by name → convert to module_id)
        if ($request->filled('module')) {
            $module = Module::where('name', $request->module)->first();
            if ($module) {
                $query->where('module_id', $module->id);
            }
        }

        // 🔹 Sorting logic
        $sort = $request->get('sort', 'updated_at');
        $direction = $request->get('direction', 'desc');

        if (in_array($sort, ['title', 'module_id', 'updated_at'])) {
            $query->orderBy($sort, $direction);
        }

        // 🔹 Pagination
        $emailTemplates = $query->paginate($request->get('per_page', 10));

        // 🔹 Fetch all modules (for dropdown)
        $modules = Module::all();

        return [
            'emailTemplates' => $emailTemplates,
            'modules' => $modules,
        ];
    }

    /**
     * Get a specific template by ID.
     */
    public function getById($id)
    {
        return Template::with('module')->findOrFail($id);
    }

    /**
     * Update a template by ID.
     */
    public function update($id, array $data)
    {
        $template = Template::findOrFail($id);
        $template->update($data);
        return $template;
    }
}
