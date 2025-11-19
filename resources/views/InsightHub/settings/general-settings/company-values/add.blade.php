@extends('insighthub.layout.app')

@section('title', 'Company Values - Add')

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
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Company Values</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">- Add Company Values</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="settings-card">
                <div class="settings-card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0 top-heading">Add Company Value</h4>
                </div>

                <form id="companyValueForm" action="{{ route('insighthub.settings.company-values.store') }}" method="POST" class="company-form">
                    @csrf
    <div class="mb-3">
    <label class="form-label">Company Value Name <span class="text-danger">*</span></label>
    <input type="text" id="companyValueName" name="company_value_name" class="form-control input-custom required-field"
           placeholder="Enter Company Value Name">
        <p class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> This field is required.</p>
    </div>

    <div class="mb-3">
    <label class="form-label">Company Value Description <span class="text-danger">*</span></label>
    <textarea id="companyValueDesc" name="company_value_description" class="form-control input-custom required-field" rows="3"
          placeholder="Enter Company Value Description"></textarea>
        <p class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> This field is required.</p>
    </div>

    <!-- ✅ Facets Field -->
    <div class="mb-3">
        <label id="facetLabel" class="form-label">Facets (0/10) <span class="text-danger">*</span></label>

        <div class="dropdown w-100">
            <button class="form-select input-custom d-flex align-items-center required-field"
                id="facetDropdownButton" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">

                <div id="selectedTags" class="tags-container"></div>
                <span id="placeholderText" class="text-muted ms-2">Select Facets</span>
            </button>

            <ul class="dropdown-menu w-100 p-2" id="facetDropdownList"></ul>
        </div>

        <p id="facetError" class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> At least 1 facet is required.</p>
    </div>

    <!-- ✅ Remaining textareas -->
    <div class="mb-3">
        <label class="form-label">Developmental Stage Description <span class="text-danger">*</span></label>
        <textarea id="devDesc" name="developmental_stage_description" class="form-control input-custom required-field" rows="3"
                  placeholder="Enter Developmental Stage Description"></textarea>
        <p class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> This field is required.</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Basic Level Description <span class="text-danger">*</span></label>
        <textarea id="basicDesc" name="basic_level_description" class="form-control input-custom required-field" rows="3"
                  placeholder="Enter Basic Level Description"></textarea>
        <p class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> This field is required.</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Intermediate Level Description <span class="text-danger">*</span></label>
        <textarea id="intermediateDesc" name="intermediate_level_description" class="form-control input-custom required-field" rows="3"
                  placeholder="Enter Intermediate Level Description"></textarea>
        <p class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> This field is required.</p>
    </div>

    <div class="mb-4">
    <label class="form-label">Advanced Level Description <span class="text-danger">*</span></label>
    <textarea id="advancedDesc" name="advanced_level_description" class="form-control input-custom required-field" rows="3"
          placeholder="Enter Advanced Level Description"></textarea>
        <p class="error-text"> <iconify-icon icon="material-symbols:info-outline-rounded" width="12" height="12"></iconify-icon> This field is required.</p>
    </div>

    <div class="d-flex align-items-center gap-3 justify-content-end mt-8">
        <button type="button" class="custom-btn grey-outline" onclick="window.location.href='{{ route('insighthub.settings.company-values.index') }}'">
            Cancel
        </button>
        <button class="custom-btn orange-fill" type="submit">Add Company Value</button>
    </div>
</form>

        </div>

    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const form = document.getElementById("companyValueForm");
const facetButton = document.getElementById("facetDropdownButton");
const facetError = document.getElementById("facetError");

function validateForm() {
    let isValid = true;

    document.querySelectorAll(".required-field").forEach(field => {
        const errorText = field.parentElement.querySelector(".error-text");
        const value = field.value ? field.value.trim() : "";

        if (field.id === "facetDropdownButton") {
            if (selectedTags.length === 0) {
                field.classList.add("input-error");
                facetError.style.display = "block";
                isValid = false;
            } else {
                field.classList.remove("input-error");
                facetError.style.display = "none";
            }
        } else {
            if (!value) {
                field.classList.add("input-error");
                errorText.style.display = "block";
                isValid = false;
            } else {
                field.classList.remove("input-error");
                errorText.style.display = "none";
            }
        }
    });

    return isValid;
}


