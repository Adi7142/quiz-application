<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $quiz->load('questions.options');
        return view('teacher.quiz-show', compact('quiz'));
    }

    public function create(Quiz $quiz)
    {
        return view('teacher.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $question = Question::create([
            'quiz_id' => $quiz->id,
            'prompt' => $request->prompt,
            'type' => $request->type ?? 'mcq',
            'points' => $request->points ?? 1,
            'correct_answer_json' => $request->correct_answer_json ?? null,
        ]);

        // Handle options
        foreach ($request->options ?? [] as $opt) {
            Option::create([
                'question_id' => $question->id,
                'text' => $opt['text'],
                'is_correct' => isset($opt['is_correct']) ? 1 : 0,
            ]);
        }

        return redirect()->route('teacher.questions.index')->with('success', 'Question created!');
    }


}

