<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $size ?? '' }}">
        <div class="modal-content">
            @isset($title)
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @endisset

            <div class="modal-body p-4">
                {!! $body !!}
            </div>

            @if (!empty($footer))
            <div class="modal-footer justify-content-center border-0 pt-0">
                {!! $footer !!}
            </div>
            @endif
        </div>
    </div>
</div>
