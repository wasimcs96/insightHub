<section class="bg-white w-100 applicants-main-div">
    <div class="hiring-tabs-div">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active bg-white rounded-0 d-flex gap-2" id="hiring-applied-tab"
                    data-bs-toggle="pill" data-bs-target="#hiring-applied" type="button" role="tab"
                    aria-controls="hiring-applied" aria-selected="true">Applied 
                    <span class="applicants-number">1</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link bg-white rounded-0 d-flex gap-2" id="hiring-assessment-tab"
                    data-bs-toggle="pill" data-bs-target="#hiring-assessment" type="button" role="tab"
                    aria-controls="hiring-assessment" aria-selected="false">Assessment <span
                        class="applicants-number">1</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link bg-white rounded-0 d-flex gap-2" id="hiring-shortlisted-tab"
                    data-bs-toggle="pill" data-bs-target="#hiring-shortlisted" type="button" role="tab"
                    aria-controls="hiring-shortlisted" aria-selected="false">Shortlisted <span
                        class="applicants-number">1</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link bg-white rounded-0 d-flex gap-2" id="hiring-screening-interview-tab"
                    data-bs-toggle="pill" data-bs-target="#hiring-screening-interview" type="button" role="tab"
                    aria-controls="hiring-screening-interview" aria-selected="false">Screening Interview <span
                        class="applicants-number">1</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link bg-white rounded-0 d-flex gap-2" id="hiring-offer-stage-tab"
                    data-bs-toggle="pill" data-bs-target="#hiring-offer-stage" type="button" role="tab"
                    aria-controls="hiring-offer-stage" aria-selected="false">Offer Stage <span
                        class="applicants-number">1</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link bg-white rounded-0 d-flex gap-2" id="hiring-hired-stage-tab"
                    data-bs-toggle="pill" data-bs-target="#hiring-hired-stage" type="button" role="tab"
                    aria-controls="hiring-hired-stage" aria-selected="false">Hired<span
                        class="applicants-number">1</span></button>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="hiring-applied" role="tabpanel" aria-labelledby="hiring-applied-tab"
            tabindex="0">
            @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-applied.hiring-applied')
        </div>
        <div class="tab-pane fade" id="hiring-assessment" role="tabpanel" aria-labelledby="hiring-assessment-tab"
            tabindex="0">
            @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-assessment.hiring-assessment')
        </div>
        <div class="tab-pane fade" id="hiring-shortlisted" role="tabpanel" aria-labelledby="hiring-shortlisted-tab"
            tabindex="0">
            @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-shortlisted.hiring-shortlisted')
        </div>
        <div class="tab-pane fade" id="hiring-screening-interview" role="tabpanel"
            aria-labelledby="hiring-screening-interview-tab" tabindex="0">
            @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-screening-interview.hiring-screening-interview')
        </div>
        <div class="tab-pane fade" id="hiring-offer-stage" role="tabpanel"
            aria-labelledby="hiring-offer-stage-tab" tabindex="0">
            @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-offer-stage.hiring-offer-stage')
        </div>
        <div class="tab-pane fade" id="hiring-hired-stage" role="tabpanel"
            aria-labelledby="hiring-hired-stage-tab" tabindex="0">
            @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-hired-stage.hiring-hired-stage')
        </div>
        @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.table')
    </div>
</section>
