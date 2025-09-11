@extends('layout')

@section('content')
    <h1>Past Quizzes</h1>

    @foreach($quizzes as $quiz)
        <h2>{{ $quiz->title }}</h2>
        @if($quiz->submissions->count())
            <table border="1" cellpadding="5">
                <tr>
                    <th>Student</th>
                    <th>Score</th>
                    <th>Submitted At</th>
                </tr>
                @foreach($quiz->submissions as $sub)
                    <tr>
                        <td>{{ $sub->user->name }}</td>
                        <td>{{ $sub->score }}</td>
                        <td>{{ $sub->submitted_at }}</td>
                        <td>
                            @foreach($sub->answers as $a)
                                <strong>{{ $a->question->prompt }}</strong>: {{ is_array(json_decode($a->answer)) ? implode(',', json_decode($a->answer)) : $a->answer }} <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No submissions yet.</p>
        @endif
    @endforeach
@endsection
