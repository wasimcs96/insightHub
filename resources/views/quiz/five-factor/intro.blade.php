@extends('quiz.layout.app')
@section('styles')

    <style>
        /* General Styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100%;
            overflow-x: hidden;
            background-color: white;
        }
        /* Main Content Styles */
        .content-container {
            width: 100vw; 
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            color: white;
            background-color: #f8f9fa;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Background Overlay for Container 1 */
        .container-1 {
            background-image: url('{{ asset('media/assessment/creative_writing_journal_900x.webp') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .container-1::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }
        .container-1 h2, .container-1 h1, .container-1 .take-test-btn {
            position: relative;
            z-index: 2; /* Ensure content is above the overlay */
        }
        .container-1 h2 {
            font-size: 32px;
            margin-bottom: 15px;
            padding-bottom: 20px;
            font-weight: 400;
            color: white;
        }
        .container-1 h1 {
            font-size: 42px;
            font-weight: bold;
            margin: 10px 0;
            line-height: 1.2;
            color: white;
            padding-bottom: 20px;
        }
        .container-1 .take-test-btn {
            padding: 15px 30px;
            font-size: 20px;
            background-color: #F6931D;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }
        .container-1 .take-test-btn:hover {
            background-color: #c78b0a;
            transform: translateY(-3px);
        }

        /* Container 2 Styles */
        .container-2 {
            background-color: rgb(255, 255, 255);
            padding: 0px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 100px;
        }
        .container-2 .content-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 80%;
            height: 80%;
            gap: 20px;
            margin-top: 50px; /* Remove margin to ensure no space */
        }
        .container-2 .content-item {
            flex: 1 1 calc(25% - 20px); /* 4 items per row, with gap adjustment */
            background-size: cover;
            background-position: center;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end; 
            margin-bottom: 50px;
        }
        .container-2 .content-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay for text visibility */
            z-index: 1;
        }
        .container-2 .content-item * {
            position: relative;
            z-index: 2; /* Ensure content is above the overlay */
            align-items: left;
        }
        .container-2 .content-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }
        .container-2 .content-item i {
            font-size: 3rem;
            color: white;
            margin-bottom: 10px;
            text-align: left;
        }
        .container-2 .content-item h3 {
            margin: 10px 0;
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-align: left;
        }
        .container-2 .content-item p {
            margin: 0;
            font-size: 16px;
            text-align: left;
            margin-bottom: 30px;
        }

        /* Button Container 2 Styles */
        .container-2 .take-test-btn {
            padding: 15px 30px;
            font-size: 20px;
            background-color: #F6931D;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .container-2 .take-test-btn:hover {
            background-color: #c78b0a;
            transform: translateY(-3px);
        }
        .modal-dialog.modal-fullscreen {
            margin: 0;
            height: 100vh;
        }

        .modal-content {
            border: none;
            border-radius: 0;
        }

        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            background-color: #212121;
        }

        .box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.201);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .box h1 {
            color: darkorange;
            font-weight: bold;
            font-size: 36px;
            margin-bottom: 30px;
        }
        .box h4 {
            color: black;
            font-weight: 400;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .box b {
            color: darkorange;
        }
        .box button {
            background-color: darkorange;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            padding: 15px 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .box button:hover {
            background-color: #e07b00;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container-2 .content-item {
                flex: 1 1 calc(33.333% - 20px); /* 3 items per row */
            }
        }

        @media (max-width: 768px) {
            .container-2 .content-item {
                flex: 1 1 calc(50% - 20px); /* 2 items per row */
            }
        }

        @media (max-width: 480px) {
            .container-2 .content-item {
                flex: 1 1 100%; /* 1 item per row */
            }
        }
        /* Modal Close Button Styles */
        .modal-header {
            border-bottom: none;
            background-color: none; 
            position: relative;
        }
        .btn-close {
            background-color: transparent;
            border: none;
            color:rgba(0, 0, 0, 0.5);
            font-size: 2rem; 
            opacity: 1;
            position: absolute; 
            top: 10px; 
            right: 10px; 
            cursor: pointer; 
            transition: opacity 0.2s ease;
            opacity: 0.8; 
        }
        .btn-close:hover {
            opacity: 1;
        }
    </style>
@endsection

    <!-- Main Content Section -->
    @section('content')

    <main>
        <div class="content-container container-1">
            <h2>CXS Personality and Motivation Assessment</h2>
            <h1>The Five Factor Personality test is<br> used globally to enhance self-awareness<br>and personal development</h1>
            <button class="take-test-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_2">Take the Test</button>
        </div>

        <div class="content-container container-2">
            <div class="content-row">
                <div class="content-item" style="background-image: url('{{ asset('media/assessment/pen-and-paper.webp') }}');">
                    <i class="fas fa-check-square"></i>
                    <h3>Complete Your Assessment</h3>
                    <p>To find out your level of personality and motivation.</p>
                </div>
                <div class="content-item" style="background-image: url('{{ asset('media/assessment/get-result.webp') }}');">
                    <i class="fas fa-edit"></i>
                    <h3>Get Your Result</h3>
                    <p>Discover your level of personality and motivation.</p>
                </div>
                <div class="content-item" style="background-image: url('{{ asset('media/assessment/next-step.jpg') }}');">
                    <i class="fas fa-chart-line"></i>
                    <h3>Your Next Steps</h3>
                    <p>Access feedback on how to improve your level of personality and motivation.</p>
                </div>
                <div class="content-item" style="background-image: url('{{ asset('media/assessment/fill-gap.jpg') }}');">
                    <i class="fas fa-thumbs-up"></i>
                    <h3>Fill Your Gap</h3>
                    <p>Access quality content to boost your performance.</p>
                </div>
            </div>
            <button class="take-test-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_2">Take the Test</button>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="kt_modal_2" tabindex="-1" aria-labelledby="kt_modal_2_label" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen d-flex justify-content-center align-items-center">
            <div class="modal-content" style="background-color: #212121; color: white;">
                <div class="modal-body d-flex justify-content-center align-items-center" style="height: 100vh; margin: 0;">
                    <div class="box">
                        <div class="modal-header" style="font-size: 50%; background-color: transparent; border: none;">
                            <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <h1>Welcome to the Personality<br>and Motivation Test</h1>
                        <h4>Take your time to read each statement.<br> Indicate which statement describes you most by using<br>one of the five options.<br>Relax, be honest, go with the answer that feels right for<br>you and remember, there are no wrong answers!</h4>
                        <h4>There is no timer for this test, but it should take you<br> around 15 minutes to complete.</h4>
                        <a href="/quiz/{{ $quiz->name }}">
                            <button class="take-test-btn">Take the Test</button>  
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
