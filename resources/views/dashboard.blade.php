<x-app-layout>

    <div class="py-12">
        <div class="grid grid-cols-3 max-w-9xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2">
                @foreach ($quizzes as $quiz)
                    <div class="p-6 text-gray-900">
                        <li>
                            <h2>{{ $quiz['quiz_title'] }}</h2>
                            <p>{{ $quiz['quiz_explanation'] }}</p>
                            <a href="{{ route('quiz.show', ['quizId' => $quiz['id']]) }}" class="btn btn-primary">Start
                                Quiz</a>
                        </li>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
