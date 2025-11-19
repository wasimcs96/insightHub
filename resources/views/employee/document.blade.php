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


    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/dashboard" class="text-muted text-hover-primary">
                            @if(auth()->user()->isEmployee())
                            Employee
                        @else
                        Candidate
                    @endif  </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Documents Upload </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>


            <!--end::Page title-->

            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  ">
            <div id="content_layout">

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
                        <header class="card-header">
                            <h4 class="card-title">Documents Upload</h4>
                        </header>
                        <div class="card-body flex flex-col p-6">

                            <div class="card-text h-full space-y-4">
                                {{-- @if($step == 6) --}}
                                <form action="{{ route('employee.document.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">Reference Letters</label>
                                            <input type="file" name="reference_letter" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('reference_letter')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->reference_letter)
                                                <input type="hidden" name="existing_reference_letter" value="{{ auth()->user()->reference_letter }}">
                                                <a href="{{ asset('' . auth()->user()->reference_letter) }}" target="_blank">Uploaded Reference Letters</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">NBI Clearance</label>
                                            <input type="file" name="nbi_clearence" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('nbi_clearence')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->nbi_clearence)
                                                <input type="hidden" name="existing_nbi_clearence" value="{{ auth()->user()->nbi_clearence }}">
                                                <a href="{{ asset('' . auth()->user()->nbi_clearence) }}" target="_blank">Uploaded NBI Clearance</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">Police Clearance</label>
                                            <input type="file" name="police_clearence" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('police_clearence')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->police_clearence)
                                                <input type="hidden" name="existing_police_clearence" value="{{ auth()->user()->police_clearence }}">
                                                <a href="{{ asset('' . auth()->user()->police_clearence) }}" target="_blank">Uploaded Police Clearance</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">Barangay Clearance</label>
                                            <input type="file" name="barangay_clearence" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('barangay_clearence')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->barangay_clearence)
                                                <input type="hidden" name="existing_barangay_clearence" value="{{ auth()->user()->barangay_clearence }}">
                                                <a href="{{ asset('' . auth()->user()->barangay_clearence) }}" target="_blank">Uploaded Barangay Clearance</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">Marriage Certificate</label>
                                            <input type="file" name="marriage_certificate" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('marriage_certificate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->marriage_certificate)
                                                <input type="hidden" name="existing_marriage_certificate" value="{{ auth()->user()->marriage_certificate }}">
                                                <a href="{{ asset('' . auth()->user()->marriage_certificate) }}" target="_blank">Uploaded Marriage Certificate</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">Certificate Of No Marriage</label>
                                            <input type="file" name="certificate_of_no_marriage" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('certificate_of_no_marriage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->certificate_of_no_marriage)
                                                <input type="hidden" name="existing_certificate_of_no_marriage" value="{{ auth()->user()->certificate_of_no_marriage }}">
                                                <a href="{{ asset('' . auth()->user()->certificate_of_no_marriage) }}" target="_blank">Uploaded Certificate Of No Marriage</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <label class="form-label mb-3">Special Power Of Attorney</label>
                                            <input type="file" name="special_power_of_attorny" accept="application/pdf" class="form-control bg-transparent" />
                                            @error('special_power_of_attorny')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if (auth()->user()->special_power_of_attorny)
                                                <input type="hidden" name="existing_special_power_of_attorny" value="{{ auth()->user()->special_power_of_attorny }}">
                                                <a href="{{ asset('' . auth()->user()->special_power_of_attorny) }}" target="_blank">Uploaded Special Power Of Attorney</a>
                                            @endif
                                        </div>
                                
                                        <div class="fv-row mb-8">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                
                                {{-- @endif --}}


                            </div>
{{-- 
<div class="container">

    @if(isset($user))
    <h2>Stored Document Data:</h2>
    <p><strong>Reference Letter:</strong> {{ $user->reference_letter }}</p>
    <p><strong>NBI Clearance:</strong> {{ $user->nbi_clearence }}</p>
    <p><strong>Police Clearance:</strong> {{ $user->police_clearence }}</p>
    <p><strong>Barangay Clearance:</strong> {{ $user->barangay_clearence }}</p>
    <p><strong>Marriage Certificate:</strong> {{ $user->marriage_certificate }}</p>
    <p><strong>Certificate of No Marriage:</strong> {{ $user->certificate_of_no_marriage }}</p>
    <p><strong>Special Power of Attorney:</strong> {{ $user->special_power_of_attorny }}</p>
@endif
</div> --}}

                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    {{-- <script>
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


@endsection
