{{-- resources/views/frontend/job-detail.blade.php --}}
@extends('avenger.layouts.app')

@section('title', env('APP_NAME') . ' | Applications')

@section('styles')

    <style>
        .feedback-message {
            display: flex;
            background: #DDF5E2;
            padding: 0px 26px;
            height: 80px;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon {
            color: #78829D;
        }

        .search-container {
            background-color: #F1F1F4;
            height: 120px;
        }

        .search-container .heading {
            color: #4B5675;
            font-size: 39px;
            font-weight: 600;
            line-height: 46.8px;
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
    </style>

    <style>
        .job-applications {
            padding: 80px 10px;
        }

        .job-applications .inner {
            padding: 48px;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .job-applications .table:not(.table-bordered)>:not(:last-child)>:last-child>* {
            background: #FAFAFB;
            padding: 16px 14px;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .job-applications .table:not(.table-bordered) tbody tr td,
        .table:not(.table-bordered) tbody tr th,
        .table:not(.table-bordered) tfoot tr td,
        .table:not(.table-bordered) tfoot tr th {
            padding: 16px;
            vertical-align: middle;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .job-applications .table:not(.table-bordered) td:first-child {
            font-weight: 600 !important;
        }

        .job-applications .table-button button,
        .table-button a {
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
            margin: auto;
        }

        .modal-div .modal-title {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .modal-div .modal-body p {
            color: #071437;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            text-align: left;
        }
    </style>

    <style>
        .job-openings {
            padding: 120px 10px;
            background: rgba(241, 241, 244, 0.50);
        }

        .job-openings .heading,
        .job-applications .heading {
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
    </style>

    <style>
        .how-it-works {
            padding: 120px 10px;
            background: #F1F1F4;
        }

        .how-it-works h4 {
            color: #4B5675;
            text-align: center;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
            margin-bottom: 48px;
        }

        .how-it-works .works-card .works-icon {
            display: flex;
            padding: 24px;
            align-items: center;
            border-radius: 100px;
            background: #DBDFE9;
            color: #78829D;
            margin-bottom: 24px;
            width: fit-content;
            height: fit-content;
        }

        .how-it-works .works-card .step-text {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 700;
            line-height: 16.77px;
        }

        .how-it-works .works-card .head {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .how-it-works .works-card .desc {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .works-button {
            color: #F7941C;
            font-size: 12px;
            line-height: 16px;
            padding: 12px 18px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF;
        }
    </style>

@endsection

@section('content')
    <section class="d-flex align-items-center flex-column justify-content-center search-container">
        <h2 class="heading">Saved Jobs</h2>
    </section>

    <!--end::Alert-->
    <section class="job-openings" style="
background: rgb(255 255 255 / 50%);padding: 50px 10px;

">
        <div class="m-auto container saved_container">

            @if ($bookmarks != [] && !$bookmarks->isEmpty())
                <div class="d-grid gap-8 mt-5 saved_job_cards" style="
        grid-template-columns: 31.8% 31.8% 31.8%;
    ">


                    @include('avenger.frontend.job-card', ['jobOpenings' => $bookmarks])

                </div>
            @else
                <p class="fs-3 text-center no_jobs">No Saved jobs Available</p>
            @endif
        </div>
    </section>

    <section class="job-openings">
        <div class="m-auto container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="heading m-0">Other jobs you might be interested in</h4>
                <a href="{{ route('all-jobs') }}">
                    <button class="see-all-btn">See All Jobs<iconify-icon icon="ic:round-chevron-right" width="16"
                            height="16"></iconify-icon></button>
                </a>
            </div>

            <div class="d-grid gap-8 mt-5" style=" grid-template-columns: 31.8% 31.8% 31.8%; ">


                @include('avenger.frontend.job-card', $jobOpenings)

            </div>
        </div>
    </section>

    <section class="how-it-works" id="how-it-works">
        <h4 class="text-center">How it works</h4>
        <div class="m-auto container">
            <div class="d-flex gap-8 mt-5">
                <div class="works-card w-25">
                    <iconify-icon icon="ic:round-login" width="32" height="32" class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 1</p>
                    <p class="mb-3 head">Sign Up</p>
                    <p class="mb-3 desc">Create your profile to get started—fill in your details, skills, preferences, and
                        upload your documents.</p>
                    @guest
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endguest
                </div>
                <div class="works-card w-25">
                    <iconify-icon icon="lucide:briefcase" width="32" height="32" class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 2</p>
                    <p class="mb-3 head">Apply for Jobs</p>
                    <p class="mb-3 desc">Browse available positions, apply with a single click, and track your application
                        status.</p>
                    @if (auth()->user() != null)
                        <a href="{{ route('all-jobs') }}" class="works-button fw-bold">Browse Jobs</a>
                    @else
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endif
                </div>
                <div class="works-card w-25">
                    <iconify-icon icon="lucide:clipboard" width="32" height="32" class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 3</p>
                    <p class="mb-3 head">Complete Assessment</p>
                    <p class="mb-3 desc">If shortlisted, complete an assessment to showcase your skills. This step helps us
                        get to know you better and ensure a perfect fit!</p>
                    @guest
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endguest
                </div>
                <div class="works-card w-25">
                    <iconify-icon icon="tdesign:user-checked-1" width="32" height="32"
                        class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 4</p>
                    <p class="mb-3 head">Get Hired</p>
                    <p class="mb-3 desc">Once you impress us, we’ll make an offer! Welcome to your new role.</p>
                    @guest
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
    @include('avenger.frontend.job-modal')

@endsection
@section('scripts')

    {{-- <script src="{{ asset('employee/assets/js/custom/jobpopup.js') }}"></script> --}}
    <script>
        $(document).on('click', '.bookmark-btn', function() {
            var button = $(this);
            var jobId = button.data('job-id');
            const $jobCard = $(this).closest('.job-card');
           
            console.log('job card',$jobCard);
            $.ajax({
                url: '/toggle-bookmark',
                method: 'POST',
                data: {
                    // _token: '{{ csrf_token() }}',
                    job_id: jobId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'added') {
                        $('.bookmark-icon-' + jobId).attr('icon', 'twemoji:star');
                        // $('.no_jobs').hide();
                        const $clonedCard = $jobCard.clone();

                        if ($('.saved_job_cards').length === 0) {
                            const savedContainer = $(`
                                <div class="d-grid gap-8 mt-5 saved_job_cards" style="grid-template-columns: 31.8% 31.8% 31.8%;">
                                </div>
                            `);


                            // Insert before or after the placeholder (adjust selector as needed)
                            $('.saved_container').append(savedContainer);
                        }
                        $('.saved_job_cards').append($clonedCard);
                    } else {
                        $('.bookmark-icon-' + jobId).attr('icon', 'line-md:star');
                        console.log('else',$jobCard);
                        $jobCard.remove();
                        if ($('.saved_job_cards .job-card').length === 0) {
                            $('.job-openings .saved_container').html(
                                '<p class="fs-3 text-center no_jobs">No Saved jobs Available</p>');
                        }
                    }
                }
            });

        });

        function copyToClipboard(event, jobUrl) {
            const url = window.location.origin + jobUrl;
            console.log(url);

            navigator.clipboard.writeText(url)
            // Find the closest .btn-container to the clicked button
            const btnContainer = event.target.closest('.btn-container');

            if (btnContainer) {
                btnContainer.classList.add('show-tooltip');

                setTimeout(() => {
                    btnContainer.classList.remove('show-tooltip');
                }, 1500);
            }

        }

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



        function loadJobDetails(jobId) {

            modalShowOverlay();
            $.ajax({
                url: '/get/job/' + jobId, // API endpoint to fetch job data by ID
                method: 'GET',

                success: function(response) {

                    if (response.status === 'success') {
                        var job = response.data;
                        console.log('responsedata', job);
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
                            $('#applynow').addClass('btn-apply-disabled');

                        }

                        $('#shareButton').attr('onclick', `sharePage('/job-details/${job.slug}')`);

                        // Set Copy Button dynamically
                        $('#copyButton').attr('onclick', `copyToClipboard(event,'/job-details/${job.slug}')`);

                        // Employment Type (e.g., "Full-time", "Part-time", "Remote")
                        // console.log(employmentStatuses)
                        var employment_type = job.employment_type ? employmentStatuses[job.employment_type] :
                            "N/A";
                        // console.log(employment_type);
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
                        // console.log(formattedDate);
                        $('#viewJobModel .view-job-header #created_at').text(formattedDate);

                        // Job Description
                        $('#viewJobModel .view-job-left-side p').text(job.job_position.description);

                        // Job Skills (Soft Skills)
                        var softSkills = job.generic_skill && job.generic_skill.length >
                            0 ? job.generic_skill : ["No skills listed."];
                        var softSkillsList = softSkills.map(function(skill) {
                            // console.log(skill.title)
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
                            // console.log(func)
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
                        alert('Error loading job details');
                    }
                },
                error: function() {
                    modalHideOverlay();
                    alert('Error loading job details');
                }
            });
        }


        function modalShowOverlay() {
            const overlay = document.getElementById('modal-overlay');
            overlay.classList.remove('d-none');
            overlay.classList.add('d-flex');
        }

        function modalHideOverlay() {
            const overlay = document.getElementById('modal-overlay');
            overlay.classList.remove('d-flex');
            overlay.classList.add('d-none');
        }
    </script>
@endsection
