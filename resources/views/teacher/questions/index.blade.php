@extends('layout')

@section('title', 'Vragenbank')

@section('content')
    <h1>Vragenbank</h1>

    <a href="{{ route('teacher.questions.create') }}" class="btn btn-primary">Nieuwe vraag toevoegen</a>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>Prompt</th>
            <th>Type</th>
            <th>Points</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        @forelse($questions as $q)
            <tr>
                <td>{{ $q->prompt }}</td>
                <td>{{ strtoupper($q->type) }}</td>
                <td>{{ $q->points }}</td>
                <td>
                    <a href="{{ route('teacher.questions.edit', $q->id) }}">Bewerk</a> |
                    <form action="{{ route('teacher.questions.destroy', $q->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">Verwijder</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Geen vragen gevonden.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $questions->links() }} <!-- pagination if used -->
@endsection

