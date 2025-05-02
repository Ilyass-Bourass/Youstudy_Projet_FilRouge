<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - YouStudy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <!-- Header -->
            <div class="bg-white rounded-2xl p-4 md:p-8 mb-8 card-shadow hover-scale">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-orange-primary mb-2">Bienvenue,
                            {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-gray-600">
                            @if (isset(Auth::user()->niveau))
                                <span class="font-medium">Niveau actuel:
                                    <span class="text-orange-primary">
                                        @if (Auth::user()->niveau == 'tron_commun')
                                            Tronc Commun
                                        @elseif(Auth::user()->niveau == 'premier_bac')
                                            1ère Année Bac
                                        @elseif(Auth::user()->niveau == 'deuxieme_bac')
                                            2ème Année Bac
                                        @else
                                            Non défini
                                        @endif
                                    </span>
                                </span>
                            @else
                                Veuillez choisir votre niveau d'étude pour commencer
                            @endif
                        </p>
                    </div>
                    @if (Auth::user()->role == 'user_premium')
                        <div class="bg-yellow-light text-orange-primary font-semibold px-4 py-2 rounded-full">Premium
                            Member</div>
                    @else
                        <a href="#"
                            class="bg-orange-primary text-white px-6 py-3 rounded-xl hover:bg-orange-light transition-all">
                            <i class="fas fa-crown mr-2"></i>Devenir Premium
                        </a>
                    @endif
                </div>
            </div>

            <!-- Global Stats Cards -->
            <h2 class="text-xl md:text-2xl font-bold text-orange-primary mb-6">Statistiques de YouStudy</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center">
                        <div class="rounded-full bg-yellow-light p-3">
                            <i class="fas fa-book text-xl text-orange-primary"></i>
                        </div>
                        <span class="text-3xl font-bold text-orange-primary">{{ $statistiques['nombreCoursDisponibles']}}</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-gray-800 font-medium">Cours disponibles</span>
                        <p class="text-gray-500 text-sm mt-1">Accédez à tous nos cours dans les 3 matières principales
                        </p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center">
                        <div class="rounded-full bg-yellow-light p-3">
                            <i class="fas fa-question-circle text-xl text-orange-primary"></i>
                        </div>
                        <span class="text-3xl font-bold text-orange-primary">{{ $statistiques['nombreQustions']}}+</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-gray-800 font-medium">Questions de quiz</span>
                        <p class="text-gray-500 text-sm mt-1">Testez vos connaissances avec nos quiz interactifs</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center">
                        <div class="rounded-full bg-yellow-light p-3">
                            <i class="fas fa-crown text-xl text-orange-primary"></i>
                        </div>
                        <span class="text-3xl font-bold text-orange-primary">{{ $statistiques['nombreUserPremium']}}+</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-gray-800 font-medium">Membres Premium</span>
                        <p class="text-gray-500 text-sm mt-1">Utilisateurs profitant d'un accès illimité</p>
                    </div>
                </div>
            </div>

            <!-- Platform Information Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 card-shadow hover-scale">
                    <h3 class="text-lg font-bold text-orange-primary flex items-center mb-4">
                        <i class="fas fa-star-half-alt mr-2"></i> Matières disponibles
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-calculator text-blue-500"></i>
                            </div>
                            <div>
                                <p class="font-medium">Mathématiques</p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <span>{{ $statistiques['nombreCoursMathematiques']}} cours disponibles</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                <i class="fas fa-atom text-green-500"></i>
                            </div>
                            <div>
                                <p class="font-medium">Physique-Chimie</p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <span>{{ $statistiques['nombreCoursPhysique']}} cours disponibles</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-dna text-purple-500"></i>
                            </div>
                            <div>
                                <p class="font-medium">Sciences de la Vie et de la Terre</p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <span>{{ $statistiques['nombreCoursSvt']}}  cours disponibles</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 card-shadow hover-scale">
                    <h3 class="text-lg font-bold text-orange-primary flex items-center mb-4">
                        <i class="fas fa-gift mr-2"></i> Avantages Premium
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="text-green-500 mr-3"><i class="fas fa-check-circle"></i></div>
                            <p>Accès à toutes les vidéos explicatives des cours</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-green-500 mr-3"><i class="fas fa-check-circle"></i></div>
                            <p>Solutions détaillées pour tous les exercices</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-green-500 mr-3"><i class="fas fa-check-circle"></i></div>
                            <p>Quiz illimités pour tester vos connaissances</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-green-500 mr-3"><i class="fas fa-check-circle"></i></div>
                            <p>Contenus exclusifs et mises à jour régulières</p>
                        </div>

                        @if (Auth::user()->role != 'user_premium')
                            <a href="#"
                                class="block text-center mt-4 bg-orange-primary text-white px-6 py-3 rounded-xl hover:bg-orange-light transition-all">
                                <i class="fas fa-crown mr-2"></i>Passer à Premium
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Call To Action -->
            <div
                class="bg-gradient-to-r from-orange-primary to-orange-light rounded-2xl p-6 md:p-8 mb-8 text-white text-center">
                <h3 class="text-xl font-bold mb-2">Commencez à apprendre maintenant !</h3>
                <p class="mb-6 max-w-lg mx-auto">Accédez à tous nos cours selon votre niveau et améliorez vos
                    connaissances dans les matières scientifiques</p>
                <a href="{{ route('partie_cour') }}"
                    class="inline-block bg-white text-orange-primary font-medium px-6 py-3 rounded-xl hover:bg-yellow-light transition-all">
                    <i class="fas fa-book-open mr-2"></i>Explorer les cours
                </a>
            </div>
        </div>
    </div>
</body>

</html>
