@extends('admin.layout.app')

@section('title', 'Setting - Matching')

@section('content')
<div class="content-wrapper transition-all duration-150 xl:ltr:ml-[248px] xl:rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div id="content_layout">




            <!-- BEGIN: Breadcrumb -->
            <div class="mb-5">
                <ul class="m-0 p-0 list-none">
                    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                        <a href="/admin/dashboard">
                            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                            <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                        </a>
                    </li>
                    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                        Admin
                        <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                    </li>
                    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                        Settings</li>
                </ul>
            </div>
            <!-- END: BreadCrumb -->
            <div class="space-y-6">



                <div class="card">
                    <div class="card-body flex flex-col p-6">
                        <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                            <div class="flex-1">
                                <div class="card-title text-slate-900 dark:text-white">Settings</div>
                            </div>
                        </header>
                        <div class="card-text h-full">
                            <div>
                                @include('admin.setting.includes.topnav')

                                <div class="tab-content">
                                    <div class="" role="tabpanel" aria-labelledby="pills-profile-tabHorizontal">
                                        <div class="card-text h-full ">
                                            <form  class="space-y-4 w-96">

                                            {{-- <form action="{{ route('weightage.storeWeightage') }}" method="POST" class="space-y-4 w-96" id="myForm"> --}}
                                                @csrf

                                                <div class="input-area relative">
                                                    <label for="largeInput" class="form-label">Pool #1 Percentage Count</label>
                                                    <div class="relative">
                                                        <input type="number" value="{{$setting->pool_one ?? 0}}" name="pool_one" class="form-control !pl-9" disabled id="pool1" placeholder="Enter Talent percentage" min="0">


                                                    </div>
                                                </div>

                                                <div class="input-area relative">
                                                    <label for="largeInput" class="form-label">Pool #2 Percentage Count</label>
                                                    <div class="relative">
                                                        <input type="number" value="{{$setting->pool_two ?? 0}}" name="pool_two" disabled class="form-control !pl-9" id="pool2" placeholder="Enter employee profile percentage" min="0">



                                                    </div>
                                                </div>

                                                <div class="input-area relative">
                                                    <label for="largeInput" class="form-label">Pool #3 Percentage Count</label>
                                                    <div class="relative">
                                                        <input type="number" value="{{$setting->pool_three ?? 0}}" name="pool_three" disabled class="form-control !pl-9" id="pool3" placeholder="Enter softskill percentage" min="0">



                                                    </div>
                                                </div>

                                                {{-- <button class="btn inline-flex justify-center btn-dark" disabled>Submit</button> --}}
                                            </form>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>
    </div>
</div>

{{-- {{dd($labels)}} --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            var pool1 = $('#pool1').val();
            var pool2 = $('#pool2').val();
            var pool3 = $('#pool3').val();
            var isValid = true;

            // Simple validation checks
            if (pool1 === '') {
                $('#pool1').next('.error').remove();
                $('#pool1').after('<span class="error">Pool 1 is required</span>');
                isValid = false;
            } else {
                $('#pool1').next('.error').remove();
            }

            if (pool2 === '') {
                $('#pool2').next('.error').remove();
                $('#pool2').after('<span class="error">Pool 2 is required</span>');
                isValid = false;
            } else {
                $('#pool2').next('.error').remove();
            }

            if (pool3 === '') {
                $('#pool3').next('.error').remove();
                $('#pool3').after('<span class="error">Pool 3 is required</span>');
                isValid = false;
            } else {
                $('#pool3').next('.error').remove();
            }

            // Prevent the form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    });

</script>

@endsection
