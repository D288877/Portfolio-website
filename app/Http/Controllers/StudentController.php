<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function view()
    {
        $results = QuizResult::get();
        $quizTitles = [];

        foreach ($results as $result) {
            $quizId = $result->quizzes_id;
            $quiz = Quiz::findOrFail($quizId);
            $quizData = json_decode(File::get(storage_path('app/public/' . $quiz->quiz_data)), true);
            $quizTitle = $quizData['quiz_title'];
            $quizTitles[$quizId] = $quizTitle;
        }
        return view('Studentview', compact('results', 'quizTitles'));
    }
}
