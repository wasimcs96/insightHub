@extends('admin.layout.app')

@section('title', 'Talent Acquisition - Templates and Settings')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }
    </style>

    <style>
        h4 {
            color: #000;
            font-size: 22.75px;
            line-height: 27.3px;
        }

        .template-tab {
            margin-top: 30px;
            border-radius: 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .template-tab .left-side {
            display: flex;
            width: 180px;
            padding: 24px 0px;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            align-self: stretch;
            border-right: 1px solid #F1F1F4;
        }

        .template-top-text {
            color: #4B5675;
            font-size: 10px;
            line-height: 14px;
            padding-left: 16px;
            margin-bottom: 8px;
        }

        .template-tab .nav-pills .nav-link {
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            width: 100%;
            border-radius: 0;
            text-align: left;
            display: flex;
            align-content: center;
            gap: 10px;
        }

        .template-tab .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-right: 4px solid #F7941C;
            background: #FAFAFB;
            color: #071437;
        }

        .template-tab .tab-content {
            padding: 32px;
            flex: 1 0 0;
        }

        .custom-button {
            padding: 14px 20px;
            gap: 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .custom-button.btn-apply {
            background: #F7941C;
            color: #FFF;
            border: 0;
        }
    </style>

    <style>
        .custom-table-container {
            margin-top: 24px;
        }

        .custom-table-container .table th {
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .custom-table-container .table td {
            padding: 24px 16px;
            border-bottom: 1px solid #F1F1F4;
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .custom-table-container .action-icon {
            cursor: pointer;
            color: #4B5675;
        }

        .custom-table-container .table tr:nth-child(even) {
            padding: 24px 16px;
            background: #FAFAFB;
        }

        .table:not(.table-bordered) td:first-child,
        .table:not(.table-bordered) th:first-child,
        .table:not(.table-bordered) tr:first-child {
            padding-left: 16px;
        }

        .table:not(.table-bordered) td:last-child,
        .table:not(.table-bordered) th:last-child,
        .table:not(.table-bordered) tr:last-child {
            padding-right: 16px;
        }

        .filter-content button {
            flex: 1 0 0;
        }

        .delete-message {
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
            display: flex;
            border: 1px solid #FFC1BB;
            background: #FFE0DD;
            margin-bottom: 30px;
            display: none;
        }

        .delete-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .delete-message .icon {
            color: #78829D;
        }
    </style>


@endsection

@section('content')
    @php
        $page = request()->get('page');
    @endphp
    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100">
            <div id="deleteMessage" class="justify-content-between align-items-center delete-message">
                <p class="fw-medium m-0" id="deleteText">Full Time Employment has been deleted successfully.</p>
                <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>

            <h4 class="fw-medium m-0">Templates and Settings</h4>
            <div class="template-tab">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills left-side" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <p class="template-top-text fw-medium">TEMPLATE</p>
                        <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'employee-contract']) }}" class="nav-link @if($page == 'employee-contract') active @endif @if($page == '') active @endif"><iconify-icon
                                icon="qlementine-icons:file-text-16" width="18" height="18"></iconify-icon>
                            Employee Contract</a>
                        <!-- <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'email-template']) }}" class="nav-link @if($page == 'email-template') active @endif"  type="button" ><iconify-icon icon="ic:outline-email" width="18"
                                height="18"></iconify-icon> Email Template</a> -->
                        {{-- <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'email-template']) }}" class="nav-link @if($page == 'email-template') active @endif"  type="button" ><iconify-icon icon="ic:outline-email" width="18"
                                height="18"></iconify-icon> Email Template</a>
                        <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'company-overview']) }}" class="nav-link @if($page == 'company-overview') active @endif" ><iconify-icon icon="lucide:briefcase"
                                width="18" height="18"></iconify-icon> Company Overview</a> --}}
                        <a href="{{ route('admin.talent-acquisition.template-settings.index', ['page' => 'compensation-benefits']) }}" class="nav-link @if($page == 'compensation-benefits') active @endif"><iconify-icon
                                icon="lucide:briefcase" width="18" height="18"></iconify-icon> Compensation and
                            Benefits</a>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">                       
                        @switch($page)
                            @case('employee-contract')
                                <div class="tab-pane fade show active" id="employee-contract" role="tabpanel"
                                    aria-labelledby="employee-contract-tab" tabindex="0">
                                    @include('admin.talent-acquisition.template-settings.employee-contract.index')
                                </div>
                            @break

                            @case('email-template')
                                <div class="tab-pane fade show active" id="email-template" role="tabpanel" aria-labelledby="email-template-tab"
                                tabindex="0">
                                    @include('admin.talent-acquisition.template-settings.email-template.index')
                                </div>
                            @break

                            @case('company-overview')
                                <div class="tab-pane fade show active" id="company-overview" role="tabpanel"
                                   aria-labelledby="company-overview-tab" tabindex="0">
                                    @include('admin.talent-acquisition.template-settings.company-overview.index')
                                </div>
                            @break

                            @case('compensation-benefits')
                                <div class="tab-pane fade show active" id="compensation-and-benefits" role="tabpanel"
                                    aria-labelledby="compensation-and-benefits-tab" tabindex="0">
                                    @include('admin.talent-acquisition.template-settings.compensation-benefits.index')
                                </div>
                            @break

                            @default
                                <div class="tab-pane fade show active" id="employee-contract" role="tabpanel"
                                    aria-labelledby="employee-contract-tab" tabindex="0">
                                    @include('admin.talent-acquisition.template-settings.employee-contract.index')
                                </div>
                        @endswitch 
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('scripts')

    <script>
        document.querySelectorAll(".confirmDelete").forEach(button => {
            button.addEventListener("click", function() {
                // Hide the corresponding modal
                let modalId = this.getAttribute("data-modal-id"); // Get the modal ID
                let modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.hide();

                // Get the item name from the button attribute
                let itemName = this.getAttribute("data-item-name") || "Item"; // Default fallback

                // Update feedback text
                document.getElementById("deleteText").textContent =
                    `${itemName} has been deleted successfully.`;

                // Show feedback message
                document.getElementById("deleteMessage").style.display = "flex";
            });
        });

        // Close feedback message when clicking the close icon
        document.getElementById("closeIcon").addEventListener("click", function() {
            document.getElementById("deleteMessage").remove(); // Remove the feedback message
        });
    </script>

@endsection
