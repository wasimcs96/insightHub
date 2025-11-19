@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
{{-- <style>
    .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image.svg")
    }
    });
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image-dark.svg")
    }
    });
    }
</style> --}}
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1
                class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Survey Create
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('survey.index')}}" class="capitalize text-muted text-hover-primary">
                        My Survey
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ !empty($user) ? 'Edit Survey' : 'Create Survey' }} </li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class="card">
            {{-- <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">{{ !empty($user) ? 'Edit Department' : 'Create Department' }}</span>
                </h3>
            </div> --}}
            <div class="card-body">
                <form class="form" action="{{route('survey.store')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                       
                        <div class="fv-row mb-7 row">
                            <div class="col-lg-6">
                                <label class=" fw-semibold fs-6 mb-2">Survey Title</label>
                                <input type="text" name="title"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('title') is-invalid @enderror"
                                    placeholder="Enter Survey Title">
                                @error('title')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class=" fw-semibold fs-6 mb-2">Survey Description</label>
                                <input type="text" name="description"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror"
                                    placeholder="Enter Survey Description">
                                @error('description')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            {{-- <div class="col-lg-6">
                                <label for="description" class="form-label fs-6 mb-2">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                                <input type="text" name="discription"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('discription') is-invalid @enderror"
                                    placeholder="">
                                @error('discription')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}

                        </div>
     
          @include('admin.survey.question')

                 @include('admin.survey.descriptive')
                        
        
                    </div>
                    <div class="text-center pt-10">
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
                           <!-- Button to add multiple-choice question -->
   

    <!-- Modals (hidden by default) -->
    <!-- Multiple Choice Modal -->
 


   
   

    <!-- Descriptive Question Modal -->
   
                    <!-- Form content for descriptive question -->
     
            </div>
    
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stack('scripts')

    <script>
        $(document).ready(function() {
            $('#add_multiple_question').click(function() {
                $('#multipleChoiceModal').modal('show');
            });

            $('#add_descriptive_question').click(function() {
                $('#descriptiveModal').modal('show');
            });
        });
    </script>







