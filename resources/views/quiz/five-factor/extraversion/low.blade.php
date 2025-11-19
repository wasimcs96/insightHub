<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-extraversion.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('EXTRAVERSION') }}</h4>



        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Low Extravert - High Introvert') }}</h5>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('As an Introvert you relate more strongly to your internal world than your external world.') }} </div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Introverts could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('content in your own company') }}</li>

        <li>{{ __('thinker') }}</li>

        <li>{{ __('not assertive or talkative') }}</li>

        <li>{{ __('a listener') }}</li>

        <li>{{ __('like predictability') }}</li>

        <li>{{ __('relaxed pace of life') }}</li>

        <li>{{ __('self-control') }}</li>

        <li>{{ __('regular habits and schedules') }}</li>

        <li>{{ __('enjoy privacy') }}</li>

        <li>{{ __('self-reflection') }}</li>


    </ul>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You may not possess all these characteristics in equal measure but most of them will describe you.') }}</div>


    </div>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse4');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse4">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('working independently.') }}</li>

            <li>{{ __('doing work to your own satisfaction.') }}</li>

            <li>{{ __('knowing exactly what is expected of you in a team or project.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your strong Introversion may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to be overwhelmed by too much social interaction and large groups.') }}</li>

            <li>{{ __('to miss out being recognised or promoted because you are more retiring.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Look for work that allows you to work independently and at your own pace.') }}</li>

            <li>{{ __('Do not rule yourself out of promotion or leadership roles because there are more Extravert candidates.') }}</li>

            <li>{{ __('Learn to say ‘no’ to people and places that drain you, but seek out people who are supportive.') }}</li>

            <li>{{ __('Take steps to increase your confidence for speaking in social and work situations.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>



        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('There is an important role for Introverts in most careers. Introverts find fulfilment in roles such as writing, creative and artistic work, performance entertainment, software development, investigative research and self-employment.') }}</div>


        </div>

    </div>

</div>
