<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-agreeableness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('AGREEABLENESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Low Agreeableness') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Low Agreeableness is associated with the ability to place self-interest above getting along with others and being less concerned about other’s wellbeing.') }}</div>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words that describe Low Agreeableness could be true for you.') }}</div>



    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Suspicious') }}</li>

        <li>{{ __('Self-confident') }}</li>

        <li>{{ __('Sceptical') }}</li>

        <li>{{ __('Competitive') }}</li>

        <li>{{ __('Uncooperative') }}</li>

        <li>{{ __('Forthright') }}</li>

        <li>{{ __('Opinionated') }}</li>

        <li>{{ __('Confrontational') }}</li>

        <li>{{ __('Honest') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse10');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse10">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('expressing your point of view.') }}</li>

            <li>{{ __('getting others to agree with you or comply.') }}</li>

            <li>{{ __('prioritising your own interests.') }}</li>

            <li>{{ __('negotiation and bargaining.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Low Agreeableness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to override the views of others.') }}</li>

            <li>{{ __('to fail to actively listen.') }}</li>

            <li>{{ __('to be unaware of what others are really thinking.') }}</li>

            <li>{{ __('to be unaware of offending others.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Work on listening more to the views of others.') }}</li>

            <li>{{ __('Be prepared to compromise when there are strong reasons for doing so.') }}</li>

            <li>{{ __('Observe agreeable people to learn how to develop your social skills.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('People with Low Agreeableness are commonly engaged in careers involving machines and technology such as engineering and the trades. It is a common trait in entrepreneurs.') }}</div>


        </div>

    </div>

</div>
