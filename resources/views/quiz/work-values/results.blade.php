@extends('layout.app')

@section('app')

<div class="w-100 bg-purple-gradient py-5 border-radius-50 text-center">

    <h1 class="color-white fs-7-rem fw-600">{{__("Well Done!")}}</h1>

    <p class="color-white fs-1-1 fw-600">{{__("for completing your Work Values inventory")}}</p>

</div>

<div class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h1 class="purple-gradient-text fw-600 fs-3-rem mb-5">{{__("Your Work Values are")}}</h1>

            <a href="#results" class="btn btn-gradient shadow rounded-custom px-5 fs-1-2 mb-3 fw-600 text-white">{{__("Find out now")}}</a>

        </div>

        <div class="row">

            <div class="col-12 col-lg-4 mb-4 mb-lg-0 ms-auto">

                <div class="border-radius-20 bg-white overflow-hidden min-h-100">

                    <img src="/images/work-values-test-2.jpg" class="w-100">

                    <div class="p-3">

                        <p class="color-purple fw-700 fs-1-1">{{__("Get your results")}}</p>

                        <p class="fw-600 color-dark-gray mb-5">{{__("These charts indicate which of the 18 values are of high, moderate and low importance for you.")}}</p>

                    </div>

                </div>

            </div>

            <div class="col-12 col-lg-1">


            </div>

            <div class="col-12 col-lg-4 me-auto">

                <div class="border-radius-20 bg-white overflow-hidden min-h-100">

                    <img src="/images/work-values-test-1.jpg" class="w-100">

                    <div class="p-3">

                        <p class="color-purple fw-700 fs-1-1">{{__("Your next steps")}}</p>

                        <p class="fw-600 color-dark-gray mb-5">{{__("Under learn more discover feedback on what each value means and how it impacts your career plan.")}}</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="container py-5" id="results">

    <work-values-chart class="mb-5" :data='@json($questions)' type='first'></work-values-chart>

    @php

    $noHighEntries = true;

    @endphp

    @foreach($questions['domains'] as $domain)

    @foreach($domain['values'] as $key => $value)

    @if($value['answers_sum_answer'] >= $value['value_answer_valuation']['high'][0])

    @php

    $noHighEntries = false;

    break;

    @endphp

    @endif

    @endforeach

    @endforeach



    @if(!$noHighEntries)

    <div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

        <div class="mb-4">

            <h2 class="text-black mb-0">{{__("Work Values of High Importance to You")}}</h2>

        </div>


        @foreach($questions['domains'] as $domain)

        @foreach($domain['values'] as $key => $value)

        @if($value['answers_sum_answer'] >= $value['value_answer_valuation']['high'][0])

        <div class="border-bottom mb-3">

            <div class="d-flex justify-content-between align-items-center ">

                <div class="d-flex align-items-center justify-content-start">

                    <img src="/images/{{ $questions['name'] }}/{{ $domain['title'] }}/visual-wv-{{ strtolower(str_replace(' ', '-', $value['title'])) }}.svg" class="d-block me-3 mb-3" width="70">

                    <div class="text-muted fs-1-rem">{{__ ($value['title']) }}</div>

                </div>



                <a href="JavaScript:;" @click="collapse('custom-collapse{{ $value['id'] }}');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-work btn-gradient rounded-custom px-5 text-white mb-3">{{__("Learn More")}}</a>

            </div>

            <div class="custom-collapse mb-3" id="custom-collapse{{ $value['id'] }}">

                {!! __($value['value_answer_valuation']['highSentence']) !!}

            </div>

        </div>

        @endif

        @endforeach

        @endforeach

    </div>

    @endif


    @php

    $noModerateEntries = true;

    @endphp

    @foreach($questions['domains'] as $domain)

    @foreach($domain['values'] as $key => $value)

    @if($value['answers_sum_answer'] >= $value['value_answer_valuation']['moderate'][0] && $value['answers_sum_answer'] <= $value['value_answer_valuation']['moderate'][1]) @php $noModerateEntries=false; break; @endphp @endif @endforeach @endforeach @if(!$noModerateEntries) <div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

        <div class="mb-4">

            <h2 class="text-black mb-0">{{__("Work Values of Moderate Importance to You")}}</h2>

        </div>


        @foreach($questions['domains'] as $domain)

        @foreach($domain['values'] as $key => $value)

        @if($value['answers_sum_answer'] >= $value['value_answer_valuation']['moderate'][0] && $value['answers_sum_answer'] <= $value['value_answer_valuation']['moderate'][1]) <div class="border-bottom mb-3">

            <div class="d-flex justify-content-between align-items-center ">

                <div class="d-flex align-items-center justify-content-start">

                    <img src="/images/{{ $questions['name'] }}/{{ $domain['title'] }}/visual-wv-{{ strtolower(str_replace(' ', '-', $value['title'])) }}.svg" class="d-block me-3 mb-3" width="70">

                    <div class="text-muted fs-1-rem">{{__ ($value['title']) }}</div>

                </div>

                <a href="JavaScript:;" @click="collapse('custom-collapse{{ $value['id'] }}');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-work btn-gradient rounded-custom px-5 text-white mb-3">{{__("Learn More")}}</a>

            </div>

            <div class="custom-collapse mb-3" id="custom-collapse{{ $value['id'] }}">

                {!! __($value['value_answer_valuation']['moderateSentence']) !!}

            </div>

