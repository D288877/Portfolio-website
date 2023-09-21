<x-app-layout>

    <div class="py-12">
        <div class="grid grid-cols-3 max-w-9xl sm:px-6 lg:px-8">
            @foreach ($quizDataArray as $quizData)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2">
                    <div class="p-6 text-gray-900 text-center">
                        @if (Auth::user()->is_admin)
                            <a class="text-red-500 inline-block"
                                href="{{ route('deletequiz', ['quizId' => $quizData['quizID']]) }}"><x-heroicon-o-trash
                                    class="w-5" /></a>
                        @endif
                        <h2 class="font-bold">{{ $quizData['quizTitle'] }}</h2>
                        <p class="my-3">{{ $quizData['quizExplanation'] }}</p>
                        <a href="{{ route('quiz', ['quizId' => $quizData['quizID']]) }}"
                            class="text-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Start
                            Quiz</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
