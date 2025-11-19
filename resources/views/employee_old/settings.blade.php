@extends('employee.layout.app')

@section('title', 'Settings')
@section('style')
    <style>
        .toggle-password {
           top: 73%;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper transition-all duration-150 xl:ltr:ml-[248px] xl:rtl:mr-[248px]" id="content_wrapper">
        <div class="page-content">
            <div id="content_layout">
                <!-- BEGIN: Breadcrumb -->
                <div class="mb-5">
                    <ul class="m-0 p-0 list-none">
                        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                            <a href="/dashboard">
                                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                                <iconify-icon icon="heroicons-outline:chevron-right"
                                    class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                            </a>
                        </li>
                        <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                            Employee
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                        </li>
                        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                            Settings
                        </li>

                    </ul>
                </div>
                <!-- END: BreadCrumb -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;">X</button></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success')) <!-- Check if there's a success message in the session -->
                    <div class="alert alert-success mb-5"> <!-- Display a success alert -->
                        {{ session('success') }} <!-- Display the success message -->
                    </div>
                @endif
                <div class="space-y-6">

                    <div class="card">
                        <div class="card-body flex flex-col p-6">
                            <header
                                class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">Settings</div>
                                </div>
                            </header>
                            <div class="card-text h-full space-y-4">
                                <form action="{{ route('employee.settings.store') }}" id="settings_form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div style=" display: flex;     justify-content: center; margin: 7px 0px 22px 0px; ">
                                     

                                            <div class="md:h-[186px] md:w-[186px] h-[140px] w-[140px] md:ml-0 md:mr-0 ml-auto mr-auto md:mb-0 mb-4 rounded-full ring-4
                                                    ring-slate-100 relative">

                                                    @if (auth()->user()->profile_picture)
                                                  
                                                    <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover rounded-full" >
                                               
                                                    @else
                                                        <img src="{{ asset('admin/assets/images/all-img/main-user.png') }}"alt="Profile Picture" class="w-full h-full object-cover rounded-full" >
                                                     @endif




                                            <label for="profile_picture" class="absolute right-2 h-8 w-8 bg-slate-50 text-slate-600 rounded-full shadow-sm flex flex-col items-center
                                                        justify-center md:top-[140px] top-[100px]">
                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                        </label>
                                            </div>
                                                
                                            
                                    </div>
                                    <div class="gap-4 grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 mb-4">
                                        <div class="input-area">
                                            {{-- <label for="profile_picture" class="form-label">Upload Profile Picture*</label> --}}
                                                                                       
                                            <input id="profile_picture" type="file" class="form-control " style="display:none" name="profile_picture"
                                                placeholder="Upload Profile Picture" value="{{ auth()->user()->profile_picture ?? ''}}" onchange="previewImage(event)" @if (!auth()->user()->profile_picture) required @endif> 
                                            <img class="mt-5" id="profile_picture_preview" src="#" alt="Preview" style="max-width: 200px;display:none;"><br>
                                            @error('profile_picture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                               

                                    <h5 class="mt-5 mb-4">Password</h5>
                                    <div class="gap-4 grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 mb-4">
                                        <div class="input-area">
                                            <div class="relative">
                                                <label for="current_password" class="form-label">Current Password</label>
                                                <input type="password" name="current_password" class="form-control !pr-12" placeholder="Current Password">
                                                <button type="button" class="border-none toggle-password absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-l border-l-slate-200 dark:border-l-slate-700 flex items-center justify-center">
                                                  <iconify-icon icon="heroicons-solid:eye"></iconify-icon>
                                                </button>
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>    
                                      
                                        
                                        <div class="input-area">
                                            <div class="relative">
                                              <label for="new_password" class="form-label">New Password</label>
                                              <input type="password" name="new_password" class="form-control !pr-12" placeholder="New Password">
                                              <button type="button" class="border-none toggle-password absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-l border-l-slate-200 dark:border-l-slate-700 flex items-center justify-center">
                                                <iconify-icon icon="heroicons-solid:eye"></iconify-icon>
                                              </button>
                                               @error('new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="input-area">
                                            <div class="relative">
                                              <label for="confirm_password" class="form-label">Confirm Password</label>
                                              <input type="password" name="confirm_password" class="form-control !pr-12" placeholder="Confirm Password">
                                              <button type="button" class="border-none toggle-password absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-l border-l-slate-200 dark:border-l-slate-700 flex items-center justify-center">
                                                <iconify-icon icon="heroicons-solid:eye"></iconify-icon>
                                              </button>
                                               @error('confirm_password')
                                                  <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>



                                    <div class="mt-12" style="display:flex; justify-content:center">
                                        <button class="btn btn-success mr-3" type="submit">Submit</button>
                                        {{-- <button class="btn btn-danger">Discard</button> --}}

                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

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


@endsection
