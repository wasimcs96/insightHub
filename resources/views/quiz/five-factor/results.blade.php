@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('apexcharts/dist/apexcharts.css') }}" />
    <style>
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
        .backdashboard-btn{
            background-color: #F6931D;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            padding: 15px 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-style: bold;
            width: 373px;
        }
        .backdashboard-btn button:hover {
            background-color: #F6931D;
        }
        .container h1{
            font-family: sans-serif;
            font-size: 40px;
            color: #F6931D;
            font-weight: bold;
        }
        .container p{
            font-family: sans-serif;
            font-size: 20px;
            color: #807E7E;
            font-weight: 400;
            margin-bottom: 50px;
        }
        .container h2{
            font-family: sans-serif;
            font-size: 38px;
            color: #807E7E;
            font-weight: 500;
            margin-bottom: 30px;
        }
        .progress-bar .status {
            background-color: #F6931D !important;
        }

        @media only screen and (min-width: 350px) and (max-width: 681px) {
            .backdashboard-btn {
                width: fit-content;
                padding: 10px 30px;
            }
            .container h1 {
                font-size: 32px;
            }

            .container p {
                margin-bottom: 20px;
            }

            .container h2 {
                font-size: 28px;
            }
        }
    </style>
@endsection

@section('app')

<div class="w-100 bg-white-gradient py-5 border-radius-50 text-center p-4">
    <div class="container p-0 md-p-4" style="margin-top: 50px;">
        <h1>Well Done!</h1>
        <p>for completing your Personality & Motivation test</p>
        <h2>Your Personality & Motivations are</h2>
    </div>

    <div class="container p-0 md-py-4" style="text-align: left;" id="results">
        @foreach($questions['domains'] as $domain)
            @foreach($domain['values'] as $value)
                @php
                    $totalScore = $value["answers_sum_answer"] * 100 / 120;
                @endphp
                @include('quiz.five-factor.'.strtolower(str_replace(' ','-',$value['title'])).'.'.($totalScore <= 25 ? 'low' : ($totalScore> 25 && $totalScore <= 76 ? 'moderate' : 'high' )),['questions'=> $questions, 'title' => $value['title']])
            @endforeach
        @endforeach
    </div>

    <a href="/dashboard">
        <button class="backdashboard-btn" style="margin-bottom: 100px;">Back to Dashboard</button>
    </a>
</div>
@endsection
