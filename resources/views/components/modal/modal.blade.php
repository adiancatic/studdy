@php
    $attributes = $attributes
        ->class([
            "modal-dialog",
            "modal-dialog-centered" => $attributes->has("center"),

            "modal-lg" => $attributes->has("size") && $attributes->get("size") === "lg",
            "modal-xl" => $attributes->has("size") && $attributes->get("size") === "xl",
            "modal-fullscreen" => $attributes->has("fullscreen"),
        ]);
@endphp

<div {{ $attributes }}>
    <div class="modal-content">

        <div class="modal-header">
            @if(isset($header) && $header)
                {{ $header }}
            @else
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            @endif
        </div>

        <div class="modal-body">
            {{ $slot }}
        </div>

        @if(! ($attributes->has("footer") && $attributes->get("footer") === "false"))
            <div class="modal-footer">
                @if(isset($footer) && $footer)
                    {{ $footer }}
                @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                @endif
            </div>
        @endif

    </div>
</div>
