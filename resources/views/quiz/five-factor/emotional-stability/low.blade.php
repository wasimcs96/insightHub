<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="mb-4">

        {{-- <img src="/images/five-factor/visual-per-emotional-stability.svg" class="d-block mb-3 five-factor-icon"> --}}

        <h4 class="text-yellow mb-3 fw-600" style="color:#F6931D;">{{ __('EMOTIONAL CONTROL') }}</h4>



        <five-factor-chart :data='@json($questions)' type="{{ $title }}"></five-factor-chart>

        <h5 class="text-muted mb-0 fw-600">{{ __('Low Emotional Control') }}</h5>



    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Low Emotional Control means that you experience negative emotions in response to life experiences more frequently than most people.') }}</div>


    </div>

    <div class="mb-3">

        <div class="text-muted fs-1-rem">{{ __('Some of these words and phrases that describe Low Emotional Control could be true for you.') }}</div>


    </div>

    <ul class="text-muted mb-3">

        <li>{{ __('Sadness') }}</li>

        <li>{{ __('Low mood') }}</li>

        <li>{{ __('Anxiety') }}</li>

        <li>{{ __('Distress') }}</li>

        <li>{{ __('Anger') }}</li>

        <li>{{ __('Fear') }}</li>

        <li>{{ __('Self-consciousness') }}</li>

        <li>{{ __('Panic') }}</li>


    </ul>

    <div>

        <a href="JavaScript:;" @click="collapse('custom-collapse1');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="text-btn" style="color:#F6931D; text-decoration:none;">{{ __('Learn More') }}</a>


    </div>


    <div class="custom-collapse mb-3 mt-5" id="custom-collapse1">

        <h5 class="fw-600 text-muted">{{ __('What are your strengths?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('You enjoy') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('making others aware of unforeseen risk and danger.') }}</li>

            <li>{{ __('seeing the problems in pursuing a project or course of action.') }}</li>

            <li>{{ __('identifying with others who struggle with their emotional reactions.') }}</li>
        </ul>


        <h5 class="fw-600 text-muted">{{ __('Where are you vulnerable?') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('Your Low Emotional Control may cause you') }}</div>


        </div>

        <ul class="text-muted">

            <li>{{ __('problems with your mental and emotional wellbeing.') }}</li>

            <li>{{ __('diminished ability to think clearly and make rational decisions.') }}</li>

            <li>{{ __('fail to cope effectively with stress.') }}</li>

            <li>{{ __('to interpret ordinary situations as threatening.') }}</li>

            <li>{{ __('to view minor frustrations as hopelessly difficult.') }}</li>

            <li>{{ __('to be in a consistently bad mood.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Advice for future work') }}</h5>


        <ul class="text-muted">

            <li>{{ __('Become aware of and acknowledge your feelings.') }}</li>

            <li>{{ __('Be confident that emotional control can be developed.') }}</li>

            <li>{{ __('Ask for support.') }}</li>

            <li>{{ __('Recognise your achievements.') }}</li>

            <li>{{ __('Practice relaxation and mindfulness to control your moods.') }}</li>

            <li>{{ __('Seek practical support to build stress resilience skills.') }}</li>


        </ul>

        <h5 class="fw-600 text-muted">{{ __('Careers') }}</h5>


        <div class="mb-3">

            <div class="text-muted fs-1-rem">{{ __('People with Low Emotional Control prefer work they can do at their own pace and where they can control the pressure involved, such as work that is predictable and routine. They prefer work that is within their skills set. They can also succeed in creative work in the Arts and Music.') }}</div>

        </div>

    </div>

</div>
