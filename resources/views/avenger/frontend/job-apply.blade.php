@extends('avenger.layouts.app')
@section('title', env('APP_NAME') . ' | Home')

@section('styles')
    <style>
        .sign-up-success {
            background-color: #FCFCFC;
        }

        .sign-up-success .card-form h5 {
            color: #99A1B7;
            font-size: 16px;
            line-height: 24px;
        }

        .sign-up-success .card-form h3 {
            color: #4B5675;
            font-size: 22.75px;
            font-style: normal;
            line-height: 27.3px;
        }

        .card-form {
            padding: 48px;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            width: fit-content;
            margin: 150px auto;
        }

        .sign-up-success form label {
            color: #071437;
            font-size: 12px;
            line-height: 16px;
        }

        .sign-up-success form input,
        .sign-up-success form select {
            height: 40px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background-color: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }
    </style>
@endsection

@section('content')

    <div class="sign-up-success">
        {{-- {{ dd(session('success')) }} --}}

        <div class="card-form">
            <h5 class="fw-bolder text-center m-0">You are now applying for</h5>
            <h3 class="fw-bolder text-center my-1">{{ $jobOpening->job_title ?? '' }}</h3>
            <h5 class="mb-5 fw-normal text-center">Verify your role, and add salary expectations and resume</h5>
            {{-- {{ dd($jobOpening) }} --}}
            <form action="{{ route('job-apply-submit', [$jobOpening->slug]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="fs-5 fw-bold mb-3">Expected Salary</label>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <label for="salaryLower" class="fw-medium">Salary Lower Bound
                            ({{ $jobOpening->currency_short_name ? $jobOpening->currency_short_name : 'PHP' }})</label>
                        <input type="text" min="0" name="salary_lower_bound" required class="form-control"
                            id="salaryLower" placeholder="Salary Lower Bound">
                    </div>
                    <div class="col-md-6">
                        {{-- {{ dd( $jobOpening->currency_short_name) }} --}}
                        <label for="salaryUpper" class="fw-medium">Salary Upper Bound
                            ({{ $jobOpening->currency_short_name ? $jobOpening->currency_short_name : 'PHP' }})</label>
                        <input type="text" min="0" name="salary_upper_bound" class="form-control" id="salaryUpper"
                            placeholder="Salary Upper Bound">
                    </div>
                </div>

                <label class="fs-5 fw-bold mb-3 mt-3">Application Document(s)</label>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label for="resume" class="fw-medium">Resume  <span class="text-danger">*</span></label>
                        <input type="file" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="checkFileSize(this)" name="cv_resume"
                            class="form-control" id="resume" style="line-height: 38px;">
                        @if (auth()->check() && auth()->user()->cv_resume)
                            <a href="{{ asset(auth()->user()->cv_resume) }}" target="_blank">Uploaded CV / Resume</a>
                        @endif
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="coverLetter" class="fw-medium">Cover Letter  </label>
                        <input type="file" class="form-control" id="coverLetter" onchange="checkFileSize(this)"
                        accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" placeholder="Upload Cover Letter" name="cover_letter"
                            style="line-height: 38px;" >
                        @if (auth()->check())
                            @php
                                $jobapplication = App\Models\JobOpeningApplication::where(
                                    'job_opening_id',
                                    $jobOpening->id,
                                )
                                    ->where('user_id', auth()->user()->id)
                                    ->first();
                            @endphp


                            @if ($jobapplication && $jobapplication->cover_letter)
                                <a href="{{ asset($jobapplication->cover_letter) }}" target="_blank">Uploaded Cover
                                    Letter</a>
                            @endif
                        @endif
                    </div> --}}
                </div>

                <div class="row mb-5">


                    {{-- {{ dd($documents) }} --}}
                    @foreach ($documents as $document)
                        @php
                            // Handle document type (can be string or JSON array)
                            $types = is_array($document->type)
                                ? $document->type
                                : (json_decode($document->type, true) ?: [$document->type]);

                            // Flatten & sanitize accepted MIME types
                            $mimeMap = [
                                '.doc' =>
                                    'application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                '.pdf' => 'application/pdf',
                                '.png' => 'image/png',
                                '.jpg' => 'image/jpeg',
                                '.jpeg' => 'image/jpeg',
                            ];

                            $acceptedTypes = collect($types)
                                ->map(function ($type) use ($mimeMap) {
                                    return $mimeMap[$type] ?? '*';
                                })
                                ->implode(',');

                            // Normalize field name
                            $fieldName = strtolower(str_replace(' ', '_', $document->name));

                            // Retrieve uploaded file if available
                            $uploadedFile = $jobapplication->$fieldName ?? null;

                            // Check if this is a website link input
                            $isWebsiteLink = in_array('website-link', $types);
                        @endphp

                        <div class="col-md-6">
                            <label for="{{ $fieldName . '_' . $document->id }}" class="fw-medium">
                                {{ ucfirst(str_replace('_', ' ', $document->name)) }}
                                @if ($document->is_required)
                                    <span class="text-danger">*</span>
                                @endif
                                ({{ is_array($types) ? implode(', ', $types) : $types }})
                            </label>

                            @if ($isWebsiteLink)
                                <input type="url" class="form-control mb-5" name="url[{{ $document->id }}]"
                                    id="{{ $fieldName . '_' . $document->id }}" placeholder="Enter link"
                                    value="{{ $uploadedFile }}" @if ($document->is_required) required @endif>
                            @else
                                <input type="file" class="form-control mb-5" name="document[{{ $document->id }}]"
                                    id="{{ $fieldName . '_' . $document->id }}" accept="{{ $acceptedTypes }}"
                                    onchange="checkFileSize(this)" style="line-height: 35px;"
                                    @if ($document->is_required) required @endif>
                            @endif

                            @if ($uploadedFile)
                                <a href="{{ asset($uploadedFile) }}" target="_blank">View Uploaded
                                    {{ ucfirst($document->name) }}</a>
                            @endif
                        </div>
                    @endforeach

                </div>


                <div class="d-flex justify-content-end align-items-center gap-4">
                    <a href="{{ route('all-jobs') }}"><button type="button" class="custom-btn  btn-orange-outline">Back to
                            Careers</button></a>

                    <button type="submit" class="custom-btn  btn-orange-fill">Apply
                        Now</button>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
