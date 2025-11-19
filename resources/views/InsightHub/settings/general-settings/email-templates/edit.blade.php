@extends('insighthub.layout.app')

@section('title', 'Email Template - Edit')

@section('styles')
    <style>
        .top-heading {
            color: #2E2F38;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }


        .custom-text-muted {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }


        .settings-card {
            padding: 24px;
            margin-top: 48px;
            border-radius: 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
        }

        .custom-btn {
            display: flex;
            height: 48px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
            width: fit-content;
        }

        .custom-btn.grey-outline {
            background: #fff;
            color: #727790;
            border: 1px solid #858BA6;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }

        .company-form .form-label {
            margin-bottom: 8px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 600;
        }

        .insert-btn {
            display: flex;
            height: 35px;
            padding: 8px 12px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F1760F;
            color: #F1760F;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            background-color: #fff;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Edit Email Templates
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Email Templates</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Edit Email Templates</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="settings-card">
                <div class="settings-card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0 top-heading">Edit Email Templates</h4>
                </div>
                <div class="pt-13">
<form method="POST" action="{{ route('insighthub.settings.email-templates.update', $template->id) }}">
    @csrf
    @method('PUT')
    <!-- Module + Email Action -->
    <div class="row mb-5">
        <div class="col-md-6">
    <label class="form-label required">Module</label>
    <input type="text" 
           class="form-control input-readonly" 
           name="module"
           value="{{ old('module', $template->module->name ?? 'N/A') }}" 
           readonly>
    </div>

        <div class="col-md-6">
            <label class="form-label required">Email Action</label>
            <input type="text" class="form-control input-readonly"
                   name="title"
                   value="{{ old('title', $template->title ?? 'N/A') }}"
                   readonly>
        </div>
    </div>

    <!-- Description -->
    <div class="mb-5">
        <label class="form-label">Description</label>
        <textarea class="form-control textarea-sm" name="description" rows="3">{{ old('description', $template->description) }}</textarea>
        @error('description')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <!-- Subject Line -->
    <div class="mb-5 position-relative">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <label class="form-label required">Subject Line</label>
            <div class="dropdown">
            <button class="insert-btn subject-insert" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Insert Data Fields ▾
            </button>
            <ul class="dropdown-menu">
                @foreach(config('constants.SUBJECT_LINE_FIELDS') as $field)
                    <li>
                        <button type="button" class="dropdown-item data-field" data-target="subject">{{ $field }}</button>
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
        <input type="text" class="form-control" name="subject" 
               value="{{ old('subject', $template->subject) }}">
        @error('subject')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email Content -->
    <div class="mb-5 position-relative">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <label class="form-label required mb-0">Email Content</label>
            <div class="dropdown">
                <button class="insert-btn ckeditor-insert" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Insert Data Fields ▾
                </button>
                <ul class="dropdown-menu">
                    @foreach(config('constants.EMAIL_CONTENT_FIELDS') as $field)
                        <li>
                            <button type="button" class="dropdown-item data-field" data-target="body">{{ $field }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <textarea class="form-control" id="emailContent" name="body" rows="5">{{ old('body', $template->email_content) }}</textarea>
        @error('body')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

</div>


            </div>
            <div class="d-flex align-items-center gap-3 justify-content-end mt-8">
                <a href="{{ route('insighthub.settings.email-templates.index') }}" class="custom-btn grey-outline">Cancel</a>
                <button class="custom-btn orange-fill">Update Template</button>
            </div>
        </div>
</form>
    @endsection

    @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle insert for SUBJECT input
        document.querySelectorAll(".data-field[data-target='subject']").forEach(btn => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                const selectedText = this.textContent.trim();
                const input = document.querySelector('#subjectInput');
                const cursorPos = input.selectionStart;
                const val = input.value;
                input.value = val.slice(0, cursorPos) + selectedText + val.slice(cursorPos);
                input.focus();
                input.setSelectionRange(cursorPos + selectedText.length, cursorPos + selectedText.length);
            });
        });

        // Handle insert for EMAIL BODY textarea
        document.querySelectorAll(".data-field[data-target='body']").forEach(btn => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                const selectedText = this.textContent.trim();
                const textarea = document.querySelector('#emailContent');
                const cursorPos = textarea.selectionStart;
                const val = textarea.value;
                textarea.value = val.slice(0, cursorPos) + selectedText + val.slice(cursorPos);
                textarea.focus();
                textarea.setSelectionRange(cursorPos + selectedText.length, cursorPos + selectedText.length);
            });
        });
    });
</script>
@endsection

