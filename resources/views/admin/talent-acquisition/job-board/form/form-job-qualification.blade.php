{{-- form-job-qualification.blade.php --}}
@php
    \Log::debug('ChildView SecondaryScope:', isset($secondaryScope) ? $secondaryScope : []);
@endphp

<style>
    .error-message {
        color: red;
        font-size: 10px;
        margin-top: 10px;
        font-weight: bold;
        margin-left: 5px;
    }
</style>

<div class="" id="job-qualifications" aria-labelledby="job-qualifications-tab" tabindex="0">
    <div class="top-content">
        <h3>Job Qualifications</h3>
        <p>Enter the required job qualifications in the designated fields.</p>
    </div>
    <form method="POST" action="{{ ($draftMode || $editMode) ? route('admin.talent-acquisition.job-board.update-job-qualifications') : route('admin.talent-acquisition.job-board.create-job-qualifications') }}" id="jobQualificationsForm" onsubmit="submitForm(event)">
        @csrf
        <input type="hidden" name="jobOpeningId" value="{{ $jobOpeningId }}">
        @if (($draftMode || $editMode))
            <input type="hidden" name="jobOpeningId" value="{{ $jobOpeningId }}">
        @endif
        <input type="hidden" name="editMode" value="{{ $editMode ? 'true' : 'false' }}">
        <input type="hidden" name="draftMode" value="{{ $draftMode ? 'true' : 'false' }}">
        <input type="hidden" name="jobId" id="jobId" value="{{ $jobsData->id }}">
        <div class="row g-3">
            <div class="col-md-4">
                <label>Education Level</label>
                <input readonly="readonly" type="text" class="form-control input-grey" name="education_level" value="{{ ($draftMode || $editMode) ? $jobOpeningData->education_level_name : $jobsData->master_education_level_name }}">
            </div>
        
            {{-- <div class="col-md-4">
                <label>Main Scope of Study</label>
                <select class="form-select input-grey" disabled>
                    <option value="{{ $jobsData->scope_of_study }}" selected>
                        {{ ($draftMode || $editMode) ? ($jobOpeningData->education_program_name ?? $jobsData->master_scope_of_study_name) : $jobsData->master_scope_of_study_name }}
                    </option>
                </select>
                <input type="hidden" name="scope_of_study" value="{{ $jobsData->scope_of_study }}">
            </div> --}}

             {{-- This is the for base_ph --}}
             <div class="col-md-4">
            <label for="dropdownScopeOfStudy">Main Scope of Study</label>
            <select class="form-select" id="dropdownScopeOfStudy" name="scope_of_study" class="validate">
                <option value="">Select Scope of Study</option>
                <option value="science" {{ ($draftMode || $editMode) && $jobOpeningData->scope_of_study == 'science' ? 'selected' : '' }}>Science</option>
                <option value="arts" {{ ($draftMode || $editMode) && $jobOpeningData->scope_of_study == 'arts' ? 'selected' : '' }}>Arts</option>
                <option value="commerce" {{ ($draftMode || $editMode) && $jobOpeningData->scope_of_study == 'commerce' ? 'selected' : '' }}>Commerce</option>
                <option value="engineering" {{ ($draftMode || $editMode) && $jobOpeningData->scope_of_study == 'engineering' ? 'selected' : '' }}>Engineering</option>
                <option value="medicine" {{ ($draftMode || $editMode) && $jobOpeningData->scope_of_study == 'medicine' ? 'selected' : '' }}>Medicine</option>
            </select>
            <div id="scopeOfStudyValue-error" class="error-message"></div>
        </div>
        
            <div class="col-md-4">
                <label>Education Program</label>
                <select class="form-select" id="educationProgram" name="education_program">
                    <option value="">Select Education Program</option>
                    @foreach($educationProgram as $program)
                        <option value="{{ $program->id }}" {{ ($draftMode || $editMode) && $jobOpeningData->education_program_id == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="scope_of_study" value="{{ $jobsData->scope_of_study }}">
                <div id="educationProgram-error" class="error-message"></div>
            </div>        
           
            <div class="col-md-6 mt-5">
                <label class="m-0">Relevant Training Program <span class="optional">- optional</span></label>
                <p class="optional-bottom">Press Enter after typing each keyword to add more</p>
                <input type="text" class="form-control" name="relevant_training_program" placeholder="Enter Relevant Training Program"
                    value="{{ ($draftMode || $editMode) ? json_encode($relevantTrainingProgramData) : '' }}">
            </div>

            <div class="col-md-6 mt-5">
                <label class="m-0">Relevant Professional Certificate <span class="optional">- optional</span></label>
                <p class="optional-bottom">Press Enter after typing each keyword to add more</p>
                <input type="text" class="form-control" name="relevant_professional_certificates" placeholder="Enter Relevant Professional Certificate"
                    value="{{ ($draftMode || $editMode) ? json_encode($relevantProfessionalCertificateData) : '' }}">
            </div>
            {{-- <div class="col-md-6 mt-5">
                <label class="m-0">Secondary Scope of Study <span class="optional">- optional</span></label>
                <p class="optional-bottom">Press Enter after typing each keyword to add more</p>
                <select class="form-control multi-select-dropdown" multiple="multiple" name="secondary_scope_of_study[]">
                    @foreach ($allSecondaryScopeOptions as $scope)
                        <option value="{{ $scope['id'] }} | {{ $scope['name'] }}"
                            @if (in_array($scope['id'], array_column($secondaryScope, 'id')))
                                selected
                            @endif
                        >
                            {{ $scope['name'] }}
                        </option>
                    @endforeach
                </select>
            </div> --}} 
            <div class="col-md-6 mt-5">
                <label class="m-0">Secondary Scope of Study <span class="optional">- optional</span></label>
                <p class="optional-bottom">Press Enter after typing each keyword to add more</p>
                <select class="form-control select2" multiple="multiple" id="secondaryScopeOfStudy" name="secondary_scope_of_study[]">
                    @foreach ($allSecondaryScopeOptions as $scope)
                        <option value="{{ $scope['id'] }} | {{ $scope['name'] }}"
                            @if (in_array($scope['id'], array_column($secondaryScope, 'id')))
                                selected
                            @endif
                        >
                            {{ $scope['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            
               
            

            {{-- <div class="col-md-6" style="margin-top: 33px;">
                <label>Experience in Relevant Sector</label>
                <div class="dropdown w-100">
                    <div class="form-select previous-job-btn text-start" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false" id="dropdownSelectedExperience">
                        @if(($draftMode || $editMode))
                            @if($jobOpeningData->min_experience == 0 && $jobOpeningData->max_experience == 0)
                                No Experience
                            @elseif($jobOpeningData->min_experience == 0 && $jobOpeningData->max_experience == 1)
                                Less than 1 Year
                            @elseif($jobOpeningData->min_experience == 1 && $jobOpeningData->max_experience == 2)
                                1-2 Years
                            @elseif($jobOpeningData->min_experience == 3 && $jobOpeningData->max_experience == 5)
                                3-5 Years
                            @elseif($jobOpeningData->min_experience == 6 && $jobOpeningData->max_experience == 8)
                                6-8 Years
                            @elseif($jobOpeningData->min_experience == 9 && $jobOpeningData->max_experience == 10)
                                9-10 Years
                            @elseif($jobOpeningData->min_experience == 10 && $jobOpeningData->max_experience == 0)
                                More than 10 Years
                            @else
                                {{ $jobOpeningData->min_experience }}-{{ $jobOpeningData->max_experience }} Years
                            @endif
                        @else
                            Choose an Experience
                        @endif
                    </div>
                    @php
                        $experienceRange = '';
                        if (($draftMode || $editMode)) {
                            if ($jobOpeningData->min_experience == 0 && $jobOpeningData->max_experience == 0) {
                                $experienceRange = 'no_experience';
                            } elseif ($jobOpeningData->min_experience == 0 && $jobOpeningData->max_experience == 1) {
                                $experienceRange = 'less_than_1_year';
                            } elseif ($jobOpeningData->min_experience == 1 && $jobOpeningData->max_experience == 2) {
                                $experienceRange = '1_2_years';
                            } elseif ($jobOpeningData->min_experience == 3 && $jobOpeningData->max_experience == 5) {
                                $experienceRange = '3_5_years';
                            } elseif ($jobOpeningData->min_experience == 6 && $jobOpeningData->max_experience == 8) {
                                $experienceRange = '6_8_years';
                            } elseif ($jobOpeningData->min_experience == 9 && $jobOpeningData->max_experience == 10) {
                                $experienceRange = '9_10_years';
                            } elseif ($jobOpeningData->min_experience == 10 && $jobOpeningData->max_experience == 0) {
                                $experienceRange = 'more_than_10_years';
                            }
                        }
                    @endphp

                    <input type="hidden" name="experience_range" id="experienceRangeInput" value="{{ $experienceRange }}" required>
                    <ul class="dropdown-menu w-100 mt-2">
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('no_experience')">No Experience</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('less_than_1_year')">Less than 1 Year</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('1_2_years')">1-2 Years</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('3_5_years')">3-5 Years</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('6_8_years')">6-8 Years</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('9_10_years')">9-10 Years</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateExperience('more_than_10_years')">More than 10 Years</a></li>
                    </ul>
                    <div id="experienceRangeInput-error" class="error-message"></div>
                </div>
            </div> --}}
            {{-- This is for base_ph --}}
            @php
                $experienceRange = '';
                if (($draftMode || $editMode)) {
                    if ($jobOpeningData->min_experience == 0 && $jobOpeningData->max_experience == 0) {
                        $experienceRange = 'no_experience';
                    } elseif ($jobOpeningData->min_experience == 0 && $jobOpeningData->max_experience == 1) {
                        $experienceRange = 'less_than_1_year';
                    } elseif ($jobOpeningData->min_experience == 1 && $jobOpeningData->max_experience == 2) {
                        $experienceRange = '1_2_years';
                    } elseif ($jobOpeningData->min_experience == 3 && $jobOpeningData->max_experience == 5) {
                        $experienceRange = '3_5_years';
                    } elseif ($jobOpeningData->min_experience == 6 && $jobOpeningData->max_experience == 8) {
                        $experienceRange = '6_8_years';
                    } elseif ($jobOpeningData->min_experience == 9 && $jobOpeningData->max_experience == 10) {
                        $experienceRange = '9_10_years';
                    } elseif ($jobOpeningData->min_experience == 10 && $jobOpeningData->max_experience == 0) {
                        $experienceRange = 'more_than_10_years';
                    }
                }
            @endphp
            <div class="col-md-6 mt-5">
                <p class="optional-bottom" style="opacity: 0">Press Enter after typing each keyword to add more</p>
                <label for="dropdownExperience">Experience in Relevant Sector</label>
                <select class="form-select" id="dropdownSelectedExperience" name="experience_range" class="validate">
                    <option value="">Select Experience</option>
                    <option value="no_experience" {{ ($draftMode || $editMode) && $experienceRange == 'no_experience' ? 'selected' : '' }}>No Experience</option>
                    <option value="less_than_1_year" {{ ($draftMode || $editMode) && $experienceRange == 'less_than_1_year' ? 'selected' : '' }}>Less than 1 Year</option>
                    <option value="1_2_years" {{ ($draftMode || $editMode) && $experienceRange == '1_2_years' ? 'selected' : '' }}>1-2 Years</option>
                    <option value="3_5_years" {{ ($draftMode || $editMode) && $experienceRange == '3_5_years' ? 'selected' : '' }}>3-5 Years</option>
                    <option value="6_8_years" {{ ($draftMode || $editMode) && $experienceRange == '6_8_years' ? 'selected' : '' }}>6-8 Years</option>
                    <option value="9_10_years" {{ ($draftMode || $editMode) && $experienceRange == '9_10_years' ? 'selected' : '' }}>9-10 Years</option>
                    <option value="more_than_10_years" {{ ($draftMode || $editMode) && $experienceRange == 'more_than_10_years' ? 'selected' : '' }}>More than 10 Years</option>
                </select>
                {{-- <input type="hidden" name="experience_range" id="experienceRangeInput" value="{{ $experienceRange }}" required> --}}
                <div id="experienceValue-error" class="error-message"></div>
            </div>
        </div>

        <div class="filter-content mt-6 display submit-button">
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2 ml-auto ">
                    @if($editMode)
                        <button class="btn btn-outline" type="button" onclick="cancelEdit()">Cancel</button>
                    @else
                        <button class="btn btn-outline" type="button" onclick="saveDraft('jobQualificationsForm')">Save Draft</button>
                    @endif 
                    <button class="btn btn-apply d-flex align-items-center gap-2" id="jobSkillsSubmitButton" type="submit" disabled>
                        {{ (request()->has('fromPrevious') && $editMode) ? 'Next: Job Skills' : ($editMode ? 'Confirm Edit' : 'Next: Job Skills') }}
                        <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
