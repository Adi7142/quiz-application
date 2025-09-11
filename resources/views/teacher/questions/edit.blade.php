@extends('layout')

@section('title', 'Vraag Bewerken')

@section('content')
    <h1>Vraag Bewerken</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.questions.update', $question) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Prompt:</label><br>
            <textarea name="prompt" rows="3" required>{{ old('prompt', $question->prompt) }}</textarea>
        </div>

        <div>
            <label>Type:</label><br>
            <select name="type" id="question-type" required>
                <option value="mcq" {{ old('type', $question->type) == 'mcq' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="text" {{ old('type', $question->type) == 'text' ? 'selected' : '' }}>Open vraag</option>
            </select>
        </div>

        <div>
            <label>Points:</label><br>
            <input type="number" name="points" value="{{ old('points', $question->points) }}" min="1" required>
        </div>

        <div id="mcq-options">
            <label>Opties:</label><br>
            @foreach($question->options as $index => $opt)
                <div>
                    <input type="text" name="options[{{ $index }}][text]" value="{{ $opt->text }}" placeholder="Optie {{ strtoupper($index + 1) }}" required>
                    <label>
                        <input type="checkbox" name="options[{{ $index }}][is_correct]" {{ $opt->is_correct ? 'checked' : '' }}> Correct
                    </label>
                </div>
            @endforeach
        </div>

        <div>
            <label>Correct answer (voor open vraag of referentie):</label><br>
            <input type="text" name="correct_answer" value="{{ old('correct_answer', is_array(json_decode($question->correct_answer_json)) ? '' : json_decode($question->correct_answer_json)) }}">
        </div>

        <button type="submit">Vraag bijwerken</button>
    </form>

    <script>
        const typeSelect = document.getElementById('question-type');
        const mcqDiv = document.getElementById('mcq-options');

        typeSelect.addEventListener('change', function() {
            if(this.value === 'mcq') {
                mcqDiv.style.display = 'block';
            } else {
                mcqDiv.style.display = 'none';
            }
        });

        if(typeSelect.value === 'mcq') {
            mcqDiv.style.display = 'block';
        } else {
            mcqDiv.style.display = 'none';
        }
    </script>
@endsection
