@php
use App\Models\MasterGeneralSetting;

$year = MasterGeneralSetting::where('name', 'year')->first();
$version = MasterGeneralSetting::where('name', 'version')->first();
@endphp
     <!--begin::Footer-->
     <div id="kt_app_footer" class="app-footer ">
        <!--begin::Footer container-->
        <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">

            <!--begin::Copyright-->
            <div class="text-gray-900 order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">&copy; {{ $year ? $year->value : date('Y') }}</span>
                <a href="https://cxsanalytics.com/" target="_blank" class="text-gray-800 text-hover-primary">
                    CXS Analytics
                </a>
            </div>
            <!--end::Copyright-->
        
            <!--begin::Version-->
            <div class="text-gray-900 order-1 order-md-2">
                <span class="text-muted fw-semibold">Version: {{ $version ? $version->value : '1.0.0' }}</span>
            </div>
            <!--end::Version-->
        
        </div>
        
        <!--end::Footer container-->
    </div>
    <!--end::Footer-->
