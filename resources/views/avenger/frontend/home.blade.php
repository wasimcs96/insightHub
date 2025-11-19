@extends('avenger.layouts.app')
@section('title', env('APP_NAME') . ' | Home')
@section('styles')

    <style>
        .search-container {
            background-color: #F1F1F4;
            padding: 58px 0px;
            min-height: 92vh;
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
            height: 49.49px;
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
            padding: 120px 10px;
            background: white;
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

    <style>
        .working-with-us {
            padding: 120px 10px;
            background: white;
        }

        .working-with-us .heading {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .working-with-us .desc {
            color: #4B5675;
            font-size: 19.5px;
            font-weight: 400;
            line-height: 29.25px;
            margin: 24px 0px;
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

@endsection
@section('content')
<section class="d-flex align-items-center flex-column justify-content-center search-container">
    <h2 class="heading">Explore Opportunities &<br> Land Your Dream Job</h2>
    
        <form method="get" class="search-box" action="{{ route('all-jobs') }}">
        <div class="search-input">
            <iconify-icon class="icon-search-box" icon="mingcute:search-line" width="16" height="16"></iconify-icon>
            <input type="text" class="form-control" name="job_title" placeholder="Search by job title or keyword">
        </div>
        <div class="search-select">
            <iconify-icon class="icon-search-box" icon="akar-icons:location" width="16"
                height="16"></iconify-icon>
                <select class="form-select" name="city_filter" id="city_id">
                    <option value="" selected>Select Location</option>

                </select>
        </div>
        <button class="custom-button btn-orange-fill" type="submit">Search</button>
        <a href="{{ route('all-jobs') }}">
            <button class="custom-button btn-outline-orange">See All Jobs</button></a>
    </form>
     
</section>

<section class="job-openings">
    <div class="m-auto container">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="heading m-0">Latest job openings</h4>
            <a href="{{ route('all-jobs') }}">
                <button class="see-all-btn">See All Jobs<iconify-icon icon="ic:round-chevron-right" width="16"
                        height="16"></iconify-icon></button>
            </a>
        </div>

        <div class="d-grid gap-8 mt-5" style="
        grid-template-columns: 31.8% 31.8% 31.8%;
    ">
           
            @include('avenger.frontend.job-card',['jobOpenings'=>$jobApiData])
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
                <button class="works-button fw-bold" onclick="window.location='{{ route('register') }}'">Sign Up Now</button>
            </div>
            <div class="works-card w-25">
                <iconify-icon icon="lucide:briefcase" width="32" height="32"
                    class="works-icon"></iconify-icon>
                <p class="mb-3 step-text">STEP 2</p>
                <p class="mb-3 head">Apply for Jobs</p>
                <p class="mb-3 desc">Browse available positions, apply with a single click, and track your application
                    status.</p>
                <button class="works-button fw-bold" onclick="window.location='{{ route('all-jobs') }}'">Browse Jobs</button>
            </div>
            <div class="works-card w-25">
                <iconify-icon icon="lucide:clipboard" width="32" height="32"
                    class="works-icon"></iconify-icon>
                <p class="mb-3 step-text">STEP 3</p>
                <p class="mb-3 head">Complete Assessment</p>
                <p class="mb-3 desc">If shortlisted, complete an assessment to showcase your skills. This step helps us
                    get to know you better and ensure a perfect fit!</p>
                {{-- <button class="works-button fw-bold" onclick="window.location='{{ route('register') }}'">Sign Up Now</button> --}}
            </div>
            <div class="works-card w-25">
                <iconify-icon icon="tdesign:user-checked-1" width="32" height="32"
                    class="works-icon"></iconify-icon>
                <p class="mb-3 step-text">STEP 4</p>
                <p class="mb-3 head">Get Hired</p>
                <p class="mb-3 desc">Once you impress us, we’ll make an offer! Welcome to your new role.</p>
                {{-- <button class="works-button fw-bold" onclick="window.location='{{ route('register') }}'">Sign Up Now</button> --}}
            </div>
        </div>
    </div>
</section>

<section class="working-with-us">
    <div class="container m-auto d-flex align-items-center gap-8">
        <div class="left-side">
            <h4 class="heading m-0">Working With Us</h4>
            <p class="desc">Curious about us? Dive into our culture, meet the teams, and discover what makes us a
                unique place to grow and thrive. Explore our values, benefits, and the inspiring projects we’re working
                on—join us in shaping the future together!</p>
            <button class="custom-button btn-outline-orange" onclick="window.location='{{ route('register') }}'"> Join Us Now<iconify-icon
                    icon="material-symbols:chevron-right-rounded" width="16"
                    height="16"></iconify-icon></button>
        </div>
        <div class="right-side">
            <img alt="Logo" src="{{ asset('/admin/media/patterns/Rectangle.png') }}" />
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
@push('script')
<script src="{{ asset('employee/assets/js/custom/jobpopup.js') }}"></script>
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
@endpush