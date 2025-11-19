@extends('insighthub.layout.app')

@section('title', 'InsightHub Dashboard')

@section('styles')
    <style>
        .top-heading {
            color: #2E2F38;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .custom-text-muted {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .hub-module {
            display: flex;
            width: 410.667px;
            padding: 24px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;
            border-radius: 8px;
            border: 1px solid #C8CFD9;
            background: #FFF;
        }

        .hub-module .icon-box {
            display: flex;
            width: 70px;
            height: 70px;
            padding: 8px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            background: #F7941C;
            color: #FFF;
        }

        .hub-module:hover {
            border: 1px solid #F7941C;
        }

        .hub-module h5 {
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
        }

        .hub-module p {
            color: #727790;
            font-size: 14px;
            font-weight: 400;
        }

        .hub-module:hover h5,
        .hub-module:hover p {
            color: #F7941C;
        }
    </style>
@endsection

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header mb-15">
                <h4 class="top-heading m-0">Hub Center</h4>
                <p class="custom-text-muted m-0">Discover tools that streamline efficiency, manage talent, and support
                    smarter decisions.</p>
            </div>
            <div class="row justify-content-center gap-5">
                
                @can('insighthub.hubcenter.talentcore.view')
               
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/TalentCore.png" alt="TalentCore">
                    <h5 class="m-0">TalentCore</h5>
                    <p class="m-0">
                        Manage employee profiles, skills, and core HR data.
                    </p>
                </div>
                @endcan

                @can('insighthub.hubcenter.balancescorecard.view')

                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Balance-Scorecard.png" alt="Balance Scorecard">
                    <h5 class="m-0">Balance Scorecard</h5>
                    <p class="m-0">
                        Track strategic performance and organizational goals.
                    </p>
                </div>
                @endcan
                @can('insighthub.hubcenter.performancemanagement.view')
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Performance-Management.png" alt="Performance Management">
                    <h5 class="m-0">Performance Management</h5>
                    <p class="m-0">
                        Conduct reviews, set goals, and manage performance.
                    </p>
                </div>
                @endcan
                @can('insighthub.hubcenter.successionplanning.view')
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Succession-Planning.png" alt="Succession Planning">
                    <h5 class="m-0">Succession Planning</h5>
                    <p class="m-0">
                        Identify and develop future leaders for key roles.
                    </p>
                </div>
                @endcan
                @can('insighthub.hubcenter.taskmanagement.view')
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Task-Management.png" alt="Task Management">
                    <h5 class="m-0">Task Management</h5>
                    <p class="m-0">
                        Assign, track, and manage tasks across your teams.
                    </p>
                </div>
                @endcan
                @can('insighthub.hubcenter.surveymanagement.view')
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Survey-Management.png" alt="Survey Management">
                    <h5 class="m-0">Survey Management</h5>
                    <p class="m-0">
                        Design, distribute, and track surveys.
                    </p>
                </div>
                @endcan
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            console.log('InsightHub Hub Center loaded');

            // Add click functionality to modules
            $('.hub-module').on('click', function(e) {
                e.preventDefault();
                console.log('Card clicked!'); // Debug log

                const moduleTitle = $(this).find('h5').text().trim();
                console.log('Module title:', moduleTitle); // Debug log

                // Add your navigation logic here based on module
                switch (moduleTitle) {
                    case 'TalentCore':
                        // Navigate to TalentCore section
                        console.log('Navigate to TalentCore');
                        alert('TalentCore clicked!'); // Visual confirmation
                        break;
                    case 'Balance Scorecard':
                        // Navigate to Balance Scorecard
                        console.log('Navigate to Balance Scorecard');
                        alert('Balance Scorecard clicked!'); // Visual confirmation
                        break;
                    case 'Performance Management':
                        // Navigate to Performance Management
                        console.log('Navigate to Performance Management');
                        alert('Performance Management clicked!'); // Visual confirmation
                        break;
                    case 'Succession Planning':
                        // Navigate to Succession Planning
                        console.log('Navigate to Succession Planning');
                        alert('Succession Planning clicked!'); // Visual confirmation
                        break;
                    case 'Task Management':
                        // Navigate to Task Management
                        console.log('Navigate to Task Management');
                        alert('Task Management clicked!'); // Visual confirmation
                        break;
                    case 'Survey Management':
                        // Navigate to Survey Management
                        console.log('Navigate to Survey Management');
                        alert('Survey Management clicked!'); // Visual confirmation
                        break;
                    default:
                        console.log('Unknown module:', moduleTitle);
                        alert('Unknown module clicked: ' + moduleTitle);
                }
            });

            // Add pulse animation to connection lines
            setInterval(function() {
                $('.connection-line').each(function() {
                    $(this).fadeOut(500).fadeIn(500);
                });
            }, 3000);
        });
    </script>
@endsection
