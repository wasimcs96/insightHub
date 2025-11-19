@extends('admin.layout.app')

@section('title', 'Talent Acquisition')

@section('styles')

    <style>
        .jp-main-div {
            padding: 32px;
            border-right: 1px #F1F1F4;
            border-bottom: 1px #F1F1F4;
            border-left: 1px #F1F1F4;
            background: #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .jp-header {
            padding: 24px 24px 24px 48px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .jp-header h4 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 8px;
        }

        .jp-header p {
            color: #99A1B7 !important;
            font-size: 13.975px !important;
            font-weight: 500 !important;
            line-height: 16.77px !important;
        }

        .jp-body {
            padding: 48px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid#F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            gap: 26px;
        }

        .jp-sidebar {
            width: 36%;
        }

        .jp-left-side {
            width: 62%;
        }

        .jp-left-side h5 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .jp-left-side p {
            color: #4B5675 !important;
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 25px !important;
        }

        .jp-left-side .accordion-button,
        .jp-left-side .accordion-item {
            padding: 16px;
            border-radius: 8px;
            font-size: 16.25px;
            font-weight: 500;
            border: 0;
            line-height: 19.5px;
        }

        .jp-left-side .accordion-body {
            padding: 20px 0px 0px;
        }

        .jp-left-side .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .jp-left-side .accordion-button {
            padding: 0px;
        }

        .jp-left-side .accordion-item {
            border: 1px solid #DBDFE9;
        }

        .jp-left-side .accordion-button:not(.collapsed) {
            color: #071437;
            box-shadow: none;
            background: none;
        }

        .jp-sidebar .box {
            padding: 24px;
            border-radius: 8px;
            background: #FAFAFB;
        }

        .jp-sidebar h4 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .jp-sidebar p {
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 22px !important;
        }

        .jp-sidebar h5 {
            color: #4B5675;
            font-size: 14px;
            font-weight: 700;
            line-height: 22px;
        }

        .jp-sidebar button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
        }

        .jp-sidebar .btn-apply {
            background: #F7941C;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }

        .jp-sidebar .btn-outline {
            display: flex;
            width: 48px;
            height: 48px;
            justify-content: center;
            align-items: center;
            border: 1px solid #99A1B7 !important;
            background: #FFF;
        }

        .filter-content button {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .filter-content .btn-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .filter-content .btn-apply {
            background: #F7941C;
            color: #fff;
        }

        .filter-content .btn-outline.outline {
            border: 1px solid #F7941C !important;
            color: #F7941C;
        }
        
    </style>

@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <input type="hidden" name="editMode" value="{{ $editMode ? 'true' : 'false' }}">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h2 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ request()->has('reuse') 
                    ? 'Reuse Job Advertisement' 
                    : ($editMode ? 'Edit Job Advertisement' : 'Create Job Advertisement') }}
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/talent-acquisition/job-board" class="text-muted text-hover-primary">Talent
                            Acquisition</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/talent-acquisition/job-board" class="text-muted text-hover-primary">Job Board</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">   {{ request()->has('reuse') 
                        ? 'Reuse Job Advertisement' 
                        : ($editMode ? 'Edit Job Advertisement' : 'Create Job Advertisement') }}</li>
                </ul>
            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100">
            <h1 class="text-dark fw-semibold lh-base m-0 mb-14" style="font-size: 32.5px;">
                Job Posting Preview
            </h1>
            <div class="jp-main-div">
                @include('admin.talent-acquisition.job-board.create-edit-job-advertisement.job-posting-preview')
            </div>
            <div class="filter-content mt-14 display">
                <div class="d-flex justify-content-between">
                    <a href="/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId={{$jobId}}&jobOpeningId={{$jobOpeningId}} {{ request()->has('reuse') 
                                ? '&edit=true&reuse=true' 
                                : ($editMode ? '&edit=true' : '&create=true') }}" class="btn btn-outline outline d-inline-flex align-items-center">                        
                                <iconify-icon icon="tabler:arrow-left" width="16" height="16"></iconify-icon>
                        <span class="ms-2">Back to Review Details</span>
                    </a>
                    <div class="d-flex gap-2">
                        <button class="btn btn-apply d-flex align-items-center gap-2" 
                                data-bs-toggle="modal"
                                data-bs-target="#{{ $jobOpeningData->application_period_start_date <= now() ? 'AdvertisementCreated' : 'AdvertisementUpdate' }}"
                                data-job-slug="{{ $jobOpeningData->slug }}"
                                onclick="updateJobOpeningStatus({{ $jobOpeningData->id }})">
                                {{ request()->has('reuse') 
                                ? 'Reuse Job Advertisement' 
                                : ($editMode ? 'Edit Job Advertisement' : 'Create Job Advertisement') }}
                            <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
            <input type="hidden" id="jobSlugHolder" value="">
        </div>
    </div>
@endsection

@include('admin.talent-acquisition.job-board.create-edit-job-advertisement.edit-job-advertisement')

@section('scripts')
<script>
    const advertisementModals = ['AdvertisementCreated', 'AdvertisementUpdate'];
    advertisementModals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const slug = button.getAttribute('data-job-slug');
                document.getElementById('jobSlugHolder').value = slug;
            });
        }
    });
</script>

  <script>
    async function saveDraftPostingReview() {

        const urlParams = new URLSearchParams(window.location.search);
        const step = urlParams.get('step');
        const jobOpeningId = urlParams.get('jobOpeningId');

        console.log(step, jobOpeningId);

        try {
            const response = await fetch("{{ route('admin.talent-acquisition.job-board.save-draft-posting-review') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token for Laravel
                },
                body: JSON.stringify({ step, jobOpeningId }),
            });

            const data = await response.json();

            if (response.ok) {
                window.location.href = '/admin/talent-acquisition/job-board'
            } else {
                alert('Error: ' + data.message || 'Failed to save draft.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error: An unexpected error occurred.');
        }
    }

    function updateJobOpeningStatus(jobOpeningId) {
        fetch(`/admin/update-job-opening-status/${jobOpeningId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // If using Laravel
            },
            body: JSON.stringify({
                status: 1
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
            } else {
                alert('Failed to update status.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
  </script>
  <script>
    const jobDetailsBaseUrl = "{{ route('job-details', ':slug') }}";

    function navigateToJobBoardReadyNewPage() {
        const slug = document.getElementById('jobSlugHolder').value;
        if (slug) {
            const finalUrl = jobDetailsBaseUrl.replace(':slug', slug);
            window.open(finalUrl, '_blank'); // open in new tab
        } else {
            alert('Job slug not found!');
        }
    }
  </script>

@endsection
