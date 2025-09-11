@extends('layout')

@section('title', 'Home')

@section('content')
    <h1>Welkom bij de Quiz App</h1>
    <p>Kies hieronder je rol om verder te gaan:</p>

    <ul>
        <li><a href="{{ route('teacher.import.form') }}">Docent: quiz importeren</a></li>
        <li><a href="{{ route('student.quizzes.show', 1) }}">Student: start quiz (voorbeeld)</a></li>
        <li><a href="{{ route('teacher.quizzes.history') }}">Docent: quiz uitslag inzien</a></li>
        <li><a href="{{ route('teacher.questions.index') }}">Docent: quiz vraag aanpassen</a></li>
    </ul>
@endsection
