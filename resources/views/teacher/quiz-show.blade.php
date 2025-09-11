@extends('layout')

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    <h2>Student resultaten</h2>
    <table>
        <tr>
            <th>Student</th><th>Score</th><th>Datum</th>
        </tr>
        @foreach($quiz->submissions as $sub)
            <tr>
                <td>{{ $sub->user->name }}</td>
                <td>{{ $sub->score }}</td>
                <td>{{ $sub->submitted_at }}</td>
            </tr>
        @endforeach
    </table>
@endsection
