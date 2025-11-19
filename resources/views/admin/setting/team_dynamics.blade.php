<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Team Dynamics')


@section('content')


<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Settings
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Settings </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Team Dynamics </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->

        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>


<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8 col-lg-12">

            <!--begin::Body-->
            <div class="card-body flex flex-col p-6">
                <div class="card-text h-full">
                @include('admin.setting.includes.topnav')

                <div class="tab-content" id="pills-tabContentHorizontal">
                    <div class="tab-pane fade show active" id="pills-homeHorizontal" role="tabpanel"
                        aria-labelledby="pills-home-tabHorizontal">
                        <div class="card-text h-full">
                            <form action="{{ route('teamDynamics.store') }}" method="POST">
                                @csrf
                                @foreach($masterFacets as $key => $masterFacet)
                                <div class="card card-docs flex-row-fluid mb-2">
                                    {{-- <header class="card-header noborder">
                                        <h5 class="fw-bold mb-5">{{ $masterFacet->title }}</h5>
                                    </header> --}}
                                    <div class="card-body fs-6 py-10 px-10 py-lg-10 px-lg-10 text-gray-700">
                                        <h5 class="fw-bold mb-9">{{ $masterFacet->title }}</h5>
                                        @foreach($masterFacet->facetQuestions as $question)
                                        <h6 class="mb-4 mt-11">Q{{ $loop->iteration }}. {{ $question->title }}</h6>
                                        <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                                            @foreach($question->facetQuestionOptions as $option)
                                            <div class="" style="display: contents;">
                                                <input type="radio" class="hidden" name="answers[{{ $question->id }}]" id="option_{{ $option->id }}" value="{{ $option->id }}" {{ isset($savedSelections[$question->id]) && $savedSelections[$question->id] == $option->id ? 'checked' : '' }}>

                                                <label class="flex items-center cursor-pointer question_card" for="option_{{ $option->id }}">
                                                    <div class="flex-1 items-center p-6 ">
                                                        {{-- <div class="card-title mb-5">{{ $option->type }}</div> --}}
                                                        <p class="card-title text-center">{{ $option->title }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                                <div class="flex justify-center mt-4">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>
                        </div>


                    </div>


                </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('styles')
<style>
    input[type=radio]:checked+label {
        box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        -webkit-box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        -moz-box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        border: solid 3px #ef305e;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .question_card {
        border-radius: 12px;
        border: 1px solid #747474;
    }

    .question_card label {
        cursor: pointer;
        border: solid 3px transparent;
        box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        -webkit-box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        -moz-box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        transition: all 0.3s ease;
    }

    .question_card:hover {
        border: 3px solid #ef305e;
        transition: all 0.3s ease;
        box-shadow: -5px 0px 33px -8px rgba(255, 101, 74, 0.45);
        -webkit-box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
        -moz-box-shadow: -5px 0px 33px -8px rgba(230, 88, 63, 0.562);
    }
    .hidden{
        display: none;
    }
    .card-title{
        font-size: 1.25rem;
        line-height: 28px;
        font-weight: 500;
    text-transform: capitalize;
    }
</style>
@endsection
@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection
