<div id="kt_app_footer" class="app-footer bg-white" style="height: 128px;">
    <div class="container-xxl d-flex justify-content-between footer-text">
        <div class="d-flex align-items-end gap-2">
            <div class="d-flex flex-wrap justify-content-center">
                <a href="/" target="_blank" class="footer-item nav-link mx-2 text-decoration-none">Home</a>
                <span class="mx-2">|</span>
                <a href="/career" class="footer-item nav-link mx-2 text-decoration-none">Careers</a>
            </div>
        </div>
        <div class="d-flex align-items-end gap-2">
            <div class="d-flex flex-wrap justify-content-center">
                <a href="/terms-of-use" target="_blank" class="footer-item nav-link mx-2 text-decoration-none">Terms of
                    Use</a>
                <span class="mx-2">|</span>
                <a href="/privacy-policy" class="footer-item nav-link mx-2 text-decoration-none">Privacy Policy</a>
                <span class="mx-2">|</span>
                <a href="/cookie-notice" class="footer-item nav-link mx-2 text-decoration-none">Cookie Notice</a>
                <span class="mx-2">|</span>
                <a href="/accessibility-statement" class="footer-item nav-link mx-2 text-decoration-none">Accessibility
                    Statement</a>
                <span class="mx-2">|</span>
                <a href="/legal-information" class="footer-item nav-link mx-2 text-decoration-none">Legal
                    Information</a>
                <span class="mx-2">|</span>
            </div>
            @php
            use App\Models\MasterGeneralSetting;

            $year = MasterGeneralSetting::where('name', 'year')->first();
            @endphp
            <p>Powered by</p>
            <img alt="Logo" src="{{ asset('media/insightaccess.png') }}" class="logo-default responsive-logo "
                style="height: 20px" />
            <p>&copy; {{ $year ? $year->value : date('Y') }} CXS Analytics</p>
        </div>
    </div>
</div>