</div>

@endif

@endforeach

@endforeach

</div>

@endif

@php

$noLowEntries = true;

@endphp

@foreach($questions['domains'] as $domain)

@foreach($domain['values'] as $key => $value)

@if($value['answers_sum_answer'] >= $value['value_answer_valuation']['low'][0] && $value['answers_sum_answer'] <= $value['value_answer_valuation']['low'][1]) @php $noLowEntries=false; break; @endphp @endif @endforeach @endforeach @if(!$noLowEntries) <div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        <h2 class="text-black mb-0">{{__("Work Values of Low Importance to You")}}</h2>

    </div>


    @foreach($questions['domains'] as $domain)

    @foreach($domain['values'] as $key => $value)

    @if($value['answers_sum_answer'] >= $value['value_answer_valuation']['low'][0] && $value['answers_sum_answer'] <= $value['value_answer_valuation']['low'][1]) <div class="border-bottom mb-3">

        <div class="d-flex justify-content-between align-items-center ">

            <div class="d-flex align-items-center justify-content-start">

                <img src="/images/{{ $questions['name'] }}/{{ $domain['title'] }}/visual-wv-{{ strtolower(str_replace(' ', '-', $value['title'])) }}.svg" class="d-block me-3 mb-3" width="70">

                <div class="text-muted fs-1-rem">{{ __($value['title']) }}</div>

            </div>

            <a href="JavaScript:;" @click="collapse('custom-collapse{{ $value['id'] }}');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-work btn-gradient rounded-custom px-5 text-white mb-3">{{__("Learn More")}}</a>

        </div>

        <div class="custom-collapse mb-3" id="custom-collapse{{ $value['id'] }}">

            {!! __($value['value_answer_valuation']['lowSentence']) !!}

        </div>

        </div>

        @endif

        @endforeach

        @endforeach

        </div>

        @endif

        <div class="mb-5">

            <work-values-chart class="mb-5" :data='@json($questions)' type='second'></work-values-chart>

        </div>

        <div class="pt-5 align-content-center">

            <work-values-spider-chart style="width:100%;height: 700px;display: block; margin:auto;box-sizing: border-box;overflow: visible;" class="mb-5 p-5" :data='@json($questions)' type='first'></work-values-spider-chart>



        </div>


        </div>

        <div class="w-100 bg-purple-gradient py-5 text-center">

            <div class="container py-lg-5">

                <div class="row align-items-center mb-4">

                    <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

                        <h1 class="color-white fs-3-rem fw-700">{{__("Congratulations!")}}</h1>

                        <h4 class="color-white fw-600 mb-4">{{__("On completing the Work Values test.")}}</h4>

                        <p class="color-white fs-1-1 mb-5">{{__("Now that you now know the Work Values that are important for you, bear these in mind in planning for future careers as well as looking for your first job.")}}</p>

                        <a href="{{ config('app.remote_base_url') }}" class="btn btn-white shadow rounded-custom px-5 fs-1-2 mb-3 fw-600">{{__("Finish")}}</a>


                    </div>

                    <div class="col-12 col-lg-6">

                        <img src="/images/after-results.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

                    </div>

                </div>

            </div>

        </div>


        @endsection
