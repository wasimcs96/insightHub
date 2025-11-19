    <style>
        .top-heading {
            color: #2E2F38;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .page-header {
            margin: 48px 0px;
        }

        .custom-text-muted {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .settings-tabs {
            border-bottom: 1px solid #DBDFE9;
        }

        .settings-tabs .nav-link {
            display: flex;
            padding: 16px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #99A1B7;
            font-size: 14px;
            font-weight: 600;
            line-height: 18px;
            position: relative;
            top: 1px;
        }

        .settings-tabs .nav-link.active {
            color: #F7941C;
            border-bottom: 1px solid #F7941C;
            background: none;
        }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container">
            <div class="page-header">
                <h4 class="top-heading m-0">General Settings</h4>
                <p class="custom-text-muted m-0">Manage your system’s core preferences and configurations.</p>
            </div>
            <!-- ✅ Tabs Navigation -->
            <ul class="nav settings-tabs mb-8" id="settingsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('company-profile.index*') ? 'active' : '' }}" 
                       href="{{ route('company-profile.index') }}" role="tab">Company Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('insighthub.settings.company-values.index*') ? 'active' : '' }}" 
                       href="{{ route('insighthub.settings.company-values.index') }}" role="tab">Company Values</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('organization-structure.*') ? 'active' : '' }}" 
                       href="{{ route('organization-structure.business-units') }}" role="tab">Organization Structure</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('insighthub.settings.email-templates*') ? 'active' : '' }}" 
                       href="{{ route('insighthub.settings.email-templates.index') }}" role="tab">Email Templates</a>
                </li>
            </ul>
        </div>
    </div>
