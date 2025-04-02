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
    <div class="flex h-screen">
        @include('layouts.navUser')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-8">
            <!-- Header du cours -->
            <div class="bg-white rounded-2xl p-8 mb-8 card-shadow">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Mathématiques - Analyse</h1>
                <p class="text-gray-600">Progression globale du cours</p>
            </div>

            <!-- Liste des chapitres -->
            <div class="space-y-4">
                <!-- Chapitre 01 -->
                <div class="bg-white rounded-xl p-6 card-shadow hover-scale cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-cream rounded-lg flex items-center justify-center">
                                <i class="fas fa-wave-square text-orange-primary text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold">Chapitre 01 : Continuité</h2>
                                <p class="text-gray-500 text-sm">Dernière visite le 29/12/2024</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-8">
                            <span class="text-2xl font-bold text-orange-primary">3%</span>
                            <span class="text-gray-500">Partie 1/11</span>
                        </div>
                    </div>
                    <div class="mt-4 bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-primary h-2 rounded-full" style="width: 3%"></div>
                    </div>
                </div>

                <!-- Chapitre 02 -->
                <div class="bg-white rounded-xl p-6 card-shadow hover-scale cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-cream rounded-lg flex items-center justify-center">
                                <i class="fas fa-square-root-alt text-orange-primary text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold">Chapitre 02 : La fonction racine n-ième</h2>
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-500">Partie 0/5</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-8">
                            <span class="text-2xl font-bold text-orange-primary">0%</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- Sous-parties -->
                        <div class="ml-16 space-y-3 mt-4">
                            <a href="{{ route('ContenuCour') }}" class="block">
                                <div class="flex items-center justify-between p-4 bg-cream rounded-lg hover:bg-yellow-light transition-all">
                                    <div>
                                        <span class="text-green-500 font-medium">PARTIE 1 :</span>
                                        <span class="ml-2">La fonction racine n-ième</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-orange-primary font-bold">0%</span>
                                        <span class="text-gray-500">Étape 0/5</span>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="flex items-center justify-between p-4 bg-cream rounded-lg">
                                <div>
                                    <span class="text-green-500 font-medium">PARTIE 2 :</span>
                                    <span class="ml-2">Calcul de limites</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-orange-primary font-bold">0%</span>
                                    <span class="text-gray-500">Étape 0/3</span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-cream rounded-lg">
                                <div>
                                    <span class="text-green-500 font-medium">PARTIE 3 :</span>
                                    <span class="ml-2">Puissance rationnelle d'un nombre strictement positif</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-orange-primary font-bold">0%</span>
                                    <span class="text-gray-500">Étape 0/3</span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-cream rounded-lg">
                                <div>
                                    <span class="text-green-500 font-medium">PARTIE 4 :</span>
                                    <span class="ml-2">Quiz final</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-orange-primary font-bold">0%</span>
                                    <span class="text-gray-500">Étape 0/1</span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-cream rounded-lg">
                                <div>
                                    <span class="text-green-500 font-medium">PARTIE 5 :</span>
                                    <span class="ml-2">Série d'exercices</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-orange-primary font-bold">0%</span>
                                    <span class="text-gray-500">Étape 0/6</span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>