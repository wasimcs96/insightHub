@extends('insighthub.layout.app')

@section('title', 'Company Values - Edit')

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

        .settings-card-header {
            padding-bottom: 24px;
            margin-bottom: 24px;
            border-bottom: 1px solid #ECF0F3;
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

        .custom-btn.black-outline {
            background: #fff;
            color: #2E2F38;
            border: 1px solid #C8CFD9;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }

        .company-form label {
            font-weight: 600;
            color: #333;
        }

        .custom-input {
            display: flex;
            height: 48px;
            padding: 14px 16px;
            align-items: center;
            align-self: stretch;
            color: #2E2F38;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 21px;
            border-radius: 4px;
            border: 1px solid #C8CFD9;
            background: #FFF;
        }

        .custom-input:focus {
            background: #fff;
            border-color: #666;
            box-shadow: none;
        }

        .company-form .form-label {
            margin-bottom: 8px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 600;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }


        .tag .remove-tag {
            cursor: pointer;
            font-size: 22px;
            margin-top: -4px;
        }

        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
            border-radius: 8px;
        }

        .dropdown-item:hover {
            border-radius: 0;
            background-color: #F5F7F8;
            color: #727790;
        }

        .dropdown-item.disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        .dropdown-item.selected::after {
            content: '✓';
            float: right;
            font-weight: bold;
            color: #727790;
        }

        #facetDropdownButton {
            height: auto !important;
            min-height: 48px;
            padding: 6px 10px;
            white-space: normal;
        }


        .tag {
            display: flex;
            padding: 2px 14px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF8EB;
            color: #D5540A;
            font-size: 14px;
            font-weight: 600;
            height: 32px;
        }

        .remove-tag {
            cursor: pointer;
            font-size: 18px;
            color: #D5540A;
        }

        .input-error {
            border: 1px solid #dc3545 !important;
        }

        .error-text {
            color: #9C2418;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
            display: none;
            margin-top: 8px;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Company Values
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="/insighthub" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Company Values</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Edit Company Values</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="settings-card">
        <div class="settings-card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0 top-heading">Edit Company Value</h4>
        </div>
        
        <form id="companyValueForm" method="POST" action="{{ route('insighthub.settings.company-values.update', $value->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Company Value Name <span class="text-danger">*</span></label>
                <input type="text" id="companyValueName" name="company_value_name" class="form-control input-custom" 
                    placeholder="Enter Company Value Name" value="{{ old('company_value_name', $value->company_value_name) }}">
                <p class="error-text">This field is required.</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Company Value Description <span class="text-danger">*</span></label>
                <textarea id="companyValueDesc" name="company_value_description" class="form-control input-custom required-field" rows="3"
                    placeholder="Enter Company Value Description">{{ old('company_value_description', $value->company_value_description) }}</textarea>
                <p class="error-text">This field is required.</p>
            </div>

            <!-- Facets Section -->
            <div class="mb-3">
                <label class="form-label">Facets ({{ count($value->facets) }}/10) <span class="text-danger">*</span></label>
                <div class="dropdown w-100">
                    <button class="form-select input-custom d-flex align-items-center required-field" id="facetDropdownButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div id="selectedTags" class="tags-container">
                            <!-- Dynamically render selected facets here -->
                            @foreach ($value->facets as $facet)
                                <div class="tag">{{ $facet }} <span class="remove-tag" onclick="removeFacet('{{ $facet }}')">&times;</span></div>
                            @endforeach
                        </div>
                        <span id="placeholderText" class="text-muted ms-2">Select Facets</span>
                    </button>
                    <ul class="dropdown-menu w-100 p-2" id="facetDropdownList"></ul>
                </div>
                <p id="facetError" class="error-text">At least 1 facet is required.</p>
            </div>

            <!-- Remaining fields -->
            <div class="mb-3">
                <label class="form-label">Developmental Stage Description <span class="text-danger">*</span></label>
                <textarea id="devDesc" name="developmental_stage_description" class="form-control input-custom" rows="3" placeholder="Enter Developmental Stage Description">{{ old('developmental_stage_description', $value->developmental_stage_description) }}</textarea>
                <p class="error-text">This field is required.</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Basic Level Description <span class="text-danger">*</span></label>
                <textarea id="basicDesc" name="basic_level_description" class="form-control input-custom" rows="3" placeholder="Enter Basic Level Description">{{ old('basic_level_description', $value->basic_level_description) }}</textarea>
                <p class="error-text">This field is required.</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Intermediate Level Description <span class="text-danger">*</span></label>
                <textarea id="intermediateDesc" name="intermediate_level_description" class="form-control input-custom" rows="3" placeholder="Enter Intermediate Level Description">{{ old('intermediate_level_description', $value->intermediate_level_description) }}</textarea>
                <p class="error-text">This field is required.</p>
            </div>

            <div class="mb-4">
                <label class="form-label">Advanced Level Description <span class="text-danger">*</span></label>
                <textarea id="advancedDesc" name="advanced_level_description" class="form-control input-custom" rows="3" placeholder="Enter Advanced Level Description">{{ old('advanced_level_description', $value->advanced_level_description) }}</textarea>
                <p class="error-text">This field is required.</p>
            </div>

            <div class="d-flex align-items-center gap-3 justify-content-end mt-8">
                <button class="custom-btn grey-outline" type="button" onclick="window.location.href='{{ route('insighthub.settings.company-values.index') }}'">Cancel</button>
                <button class="custom-btn orange-fill" type="submit">Update Company Value</button>
            </div>
        </form>
    </div>

    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        const form = document.getElementById("companyValueForm");

        // Global selected tags array (start with server-provided facets)
        let selectedTags = @json($value->facets ?? []);

        // Dynamically populate selected tags (facets) on page load
        function renderTags() {
            const container = document.getElementById('selectedTags');
            // clear existing tags in DOM to avoid duplicates
            container.innerHTML = '';
            selectedTags.forEach(facet => {
                const div = document.createElement('div');
                div.classList.add('tag');
                div.innerHTML = `
                    ${facet}
                    <span class="remove-tag" data-facet="${facet}">&times;</span>
                `;
                // attach delegated click handler instead of inline onclick to keep markup clean
                container.appendChild(div);
            });

            // attach click handlers for remove buttons
            Array.from(container.getElementsByClassName('remove-tag')).forEach(el => {
                el.addEventListener('click', function () {
                    const f = this.getAttribute('data-facet');
                    removeFacet(f);
                });
            });
        }

        // Render the facets dropdown
        function renderDropdown() {
            // Populate the facets dropdown
        }

        // Remove a facet from the selected tags
        function removeFacet(facet) {
            // remove from DOM
            const tagsContainer = document.getElementById('selectedTags');
            const tags = Array.from(tagsContainer.getElementsByClassName('tag'));
            tags.forEach(tag => {
                if (tag.textContent.includes(facet)) {
                    tag.remove();
                }
            });

            // remove from selectedTags array
            selectedTags = selectedTags.filter(f => f !== facet);
        }

        // Call render functions
        renderTags();
        renderDropdown();
    </script>

        <script>
            $(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    // const id = params.get("id");
    const id = @json($value->id);

    console.log("Editing company value with ID:", id);

    if (id) {
    // debug: ensure facets payload contains the expected slugs
    console.log('Submitting payload facets:', selectedTags);

    $.ajax({
            url: `/insighthub/settings/company-values/${id}`,
            method: "GET",
            success: function (response) {
                const data = response.data;
                $("#companyValueName").val(data.company_value_name);
                $("#companyValueDesc").val(data.company_value_description);
                // replace selected tags with server values (avoid duplicates)
                selectedTags.length = 0;
                if (Array.isArray(data.facets)) selectedTags.push(...data.facets);
                renderDropdown();
                renderTags();
                $("#devDesc").val(data.developmental_stage_description);
                $("#basicDesc").val(data.basic_level_description);
                $("#intermediateDesc").val(data.intermediate_level_description);
                $("#advancedDesc").val(data.advanced_level_description);
            }
        });
    }

        $("#companyValueForm").on("submit", function (e) {
        e.preventDefault();

        const payload = {
            company_value_name: $("#companyValueName").val(),
            company_value_description: $("#companyValueDesc").val(),
            facets: selectedTags,
            developmental_stage_description: $("#devDesc").val(),
            basic_level_description: $("#basicDesc").val(),
            intermediate_level_description: $("#intermediateDesc").val(),
            advanced_level_description: $("#advancedDesc").val()
        };

        // Build headers safely (meta tag may not exist because routes here use api middleware)
        const headers = {};
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (csrfMeta) headers['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');

        // Some servers (or middleware) block PUT; use POST with method override header so Laravel recognizes it as PUT
        headers['X-HTTP-Method-Override'] = 'PUT';

        $.ajax({
            url: `/insighthub/settings/company-values/${id}`,
            method: "POST",
            headers: headers,
            contentType: "application/json",
            data: JSON.stringify(payload),
            success: function (response) {
                const msg = (response && response.message) ? response.message : 'Company Value updated successfully!';
                window.location.href = '/insighthub/settings/company-values?success=' + encodeURIComponent(msg);
            },
            error: function (xhr) {
                try {
                    const json = xhr.responseJSON || {};
                    if (json.message) {
                        toastr.error(json.message);
                    } else if (json.errors) {
                        const first = Object.values(json.errors)[0];
                        toastr.error(Array.isArray(first) ? first[0] : first);
                    } else {
                        toastr.error("Failed to update company value!");
                    }
                    console.error(json);
                } catch (e) {
                    toastr.error("Failed to update company value!");
                    console.error(e);
                }
            }
        });
    });
});

        </script>
    @endsection
