@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('styles')
<!-- Add any additional styles here -->
@endsection

@section('content')

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
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
                        @endif
                    </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Dashboard
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<form action="{{ route('contracts.sign', $contract->id) }}" method="POST">
    @csrf
    <h2>Contract Details</h2>
    <p>{{ $contract->contract_details }}</p>
    
    <label for="signature">Signature:</label>
    <div>
        <canvas id="signature-pad" width="400" height="200" style="border:1px solid #000;"></canvas>
    </div>
    <button type="button" id="clear-signature">Clear</button>
    <input type="hidden" name="signature" id="signature">

    <button type="submit">Sign Contract</button>
</form>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.0.0/signature_pad.umd.min.js"></script>
<script src="{{ asset('signature-pad/js/signature_pad.umd.min.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);
        var clearButton = document.getElementById('clear-signature');
        var signatureInput = document.getElementById('signature');

        clearButton.addEventListener('click', function () {
            signaturePad.clear();
        });

        document.querySelector('form').addEventListener('submit', function (event) {
            if (signaturePad.isEmpty()) {
                alert('Please provide a signature first.');
                event.preventDefault();
            } else {
                signatureInput.value = signaturePad.toDataURL();
            }
        });
    });
</script>
@endsection
