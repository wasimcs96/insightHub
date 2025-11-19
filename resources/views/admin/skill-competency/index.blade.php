@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
<style>
  .displayNone {
    display: none;
  }

  .report-message-container {
    text-align: center;
    /* Centers the text */
    padding: 50px;
    /* Adds space around the content */
    color: #6c757d;
    /* Sets the text color */
    font-family: Arial, sans-serif;
    /* Sets the font style */
  }

  .report-message-container h2 {
    margin-bottom: 16px;
    /* Space below the header */
    font-size: 24px;
    /* Sets the font size for the header */
  }

  .report-message-container p {
    margin-bottom: 24px;
    /* Space below the paragraph */
    font-size: 16px;
    /* Sets the font size for the paragraph */
  }

  .report-link-button {
    display: inline-block;
    /* Makes the link a block-level element */
    padding: 10px 20px;
    /* Adds padding inside the button */
    font-size: 16px;
    /* Sets the font size for the button */
    color: #f7941d;
    /* Sets the text color for the button */
    border: 1px solid #f7941d;
    /* Sets the background color for the button */
    border-radius: 22px;
    /* Rounds the corners of the button */
    text-decoration: none;
    /* Removes the underline from the link */
    transition: background-color 0.3s ease;
    /* Adds a transition effect when hovering or focusing */
  }


  .step-bar-wrapper {
    font-size: 0;
    background: #fff;
    text-align: center;
    padding: 50px 0 0;
    /* box-shadow:5px 5px 24px 0px rgba(0, 0, 0, 0.2); */
    width: 100%;
    margin: 30px auto 0;
    position: relative;
    z-index: 10;
    border-radius: 10px
  }

  a {
    color: #5c399e;
    /* change primary color */
  }

  .step-wrapper {
    padding: 0;
    margin: 0;
    font-size: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    counter-reset: step;
    tr
  }

  .step-wrapper li {
    width: 120px;
  }

  .step-wrapper li>a:before {
    content: '';
    width: 36px;
    height: 36px;
    display: block;
    font-size: 16px;
    font-weight: 700;
    background-color: transparent;
    border-radius: 100%;
    z-index: 1;
    position: absolute;
    text-align: center;
  }

  .step-wrapper li>a:after {
    content: counter(step);
    counter-increment: step;
    width: 36px;
    line-height: 36px;
    display: block;
    font-size: 16px;
    color: #bbb;
    font-weight: 700;
    background-color: transparent;
    border-radius: 100%;
    z-index: 1;
    position: absolute;
    text-align: center;
  }

  .step-wrapper li.completed>a:after {
    content: '\2713';
    color: currentColor;
  }

  .step-wrapper li:first-of-type a:before,
  .step-wrapper li:first-of-type a:after {
    margin-left: -42px;
  }

  .step-wrapper li:last-of-type>a:before,
  .step-wrapper li:last-of-type>a:after {
    margin-left: 39px;

  }

  .step-wrapper li.completed>a:before {
    background: #fff;
    color: #c4c4c4;
    -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
  }

  .step-wrapper li.active>a:before {
    background-color: #f7941d;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 0px rgba(0, 0, 0, 0.15), 0px 0px 9px 0px #f7941d;
    background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
    background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
    background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    background-image: -moz-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    background-image: -ms-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    background-image: -o-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
  }

  .step-wrapper li.active>a:after {
    color: #fff;
  }

  .step-wrapper li span {
    display: block;
    width: 100%;
    text-align: center;
    margin-bottom: 15px;
  }

  .step-wrapper li span a {
    font-size: 14px;
    font-weight: 700;
  }

  .step-wrapper li:not(.active):not(.completed) span a {
    color: #bbb;
  }

  .step-wrapper li>a {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    height: 48px
  }

  .step-wrapper li:first-of-type>a {
    padding-left: 40px;
  }

  .step-wrapper li:last-of-type>a {
    padding-right: 40px;
  }

  .step-wrapper li>a svg {
    height: 48px;
    min-height: 48px;
    width: auto;
    position: absolute;
    display: inline-block;
    stroke-width: 0;
    transition: all 300ms ease-in-out;
  }

  .step-wrapper li>a svg {
    filter: url(#inset-shadow);
  }

  a.button {
    margin: 50px 15px;
    display: inline-block;
    border-radius: 4px;
    width: 100px;
    height: 50px;
    text-align: center;
    line-height: 50px;
    background-color: currentColor;
    -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
    background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
    background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
    background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    background-image: -moz-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    background-image: -ms-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    background-image: -o-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
  }

  a.button span {
    color: #fff;
    font-size: 16px;
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
          <a href="/admin/dashboard" class="text-muted text-hover-primary">
            Admin </a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-500 w-5px h-2px"></span>
        </li>
        <!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
        Employee Skills & Competencies  </li>
        <!--end::Item-->

      </ul>
      <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->

    <!--end::Actions-->
  </div>
  <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">

  <!--begin::Content container-->
  <div id="kt_app_content_container" class="app-container  container-xxl ">

    @include('admin/skill-competency.topnav')
    <div class="card card-xl-stretch mb-xl-8">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold fs-1 mb-1">Skill & Competencies</span>

        </h3>
        <!-- <a href="/admin/skill-competencies/skill-review" class="align-content-center pb-4 text-gray-600">Skill & Competencies Review Form</a> -->
      </div>
      <div class="card-body px-6 pb-6">

        <form class="form" action="{{ route('admin.skill-competencies.stepTwo', ['id' => ':id']) }}" method="get" enctype="multipart/form-data">
          @csrf
          <!--begin::Input group-->
          <div class="fv-row mb-7 row">

            <div class="col-md-6 fv-row">
              <label class="required fs-6 fw-semibold mb-2">Select Department</label>
              <select class="form-select form-select-solid" id="pool" data-control="select2" data-hide-search="false" data-placeholder="Select Department" name="pool">
            <option value="" selected>Please select a department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
            </div>

            <div class="col-lg-6" id="employeesDiv">
              <label class="required fw-semibold fs-6 mb-2">Individual</label>
              <!--end::Label-->

              <!--begin::Input-->
              <select class="form-select form-select-solid" id="employees" data-control="select2" data-hide-search="false" required data-placeholder="Select Employee" name="employee">
            <!-- Options will be dynamically added here via JavaScript -->
        </select>
            </div>

            <div class="col-lg-12 ">
              <div class="text-lg-end pt-10">
                {{-- <button type="reset" class="btn-closes btn btn-light me-3" data-bs-dismiss="modal">

                                    Discard
                                </button> --}}

                <button id="submitButton" class="btn btn-primary" type="button">
                  <span class="indicator-label">
                  Conduct Review
                  </span>
                  <span class="indicator-progress" style="display: none;">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                  </span>
                </button>
              </div>
            </div>

          </div>


          <!--end::Scroll-->

          <!--begin::Actions-->

          <!--end::Actions-->
        </form>

      </div>

    </div>
    <!--end::Form-->


  </div>
</div>

@endsection

@section('scripts')
<script>
  // Fetch employees based on selected department
  $(document).ready(function() {
    $('#pool').change(function() {
      var selectedDepartmentId = $(this).val();
      if (selectedDepartmentId) {
        $.ajax({
          url: '/admin/get-users-by-department/' + selectedDepartmentId,
          type: 'GET',
          success: function(response) {
            var users = response.users;
            var $usersDropdown = $('#employees');
            $usersDropdown.empty();
            users.forEach(function(user) {
              $usersDropdown.append($('<option>', {
                value: user.id,
                text: user.name
              }));
            });
            $('#employeesDiv').show();
            $usersDropdown.select2({
              maximumSelectionLength: 5,
              placeholder: "Select Full Name",
              allowClear: true
            });
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      } else {
        $('#employeesDiv').hide();
      }
    });
  });

  // Add validation and form submission logic
  document.getElementById('submitButton').addEventListener('click', function() {
    var selectedEmployeeId = document.getElementById('employees').value;
    if (!selectedEmployeeId) {
      // alert('Please select an employee before submitting the form.');
      return;
    }
    var url = "{{ route('admin.skill-competencies.stepTwo', ['id' => ':id']) }}";
    url = url.replace(':id', selectedEmployeeId);
    window.location.href = url;
  });
</script>
@endsection