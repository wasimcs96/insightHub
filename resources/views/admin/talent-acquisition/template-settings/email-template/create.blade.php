@extends('admin.layout.app')

@section('title', 'Talent Insights Hub')

@section('styles')
<style>
    .app-wrapper { margin-top: 74px !important; }
    h4 { color: #000; font-size: 22.75px; line-height: 27.3px; margin-bottom: 30px; }

    .success-message {
        border-radius: 8px;
        background: #DDF5E2;
        padding: 24px;
        display: flex;
        border: 1px solid #BBECC5;
        margin-bottom: 30px;
        display: none;
    }

    .success-message p { color: #071437; font-size: 13.975px; line-height: 16.77px; }
    .success-message .icon { color: #78829D; }

    .template-tab {
        padding: 32px;
        gap: 24px;
        border-radius: 8px;
        border: 1px solid #F1F1F4;
        background: #FFF;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
    }

    .template-tab label {
        color: #071437;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .template-tab input,
    .selected-div,
    .custom-select {
        height: 40px;
        padding: 0px 12px;
        border-radius: 4px;
        border: 1px solid #DBDFE9;
        background: #FFF;
        color: #99A1B7;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
    }

    .btn-data-fields {
        display: flex;
        padding: 8px 16px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 4px;
        border: 1px solid #F7941C;
        background: #FFF;
        color: #F7941C;
        font-size: 12px;
        font-weight: 600;
        line-height: 16px;
    }

    .dropdown-item { padding: 12px 16px; }
    .form-control:focus, button:focus:not(:focus-visible) { box-shadow: none; border-color: #DBDFE9; }

    .custom-button {
        padding: 14px 20px;
        gap: 8px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .custom-button.btn-apply {
        background: #F7941C;
        color: #FFF;
        border: 0;
    }

    .editor-wrapper { width: 100%; max-width: 100%; box-sizing: border-box; }
    #example { width: 100%; min-height: 300px; }
    .ck-editor__editable_inline { min-height: 300px; }
</style>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid position-lg-relative">
    <div id="kt_app_content_container" class="app-container container-xxl w-100">
        <div class="justify-content-between align-items-center success-message">
            <p class="fw-medium m-0"><b>Success!</b> Send Assessment Link Email Template has been created successfully.</p>
            <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer" id="closeIcon"></iconify-icon>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-medium">Create Email Template</h4>
            <a href="{{ route('admin.talent-acquisition.template-settings.index',['page' => 'email-template']) }}" class="custom-button btn-apply d-flex align-items-center">
                <iconify-icon icon="material-symbols:arrow-back" width="16" height="16"></iconify-icon> Back
            </a>
        </div>

        <div class="template-tab">
            <form action="{{ route('admin.talent-acquisition.template-settings.email-template.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Email Template Name</label>
                    <input type="text" class="form-control" placeholder="Enter Email Template Name" name="title" value="{{ old('title', session('duplicate_template.title')) }}">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-1 d-flex justify-content-between align-items-center">
                    <label class="flex-grow-1 mb-0">Subject Line</label>
                    <div class="dropdown">
                        <button class="btn-data-fields subject-insert" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Insert Data Fields <iconify-icon icon="gg:chevron-down" width="16" height="16"></iconify-icon>
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

                <div class="mt-2 d-flex gap-1">
                    <input type="text" class="form-control" id="subjectInput" name="subject" placeholder="Update on Your Application for" value="{{ old('subject', session('duplicate_template.subject')) }}">
                    @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label>Select a button in the hiring stages to trigger the email</label>
                    <select class="custom-select" name="type" id="selectedType" style="width: 30%">
                        @foreach(config('constants.TYPE_FIELDS') as $key => $value)
                            <option value="{{ $key }}"  {{ old('type', session('duplicate_template.type')) == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-1 d-flex justify-content-between align-items-center">
                    <label class="flex-grow-1 mb-0">Email content</label>
                    <div class="dropdown">
                        <button class="btn-data-fields ckeditor-insert" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Insert Data Fields <iconify-icon icon="gg:chevron-down" width="16" height="16"></iconify-icon>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach(config('constants.EMAIL_CONTENT_FIELDS') as $field)
                                <li>
                                    <button type="button" class="dropdown-item data-field" data-target="editor">{{ $field }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-2 mb-8 gap-1">
                    <textarea id="example" name="description">{{ old('description', session('duplicate_template.description')) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="custom-button btn-apply">Create Template</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let savedRange = null;
    const editor = CKEDITOR.replace('example');

    editor.on('contentDom', function () {
        editor.document.on('mousedown', function () {
            const sel = editor.getSelection();
            if (sel) {
                const ranges = sel.getRanges();
                if (ranges.length > 0) {
                    savedRange = ranges[0];
                }
            }
        });
    });

    editor.on('blur', function () {
        const sel = editor.getSelection();
        if (sel) {
            const ranges = sel.getRanges();
            if (ranges.length > 0) {
                savedRange = ranges[0];
            }
        }
    });

    document.querySelectorAll(".insert-subject").forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const selectedText = `[${this.textContent.trim()}]`;
            const input = document.querySelector('#subjectInput');
            const cursorPos = input.selectionStart;
            const val = input.value;
            input.value = val.slice(0, cursorPos) + selectedText + val.slice(cursorPos);
            input.focus();
            input.setSelectionRange(cursorPos + selectedText.length, cursorPos + selectedText.length);
        });
    });

    document.querySelectorAll(".insert-ckeditor").forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const selectedText = `[${this.textContent.trim()}]`;
            editor.focus();
            if (savedRange) editor.getSelection().selectRanges([savedRange]);
            editor.insertText(selectedText);
        });
    });
</script>
@endsection