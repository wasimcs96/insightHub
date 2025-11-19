<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-openness.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('OPENNESS') }}</h4>



        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Moderate Openness') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Moderate Openness indicates your ability to adapt to routines and your willingness to explore new ideas and experiences.') }}</div>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe people with Moderate Openness could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Imaginative') }}</li>

        <li>{{ __('Creative') }}</li>

        <li>{{ __('Individualistic and non-conforming') }}</li>

        <li>{{ __('Intellectually curious') }}</li>

        <li>{{ __('Artistic interests') }}</li>

        <li>{{ __('Adventurous') }}</li>

        <li>{{ __('Broad interests') }}</li>

        <li>{{ __('Express feeling readily') }}</li>

        <li>{{ __('Down to earth') }}</li>

        <li>{{ __('Conventional') }}</li>

        <li>{{ __('Balance between familiarity and novelty') }}</li>

        <li>{{ __('Conforming') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse8');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn-text" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse8">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('being open-minded to new ideas and experiences.') }}</li>

            <li>{{ __('learning new skills or knowledge.') }}</li>

            <li>{{ __('seeing things from different perspectives.') }}</li>

            <li>{{ __('completing tasks and following procedures.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('What are your vulnerabilities?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Moderate Openness may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('to be content to follow routines and established procedures and miss opportunities to gain new experiences and knowledge or contribute creative ideas in work.') }}</li>

            <li>{{ __('to remain in a role that does not provide opportunities to be creative and explore new ideas and experiences.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('If you are mainly engaged in routine work, find opportunities for creative activities as well.') }}</li>

            <li>{{ __('Take advantage of opportunities to enhance your present skills, knowledge and experience.') }}</li>

            <li>{{ __('Be willing to volunteer to take the lead in projects.') }}</li>

            <li>{{ __('Congratulate yourself when you step out of your comfort zone as it will build your confidence.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('There is an important role for people who are moderate in Openness in most careers. The ability to pivot from creative thinking and new experiences to routine procedures and tasks gives a flexibility to thrive in most working environments from administration and management to creative design and software coding.') }}</div>


        </div>

    </div>

</div>
