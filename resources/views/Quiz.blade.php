<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1 class="text-lg"><strong>{{ $quizData['quiz_title'] }}</strong></h1>
                        <form action="{{ route('quiz.submit', $quizId) }}" method="POST">
                            @csrf
                            @foreach ($quizData['questions'] as $index => $question)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <p><strong>Question {{ $index + 1 }}:</strong> {{ $question['question'] }}
                                        </p>

                                        @if ($question['type'] === 'multiple_choice')
                                            @foreach ($question['options'] as $optionIndex => $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="answers[{{ $index }}][]"
                                                        id="option_{{ $index }}_{{ $optionIndex }}"
                                                        value="{{ $optionIndex }}">
                                                    <label class="form-check-label"
                                                        for="option_{{ $index }}_{{ $optionIndex }}">
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @elseif ($question['type'] === 'single_choice')
                                            @foreach ($question['options'] as $optionIndex => $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="answers[{{ $index }}]"
                                                        id="option_{{ $index }}_{{ $optionIndex }}"
                                                        value="{{ $optionIndex }}">
                                                    <label class="form-check-label"
                                                        for="option_{{ $index }}_{{ $optionIndex }}">
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @elseif ($question['type'] === 'open_ended')
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="answers[{{ $index }}]" placeholder="Your Answer"
                                                    required>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit"
                                class="text-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Submit Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
