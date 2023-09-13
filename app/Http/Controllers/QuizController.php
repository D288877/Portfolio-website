<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class QuizController extends Controller
{
    public function create()
    {
        return view('QuizCreate');
    }

    public function save(Request $request)
    {
        $request->validate([
            'quiz_data' => 'required|file|mimes:json|max:2048'
        ]);
        $quizDataFileName = 'quiz.json'; // Customize the file name as needed
        $quizDataFilePath = $request->file('quiz_data_file')->storeAs('public/json', $quizDataFileName);
        $quizDataFilePath = str_replace('public/', '', $quizDataFilePath);
        Quiz::create([
            'quiz_data' => $quizDataFilePath,
        ]);

        return redirect()->back()->with('success', 'Quiz data saved successfully.');
    }

    public function showQuiz()
    {
        // Read the JSON file
        $quizData = json_decode(File::get('path/to/quiz.json'), true);

        // Pass quiz data to the view
        return view('quiz', ['quizData' => $quizData]);
    }

    public function submitQuiz(Request $request)
    {
        // Retrieve user's answers from the form
        $userAnswers = $request->input('answers');

        // Read the JSON file with quiz data
        $quizData = json_decode(File::get('path/to/quiz.json'), true);

        // Calculate the user's score
        $score = $this->calculateScore($quizData, $userAnswers);

        // Redirect to the result page with the score
        return view('quiz.result', ['score' => $score]);
    }

    private function calculateScore($quizData, $userAnswers)
    {
        $correctAnswers = 0;

        foreach ($quizData['questions'] as $index => $question) {
            $correctOptionIndex = $question['correct_option'];
            if ($userAnswers[$index] == $correctOptionIndex) {
                $correctAnswers++;
            }
        }

        return $correctAnswers;
    }
}
