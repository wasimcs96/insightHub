@extends('admin.layout.app')

@section('title', 'Take Interview')

@section('content')
<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">Conduct Interview of {{ $name }} for {{ $job_opening_application->jobOpening->job_title ?? " " }}</h3> 
                <div class="card-toolbar">
                  
                    <a href="{{ route('admin.job-applicant.show',[$job_opening_application->job_opening_id]) }}?status=5" class="btn btn-sm btn-primary">
                        <iconify-icon icon="material-symbols:arrow-back"></iconify-icon> Back To Interview Lists
                    </a>               
                </div>               
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Form-->
                <form action="{{ route('admin.job-openings.store-interview-response') }}" method="POST">
                    @csrf
                    <input type="text" class="hidden" name="job_opening_application_id" value="{{ $job_opening_application_id }}" hidden>
                    
                    <!-- Question 1 -->
                    <div class="form-group mb-4">
                        <h6>1. Can you describe your understanding of employee retention and why it is important for organizations?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="background" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="background" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="background" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>
                
                    <!-- Question 2 -->
                    <div class="form-group mb-4">
                        <h6>2. Describe a situation where you successfully contributed to retaining key talent within your previous organization. What strategies did you employ?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="itProject" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="itProject" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="itProject" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>
                
                    <!-- Question 3 -->
                    <div class="form-group mb-4">
                        <h6>3. What are the key factors that contribute to high employee retention rates in an organization?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="studyMotivation" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="studyMotivation" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="studyMotivation" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="form-group mb-4">
                        <h6>4. How do you handle situations where employees express dissatisfaction or are at risk of leaving?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="studyPractices" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="studyPractices" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="studyPractices" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="form-group mb-4">
                        <h6>5. What role does company culture play in employee retention, and how have you contributed to creating a positive work environment?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="networkProtocols" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="networkProtocols" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="networkProtocols" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 6 -->
                    <div class="form-group mb-4">
                        <h6>6. How do you measure the effectiveness of employee retention strategies?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="additionalSkills" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="additionalSkills" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="additionalSkills" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 7 -->
                    <div class="form-group mb-4">
                        <h6>7. How do you stay updated on best practices in employee retention and apply them in your role?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="englishProficiency" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="englishProficiency" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="englishProficiency" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 8 -->
                    <div class="form-group mb-4">
                        <h6>8. Evaluate the candidate's ability to build and maintain positive relationships with team members and supervisors.</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="timeliness" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="timeliness" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="timeliness" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 9 -->
                    <div class="form-group mb-4">
                        <h6>9. How do you ensure that employees remain engaged and motivated in their roles over the long term?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="auditorySkills" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="auditorySkills" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="auditorySkills" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>

                    <!-- Question 10 -->
                    <div class="form-group mb-4">
                        <h6>10. What approaches do you take to gather and respond to employee feedback?</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="inquisitiveAbilities" value="5" required>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="inquisitiveAbilities" value="3">
                            <label class="form-check-label">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inquisitiveAbilities" value="1">
                            <label class="form-check-label">1</label>
                        </div>
                    </div>
                
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--begin::Body-->
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#overview_of_company'), {
        removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    
    ClassicEditor
        .create(document.querySelector('#job_role_description'), {
        removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const companySelect = document.getElementById('company_id');
        const departmentSelect = document.getElementById('department_id');
        const positionSelect = document.getElementById('position_id');

        const routes = {
            departments: '{{ route("admin.job-opening.get-departments-by-company", ["companyId" => ":companyId"]) }}',
            positions: '{{ route("admin.job-opening.get-positions-by-department", ["departmentId" => ":departmentId"]) }}'
        };

        companySelect.onchange = function() {
            populateDepartments(this.value);
        };

        departmentSelect.onchange = function() {
            populatePositions(this.value);
        };

        function populateDepartments(companyId, preselectId = '') {
            let url = routes.departments.replace(':companyId', companyId);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    departmentSelect.disabled = false;
                    departmentSelect.innerHTML = `<option value="">Select Department</option>`;
                    data.forEach(department => {
                        const isSelected = preselectId === department.id ? 'selected' : '';
                        departmentSelect.innerHTML += `<option value="${department.id}" ${isSelected}>${department.name}</option>`;
                    });
                    if (preselectId) {
                        populatePositions(preselectId);
                    } else {
                        positionSelect.innerHTML = `<option value="">Select Position</option>`;
                        positionSelect.disabled = true;
                    }
                });
        }

        function populatePositions(departmentId, preselectId = '') {
            let url = routes.positions.replace(':departmentId', departmentId);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    positionSelect.disabled = false;
                    positionSelect.innerHTML = `<option value="">Select Position</option>`;
                    data.forEach(position => {
                        const isSelected = preselectId === position.id ? 'selected' : '';
                        positionSelect.innerHTML += `<option value="${position.id}" ${isSelected}>${position.name}</option>`;
                    });
                });
        }
    });
</script>

@endsection