form.addEventListener("submit", function (e) {
    if (!validateForm()) {
        e.preventDefault();
        console.log("Validation failed!");
        return;
    }
    console.log("Form submitted!");
});


document.querySelectorAll("input, textarea").forEach(field => {
    field.addEventListener("input", validateForm);
});


       
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBtn = document.querySelector('.feedback.feedback-msg');
            const feedbackMsg = document.getElementById('feedbackMessage');
            const closeIcon = document.getElementById('closeIcon');

            confirmBtn.addEventListener('click', function() {
                feedbackMsg.style.display = 'flex'; // Make it visible with flex for alignment
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            closeIcon.addEventListener('click', function() {
                feedbackMsg.style.display = 'none'; // Hide it
            });
        });



        
        const FACETS_MAP = @json(config('constants.30_facets'));
        const facets = Object.entries(FACETS_MAP).map(([key, label]) => ({ key, label }));
        
        facets.sort((a, b) => a.label.localeCompare(b.label));

        
        const selectedTags = [];
        const maxSelection = 10;

        const facetDropdownList = document.getElementById('facetDropdownList');
        const selectedTagsContainer = document.getElementById('selectedTags');

        
        function renderDropdown() {
            facetDropdownList.innerHTML = "";
            facets.forEach(facet => {
                const isSelected = selectedTags.includes(facet.key);
                const isDisabled = selectedTags.length >= maxSelection && !isSelected;

                const li = document.createElement('li');
                li.innerHTML = `
            <a class="dropdown-item ${isDisabled ? 'disabled' : ''} ${isSelected ? 'selected' : ''}"
               href="#">${facet.label}</a>`;

                li.addEventListener('click', () => toggleFacet(facet.key));
                facetDropdownList.appendChild(li);
            });
        }

       
        function renderTags() {
            selectedTagsContainer.innerHTML = "";

            selectedTags.forEach(facetKey => {
                const label = (FACETS_MAP && FACETS_MAP[facetKey]) ? FACETS_MAP[facetKey] : facetKey;
                const div = document.createElement('div');
                div.classList.add('tag');
                div.innerHTML = `
            ${label}
            <span class="remove-tag" onclick="removeFacet('${facetKey}')">&times;</span>
        `;
                selectedTagsContainer.appendChild(div);
            });

            
            const facetLabel = document.getElementById('facetLabel');
            if (facetLabel) facetLabel.innerHTML = `Facets (${selectedTags.length}/10) <span class="text-danger">*</span>`;

            
            const placeholder = document.getElementById("placeholderText");
            placeholder.style.display = selectedTags.length > 0 ? "none" : "block";
        }

        function toggleFacet(facet) {
            if (selectedTags.includes(facet)) return;

            if (selectedTags.length < maxSelection) {
                selectedTags.push(facet);
            }
        renderDropdown();
            renderTags();
        }

        function removeFacet(facet) {
            const index = selectedTags.indexOf(facet);
            selectedTags.splice(index, 1);

            renderDropdown();
            renderTags();
        }

        renderDropdown();
    </script>

    <script>
        $("#companyValueForm").on("submit", function (e) {
    e.preventDefault();

    if (!validateForm()) return;

    const payload = {
        company_value_name: $("#companyValueName").val(),
        company_value_description: $("#companyValueDesc").val(),
        facets: selectedTags,
        developmental_stage_description: $("#devDesc").val(),
        basic_level_description: $("#basicDesc").val(),
        intermediate_level_description: $("#intermediateDesc").val(),
        advanced_level_description: $("#advancedDesc").val()
    };

    $.ajax({
        url: "/insighthub/settings/company-values",
        method: "POST",
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        contentType: "application/json",
        data: JSON.stringify(payload),
        success: function (response) {
            const msg = (response && response.message) ? response.message : 'Company Value created successfully!';
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
                    toastr.error("Failed to create company value!");
                }
                console.error(json);
            } catch (e) {
                toastr.error("Failed to create company value!");
                console.error(e);
            }
        }
    });
});

    </script>
@endsection
