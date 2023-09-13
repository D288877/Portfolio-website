<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1>Quiz</h1>
                        <form action="{{ route('quiz.submit') }}" method="POST">
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
                                                        name="answers[{{ $index }}][{{ $optionIndex }}]"
                                                        id="option_{{ $index }}_{{ $optionIndex }}">
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
                            <button type="submit" class="btn btn-primary">Submit Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
