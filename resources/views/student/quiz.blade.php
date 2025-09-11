@extends('layout')

@section('content')
    <h1>{{ $quiz->title }}</h1>

    <form action="{{ route('student.quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        @foreach($quiz->questions as $q)
            <div class="question">
                <p><strong>{{ $loop->iteration }}. {{ $q->prompt }}</strong></p>

                @if($q->type === 'mcq')
                    @foreach($q->options as $opt)
                        <label>
                            <input type="checkbox" name="answers[{{ $q->id }}][]" value="{{ $opt->id }}">
                            {{ $opt->text }}
                        </label><br>
                    @endforeach
                @else
                    <textarea name="answers[{{ $q->id }}]" rows="2"></textarea>
                @endif
            </div>
        @endforeach
        <button type="submit">Indienen</button>
    </form>
@endsection

