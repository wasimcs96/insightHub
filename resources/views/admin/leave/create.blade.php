@extends('admin.layout.app')

@section('title', 'Create Leave')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                Create Leave
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('leave.index') }}" class="text-muted text-hover-primary">Leave</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Name Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Days Per Year Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Days Per Year</label>
                            <input type="number" name="days_per_year" id="daysPerYearInput" class="form-control form-control-solid @error('days_per_year') is-invalid @enderror" placeholder="Enter Days Per Year" required>
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" value="1" name="depend_on_job" id="flexCheckDefault" onclick="toggleInput()" />
                                <label class="form-check-label" for="flexCheckDefault">
                                   Depend on Job
                                </label>
                            </div>
                            @error('days_per_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Entitlement Field -->
                        {{-- <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Entitlement</label>
                            <textarea name="entitlement" class="form-control form-control-solid @error('entitlement') is-invalid @enderror" placeholder="Enter Entitlement"></textarea>
                            @error('entitlement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <!-- Eligibility Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Eligibility</label>
                            <select name="eligibility" class="form-control form-control-solid @error('eligibility') is-invalid @enderror">
                                <option value="A">All Employee</option>
                                <option value="M">Male Employee</option>
                                <option value="F">Female Employee</option>
                            </select>
                            @error('eligibility')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Purpose Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Purpose</label>
                            <textarea name="purpose" class="form-control form-control-solid @error('purpose') is-invalid @enderror" placeholder="Enter Purpose"></textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cumulative Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Cumulative</label>
                            <select name="cumulative" class="form-control form-control-solid @error('cumulative') is-invalid @enderror">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('cumulative')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function toggleInput() {
    const checkBox = document.getElementById('flexCheckDefault');
    const inputField = document.getElementById('daysPerYearInput');

    if (checkBox.checked) {
        inputField.disabled = true; // Disable the input
        inputField.value = ''; // Optionally clear the value if needed
    } else {
        inputField.disabled = false; // Enable the input
    }
}

</script>
@endsection
