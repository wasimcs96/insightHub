<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-openness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('OPENNESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Low Openness') }}</h5>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Low Openness indicates your preference for routine, predictability, rituals, and regular habits. Predictability gives a sense of security and control over your environment, schedule and life.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Low Openness could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Down to earth') }}</li>

        <li>{{ __('Conventional') }}</li>

        <li>{{ __('Concrete thinking') }}</li>

        <li>{{ __('Focused interests rather than broad range of interests') }}</li>

        <li>{{ __('Prefer familiarity over novelty') }}</li>

        <li>{{ __('Emotionally reserved') }}</li>

        <li>{{ __('Conforming') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse7');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse7">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('organising.') }}</li>

            <li>{{ __('following procedures.') }}</li>

            <li>{{ __('completing tasks.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Low Openness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to find it hard to adapt to change or the unexpected.') }}</li>

            <li>{{ __('to have difficulty working with ambiguity and uncertainty.') }}</li>

            <li>{{ __('to feel stress when working with people who do not keep to procedures and rules.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Take the lead in setting up processes for projects.') }}</li>

            <li>{{ __('Let others know of your preference for predictability and your need to know of changes in advance.') }}</li>

            <li>{{ __('Offer to organise ‘traditions’ in your family or work.') }}</li>

            <li>{{ __('When facing change, find out as much information as possible in advance.') }}</li>

            <li> {{ __('Plan ahead for unexpected events, for example ‘if this happens, I will…’') }}</li>

            <li>{{ __('Reflect on how you have successfully adapted to change in the past.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('People who are low in Openness have important roles in most careers, especially where following processes and established procedures are involved, such as administration, management, supervision of people or things, completing tasks to a high standard.') }}</div>


        </div>

    </div>

</div>
