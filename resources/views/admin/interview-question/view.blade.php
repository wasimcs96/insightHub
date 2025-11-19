@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 90px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .back-btn {
            color: #F7941C;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .heading {
            color: #000;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin: 30px 0px;
        }

        .styles-bulk-upload .card-question {
            display: flex;
            padding: 16px 16px 32px 16px;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            align-self: stretch;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.07);
        }

        .styles-bulk-upload .inner-card {
            display: flex;
            padding-bottom: 16px;
            flex-direction: column;
            gap: 8px;
            align-self: stretch;
            border-bottom: 1px solid #F3F3F3;
        }

        .styles-bulk-upload .button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .styles-bulk-upload .button.btn-edit {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .styles-bulk-upload .button.btn-delete {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .styles-bulk-upload .inner-card p {
            color: #99A1B7;
            font-size: 14.95px;
            font-weight: 500;
            line-height: 17.94px;
        }

        .styles-bulk-upload .inner-card h5 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }
    </style>

@endsection

@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container styles-bulk-upload">
               <a href="{{route('admin.interview-question.index')}}">
                <p class="d-flex align-items-center gap-3 back-btn"><iconify-icon icon="majesticons:arrow-left-line"
                    width="18" height="18"></iconify-icon> Back to List
            </p>
               </a>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="heading">Interview Questions for {{ $job->title }} </h4>
                    <div class="d-flex gap-5">
                       <a href="{{ route('admin.interview-question.edit', ['department_id' => $group->department_id, 'job_id' => $group->job_id]) }}">
                        <button class="button btn-edit"><iconify-icon icon="ph:note-pencil-bold" width="16"
                            height="16"></iconify-icon> Edit</button>
                       </a>
                    
                        <button class="button btn-delete" data-bs-toggle="modal" data-bs-target="#deleteInterview"
                        data-job="{{ $group->job_id }}" data-department="{{ $group->department_id }}">
                        <iconify-icon icon="bx:trash" width="16" height="16"></iconify-icon>Delete
                       </button>
                    </div>
                </div>
                <div class="card-question">
                    @foreach($questions as $index => $question)
                        <div class="inner-card {{ $loop->last ? 'border-0' : '' }}">
                            <p class="m-0">Question {{ $index + 1 }}</p>
                            <h5 class="m-0">{{ $question->title }}</h5>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>

            <!-- Delete Confirmation Modal & Form -->
<form id="deleteInterviewForm" method="POST" action="{{ route('admin.interview-question.destroy') }}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="job_id" id="deleteJobId">
    <input type="hidden" name="department_id" id="deleteDepartmentId">

    <div class="modal fade" id="deleteInterview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-div">
                <div class="modal-body text-center pt-5">
                    <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" style="float:right;">
                        <iconify-icon icon="mingcute:close-fill" width="24" height="24" style="color: #99A1B7;"></iconify-icon>
                    </button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-3" style="color: #FF6355;"></iconify-icon>
                    <p class="fw-bolder fs-1" style="color: #4B5675;">Are You Sure You Want to Delete this Interview Question?</p>
                    <p class="text-muted">This action is permanent and cannot be undone.</p>
                </div>
                <div class="modal-footer d-block border-0">
                    <div class="d-flex w-100 gap-2">
                        <button type="button" class="btn btn-outline w-50" data-bs-dismiss="modal">No, cancel</button>
                        <button type="submit" class="btn btn-danger w-50">Yes, delete it</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll("[data-bs-target='#deleteInterview']");

        deleteButtons.forEach(button => {
            button.addEventListener("click", () => {
                document.getElementById("deleteJobId").value = button.dataset.job;
                document.getElementById("deleteDepartmentId").value = button.dataset.department;
            });
        });
    });
</script>

@endsection
