<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class QuizController extends Controller
{
    public function dashboard()
    {
        $quizzes = Quiz::all();
        $quizDataArray = [];

        if (!$quizzes->isEmpty()) {
            foreach ($quizzes as $quiz) {
                $quizData = json_decode(File::get(storage_path('app/public/' . $quiz->quiz_data)), true);
                $quizTitle = $quizData['quiz_title'];
                $quizExplanation = $quizData['quiz_explanation'];
                $quizID = $quiz->id;
                $quizDataArray[] = compact('quizData', 'quizTitle', 'quizExplanation', 'quizID');
            }
        }
        return view('dashboard', compact('quizDataArray'));
    }

    public function create()
    {
        return view('QuizCreate');
    }

    public function save(Request $request)
    {
        $request->validate([
            'quiz_data' => 'required|file|mimes:json'
        ]);
        $originalFileName = $request->file('quiz_data')->getClientOriginalName();
        $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);

        $number = Quiz::where('quiz_data', 'like', 'public/json/' . $baseName . '%')->count() + 1;
        $quizDataFileName = $baseName . '_' . $number . '.json';
        $quizDataFilePath = $request->file('quiz_data')->storeAs('public/json', $quizDataFileName);
        $quizDataFilePath = str_replace('public/', '', $quizDataFilePath);
        Quiz::create([
            'quiz_data' => $quizDataFilePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Quiz data saved successfully.');
    }

    public function showQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $jsonFilePath = $quiz->quiz_data;
        $quizData = json_decode(File::get(storage_path('app/public/' . $jsonFilePath)), true);

        return view('quiz', compact('quizData', 'quizId'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        $userAnswers = $request->input('answers');
        $quiz = Quiz::findOrFail($quizId);
        $jsonFilePath = $quiz->quiz_data;
        $quizData = json_decode(File::get(storage_path('app/public/' . $jsonFilePath)), true);
        $score = $this->calculateScore($quizData, $userAnswers);

        $quizResult = new QuizResult();
        $quizResult->user_id = Auth::id();
        $quizResult->quizzes_id = $quizId;
        $quizResult->score = $score;
        $quizResult->save();

        return view('quiz.result', compact('score', 'quizData', 'userAnswers'));
    }

    private function calculateScore($quizData, $userAnswers)
    {
        $totalQuestions = count($quizData['questions']);
        $correctAnswers = 0;

        foreach ($quizData['questions'] as $index => $question) {
            $userAnswer = $userAnswers[$index] ?? null;

            if ($question['type'] === 'multiple_choice') {
                $correctOptions = $question['correct_options'];

                if (count(array_diff($userAnswer, $correctOptions)) === 0 && count(array_diff($correctOptions, $userAnswer)) === 0) {
                    $correctAnswers++;
                }
            } elseif ($question['type'] === 'single_choice') {
                $correctOption = $question['correct_option'];

                if ($userAnswer == $correctOption) {
                    $correctAnswers++;
                }
            } elseif ($question['type'] === 'open_ended') {
                $correctAnswer = $question['correct_answer'];

                if (strtolower($userAnswer) === strtolower($correctAnswer)) {
                    $correctAnswers++;
                }
            }
        }

        $proportionCorrect = $correctAnswers / $totalQuestions;
        $score = $proportionCorrect * 10;

        return min(max($score, 0), 10);
    }

    public function delete($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->delete();
        return redirect()->route('dashboard');
    }
}
