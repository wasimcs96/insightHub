<div class="elements-chart-organization d-flex align-items-center gap-1">
            <button class="show-details-btn" id="showDetailsBtn" type="button">
                <iconify-icon icon="line-md:chevron-double-right" width="18" height="18"></iconify-icon> Show Details
            </button>
        </div>
<div id="detailsPanel">
    
</div>
{{-- @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showBtn = document.getElementById('showDetailsBtn');
            const detailsPanel = document.getElementById('detailsPanel');
            const collapseBtn = document.getElementById('collapseBtn');

            // REVERSED INITIAL STATE
            showBtn.style.display = 'flex';
            // detailsPanel.style.display = 'none';

            showBtn.addEventListener('click', () => {
                showBtn.style.display = 'none';
                detailsPanel.style.display = 'flex';
            });

            collapseBtn.addEventListener('click', () => {
                detailsPanel.style.display = 'none';
                showBtn.style.display = 'flex';
            });
        });
    </script>
@endpush --}}
