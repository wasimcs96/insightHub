@foreach ($jobOpenings as $data)
    <div class="job-card">
        <div class="job-header">
            <h6>{{ $data->job_title ?? '' }} @auth @php  $bookmarkedJobs = auth()->user() ? auth()->user()->jobBookmarks->pluck('job_id')->toArray() : []; @endphp <iconify-icon
                        class="bookmark-icon-{{ $data->id ?? '' }} bookmark-btn" data-job-id="{{ $data->id ?? '' }}"
                        icon="{{ in_array($data->id, $bookmarkedJobs) ? 'twemoji:star' : 'line-md:star' }}" width="24"
                    height="24"></iconify-icon>@endauth
            </h6>
            <div class="d-flex align-items-center gap-3">
                <p class="d-flex align-items-center gap-2 m-0">
                    <iconify-icon icon="mdi:clock-outline" width="16" height="16"></iconify-icon>
                    {{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y') }}
                </p>
                <p class="d-flex align-items-center gap-2 m-0">
                    @if ($data->city && $data->country)
                        <iconify-icon icon="akar-icons:location" width="16" height="16"></iconify-icon>
                    @endif
                    {{ $data->city->name ?? '' }}
                    @if ($data->city && $data->country)
                        ,
                    @endif
                    {{ $data->country->name ?? '' }}
                </p>
            </div>
        </div>
        <div class="job-body">
            <p>{{ $data->job_position->description ?? '' }}</p>
            <div class="d-flex justify-content-between gap-3">
                <a class="custom-button btn-grey-outline w-100" href="/job-details/{{ $data->slug ?? '' }}">More
                    info</a>
                <button class="custom-button btn-orange-fill w-100 fw-bold" data-bs-toggle="modal"
                    data-bs-target="#viewJobModel" onclick="loadJobDetails({{ $data->id }})">Apply Now</button>

            </div>
        </div>
    </div>
@endforeach

@push('style')
    <style>
        .job-openings .job-card {
            background-color: #fff;
            height: fit-content;
        }

        .job-openings .job-card .job-header {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
        }

        .job-openings .job-card .job-body {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
        }

        .job-openings .job-card .job-body .custom-button {
            font-size: 14px;
        }

        .job-openings .job-card .job-header h6 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }

        .job-openings .job-card .job-header p {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
        }

        .job-openings .job-card .job-body p {
            overflow: hidden;
            color: #99A1B7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin-bottom: 16px;
        }
    </style>
@endpush
@push('script')
    <script></script>
@endpush
