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
                        <h1 class="text-2xl md:text-3xl font-bold text-orange-primary mb-2">La fonction racine n-ième (Cours)</h1>
                        <p class="text-gray-600">Chapitre 02 - Partie 1/5</p>
                    </div>
                    <button class="bg-orange-primary text-white px-4 md:px-6 py-2 md:py-3 rounded-xl hover:bg-orange-light transition-all">
                        <i class="fas fa-crown mr-2"></i>Premium Active
                    </button>
                </div>
            </div>

            <!-- Video Section -->
            <div class="bg-white rounded-2xl overflow-hidden mb-8 card-shadow hover-scale">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-[400px]" src="https://www.youtube.com/embed/votre_video_id" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Course Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Définition -->
                    <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="p-3 rounded-xl bg-pink-100">
                                <i class="fas fa-book text-xl text-pink-500"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Définition</h2>
                            </div>
                        </div>
                        <div class="rounded-xl p-4" style="background-color: rgba(246, 209, 205, var(--tw-bg-opacity))">
                            <p class="mb-2">Soit n ∈ ℕ,</p>
                            <p class="mb-2">La fonction x ↦ xⁿ est continue et strictement croissante sur ℝ⁺.</p>
                            <p class="mb-2">Elle admet donc une fonction réciproque que l'on nomme « racine n-ième », et on a :</p>
                            <ul class="list-disc list-inside space-y-2 pl-4">
                                <li>Pour tout x ∈ ℝ⁺: xⁿ = y ⇔ ⁿ√y = x.</li>
                                <li>f⁻¹: x ↦ ⁿ√x est continue et strictement croissante sur ℝ⁺.</li>
                                <li>ⁿ√x = x et ⁿ√x = √x.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Propriété -->
                    <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="p-3 rounded-xl bg-amber-100">
                                <i class="fas fa-lightbulb text-xl text-amber-500"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Propriété</h2>
                            </div>
                        </div>
                        <div class="rounded-xl p-4" style="background-color: rgba(255, 232, 174, var(--tw-bg-opacity))">
                            <p class="mb-2">Soient x ∈ ℝ⁺, y ∈ ℝ⁺, n ∈ ℕ* et m ∈ ℕ* on a :</p>
                            <ul class="list-disc list-inside space-y-2 pl-4">
                                <li>ⁿ√x = x</li>
                                <li>ⁿ√xⁿ = x</li>
                                <li>ⁿ√xy = ⁿ√x × ⁿ√y</li>
                                <li>ⁿ√(x/y) = ⁿ√x/ⁿ√y</li>
                                <li>ⁿ√x^m = x^(m/n)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Exemple -->
                    <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="p-3 rounded-xl bg-gray-100">
                                <i class="fas fa-pencil text-xl text-gray-500"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Exemple</h2>
                            </div>
                        </div>
                        <div class="rounded-xl p-4" style="background-color: rgba(229, 231, 235, var(--tw-bg-opacity))">
                            <ul class="list-disc list-inside space-y-2 pl-4">
                                <li>³√27 = 3</li>
                                <li>⁷√7⁷ = 7</li>
                                <li>⁴√7² = 7^(2/4) = 7^(1/2) = √7</li>
                                <li>²√(7 × π) = √7 × √π</li>
                            </ul>
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
