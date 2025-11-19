@extends('avenger.layouts.app')
@section('title', env('APP_NAME') . ' | Home')
@section('styles')

    <style>
        .search-container {
            background-color: #F1F1F4;
            padding-top: 72px;
        }

        .search-container .heading {
            color: #4B5675;
            text-align: center;
            font-size: 65px;
            font-weight: 600;
            line-height: 78px;
            margin-bottom: 21px;
        }


        .search-box {
            display: flex;
            padding: 20px;
            justify-content: center;
            gap: 16px;
            border-radius: 8px;
            background: #FFF;
            position: relative;
            z-index: 1;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
        }

        .custom-button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            height: fit-content;
            width: fit-content;
            gap: 8px;
        }

        .custom-button.btn-orange-fill {
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C;
        }

        .custom-button.btn-outline-orange {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .custom-button.btn-grey-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .form-control,
        .form-control:focus,
        .form-select {
            border: none;
            box-shadow: none;
            padding: 0;
        }

        .search-input,
        .search-select {
            display: flex;
            height: 56px;
            padding: 0px 12px;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background-color: #FFF;
            overflow: hidden;
            color: #99A1B7;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .search-box .form-select {
            color: #99A1B7 !important;
        }

        .icon-search-box {
            color: #78829D;
        }

        .search-input {
            width: 350px;
        }

        .search-select {
            width: 200px;
        }
    </style>

    <style>
        .job-openings {
            padding: 80px 10px 120px 10px;
            background: white;
            position: relative;
            top: -45px;
        }

        .job-card {
            width: 292px;
        }

        .job-openings .heading {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .job-openings .see-all-btn {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background: white;
        }


        .job-openings .filter-div span {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .job-openings .filter-div .form-select,
        .job-openings .filter-div .clear-filter {
            height: 36px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background-color: #FFF;
            color: #071437;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            width: 182px;
            cursor: pointer;
        }

        .job-openings .filter-tab-div {
            border: 1px solid #99A1B7;
            border-radius: 6px;
        }

        .job-openings .filter-tab-div ul {
            height: 34.8px;
            width: max-content;
        }

        .job-openings .tabs-div .nav-pills .nav-item,
        .job-openings .filter-tab-div .nav-pills .nav-item {
            margin: 0;
        }

        .job-openings .tabs-div .nav-pills .nav-link,
        .job-openings .filter-tab-div .nav-pills .nav-link {
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            border-radius: 0;
            height: 34.8px;
            border: 1px solid #99A1B7;
        }

        .job-openings .tabs-div .nav-pills .nav-link.active,
        .job-openings .filter-tab-div .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background: #99A1B7;
            color: #fff;
            height: 34.8px;
        }

        #mostRelevant-tab.nav-link,
        #mostRecent-tab.nav-link {
            border: 0;
        }

        #mostRelevant-tab.nav-link.active {
            border-radius: 6px 0px 0px 6px;
            border: none;
        }

        #mostRecent-tab.nav-link.active {
            border-radius: 0px 6px 6px 0px;
            border: none;
        }
    </style>

    <style>
        .join-section {
            padding: 120px 10px;
            background: #F1F1F4;
        }

        .join-section .heading {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .join-section .heading span {
            color: #F7941C;
        }

        .join-section .desc {
            color: #99A1B7;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin: 24px 0px;
        }
    </style>

    <style>
        .job-openings .job-card {
            background-color: #fff;
            height: fit-content;
        }

        .job-openings .job-card .job-header {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
        }

        .job-openings .job-card .job-body {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
        }

        .job-openings .job-card .job-body .custom-button {
            font-size: 14px;
        }

        .job-openings .job-card .job-header h6 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }

        .job-openings .job-card .job-header p {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
        }

        .job-openings .job-card .job-body p {
            overflow: hidden;
            color: #99A1B7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin-bottom: 16px;
        }
    </style>
@endsection

