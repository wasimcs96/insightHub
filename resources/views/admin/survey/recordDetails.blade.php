@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
<style>
    .image-input-placeholder {
        background-image: url({{ asset('admin/media/svg/files/blank-image.svg') }});
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{ asset('admin/media/svg/files/blank-image-dark.svg') }});
    }
</style>
@endsection
@section('content')
@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
               Survey
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">Survey</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h2 class="capitalize">Employees Details</h2>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a href="{{ route('survey.index') }}" class="btn btn-primary d-flex align-items-center">
                            <iconify-icon icon="weui:back-filled"></iconify-icon>
                            Back to Survey List
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body py-4">
                <table class="table align-middle table-row-dashed fs-6 gy-5 text-center" id="kt_table_users">
                    <thead>
                        <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-20px text-center">User Name</th>
                            <th class="min-w-20px text-center">User Email</th>
                            <th class="min-w-20px text-center">Survey Submitted</th>
                            <th class="min-w-20px text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($uniqueUsers as $user)
                        <tr>
                            <td class="text-center">{{ $user->user->name }}</td>
                            <td class="text-center">{{ $user->user->email }}</td>
                            @php 
                                $surveyResult = App\Models\SurveyResult::where('user_id', $user->user->id)
                                                                        ->where('survey_id', $user->survey_id)
                                                                        ->count();
                            @endphp
                            <td class="text-center">
                                {{ $surveyResult > 0 ? 'Yes' : 'No' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('survey.viewAnswers', ['surveyId' => $survey->id, 'userId' => $user->user->id]) }}">
                                <button class="btn btn-primary view-more">View More</button>
                            </a>
                                <div class="survey-details" id="" style="display: none;">
                                    <!-- Details will be loaded here via AJAX -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $surveyResults->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $('#form-' + $(this).attr('custom1'));
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this department?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000);
        }
    });

    $(document).ready(function() {
        $('.view-more').click(function() {
            var id = $(this).data('id');
            var detailsDiv = $('#details-' + id);

            if (detailsDiv.is(':empty')) {
                $.ajax({
                    url: '{{ url("admin/survey/details") }}/' + id,
                    method: 'GET',
                    success: function(data) {
                        var html = '<ul>';
                        data.answers.forEach(function(answer) {
                            html += '<li><strong>Question:</strong> ' + answer.question + '</li>';
                            html += '<li><strong>Answer:</strong> ' + answer.answer + '</li>';
                        });
                        html += '</ul>';
                        detailsDiv.html(html);
                    }
                });
            }

            detailsDiv.toggle();
        });
    });
</script>
@endsection
