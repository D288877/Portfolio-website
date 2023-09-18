<x-app-layout>

    <div class="py-12">
        <div class="grid grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/quiz/create" method="POST" class="ml-3 w-40" enctype="multipart/form-data">
                        @csrf
                        <label for="quiz_data">Quiz Data (JSON file):</label>
                        <input type="file" name="quiz_data" id="quiz_data" class="my-3">
                        <x-input-error :messages="$errors->get('quiz_data')" class="mt-2" />
                        <x-primary-button type="submit">Submit</x-primary-button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ml-3">
                <div class="p-6 text-gray-900">
                    <p>
                        Format uw json file zo:<br>
                        { <br>
                        "quiz_title": "General Knowledge Quiz", <br>
                        "quiz_explanation": "Test your general knowledge with this quiz!", <br>
                        "questions": [ <br>
                        { <br>
                        "type": "multiple_choice", <br>
                        "question": "What is the capital of France?", <br>
                        "options": [ <br>
                        "Paris", <br>
                        "London", <br>
                        "Berlin", <br>
                        "Madrid" <br>
                        ], <br>
                        "correct_options": [0] <br>
                        }, <br>
                        { <br>
                        "type": "single_choice", <br>
                        "question": "What is 2 + 2?", <br>
                        "options": [ <br>
                        "3", <br>
                        "4", <br>
                        "5", <br>
                        "6" <br>
                        ], <br>
                        "correct_option": 1 <br>
                        }, <br>
                        { <br>
                        "type": "open_ended", <br>
                        "question": "What is your favorite color?", <br>
                        "correct_answer": "Blue" <br>
                        }, <br>
                        { <br>
                        "type": "multiple_choice", <br>
                        "question": "Which planet is known as the Red Planet?", <br>
                        "options": [ <br>
                        "Earth", <br>
                        "Mars", <br>
                        "Venus", <br>
                        "Jupiter" <br>
                        ], <br>
                        "correct_options": [1] <br>
                        }, <br>
                        { <br>
                        "type": "single_choice", <br>
                        "question": "Who wrote the play 'Romeo and Juliet'?", <br>
                        "options": [ <br>
                        "Charles Dickens", <br>
                        "William Shakespeare", <br>
                        "Jane Austen", <br>
                        "Leo Tolstoy" <br>
                        ], <br>
                        "correct_option": 1 <br>
                        } <br>
                        ] <br>
                        } <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
