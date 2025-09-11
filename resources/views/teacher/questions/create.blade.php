@extends('layout')

@section('title', 'Nieuwe Vraag Toevoegen')

@section('content')
    <h1>Nieuwe Vraag Toevoegen</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.questions.store') }}" method="POST">
        @csrf
        <div>
            <label>Prompt:</label><br>
            <textarea name="prompt" rows="3" required>{{ old('prompt') }}</textarea>
        </div>

        <div>
            <label>Type:</label><br>
            <select name="type" id="question-type" required>
                <option value="mcq" {{ old('type') == 'mcq' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Open vraag</option>
            </select>
        </div>

        <div>
            <label>Points:</label><br>
            <input type="number" name="points" value="{{ old('points', 1) }}" min="1" required>
        </div>

        <div id="mcq-options">
            <label>Opties:</label><br>
            <div>
                <input type="text" name="options[0][text]" placeholder="Optie A" required>
                <label>
                    <input type="checkbox" name="options[0][is_correct]"> Correct
                </label>
            </div>
            <div>
                <input type="text" name="options[1][text]" placeholder="Optie B" required>
                <label>
                    <input type="checkbox" name="options[1][is_correct]"> Correct
                </label>
            </div>
            <div>
                <input type="text" name="options[2][text]" placeholder="Optie C">
                <label>
                    <input type="checkbox" name="options[2][is_correct]"> Correct
                </label>
            </div>
        </div>

        <div>
            <label>Correct answer (voor open vraag of referentie):</label><br>
            <input type="text" name="correct_answer" value="{{ old('correct_answer') }}">
        </div>

        <button type="submit">Vraag toevoegen</button>
    </form>

    <script>
        // Toggle MCQ options visibility if question type changes
        const typeSelect = document.getElementById('question-type');
        const mcqDiv = document.getElementById('mcq-options');

        typeSelect.addEventListener('change', function() {
            if(this.value === 'mcq') {
                mcqDiv.style.display = 'block';
            } else {
                mcqDiv.style.display = 'none';
            }
        });

        // Initial display
        if(typeSelect.value === 'mcq') {
            mcqDiv.style.display = 'block';
        } else {
            mcqDiv.style.display = 'none';
        }
    </script>
@endsection
