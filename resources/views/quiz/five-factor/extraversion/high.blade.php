<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-extraversion.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('EXTRAVERSION') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('High Extravert') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('As an Extravert you relate more strongly to your external world than your internal world.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe extraverts could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Creative') }}</li>

        <li>{{ __('Adventurous') }}</li>

        <li>{{ __('Imaginative') }}</li>

        <li>{{ __('Think of new ideas') }}</li>

        <li>{{ __('Friendliness') }}</li>

        <li>{{ __('Gregarious') }}</li>

        <li>{{ __('Assertiveness') }}</li>

        <li>{{ __('Energetic') }}</li>

        <li>{{ __('Excitement-seeking') }}</li>

        <li>{{ __('Sociable') }}</li>

        <li>{{ __('Outgoing') }}</li>

        <li>{{ __('Take the lead') }}</li>

        <li>{{ __('Enjoy large gatherings') }}</li>

        <li>{{ __('Enjoy attention') }}</li>


    </ul>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You may not possess all these characteristics in equal measure but most of them will describe you.') }}</div>


    </div>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse6');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse6">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('social situations where you can express your ideas.') }}</li>

            <li>{{ __('engaging in projects to which you can contribute creatively through fresh ideas and approaches.') }}</li>

            <li>{{ __('investing effort and energy in projects that motivate you.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your strong extraversion may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to be dominant in social contexts and less aware of what Introverts could contribute if given opportunity to do so.') }}</li>

            <li>{{ __('to neglect the routine and mundane aspects of bringing ideas to reality.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Seek to be part of a balanced team where others complement your Extraversion.') }}</li>

            <li>{{ __('Give others opportunities to participate and share ideas and experience.') }}</li>

            <li>{{ __('Practice active listening.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>



        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('There is an important role for Extraverts in most careers that involve social interactions with management teams, staff or the public and where creative thinking and leadership are valued: for example sales, entrepreneurial activity, senior management, entertainment and politics.') }}</div>



        </div>

    </div>

</div>
