<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-emotional-stability.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('EMOTIONAL CONTROL') }}</h4>



        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Moderate Emotional Control') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Moderate Emotional Control relates to a moderate ability to keep your emotions steady and under control in response to life experiences.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these phrases that describe Moderate Emotional Control could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Mainly positive emotions about past, present and future.') }}</li>

        <li>{{ __('Overall satisfaction with life.') }}</li>

        <li>{{ __('Moderate levels of stress resilience.') }}</li>

        <li>{{ __('Some ability to overcome setbacks and disappointments.') }}</li>

        <li>{{ __('Psychological resilience') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse2');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="text-btn" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse2">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('activities with protected risk.') }}</li>

            <li>{{ __('moderate challenge.') }}</li>

            <li>{{ __('problem solving.') }}</li>

            <li>{{ __('supporting others with lower emotional control.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Moderate Emotional Control may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to be anxious in high risk situations.') }}</li>

            <li>{{ __('to draw back from challenges that would stretch you, but you are capable of doing.') }}</li>

            <li>{{ __('to be held back by others around you with higher levels of anxiety and lower resilience.') }}</li>

            <li>{{ __('to underestimate your resilience under pressure.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Do not let negative emotions hold you back from attempting new opportunities, such as self-employment.') }}</li>

            <li>{{ __('Be aware of the role you have in interfacing between colleagues with high and low emotional control to enable collaboration.') }}</li>

            <li>{{ __('You could have a supportive role to colleagues who have lower level of emotional control.') }}</li>

            <li>{{ __('Be aware of your level of stress tolerance and choose environments where this will not be compromised.') }}</li>

            <li>{{ __('Value your ability to pick up on risk.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Moderate Emotional Control is valuable in many careers where there are moderate levels of risk and uncertainty. This may include work where you can play a supportive role to senior leadership and management. Self-employment is also a potential career option.') }}</div>


        </div>

    </div>

</div>
