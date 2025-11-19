<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-agreeableness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('AGREEABLENESS') }}</h4>

        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Moderate Agreeableness') }}</h5>

    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You combine a balance of being agreeable and disagreeable, which means you are able to get on with others well but also to be more objective in relating to others when it is appropriate.') }}</div>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Moderate Agreeableness could be true for you.') }}</div>



    </div>

    <ul class="text-muted mb-3">
        <li>{{ __('Compliant') }}</li>
        <li>{{ __('Kind') }}</li>
        <li>{{ __('Trusting') }}</li>
        <li>{{ __('Conciliatory') }}</li>
        <li>{{ __('Considerate') }}</li>
        <li>{{ __('Friendly') }}</li>
        <li>{{ __('Generous') }}</li>
        <li>{{ __('Helpful') }}</li>
        <li>{{ __('Willingness to compromise to other’s interests') }}</li>
        <li>{{ __('Optimistic view of people') }}</li>
        <li>{{ __('Assertive') }}</li>
        <li>{{ __('Sceptical') }}</li>
        <li>{{ __('Confident') }}</li>
        <li>{{ __('Honest') }}</li>
    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse11');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>



    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse11">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>

        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>



        </div>

        <ul class="text-muted">

            <li>{{ __('working with and getting on with other people.') }}</li>

            <li>{{ __('understanding other’s point of view.') }}</li>

            <li>{{ __('actively listening to others.') }}</li>

            <li>{{ __('collaborating with colleagues.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>



        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Moderate Agreeableness may cause you') }}</div>



        </div>

        <ul class="text-muted">

            <li>{{ __('to fail to you express your views.') }}</li>

            <li>{{ __('to fail to make objective tough decisions.') }}</li>

            <li>{{ __('to hide what you really think.') }}</li>

            <li>{{ __('to avoid conflict when it is appropriate.') }}</li>

            <li>{{ __('to be weak in bargaining and negotiating for your own interests.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Consider careers that are associated with people.') }}</li>

            <li>{{ __('Be prepared to express your views when not in agreement.') }}</li>

            <li>{{ __('Value your ability to represent others who are high in agreeableness and have difficulty expressing themselves.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>



        <div class="mb-3">
            <div class="text-muted fs-1-rem">{{ __('Agreeableness is highly valued, especially in careers involving people, such as teaching and caring professions. It is a valuable trait in being part of a team and in leadership. Develop your weaker traits to widen your career choices.') }}</div>
        </div>

    </div>

</div>
