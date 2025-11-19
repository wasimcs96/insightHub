<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-conscientiousness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('CONSCIENTIOUSNESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Low Conscientiousness') }}</h5>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You are low in Conscientiousness, which means that you are more relaxed about your life and less interested in controlling and regulating your life and work. It does not mean you are not reliable or hardworking, but that you are less goal-orientated and are more motivated by enjoying your life in the present than reaching for future rewards.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these phrases describing Low Conscientiousness could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">
        <li>{{ __('Not driven to achieve') }}</li>
        <li>{{ __('Lack of focus') }}</li>
        <li>{{ __('Less observant of rules and boundaries') }}</li>
        <li>{{ __('Interesting to be around') }}</li>
        <li>{{ __('Relaxed') }}</li>
        <li>{{ __('Unmotivated at times') }}</li>
    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse13');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse13">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('living life in the present and avoiding stress.') }}</li>

            <li>{{ __('being spontaneous and engaging in what interests you personally') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Low Conscientiousness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to miss out on opportunities for employment and promotion.') }}</li>

            <li>{{ __('to cause you to fail to organise your life to achieve a desired goal, even though you have the skills and knowledge.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('If you have Low Conscientiousness, watch other people around you, who are more conscientious, for habits or behaviours that you could introduce into your life. This will help you improve your prospects for recruitment and promotion.') }}</li>

            <li>{{ __('Low Conscientiousness can be improved by taking a role that involves hard work and responsibility.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('People who are low in Conscientiousness can find careers where they can work at their own pace and to their own standards to be most satisfying and successful.') }}</div>


        </div>

    </div>

</div>
