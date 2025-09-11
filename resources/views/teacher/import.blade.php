@extends('layout')

@section('content')
    <h1>Upload quiz</h1>
    <form action="{{ route('teacher.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Titel:</label>
        <input type="text" name="title" required>
        <label>Bestand (JSON/CSV):</label>
        <input type="file" name="file" required>
        <button type="submit">Uploaden</button>
    </form>
@endsection
