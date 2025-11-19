<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-emotional-stability.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('EMOTIONAL CONTROL') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('High Emotional Control') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Emotional Control relates to your ability to keep your emotions steady and under control in response to life experiences.') }}</div>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe High Emotional Control could be true for you.') }}</div>



    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Mainly positive emotions about past, present and future') }}</li>

        <li>{{ __('Rarely unhappy or stressed by life') }}</li>

        <li>{{ __('Positive self-esteem') }}</li>

        <li>{{ __('Self-efficacy') }}</li>

        <li>{{ __('Overall satisfaction with life') }}</li>

        <li>{{ __('High level of stress resilience') }}</li>

        <li>{{ __('Accepting of setbacks and disappointments') }}</li>

        <li>{{ __('Tolerant of risk') }}</li>

        <li>{{ __('Resilient') }}</li>

        <li>{{ __('Calm') }}</li>

        <li>{{ __('Confident') }}</li>


    </ul>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You may not possess all these characteristics in equal measure but most of them will describe you.') }}</div>


    </div>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse3');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="text-btn" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse3">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('work that is unpredictable.') }}</li>

            <li>{{ __('coping with uncertainty.') }}</li>

            <li>{{ __('activities with some risk.') }}</li>

            <li>{{ __('challenge.') }}</li>

            <li>{{ __('problem solving.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your High Emotional Control may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to be unaware of when demands on you are becoming detrimental to your well-being.') }}</li>

            <li>{{ __('to be too late in placing limits to what you take on.') }}</li>

            <li>{{ __('to underestimate risk.') }}</li>

            <li>{{ __('to fail to empathise with or understand others who have low emotional control.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Be willing to take on leadership roles.') }}</li>

            <li>{{ __('Support others to develop emotional regulation skills.') }}</li>

            <li>{{ __('Look for opportunities for your skills and knowledge to be expanded.') }}</li>

            <li>{{ __('Be aware of the limitations of others with lower emotional control than you.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('High Emotional Control is valuable in most careers, but especially where risk is greater such as the military, management, aviation, surgery, police and emergency services and self-employment. People with high emotional control more readily consider and implement career changes, work promotions and other transformations.') }}</div>

        </div>

    </div>

</div>
