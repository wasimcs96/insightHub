@extends('employee.layout.app')

@section('title', 'Settings')

@section('style')
    <style>
        /* Remove space at the top */
        .app-content {
            padding-top: 0;
            margin-top: 0;
        }

        /* Add space at the bottom between content and footer */
        .app-content {
            margin-bottom: 50px;
            /* Adjust this value to change bottom spacing */
        }

        .toggle-password {
            top: 73%;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
            /* Adds space between card and footer */
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title h5 {
            color: #5C5C5C;
            font-size: 24px;
        }

        .form-control-lg {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 0.5rem;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        .toggle-password {
            cursor: pointer;
        }

        .btn-danger {
            background-color: #ff3b3b;
            border: none;
            padding: 10px 25px;
            border-radius: 0.5rem;
            font-size: 18px;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #e63030;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: 14px;
            }

            .form-control-lg {
                padding: 8px 10px;
                font-size: 12px;
            }

            .btn-danger {
                font-size: 14px;
                padding: 6px 15px;
            }

            /* Adjust image size */
            #profile_picture_display {
                width: 100%;
                max-width: 150px;
                height: auto;
            }

            /* Adjust margins for smaller screens */
            .card-body {
                padding: 5px;
                ;
            }
        }
    </style>
@endsection

@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-0 py-lg-0">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/dashboard" class="text-muted text-hover-primary">
                            @if (auth()->user()->isEmployee())
                                Employee
                            @else
                                Candidate
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Settings
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin:: Main Setting Page -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-15">
        <div id="kt_app_content_container" class="app-container">
            <div id="content_layout">
                @if ($errors->any())
                    <div class="alert alert-danger mb-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }} <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close" style="float: right;">X</button></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @if (session('success'))
                    <div class="alert alert-success mb-5">
                        {{ session('success') }}
                    </div>
                @endif --}}
                <div class="space-y-6">
                    <div class="card-title mx-10 mb-5" style="font-size:38px;">Settings</div>
                    <div class="container-fluid">
                        <!-- Begin Profile and Change Password Cards -->
                        <form action="{{ route('employee.settings.store') }}" id="settings_form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Left Card: Profile Photo -->
                                <div class="col-12 col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="text-align: left; color:#5C5C5C; font-size:24px;">
                                                Profile Photo</h5>


                                            {{-- <div class="position-relative mb-4">
                                                <img id="profile_picture_display"
                                                    src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Picture"
                                                    onerror="this.src='{{ asset('images/default-user.svg') }}'"
                                                    class="rounded-circle border"
                                                    style="width: 300px; height: 300px; object-fit: cover; border: 0.5px solid gray;">
                                            </div>
                                            <label for="profile_picture" class="d-block text-center mt-3"
                                                style="cursor: pointer; color:red; font-size:24px;">
                                                Edit profile image
                                            </label>
                                            <input id="profile_picture" type="file" class="form-control d-none"
                                                name="profile_picture" onchange="previewImage(event)">
                                            <img id="profile_picture_preview" src="#" alt="Preview" class="mt-3"
                                                style="max-width: 200px; display: none;">
                                            @error('profile_picture')
                                                <div class="invalid-feedback d-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror --}}


                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                {{-- <label class="d-block fw-semibold fs-6 mb-5">Avatar</label> --}}
                                                <!--end::Label-->


                                                <!--begin::Image placeholder-->

                                                <!--end::Image placeholder-->
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-outline image-input-placeholder"
                                                    data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-250px h-250px"
                                                        @if (!empty(auth()->user()) && isset(auth()->user()->profile_picture)) style="background-image: url('{{ asset(auth()->user()->profile_picture) }}');"
                                    @else
                                    style="background-image: url('{{ asset('images/default-user.svg') }}');" @endif>
                                                    </div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <iconify-icon icon="heroicons-outline:pencil-alt"
                                                            class="fa-1-5"></iconify-icon>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="profile_picture" accept=".png, .jpg, .jpeg"
                                                            value="{{ old('profile_picture') }}" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    {{-- <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                                                        </iconify-icon>
                                                    </span> --}}
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    {{-- <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                                                        </iconify-icon>

                                                    </span> --}}
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Hint-->
                                                <div class="form-text  @error('avatar') is-invalid @enderror">Allowed file
                                                    types: png,
                                                    jpg, jpeg.</div>
                                                @error('avatar')
                                                    <div class="invalid-feedback text-red-500">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <!--end::Hint-->
                                            </div>


                                            {{-- card end --}}
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Card: Change Password -->
                                <div class="col-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-10"
                                                style="text-align: left; color:#5C5C5C; font-size:24px;">Change Password
                                            </h5>



                                            <div class="mb-4">
                                                <label class="form-label fw-semibold fs-6 mb-2">Current Password</label>
                                                <div class="position-relative">
                                                    <input class="form-control form-control-lg" type="password"
                                                        placeholder="Current Password" name="current_password"
                                                        autocomplete="off">
                                                    <span class="position-absolute toggle-password"
                                                        style="right: 15px; top: 50%; transform: translateY(-50%);">
                                                        <iconify-icon icon="ph:eye-slash" class="fa-1-5"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label fw-semibold fs-6 mb-2">New Password</label>
                                                <div class="position-relative">
                                                    <input class="form-control form-control-lg" type="password"
                                                        placeholder="New Password" name="new_password"
                                                        autocomplete="off">
                                                    <span class="position-absolute toggle-password"
                                                        style="right: 15px; top: 50%; transform: translateY(-50%);">
                                                        <iconify-icon icon="ph:eye-slash" class="fa-1-5"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label fw-semibold fs-6 mb-2">Confirm Password</label>
                                                <div class="position-relative d-flex">
                                                    <input class="form-control form-control-lg me-2" type="password"
                                                        placeholder="Confirm Password" name="confirm_password"
                                                        autocomplete="off">
                                                    <span class="position-absolute toggle-password"
                                                        style="right: 15px; top: 50%; transform: translateY(-50%);">
                                                        <iconify-icon icon="ph:eye-slash" class="fa-1-5"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Right Aligned Submit Button -->
                                            <div class="d-flex justify-content-end mt-10">
                                                <button class="btn btn-danger btn-lg" type="submit">Submit</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Profile and Change Password Cards -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end:: Main Setting Page -->

    <!--begin:: JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $("#settings_form").validate({
            errorElement: "span",
            rules: {
                job_desc: {
                    required: true
                },
                tooltip_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                job_desc: "Please enter your Job Description",
                tooltip_email: {
                    required: "Enter your email",
                    email: "Enter a valid email"
                }
            }
        });
    </script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profile_picture_preview');
                output.style.display = 'block';
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const inputField = this.previousElementSibling;
                const icon = this.querySelector('iconify-icon');

                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    icon.setAttribute('icon', 'heroicons-solid:eye-off');
                } else {
                    inputField.type = 'password';
                    icon.setAttribute('icon', 'heroicons-solid:eye');
                }
            });
        });
    </script>
    <!--end:: JavaScript-->

