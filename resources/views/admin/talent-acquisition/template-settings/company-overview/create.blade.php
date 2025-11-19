@extends('admin.layout.app')

@section('title', 'Talent Acquisition - Company Overview')

@section('styles')

    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />

    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }
    </style>

    <style>
        h4 {
            color: #000;
            font-size: 22.75px;
            line-height: 27.3px;
            margin-bottom: 30px;
        }

        .success-message {
            border-radius: 8px;
            background: #DDF5E2;
            padding: 24px;
            display: flex;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            margin-bottom: 30px;
            display: none;
        }

        .success-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .success-message .icon {
            color: #78829D;
        }

        .template-tab {
            padding: 32px;
            gap: 24px;
            border-radius: 8px;
            border-right: 1px #F1F1F4;
            border-bottom: 1px #F1F1F4;
            border-left: 1px #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .template-tab label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .template-tab input {
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

        .form-control:focus,
        button:focus:not(:focus-visible) {
            box-shadow: none;
            border-color: #DBDFE9;
        }

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

        .custom-button.btn-back {
            background: #DBDFE9;
            color: #4B5675;
            border: 0;
        }
        .editor-wrapper { width: 100%; max-width: 100%; box-sizing: border-box; }
    #overviewEditor { width: 100%; min-height: 300px; }
    .ck-editor__editable_inline { min-height: 300px; }
    </style>


@endsection

@section('content')

    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100">
            <div class="justify-content-between align-items-center success-message">
                <p class="fw-medium m-0"><b>Success!</b> Company Overview 1 has been created successfully.
                </p>
                <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>

            <h4 class="fw-medium">Create Company/Department Overview</h4>
            <div class="template-tab">
                <form action="{{ route('admin.talent-acquisition.template-settings.company-overview.store') }}" class="w-100" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Company/Department Overview Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter Company/Department Overview Name">
                    </div>
                    <div class="mb-8">
                        <label>Company/Department Overview</label>
                        <textarea id="overviewEditor" name="description" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <!-- Back Button -->
                        <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'company-overview']) }}" class="custom-button btn-back">
                            Back
                        </a>
                        <button class="custom-button btn-apply" type="submit">Create
                            Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

{{-- @section('scripts')

    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new FroalaEditor('#overviewEditor', {
                height: 200
            });
        });
    </script>

@endsection --}}

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    let savedRange = null;
    const editor = CKEDITOR.replace('overviewEditor');

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

