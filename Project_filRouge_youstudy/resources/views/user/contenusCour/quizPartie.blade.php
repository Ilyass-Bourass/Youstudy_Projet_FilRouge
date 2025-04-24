<?php
//dd($questionsQuiz);
//dd($partieCour);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours - YouStudy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- KaTeX pour les formules mathématiques -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <style>
        :root {
            --orange-primary: #FF7D29;
            --orange-light: #FFBF78;
            --yellow-light: #FFEEA9;
            --cream: #FEFFD2;
            --white: #FFFFFF;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-scale {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .progress-animation {
            transition: width 1s ease-in-out;
        }

        .card-shadow {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: var(--orange-primary);
            color: white;
            transform: translateX(10px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--orange-primary), var(--orange-light));
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'orange-primary': '#FF7D29',
                        'orange-light': '#FFBF78',
                        'yellow-light': '#FFEEA9',
                        'cream': '#FEFFD2',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-cream">
    <div class="flex">
        @include('layouts.navUser')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4 md:p-8">
            <!-- Breadcrumb -->
            <div class="flex items-center mb-6 text-sm">
                <a href="{{ route('myCourses') }}" class="text-gray-500 hover:text-orange-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour aux chapitres
                </a>
            </div>

            <!-- Course Title -->
            <div class="bg-white rounded-2xl p-4 md:p-8 mb-8 card-shadow hover-scale">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-orange-primary mb-2">{{ $partieCour->titre }}
                            (Mini Quiz)</h1>
                        <p class="text-gray-600">Chapitre {{ sprintf('%02d', $partieCour->order) }}</p>
                    </div>
                    @if(Auth::user()->role == 'user_premium')
                        <div class="bg-yellow-light text-orange-primary font-semibold px-4 py-2 rounded-full">Premium Member</div>
                    @else
                    <button class="bg-green-primary text-white px-6 py-3 rounded-xl hover:bg-orange-light transition-all">
                        <i class="fas fa-crown mr-2"></i>Premium Active
                    </button>
                    @endif
                </div>
            </div>



            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Course Content -->
                <!-- Messages de succès et d'erreur -->
                <div class="lg:col-span-3 mb-6">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Bravo!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Erreur!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-6 card-shadow mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Mini Quiz - </h2>

                        @if(Auth::user()->role == 'user_premium')
                            <!-- Mini Quiz Form -->
                            <form action="{{ route('traitementQuiz') }}" method="POST" class="space-y-8">
                                @csrf

                                @foreach ($questionsQuiz as $index => $question)
                                    <div class="p-4 bg-yellow-light bg-opacity-30 rounded-xl shadow-sm">
                                        <h3 class="font-semibold text-gray-800 mb-4">
                                            <span class="text-red-500 font-size-16">Question
                                                {{ sprintf('%02d', $index + 1) }} :</span>
                                            {{ $question->question }}
                                        </h3>

                                        <!-- Hidden inputs -->
                                        <input type="hidden" name="correct_answers[{{ $question->id }}]"
                                            value="{{ $question->correct_answer }}">
                                        <input type="hidden" name="quiz_id" value="{{ $question->quiz_id }}">

                                        <div class="space-y-3">
                                            @foreach ($question->propositions as $key => $proposition)
                                                <label
                                                    class="flex items-center p-3 bg-white rounded-lg hover:bg-orange-light hover:text-white transition-all cursor-pointer">
                                                    <input type="radio" required name="question[{{ $question->id }}]"
                                                        value={{ $key + 1 }} class="mr-3">
                                                    <span>{{ $proposition }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Submit Button -->
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-orange-primary text-white px-6 py-3 rounded-xl hover:bg-orange-light transition-all">
                                        Valider mes réponses
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="flex flex-col items-center justify-center p-8 text-center">
                                <i class="fas fa-crown text-6xl text-orange-primary mb-4"></i>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Contenu Premium</h3>
                                <p class="text-gray-600 mb-6">Ce quiz est réservé aux membres premium</p>
                                <a href="#" class="bg-orange-primary text-white px-8 py-3 rounded-xl hover:bg-orange-light transition-all">
                                    <i class="fas fa-crown mr-2"></i>Activer Premium
                                </a>
                            </div>
                        @endif
                    </div>
                </div>


                <!-- Right Sidebar -->
                @include('layouts.right_sidbarContenuCour')
            </div>
        </div>
    </div>
</body>

</html>