@section('content')

    <section class="d-flex align-items-center flex-column justify-content-center search-container">
        <h2 class="heading">Careers</h2>
        <div class="search-box">
            <div class="search-input">
                <iconify-icon class="icon-search-box" icon="mingcute:search-line" width="16" height="16"></iconify-icon>
                <input type="text" class="form-control" name="job_title" id="job_filter" value="{{ request('job_title') }}"
                    placeholder="Search by job title or keyword">
            </div>
            <div class="search-select">
                <iconify-icon class="icon-search-box" icon="akar-icons:location" width="16"
                    height="16"></iconify-icon>
                <select class="form-select" name="city" id="city_id">
                    <option value="" selected>Select Location</option>

                </select>

                {{-- <select id="city_id" class="form-control select2-ajax" name="city_id" data-control="select2" data-hide-search="false">
                    <option value="">Select City</option>                         
                </select> --}}

            </div>
            <button class="custom-button btn-orange-fill" id="filter-submit">Search</button>
        </div>
    </section>

    <section class="job-openings">
        <div class="m-auto container">
            <div class="d-flex align-items-center gap-7 filter-div justify-content-center mb-15">
                <span class="fw-bold">{{ $jobOpenings->count() ?? '' }} Open Job(s)</span>
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select" id="department">
                        <option value="" selected>Department</option>

                    </select>
                    <select class="form-select" id="education-level">
                        <option value="" selected>Education Level</option>

                        @foreach ($educationlevel as $value)
                            <option value="{{ $value->id ?? '' }}">{{ $value->name ?? '' }}</option>
                        @endforeach
                    </select>

                    <select class="form-select" id="employment-type">
                        <option value="" selected>Employment Type</option>

                        @foreach (config('constants.EMPLOYMENT_STATUSES') as $key => $value)
                            <option value="{{ $key ?? '' }}">{{ $value ?? '' }}</option>
                        @endforeach

                    </select>
                    <a href="" class="clear-filter align-items-center d-flex" style="width: fit-content">Clear
                        filter</a>
                    <div class="filter-tab-div">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="mostRelevant-tab active" data-bs-toggle="pill"
                                    data-bs-target="#mostRelevant" type="button" role="tab"
                                    aria-controls="mostRelevant" aria-selected="true" data-sort="title_asc">
                                    A to Z
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="mostRecent-tab" data-bs-toggle="pill"
                                    data-bs-target="#mostRecent" type="button" role="tab" aria-controls="mostRecent"
                                    aria-selected="false" data-sort="title_desc">
                                    Z to A
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-8 mt-5 flex-wrap justify-content-center" id="job-cards-container">

            </div>
            <div id="loading-indicator" class="text-center" style="display: none;">
                <div
                    style="
                display: flex;
                justify-content: center;
                align-items: center;
                align-content: center;
            ">
                    <p class="fs-5"
                        style="
                margin-bottom: 0;
                padding: 10px;
                margin: 10px;
                border: 1px solid #f7941c;
                border-radius: 6px;
            ">
                        Loading more jobs...</p>
                </div>

            </div>
        </div>
    </section>

    <section class="join-section">
        <div class="m-auto container text-center">
            <h4 class="heading m-0">Join our talent network of <span>80K+</span> employees</h4>
            <p class="desc">Sign up and the first one to learn about new job opportunities that might be a perfect fit
                for you</p>
            <button class="custom-button btn-orange-fill fw-bold m-auto" onclick="window.location='{{ route('register') }}'">Join Now<iconify-icon
                    icon="material-symbols:chevron-right-rounded" width="16" height="16"></iconify-icon></button>
        </div>
    </section>
    

    @include('avenger.frontend.job-modal')


@endsection


