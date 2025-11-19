<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-conscientiousness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('CONSCIENTIOUSNESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Moderate Conscientiousness') }}</h5>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You can adapt to being disciplined and achievement-orientated when this is required or when you are personally motivated towards a goal. You can also be more relaxed and work at a slower pace when it is appropriate.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases describing high and low Conscientiousness could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Dependability') }}</li>

        <li>{{ __('Hard working') }}</li>

        <li>{{ __('Self-efficacy') }}</li>

        <li>{{ __('Diligent') }}</li>

        <li>{{ __('Sacrificing gratification for a goal') }}</li>

        <li>{{ __('Self-discipline') }}</li>

        <li>{{ __('Persistence') }}</li>

        <li>{{ __('Focused') }}</li>

        <li>{{ __('Relaxed') }}</li>

        <li>{{ __('Interesting to be around') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse14');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse14">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('a wide range of work environments, provided you are able to balance high intensity work towards goals with less intense and goal-orientated work.') }}</li>

            <li>{{ __('a fast-paced environment if it is not sustained for long periods.') }}</li>

            <li>{{ __('interfacing between colleagues and staff who are high or low in Conscientiousness.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Moderate Conscientiousness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to lose motivation if you experience prolonged intensity in goal-orientated work.') }}</li>

            <li>{{ __('to vary in your focus depending on how much you are motivated by your work.') }}</li>

            <li>{{ __('to limit to how much you are willing to sacrifice to achieve objectives.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('If possible, schedule more demanding tasks for the time of day when you do your best work.') }}</li>

            <li>{{ __('Avoid long periods of intense work without breaks for relaxation or less intense activity.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('People who are moderate in Conscientiousness are adaptable to many different work contexts and careers. Their level of Conscientiousness makes them employable and also improves their prospects for promotion.') }}</div>


        </div>

    </div>

</div>
