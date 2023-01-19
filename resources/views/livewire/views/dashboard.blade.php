<div class="dashboard">
    <div class="container">
        <div class="row">
            <h1 class="dashboard__title">{{ __("Welcome") }}, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>
        </div>

        <div class="row">
            <div class="col-4">
                @php
                    $now = \Carbon\CarbonImmutable::now();
                    $offset = 0;
                    $offsetType = \App\Http\Livewire\Views\Calendar\Calendar::TYPE_WEEK;
                @endphp

                <livewire:views.calendar.grid-day
                    :now="$now"
                    :offset="$offset"
                    :offsetType="$offsetType"
                    key="{{ $offsetType }}-{{ $offset }}" />
            </div>

            <div class="col-8">
                <div class="row m-0">

                    <div class="dashboard__notebooks">
                        <div class="row">
                            <div class="col">
                                <h5 class="dashboard__notebooks-title">{{ __("Subjects") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            @foreach(\Illuminate\Support\Facades\Auth::user()->subjects()->take(3)->get() as $subject)
                                <div class="col">
                                    <a href="{{ $subject->url }}" class="dashboard__notebook-card">
                                        <div class="notebook-card__icon">
                                            <i class="fas fa-{{ $subject->icon }}"></i>
                                        </div>
                                        <div class="notebook-card__title">{{ $subject->title }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div>
                                    <a href="/subjects" class="btn btn-default">
                                        {{ __("All subjects") }}
                                        <i class="far fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard__notebooks mt-4">
                        <div class="row">
                            <div class="col">
                                <h5 class="dashboard__notebooks-title">{{ __("Notebooks") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            @foreach(\Illuminate\Support\Facades\Auth::user()->notebooks()->take(3)->get() as $notebook)
                                <div class="col">
                                    <a href="{{ $notebook->url }}" class="dashboard__notebook-card">
                                        <div class="notebook-card__icon">
                                            <i class="fas fa-{{ $notebook->icon }}"></i>
                                        </div>
                                        <div class="notebook-card__title">{{ $notebook->title }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div>
                                    <a href="/notebooks" class="btn btn-default">
                                        {{ __("All notebooks") }}
                                        <i class="far fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard__notebooks mt-4">
                        <div class="row">
                            <div class="col">
                                <h5 class="dashboard__notebooks-title">{{ __("Subject progress") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            @foreach(\Illuminate\Support\Facades\Auth::user()->subjects as $subject)
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="dashboard__notebook-card">
                                                <div class="notebook-card__icon">
                                                    <i class="fas fa-{{ $subject->icon }}"></i>
                                                </div>
                                                <div class="notebook-card__title">{{ $subject->title }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            @php
                                                $quizzes = \App\Models\Quiz::whereIn("note_id", $subject->notes->pluck("id"))->get();
                                                if ($quizzes) {
                                                    $subjectRating = \App\Models\QuizLog::whereIn("quiz_id", $quizzes->pluck("id"))->get()->average("rating");
                                                }
                                            @endphp
                                            @if($subjectRating)
                                                <x-progress-line :actual="$subjectRating" max="5" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div>
                                    <a href="/quizzes" class="btn btn-default">
                                        {{ __("All quizzes") }}
                                        <i class="far fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