@endsection



<!-- THIS IS OLD FRONT END CODE -->
{{-- <div class="container mx-auto p-6">
                        <div class="flex space-x-4">
                            <!-- Profile Photo Card -->
                            <div class="card flex-1 p-6">
                                <div class="card-body flex flex-col">
                                    <div class="card-title mb-4">Profile Photo</div>
                                    <form action="{{ route('employee.settings.store') }}" id="settings_form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div style="display: flex; justify-content: center; margin: 7px 0 22px 0;">
                                            <div class="relative ring-4 ring-slate-100">
                                                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Picture" onerror="this.src='{{ asset('images/default-user.svg') }}'" class="w-full h-full object-cover rounded-full" style="border-radius: 50%; border: 7px solid yellow; width: 12%; height: 68%;">
                                                <label for="profile_picture" class="absolute right-2 top-[-35px] bg-slate-50 text-slate-600 rounded-full shadow-sm flex items-center justify-center h-8 w-8">
                                                    <iconify-icon icon="heroicons:pencil-square" class="fa-2x"></iconify-icon>
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <input id="profile_picture" type="file" class="form-control" style="display:none" name="profile_picture" placeholder="Upload Profile Picture" onchange="previewImage(event)">
                                            <img class="mt-5" id="profile_picture_preview" src="#" alt="Preview" style="max-width: 200px; display:none;"><br>
                                            @error('profile_picture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                            </div>
                    
                            <!-- Password Card -->
                            <div class="card flex-1 p-6">
                                <div class="card-body flex flex-col">
                                    <div class="card-title mb-4">Change Password</div>
                                    <form action="{{ route('employee.settings.store') }}" id="settings_form" method="POST">
                                        @csrf
                                        <h5 class="mt-5 mb-4">Password</h5>
                                        <div class="row">
                                            <div class="mb-10 col-lg-4 mt-5">
                                                <div class="mb-1">
                                                    <label class="form-label fw-semibold fs-6 mb-2">Current Password</label>
                                                    <div class="position-relative mb-3">
                                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Current Password" name="current_password" autocomplete="off">
                                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2">
                                                            <i class="ki-eye-slash"><iconify-icon icon="ph:eye-slash" class="fa-1-5"></iconify-icon></i>
                                                            <i class="d-none"><iconify-icon icon="mdi:eye-outline" class="fa-1-5"></iconify-icon></i>
                                                        </span>
                                                    </div>
                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-10 col-lg-4 mt-5">
                                                <div class="mb-1">
                                                    <label class="form-label fw-semibold fs-6 mb-2">New Password</label>
                                                    <div class="position-relative mb-3">
                                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="New Password" name="new_password" autocomplete="off">
                                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2">
                                                            <i class="ki-eye-slash"><iconify-icon icon="ph:eye-slash" class="fa-1-5"></iconify-icon></i>
                                                            <i class="d-none"><iconify-icon icon="mdi:eye-outline" class="fa-1-5"></iconify-icon></i>
                                                        </span>
                                                    </div>
                                                    @error('new_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-10 col-lg-4 mt-5">
                                                <div class="mb-1">
                                                    <label class="form-label fw-semibold fs-6 mb-2">Confirm Password</label>
                                                    <div class="position-relative mb-3">
                                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Confirm Password" name="confirm_password" autocomplete="off">
                                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2">
                                                            <i class="ki-eye-slash"><iconify-icon icon="ph:eye-slash" class="fa-1-5"></iconify-icon></i>
                                                            <i class="d-none"><iconify-icon icon="mdi:eye-outline" class="fa-1-5"></iconify-icon></i>
                                                        </span>
                                                    </div>
                                                    @error('confirm_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-12 flex justify-center">
                                            <button class="btn btn-primary mr-3" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script>
        $("#settings_form").validate({
            errorElement: "span",
            rules: {
                job_desc: {
                    required: true
                },
                tooltip_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                job_desc: "Please enter your Job Description",
                tooltip_email: {
                    required: "Enter your email",
                    email: "Enter a valid email"
                }
            }
        });
    </script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profile_picture_preview');
                output.style.display = 'block';
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const inputField = this.previousElementSibling;
                const icon = this.querySelector('iconify-icon');

                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    icon.setAttribute('icon', 'heroicons-solid:eye-off');
                } else {
                    inputField.type = 'password';
                    icon.setAttribute('icon', 'heroicons-solid:eye');
                }
            });
        });
    </script> --}}
{{-- 

@endsection --}}
