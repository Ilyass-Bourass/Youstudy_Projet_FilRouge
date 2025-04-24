<?php
// dd($userNiveau);
?>

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
        <div class="flex-1 overflow-auto p-4 md:p-8">
            <!-- Header du cours -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
            <div class="bg-white rounded-xl p-6 md:p-8 card-shadow w-full">
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-4">Mes Cours</h1>
                <p class="text-sm md:text-base text-gray-600">Progression globale des cours</p>
                <div class="mt-4 bg-gray-200 rounded-full h-2">
                <div class="bg-orange-primary h-2 rounded-full" style="width:10%"></div>
                </div>
                <p class="text-sm md:text-base text-gray-600 mt-2">Mathématiques - Niveau :
                <span class="font-semibold">{{ $userNiveau }}</span>
                </p>
            </div>
            <div>
                <form method="GET" action="{{ route('ChangerNiveau') }}" class="flex items-center space-x-4">
                <select
                    class="w-full md:w-auto bg-white border border-gray-300 text-gray-700 py-2 md:py-3 px-3 md:px-4 pr-8 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-primary"
                    name="niveau" id="niveau" onchange="this.form.submit()">
                    <option value="">-- Choisir votre niveau --</option>
                    <option value="tron_commun" {{ $userNiveau == 'tron_commun' ? 'selected' : '' }}>Tronc
                    commun</option>
                    <option value="premier_bac" {{ $userNiveau == 'premier_bac' ? 'selected' : '' }}>Première
                    année Bac</option>
                    <option value="deuxieme_bac" {{ $userNiveau == 'deuxieme_bac' ? 'selected' : '' }}>Deuxième
                    année Bac</option>
                </select>
                </form>
            </div>
            </div>

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Succès !</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Liste des cours -->
            <div class="space-y-4">
            @forelse ($cours as $index => $cour)
                <!-- Cours {{ $index + 1 }} -->
                <div class="bg-white rounded-xl p-6 card-shadow hover-scale cursor-pointer" onclick="toggleParts({{ $index }})">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-cream rounded-lg flex items-center justify-center">
                        @if ($cour->matiere_cour == 'math')
                        <i class="fas fa-square-root-alt text-orange-primary text-xl"></i>
                        @elseif($cour->matiere_cour == 'pc')
                        <i class="fas fa-atom text-orange-primary text-xl"></i>
                        @else
                        <i class="fas fa-leaf text-orange-primary text-xl"></i>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">Chapitre {{ sprintf('%02d', $index + 1) }} :
                        {{ $cour->titre }}</h2>
                        <p class="text-gray-500 text-sm">
                        {{ ucfirst(str_replace('_', ' ', $cour->matiere_cour)) }}</p>
                    </div>
                    </div>
                    <div class="flex items-center space-x-8">
                    <span class="text-2xl font-bold text-orange-primary">0%</span>
                    <span class="text-gray-500">Cour {{ $index + 1 }}/{{ count($cours) }}</span>
                    </div>
                </div>
                <div class="mt-4 bg-gray-200 rounded-full h-2">
                    <div class="bg-orange-primary h-2 rounded-full" style="width: 0%"></div>
                </div>

                <!-- Sous-parties du cours -->
                @if (count($cour->parties) > 0)
                    <div id="parts-{{ $index }}" class="ml-16 space-y-3 mt-4 hidden">
                    @foreach ($cour->parties as $partie)
                         <a href="{{ route('ContenuCour', $partie->id) }}" class="block">
                        <div
                            class="flex items-center justify-between p-4 bg-cream rounded-lg hover:bg-yellow-light transition-all">
                            <div>
                            <span class="text-green-500 font-medium">PARTIE
                                {{ $partie->order }}/{{ count($cour->parties) }}</span>
                            <span class="ml-2">{{ $partie->titre }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                            <span class="text-orange-primary font-bold">0%</span>
                            <span class="text-gray-500">Non commencé</span>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </div>
                        </a>
                    @endforeach
                    </div>
                @else
                    <div class="ml-16 mt-4 text-gray-500 italic">Aucune partie disponible pour ce cours</div>
                @endif
                </div>
            @empty
                <div class="bg-white rounded-xl p-6 card-shadow text-center">
                <p class="text-gray-500">Aucun cours disponible pour votre niveau actuel.</p>
                </div>
            @endforelse
            </div>
        </div>

        <script>
            function toggleParts(index) {
            const parts = document.getElementById(`parts-${index}`);
            if (parts) {
                parts.classList.toggle('hidden');
            }
            }
        </script>
    </div>
    
</body>

</html>