@section('scripts')
    <!-- AJAX Script -->
    <script>
        $(document).ready(function() {
            // Initial load of job cards
            loadJobCards();

            // Function to load job cards via AJAX
            function loadJobCards(sortBy) {

                var selectedcity = @json(request('city_filter'));
              
                var department = $('#department').val();
                var educationLevel = $('#education-level').val();
                var employmentType = $('#employment-type').val();
                var job_title = $('#job_filter').val();
                var city_filter = $('#city_id').val() || selectedcity; 

                // if (!city_filter) {
                //     $('#city_id').val(selectedcity).trigger('change'); // Trigger change event if necessary
                // }
                
                $.ajax({
                    url: '{{ route('all-jobs') }}', // Route to fetch job cards
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        department: department,
                        education_level: educationLevel,
                        employment_type: employmentType,
                        job_title: job_title,
                        city_filter: city_filter,
                        sort_by: sortBy
                    },
                    beforeSend: function() {
                        // Show the skeleton loader before the content is loaded
                        $('#job-cards-container').html(`
                        <div class="skeleton-loader">
                            <div class="skeleton-card">
                                <div class="skeleton-header">
                                    <div class="skeleton-title"></div>
                                    <div class="skeleton-meta">
                                        <div class="skeleton-date"></div>
                                        <div class="skeleton-location"></div>
                                    </div>
                                </div>
                                <div class="skeleton-body">
                                    <div class="skeleton-text"></div>
                                    <div class="skeleton-buttons">
                                        <div class="skeleton-btn"></div>
                                        <div class="skeleton-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="skeleton-loader">
                            <div class="skeleton-card">
                                <div class="skeleton-header">
                                    <div class="skeleton-title"></div>
                                    <div class="skeleton-meta">
                                        <div class="skeleton-date"></div>
                                        <div class="skeleton-location"></div>
                                    </div>
                                </div>
                                <div class="skeleton-body">
                                    <div class="skeleton-text"></div>
                                    <div class="skeleton-buttons">
                                        <div class="skeleton-btn"></div>
                                        <div class="skeleton-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="skeleton-loader">
                            <div class="skeleton-card">
                                <div class="skeleton-header">
                                    <div class="skeleton-title"></div>
                                    <div class="skeleton-meta">
                                        <div class="skeleton-date"></div>
                                        <div class="skeleton-location"></div>
                                    </div>
                                </div>
                                <div class="skeleton-body">
                                    <div class="skeleton-text"></div>
                                    <div class="skeleton-buttons">
                                        <div class="skeleton-btn"></div>
                                        <div class="skeleton-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="skeleton-loader">
                            <div class="skeleton-card">
                                <div class="skeleton-header">
                                    <div class="skeleton-title"></div>
                                    <div class="skeleton-meta">
                                        <div class="skeleton-date"></div>
                                        <div class="skeleton-location"></div>
                                    </div>
                                </div>
                                <div class="skeleton-body">
                                    <div class="skeleton-text"></div>
                                    <div class="skeleton-buttons">
                                        <div class="skeleton-btn"></div>
                                        <div class="skeleton-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    `);
                    },
                    success: function(response) {
                        // Replace the skeleton loader with the actual job cards
                        console.log(response);
                        $('#job-cards-container').html(response.view);
                        $('#job_count').text(response.jobCount + ' Open Job(s)');
                        // console.log(response.city['name']);
                        if (response.city != '') {
                            initCitySelect2('#city_id', response.city['id'], response.city['name']);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching job cards:', error);
                        // In case of error, you can show a message or retry option
                        $('#job-cards-container').html(
                            '<p>Error loading job cards. Please try again later.</p>');
                    }
                });
            }

            $('#department, #education-level, #employment-type').on('change', function() {
                loadJobCards();
            });
            $('#filter-submit').on('click', function() {
                loadJobCards();
            });
            $('#pills-tab .nav-link').on('click', function() {
                var sortBy = $(this).data('sort'); // Get the sorting type (title_asc or title_desc)
                console.log(sortBy);
                loadJobCards(sortBy);

                // Set the active class for the selected tab
                $('#pills-tab .nav-link').removeClass('active');
                $(this).addClass('active');
            });

            $('.clear-filter').on('click', function(e) {
                e.preventDefault();

                // Reset the select boxes
                $('#department').val('');
                $('#education-level').val('');
                $('#employment-type').val('');

                // Reload the job cards with no filters applied
                loadJobCards();
            });
        });

        $(document).ready(function() {
            var nextPageUrl = '{{ $jobOpenings->nextPageUrl() }}'; // Get next page URL
            var loading = false; // To prevent multiple requests

            function loadMoreJobs() {
                if (!nextPageUrl || loading) return;
                loading = true;

                $('#loading-indicator').show(); // Show loading text

                $.ajax({
                    url: nextPageUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#job-cards-container').append(response.view); // Append new jobs
                        nextPageUrl = response.next_page_url; // Update next page URL
                        $('#loading-indicator').hide();
                        loading = false;
                    },
                    error: function() {
                        $('#loading-indicator').hide();
                        loading = false;
                    }
                });
            }

            // Detect scroll event to load more jobs
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
                    loadMoreJobs();
                }
            });
        });
    </script>



    <script>
        var employmentStatuses = @json(config('constants.EMPLOYMENT_STATUSES'));
        var authuser = @json(auth()->user() ? 1 : 0);

        function loadJobDetails(jobId) {
            modalShowOverlay(); 

            $.ajax({
                url: '/get/job/' + jobId, // API endpoint to fetch job data by ID
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        var job = response.data;
                        console.log('authenticated', authuser);
                        // Populate the modal with the job details

                        // Job Title
                        $('#viewJobModel .view-job-header h4').text(job.job_position.title);

                        if (job.application_exist === 0) {
                   
                                if (authuser === 1) {
                                    $('#applynow').attr('href', '/apply/job/' + job.slug);
                                } else {
                                    $('#applynow').attr('href', '/job/apply/guest-user/' + job.slug);
                                }
                            } else {
                                $('#applynow').attr('href', 'javascript:void(0)');
                                $('#applynow').removeClass('btn-apply');
                                $('#applynow').text('Applied');
                                $('#applynow').addClass('btn-apply-disabled');

                            }
                        $('#shareButton').attr('onclick', `sharePage('/job-details/${job.slug}')`);

                        // Set Copy Button dynamically
                        $('#copyButton').attr('onclick', `copyToClipboard(event,'/job-details/${job.slug}')`);

                        // Employment Type (e.g., "Full-time", "Part-time", "Remote")
                        console.log(employmentStatuses)
                        var employment_type = job.employment_type ? employmentStatuses[job.employment_type] :
                            "N/A";
                        console.log(employment_type);
                        $('#viewJobModel .view-job-header #employment_type').text(employment_type);

                        // Location (if available, otherwise show 'N/A')

                        var location = job.job_location_type ? job.job_location_type : 'N/A';
                        location = location.charAt(0).toUpperCase() + location.slice(1).toLowerCase();
                        $('#viewJobModel .view-job-header #location').text(location);

                        // Posted Date
                        var postedDate = new Date(job.created_at);
                        var formattedDate = (postedDate.getDate() < 10 ? '0' : '') + postedDate.getDate() +
                            '.' +
                            ((postedDate.getMonth() + 1) < 10 ? '0' : '') + (postedDate.getMonth() + 1) + '.' +
                            postedDate.getFullYear();
                        console.log(formattedDate);
                        $('#viewJobModel .view-job-header #created_at').text(formattedDate);

                        // Job Description
                        $('#viewJobModel .view-job-left-side p').text(job.job_position.description);

                        // Job Skills (Soft Skills)
                        var softSkills = job.generic_skill && job.generic_skill.length >
                            0 ? job.generic_skill : ["No skills listed."];
                        var softSkillsList = softSkills.map(function(skill) {
                            console.log(skill.title)
                            return `<li>${skill.title}</li>`;
                        }).join('');
                        $('#viewJobModel .view-job-left-side #collapseSoftSkills .accordion-body ul').html(
                            softSkillsList);

                        // Job Technical Skills
                        var techSkills = job.technical_skill && job.technical_skill.length > 0 ? job
                            .technical_skill : ["No technical skills listed."];
                        var techSkillsList = techSkills.map(function(skill) {
                            return `<li>${skill.name}</li>`;
                        }).join('');
                        $('#viewJobModel .view-job-left-side #collapseTechnicalSkills .accordion-body ul').html(
                            techSkillsList);

                        // Job Critical Work Functions
                        var cwf = job.cwf && job.cwf.length > 0 ? job.cwf : ["No critical functions listed."];
                        var cwfList = cwf.map(function(func) {
                            console.log(func)
                            return `<li>${func.description}</li>`;
                        }).join('');
                        $('#viewJobModel .view-job-left-side #collapseCriticalWorkFunctions .accordion-body ul')
                            .html(cwfList);

                        // Education Level
                        var educationLevel = job.education_level ? job.education_level.name : "N/A";
                        $('#viewJobModel .view-job-sidebar #education-level').text(educationLevel);

                        // Education Program
                        var educationProgram = job.education_program ? job.education_program.name : "N/A";
                        $('#viewJobModel .view-job-sidebar #education-program').text(educationProgram);

                        // Work Experience (Min & Max Experience)
                        var workExperience = job.work_experience ? job.work_experience : "N/A";
                        $('#viewJobModel .view-job-sidebar #work-experience').text(workExperience + " years");

                        // Vacancies
                        $('#viewJobModel .view-job-sidebar #vacancies').text(job.job_position.vacancy);

                        // Company Overview (if available)
                        $('#viewJobModel .view-job-sidebar #company-overview').text(job.company_overview ? job
                            .company_overview.description : "N/A");

                        // Open the modal
                        $('#viewJobModel').modal('show');
                    modalHideOverlay();

                    } else {
                    // modalHideOverlay();

                        alert('Error loading job details');
                    }
                },
                error: function() {
                    modalHideOverlay();
                    alert('Error loading job details');
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            // Ajax request to fetch departments
            $.ajax({
                url: "{{ route('get.department') }}", // Use the route to the controller action
                method: "GET",
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        // Get the select box element
                        var selectBox = $('#department');

                        // Loop through the departments and append them to the select box
                        $.each(response.data, function(index, department) {
                            selectBox.append('<option value="' + department.id + '">' +
                                department.name + '</option>');
                        });
                    } else {
                        alert('Failed to load departments.');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching departments.');
                }
            });
        });
    </script>

    <script>
        function initCitySelect2(selector, initialId, initialName) {
            var $select = $(selector);

            // Append the initial option if provided
            if (initialId && initialName) {
                var option = new Option(initialName, initialId, true, true);
                $select.append(option).trigger('change');
            }

            // Initialize Select2 with AJAX support
            $select.select2({
                ajax: {
                    url: '{{ route('get.cities') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            id: params.id // you can pass id directly if needed
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a City',
                minimumInputLength: 1
            });
        }
        // });

        $(document).ready(function() {
            // Assume these values are passed from the server
            initCitySelect2('#city_id', '{{ request('city_id') }}');
        });
    </script>

    {{-- <script>
    function copyToClipboard(jobUrl) {
        const url = window.location.origin + jobUrl;
        navigator.clipboard.writeText(url).then(() => {
            const btnContainer = document.querySelector('.btn-container');
            btnContainer.classList.add('show-tooltip');

            setTimeout(() => {
                btnContainer.classList.remove('show-tooltip');
            }, 1500);
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    }
</script>
<script>
    function sharePage(jobUrl) {
        const pageUrl = window.location.origin + jobUrl;
        const pageTitle = document.title;

        // Check if Web Share API is supported (mostly on mobile)
        if (navigator.share) {
            navigator.share({
                title: pageTitle,
                text: "Check out this page:",
                url: pageUrl
            })
            .then(() => console.log("Shared successfully"))
            .catch((error) => console.error("Error sharing:", error));
        } else {
            // Fallback for desktop: Open a list of social media share links
            const encodedUrl = encodeURIComponent(pageUrl);

            const socialLinks = `
                <div id="shareModal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    background: white; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <h3>Share this page</h3>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}" target="_blank">Facebook</a> |
                    <a href="https://api.whatsapp.com/send?text=${encodedUrl}" target="_blank">WhatsApp</a> |
                    <a href="https://twitter.com/intent/tweet?url=${encodedUrl}" target="_blank">Twitter</a> |
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=${encodedUrl}" target="_blank">LinkedIn</a>
                    <button onclick="document.getElementById('shareModal').remove()">Close</button>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', socialLinks);
        }
    }
</script> --}}

    {{-- <script>
    $(document).on('click', '.bookmark-btn', function() {
        var button = $(this);
        var jobId = button.data('job-id');

        $.ajax({
            url: '{{ route('toggle-bookmark') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                job_id: jobId
            },
            success: function(response) {
                console.log(response);
                if (response.status === 'added') {
                    $('.bookmark-icon-'+jobId).attr('icon', 'twemoji:star');
                }else{
                    $('.bookmark-icon-'+jobId).attr('icon', 'line-md:star');
                }
            }
        });
    });
</script> --}}
    <script src="{{ asset('employee/assets/js/custom/jobpopup.js') }}"></script>
@endsection
