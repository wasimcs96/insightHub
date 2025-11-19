<style>

    .modal-body p, .modal-body ul {
margin-bottom: 24px;
    }

    .modal-body p, .modal-body li {
color: #071437;
    font-size: 14px;
    font-weight: 400;
    line-height: 22px;
    }

    .modal-body ul {
        padding-left: 15px;
    }
</style>
<div class="modal-body">
    <p>
        You are about to update the following fields:
    </p>
    {{-- <p class="text-center" style="color: #4B5675;"> --}}
      {{-- {!! $bodyHtml !!} --}}
    {{-- </p> --}}


    @php
        $bada = False;
        $chota = False;
    @endphp

    {{-- Structural Changes Section --}}
    
    @if ($bodyHtml && strip_tags($bodyHtml) != '')
        
        <p><b>Structural Changes:</b></p>
        {!! $bodyHtml !!}
        @php
            $bada = True;
        @endphp
       
    @endif

    <!-- Non-Structural Changes Section -->
    @if($descriptions && strip_tags($descriptions) != '' && strip_tags($descriptions) != '')
        <p><b>Non-Structural Changes:</b></p>
        {!! $descriptions !!}
        @php
            $chota = True;
        @endphp
    @endif

    <!-- Confirmation Message -->
    @if ($bada == True)
        <p>
            Upon confirming, your <b>changes will be saved</b>, and you’ll be redirected to <b>Org Chart View Mode</b> to view the updated structure.
        </p>
    @endif

    @if ($bada == False && $chota == True)
        <p>
            Upon confirming, your <b>Non-structural changes will be saved immediately</b> and reflected in the org chart.
        </p>
    @endif

        <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>