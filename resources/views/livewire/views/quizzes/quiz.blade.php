<div class="quiz">
    <div class="quiz__container">
        <h6 class="quiz__pretitle">
            {{ __("Question") }} <strong>{{ $entryIndex + 1 }} / {{ $entries->count() }}</strong>
        </h6>

        <h3 class="quiz__title">{{ $this->getEntry()->question }}</h3>

        @if($this->getEntry()->answer)
            <button class="btn btn-default collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#entry-answer">{{ __("Answer") }}<i class="far fa-chevron-down"></i></button>
            <div class="collapse" id="entry-answer">
                <div class="quiz__answer">
                    {{ $this->getEntry()->answer }}
                </div>
            </div>
        @endif

        <div class="quiz__cta">
            <div class="quiz__controls">
                <button class="btn btn-lg btn-default" @disabled(! $this->hasPrevEntry()) wire:click="prevEntry"><i class="far fa-arrow-left"></i>{{ __("Previous question") }}</button>
                <button class="btn btn-lg btn-default" @disabled(! $this->hasNextEntry()) wire:click="nextEntry">{{ __("Next question") }}<i class="far fa-arrow-right"></i></button>
            </div>

            @if(! $this->hasNextEntry())
                <div class="quiz__finish">
                    <button class="btn btn-lg btn-default" wire:click="finish">{{ __("Finish quiz") }}</button>
                </div>
            @endif
        </div>
    </div>
</div>
