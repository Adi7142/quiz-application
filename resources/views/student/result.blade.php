@extends('layout')

@section('content')
    <h1>Resultaat voor {{ $quiz->title }}</h1>
    <p>Totale score: {{ $submission->score }}</p>

    @foreach($submission->answers as $ans)
        <div class="question">
            <p><strong>{{ $ans->question->prompt }}</strong></p>
            <p>Jouw antwoord: {{ is_array($ans->answer_json) ? implode(',', $ans->answer_json) : $ans->answer_json }}</p>
            <p>Status: {{ $ans->is_correct ? '✅ Correct' : '❌ Fout' }}</p>
            @if(!$ans->is_correct)
                <p>Juiste antwoord:
                    @if($ans->question->type === 'mcq')
                        {{ implode(', ', $ans->question->options()->where('is_correct', true)->pluck('text')->toArray()) }}
                    @else
                        {{ implode(', ', $ans->question->correct_answer_json ?? []) }}
                    @endif
                </p>
            @endif
        </div>
    @endforeach
@endsection

