
<?php 
   // dd($partieCour);
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
    
    <script>
        MathJax = {
            tex: {
                inlineMath: [
                    ['$', '$'],
                    ['\\(', '\\)']
                ]
            },
            svg: {
                fontCache: 'global'
            }
        };
    </script>
    
    
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
    <script>
        function toggleCorrection(exerciseId) {
            const correction = document.getElementById(`correction-${exerciseId}`);
            const button = document.getElementById(`button-${exerciseId}`);
            
            if (correction.classList.contains('hidden')) {
                correction.classList.remove('hidden');
                button.innerHTML = '<i class="fas fa-eye-slash mr-2"></i>Masquer la correction';
            } else {
                correction.classList.add('hidden');
                button.innerHTML = '<i class="fas fa-eye mr-2"></i>Afficher la correction';
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
                        <h1 class="text-2xl md:text-3xl font-bold text-orange-primary mb-2">{{ $partieCour->titre}} (Exercices)</h1>
                        <p class="text-gray-600">Chapitre {{ sprintf("%02d",$partieCour->order)}}</p>
                    </div>
                    <button class="bg-orange-primary text-white px-4 md:px-6 py-2 md:py-3 rounded-xl hover:bg-orange-light transition-all">
                        <i class="fas fa-crown mr-2"></i>Premium Active
                    </button>
                </div>
            </div>

            <!-- Video Section -->
            

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Course Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Exercice 1 -->
                    <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                        <!-- Énoncé -->
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="p-3 rounded-xl bg-blue-100">
                                <i class="fas fa-pencil-alt text-xl text-blue-500"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Exercice d'application 1</h2>
                            </div>
                        </div>
                        <div class="rounded-xl p-4 mb-4" style="background-color: rgba(219, 234, 254, var(--tw-bg-opacity))">
                            {!! $partieCour->contenu_exercice !!}
                        </div>

                        <!-- Bouton Afficher/Masquer -->
                        <button 
                            id="button-1"
                            onclick="toggleCorrection(1)"
                            class="w-full bg-orange-primary text-white px-4 py-2 rounded-xl hover:bg-orange-light transition-all">
                            <i class="fas fa-eye mr-2"></i>Afficher la correction
                        </button>

                        <!-- Correction (cachée par défaut) -->
                        <div id="correction-1" class="hidden mt-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <div class="p-3 rounded-xl bg-pink-100">
                                    <i class="fas fa-check text-xl text-pink-500"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Correction</h2>
                                </div>
                            </div>
                            <div class="rounded-xl p-4" style="background-color: rgba(246, 209, 205, var(--tw-bg-opacity))">
                                
                                <!-- Vidéo correction -->
                                <div class="aspect-w-16 aspect-h-9 mb-4">
                                    <iframe class="w-full h-[300px] rounded-xl" 
                                            src="{{ $partieCour->solution_exercice_video }}"
                                            frameborder="0" 
                                            allowfullscreen>
                                    </iframe>
                                </div>

                                <!-- Solution écrite -->
                                <div class="space-y-4">
                                    {!! $partieCour->solution_exercice_text !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                @include('layouts.right_sidbarContenuCour')
            </div>
        </div>
    </div>
</body>
</html>
