<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-4">Quiz Result</h1>
                    <p>Uw cijfer: {{ $score }}</p>
                    <h2 class="text-xl font-semibold mt-4">Fouten:</h2>
                    @foreach ($quizData['questions'] as $index => $question)
                        <div class="mb-4">
                            <p><strong>Vraag {{ $index + 1 }}:</strong> {{ $question['question'] }}</p>
                            @if ($question['type'] === 'multiple_choice')
                                <p><strong>Uw antwoord:</strong>
                                    @if (is_array($userAnswers[$index]))
                                        {{ implode(
                                            ', ',
                                            array_map(function ($optionIndex) use ($question) {
                                                return $question['options'][$optionIndex];
                                            }, $userAnswers[$index]),
                                        ) }}
                                    @else
                                        {{ $question['options'][$userAnswers[$index]] }}
                                    @endif
                                </p>
                                <p><strong>Goede antwoorden:</strong>
                                    @foreach ($question['correct_options'] as $correctOptionIndex)
                                        {{ $question['options'][$correctOptionIndex] }},
                                    @endforeach
                                </p>
                            @elseif ($question['type'] === 'single_choice')
                                <p><strong>Uw antwoord:</strong> {{ $question['options'][$userAnswers[$index]] }}</p>
                                <p><strong>Goede antwoorden:</strong>
                                    {{ $question['options'][$question['correct_option']] }}</p>
                            @elseif ($question['type'] === 'open_ended')
                                <p><strong>Uw antwoord:</strong> {{ $userAnswers[$index] }}</p>
                                <p><strong>Goede antwoorden:</strong> {{ $question['correct_answer'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
