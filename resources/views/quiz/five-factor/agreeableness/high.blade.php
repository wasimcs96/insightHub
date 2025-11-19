<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-agreeableness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('AGREEABLENESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('High Agreeableness') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('High Agreeableness means you are motivated to promote cooperation and harmony with others.') }}</div>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe agreeableness could be true for you.') }}</div>



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
        <li>{{ __('Willingness to compromise to others’ interests') }}</li>
        <li>{{ __('Optimistic view of people') }}</li>

    </ul>

    <div class="mb-3">
        <div class="text-muted fs-1-rem">{{ __('You may not possess all these characteristics in equal measure but most of them will describe you.') }}</div>
    </div>

    <div>
        <a href="JavaScript:;" @click="collapse('custom-collapse12');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText='{{ __('Close')}}' : $event.target.innerText='{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>
    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse12">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('working with and getting on with other people.') }}</li>

            <li>{{ __('being popular.') }}</li>

            <li>{{ __('understanding other’s point of view.') }}</li>

            <li>{{ __('actively listening to others.') }}</li>

            <li>{{ __('collaborating with colleagues.') }}</li>

        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>
        <div class="mb-3">
            <div class="text-muted fs-1-rem">{{ __('Your High Agreeableness may cause you') }}</div>
        </div>

        <ul class="text-muted">

            <li>{{ __('to fail to express your views.') }}</li>

            <li>{{ __('to fail to make objective tough decisions.') }}</li>

            <li>{{ __('to avoid confrontation when it is appropriate.') }}</li>

            <li>{{ __('to hide what you really think.') }}</li>

            <li>{{ __('to avoid conflict when it is appropriate.') }}</li>

            <li>{{ __('to be weak in bargaining and negotiating for your own interests.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>



        <ul class="text-muted">

            <li>{{ __('Consider careers that are associated with people.') }}</li>
            <li>{{ __('Do not allow your agreeableness to make you compliant when you need to disagree.') }}</li>
            <li>{{ __('Beware of taking on responsibilities too readily to help others.') }}</li>
            <li>{{ __('Observe less agreeable people to learn how to be more assertive.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>

        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('High Agreeableness is highly valued, especially in careers involving people, such as teaching and caring professions. It is a valuable trait in being part of a team, but less so in leading a team, where difficult decisions about people may need to be made.') }}</div>



        </div>

    </div>

</div>
