@extends('insighthub.layout.app')

@section('title', $title ?? 'InsightHub Subsidiaries')

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

        .custom-btn {
            display: flex;
            height: 48px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }
    </style>
@endsection

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header mb-15">
                <h4 class="top-heading m-0">Subsidiaries</h4>
                <p class="custom-text-muted m-0">Discover tools that streamline efficiency, manage talent, and support
                    smarter decisions.</p>
            </div>
            <div class="row justify-content-center gap-5">
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Aboitiz-Power.png" alt="Aboitiz">
                    <p class="m-0">
                        A leader in the Philippine energy sector, providing reliable and sustainable power solutions.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                        Login as Aboitiz Power
                    </button>
                </div>
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/union-bank.png" alt="Aboitiz">
                    <p class="m-0">
                        A trailblazer in digital banking, offering innovative financial services to Filipinos.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                        Login as Union Bank
                    </button>
                </div>
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/Aboitiz-foods.png" alt="Aboitiz">
                    <p class="m-0">
                        A key player in the food and agribusiness industry, from farm to table.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                       Login as Aboitiz Foods
                    </button>
                </div>
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/aboitiz-info-capitial.png" alt="Aboitiz">
                    <p class="m-0">
                        Developing smart and sustainable infrastructure to drive economic growth.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                        Login as Aboitiz Infra Capital
                    </button>
                </div>
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/aboitiz-land.png" alt="Aboitiz">
                    <p class="m-0">
                        Creating better ways to live through innovative and thriving real estate developments.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                        Login as Aboitiz Land
                    </button>
                </div>
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/aboitiz-construction.png" alt="Aboitiz">
                    <p class="m-0">
                        A trusted partner in delivering high-quality engineering and construction projects.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                        Login as Aboitiz Construction
                    </button>
                </div>
                <div class="hub-module text-center p-4">
                    <img src="/insightHub/media/ADI.png" alt="Aboitiz">
                    <p class="m-0">
                        Driving the AI-powered future of the Group to create business value and sustainable impact.
                    </p>
                    <button class="custom-btn orange-fill w-100">
                        Login as Aboitiz Data Innovation
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
