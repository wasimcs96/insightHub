<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-conscientiousness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('CONSCIENTIOUSNESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('High - Focus') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You are high in Conscientiousness which means you are strong in controlling and regulating your life and work.') }}</div>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Conscientiousness could be true for you.') }}</div>



    </div>

    <ul class="text-muted mb-3">
        <li>{{ __('Dependability') }}</li>
        <li>{{ __('Hard working') }}</li>
        <li>{{ __('Self-efficacy') }}</li>
        <li>{{ __('Orderliness') }}</li>
        <li>{{ __('Dutifulness') }}</li>
        <li>{{ __('Diligent') }}</li>
        <li>{{ __('Ambition') }}</li>
        <li>{{ __('Striving for achievement') }}</li>
        <li>{{ __('Sacrificing gratification for a goal') }}</li>
        <li>{{ __('Self-discipline') }}</li>
        <li>{{ __('Persistence') }}</li>
    </ul>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You may not possess all these characteristics in equal measure, but most of them will describe you.') }}</div>


    </div>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse15');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse15">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('setting goals and striving to achieve them.') }}</li>

            <li>{{ __('organising yourself and others to achieve an objective.') }}</li>

            <li>{{ __('hard and challenging work.') }}</li>

            <li>{{ __('being considered reliable.') }}</li>

            <li>{{ __('a fast-paced environment.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your high Conscientiousness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to be prone to stress and driven to achieve unreachable goals.') }}</li>

            <li>{{ __('to place unrealistic demands on others around you, especially if they do not match your level of Conscientiousness.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Look for work that is challenging and allows you to aim for and achieve goals.') }}</li>

            <li>{{ __('Be conscientious about taking breaks from work to do things you enjoy for their own sake.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>



        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('High Conscientiousness is valued in most careers and by most employers and is a valuable trait for recruitment and promotion. It is a characteristic that is valued in senior management in organisations, as well as a key trait in entrepreneurs. You are more likely to be proactive in exploring career possibilities.') }}</div>


        </div>

    </div>

</div>
