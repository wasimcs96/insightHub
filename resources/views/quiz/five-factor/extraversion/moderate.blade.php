<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-extraversion.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('EXTRAVERSION') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Moderate Extravert') }}</h5>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You relate closely to both your external and internal worlds and have characteristics of Extraversion and Introversion.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Extraverts could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Creative') }}</li>

        <li>{{ __('Adventurous') }}</li>

        <li>{{ __('Imaginative') }}</li>

        <li>{{ __('Think of new ideas') }}</li>

        <li>{{ __('Friendliness') }}</li>

        <li>{{ __('Energetic') }}</li>

        <li>{{ __('Excitement-seeking') }}</li>

        <li>{{ __('Sociable') }}</li>

        <li>{{ __('Outgoing') }}</li>

        <li>{{ __('Take the lead') }}</li>

        <li>{{ __('Content in your own company') }}</li>

        <li>{{ __('A listener') }}</li>

        <li>{{ __('Emotional regulation') }}</li>

        <li>{{ __('Self-reflection') }}</li>


    </ul>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You may not possess all these characteristics in equal measure but most of them will describe you.') }}</div>


    </div>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse5');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse5">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('a wide range of work environments.') }}</li>

            <li>{{ __('a balance between social and solo time.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your moderate Extraversion may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to need a balance between time on your own and time with other people.') }}</li>

            <li>{{ __('to lose motivation, energy and concentration if the balance swings too far in one direction.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Be aware of when you need to spend time with others or time on your own.') }}</li>

            <li>{{ __('Have a strategy for what to do when you realise you need more interaction with either your external world or internal world to function at your best.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Moderate Extraverts have an important role in most careers because they can balance social contexts as well as independent work. They have a special role in interfacing between extravert and introvert colleagues to bring collaboration and unity of purpose.') }}</div>


        </div>

    </div>

</div>
