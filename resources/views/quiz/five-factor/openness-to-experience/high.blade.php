<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-openness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('OPENNESS') }}</h4>


        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('High Openness') }}</h5>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('You are high in Openness which means you are open to new ideas and new experiences.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Openness could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Imaginative') }}</li>

        <li>{{ __('Creative') }}</li>

        <li>{{ __('Individualistic and non-conforming') }}</li>

        <li>{{ __('Intellectually curious') }}</li>

        <li>{{ __('Artistic interests') }}</li>

        <li>{{ __('Adventurous') }}</li>

        <li>{{ __('Abstract, symbolic thinking') }}</li>

        <li>{{ __('Broad interests') }}</li>

        <li>{{ __('Express feeling readily') }}</li>

        <li>{{ __('Challenge') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse9');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse9">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('being open-minded and exploring new ideas and experiences.') }}</li>

            <li>{{ __('learning new skills or knowledge.') }}</li>

            <li>{{ __('working where there is ambiguity and uncertainty.') }}</li>

            <li>{{ __('seeing things from different perspectives.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your Vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your high Openness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to have difficulty in completing routine tasks.') }}</li>

            <li>{{ __('to be unhappy in a role that does not provide opportunities to be creative and explore new ideas and experiences.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Look for a career that involves variety and creativity.') }}</li>

            <li>{{ __('Make sure you bring your ideas to reality.') }}</li>

            <li>{{ __('Spend time with people from other fields of work to expand your ideas and experience.') }}</li>

            <li>{{ __('Be careful to value others with whom you work, who are good completing routine tasks.') }}</li>

            <li>{{ __('Find ways of automating or delegating routine tasks.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('There is an important role for people who are high in Openness in many careers that involve openness to discovering new information, approaches or experiences such as research and experimentation, creative and artistic work, design, writing, entrepreneurial activity, sales, marketing and performance entertainment.') }}</div>


        </div>

    </div>

</div>
